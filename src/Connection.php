<?php

/**
 * Connection
 * 
 * Simple connection class.
 * 
 * @author Gemblue
 */

namespace Gemblue\TinyWallet;

class Connection {

    public $host;
    public $username;
    public $password;
    public $database;
    public $subject_table;
    
    /**
     * Construct.
     */
    public function __construct() {

        // Inject config.
        require __DIR__ . '/Config/database.php';

        // Put to property.
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->subject_table = $config['subject_table'];
    }
}

