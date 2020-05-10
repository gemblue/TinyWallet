<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require __DIR__ . '/../autoload.php';

// Create wallet.
$wallet = \Gemblue\TinyWallet\Factory::getInstance([
    'host' => 'localhost',
    'username' => 'app',
    'password' => '12345',
    'database' => '_menit',
    'subjectTable' => 'users'
]);

// $wallet->record([
//     'subject_id' => 1,
//     'status' => 'CONFIRMED',
//     'type' => 'INCOME',
//     'currency' => 'IDR',
//     'amount' => 5000,
//     'code' => NULL,
//     'metadata' => NULL
// ]);

// $wallet->record([
//     'subject_id' => 1,
//     'status' => 'CONFIRMED',
//     'type' => 'WITHDRAWAL',
//     'currency' => 'IDR',
//     'amount' => 2000,
//     'code' => NULL,
//     'metadata' => NULL
// ]);

$wallet->syncronize();