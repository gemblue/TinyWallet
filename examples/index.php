<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require __DIR__ . '/../autoload.php';

use Gemblue\Wallet\Wallet;

$wallet = new Wallet;

/*
// Income.
$wallet->record([
    'subject_id' => 1,
    'status' => 'CONFIRMED',
    'type' => 'INCOME',
    'currency' => 'IDR',
    'amount' => 10000,
    'code' => NULL,
    'metadata' => NULL
]);

// Withdrawal.
$wallet->record([
    'subject_id' => 1,
    'status' => 'CONFIRMED',
    'type' => 'WITHDRAWAL',
    'currency' => 'IDR',
    'amount' => 5000,
    'code' => NULL,
    'metadata' => NULL
]);

$wallet->syncronize();
*/

echo $wallet->getBalance(1);