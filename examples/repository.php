<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require __DIR__ . '/../autoload.php';

use Gemblue\Wallet\Repository\Transaction;
use Gemblue\Wallet\Repository\Log;
use Gemblue\Wallet\Repository\Ledger;

$transaction = new Transaction;

$id = $transaction->save([
    'subject_id' => 1,
    'type' => 'PAYMENT',
    'currency' => 'IDR',
    'amount' => 15000,
    'code' => NULL,
    'metadata' => NULL
]);
echo $id;

exit;

$transaction->delete(11);
print_r($transaction->get());

$transaction->update(6, [
    'type' => 'PAYMENT',
    'code' => 'CODE12'
]);

$log = new Log;

$id = $log->save([
    'transaction_id' => 1,
    'status' => 'CONFIRMED',
]);
echo $id;

print_r($log->get());

$ledger = new Ledger;

$id = $ledger->save([
    'subject_id' => 1,
    'transaction_id' => 1,
    'amount' => 13000,
    'entry' => 'DEBET',
]);
echo $id;

print_r($ledger->get());