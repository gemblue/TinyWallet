<?php

/**
 * Wallet
 * 
 * Facade interface to hide submodule complexity. 
 * Make us easy to communicate wallet module
 * 
 * @package Wallet
 * @author Oriza
 */

namespace Gemblue\Wallet;

use Gemblue\Wallet\Repository\Log;
use Gemblue\Wallet\Repository\Ledger;
use Gemblue\Wallet\Repository\Transaction;

class Wallet {
    
    /** Props */
    protected $log;
    protected $Ledger;
    protected $transaction;
    protected $credit = ['TOPUP', 'HOLD', 'PAYMENT', 'INCOME'];
    protected $debit = ['WITHDRAWAL', 'FEE'];

    public function __construct() {
        
        $this->log = new Log;
        $this->ledger = new Ledger;
        $this->transaction = new Transaction;
        
    }

    /**
     * Get user latest balance
     */
    public function getBalance(int $subjectId) : int {
        return $this->ledger->getSummary($subjectId);
    }

    /**
     * To record transaction.
     */
    public function record(array $args) : bool {
        
        /** Save transaction. */
        $id = $this->transaction->save([
            'subject_id' => $args['subject_id'],
            'type' => $args['type'],
            'currency' => $args['currency'],
            'amount' => $args['amount'],
            'code' => $args['code'],
            'metadata' => $args['metadata']
        ]);
        
        /** Save log. */
        $this->log->save([
            'transaction_id' => $id,
            'status' => $args['status'],
        ]);
        
        return true;    
    }

    /**
     * To Sync Ledgers and update wallet balance.
     */
    public function syncronize() : bool {
        
        // Get confirmed transaction log.
        $logs = $this->log->getConfirmedLogs();
        
        // Insert into ledger.
        foreach ($logs as $log) {

            $type = $log['type'];
            
            if (in_array($log['type'], $this->credit)) {
                $entry = 'CREDIT';
                $amount = $log['amount'];
            } else {
                $entry = 'DEBIT';
                $amount = '-' . $log['amount'];
            }

            $this->ledger->save([
                'subject_id' => $log['subject_id'],
                'transaction_id' => $log['transaction_id'],
                'amount' => $amount,
                'entry' => $entry
            ]);            
        }
        
        return true;
    }
}