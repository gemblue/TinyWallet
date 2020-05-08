<?php

/**
 * Log
 * 
 * Repository for log. Just wrap mysqli. Not ORM/Object approach.
 * Hail SQL.
 * 
 * @package Log
 * @author Gemblue
 */

namespace Gemblue\TinyWallet\Repository;

class Log extends Repository {

    /** Table */
    protected $table = 'wallet_transaction_log';
    protected $transaction = 'wallet_transaction';
    
    /**
     * Construct.
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();        
    }
    
    /**
     * Save.
     */
    public function save(array $args) : bool {
        
        $date = date('Y-m-d H:i:s');

        $sql  = "INSERT INTO {$this->table} SET ";
        $sql .= "transaction_id = \"{$args['transaction_id']}\", ";
        $sql .= "status = \"{$args['status']}\", ";
        $sql .= "created_at = \"{$date}\" ";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to insert ..');    
        
        return mysqli_insert_id($this->connection);
    }

    /**
     * Get.
     */
    public function getConfirmedLogs($fields = '*', $limit = null, $order = 0) : array {
        
        $sql  = "SELECT t1.{$fields}, t2.subject_id, t2.amount, t2.type FROM {$this->table} as t1 JOIN {$this->transaction} as t2 ON t1.transaction_id = t2.id ";
        $sql .= "WHERE t1.status = \"CONFIRMED\" ";

        if ($limit != null) {
            $sql  .= "LIMIT {$limit}";
        }

        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    
        
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
}