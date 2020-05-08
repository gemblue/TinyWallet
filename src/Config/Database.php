<?php namespace Gemblue\TinyWallet\Config;

/**
 * Config
 * 
 * Config array files.
 * 
 * @package Config
 * @author Gemblue
 */

class Database {

    public $config;

    public function __construct()
    {
    	$this->config['host'] 	  = $_ENV['DBHOST'] ?? 'localhost';
	    $this->config['username'] = $_ENV['DBUSER'] ?? 'app';
	    $this->config['password'] = $_ENV['DBPASS'] ?? '12345678';
	    $this->config['database'] = $_ENV['DBNAME'] ?? '_wallets';
    }

}