<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require __DIR__ . '/../autoload.php';

// Create wallet.
$wallet = \Gemblue\TinyWallet\Factory::getInstance([
    'host' => 'localhost',
    'username' => $_ENV['DBUSER'],
    'password' => $_ENV['DBPASS'],
    'database' => $_ENV['DBNAME'],
    'subjectTable' => 'mein_users'
]);

$wallet->record([
    'subject_id' => 1,
    'status' => 'CONFIRMED',
    'type' => 'INCOME',
    'currency' => 'IDR',
    'amount' => 10000,
    'code' => NULL,
    'metadata' => NULL
]);