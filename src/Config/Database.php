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
    	// $this->config['host'] 	  = 'localhost';
	    // $this->config['username'] = 'app';
	    // $this->config['password'] = '12345678';
	    // $this->config['database'] = '_codepolitan';
    	$this->config['host'] 	  = 'localhost';
	    $this->config['username'] = 'root';
	    $this->config['password'] = 'root';
	    $this->config['database'] = 'codepolitan_prod';
	    $this->config['subject_table'] = 'mein_users';
    }

}