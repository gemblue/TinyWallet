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

    public $connection;
    public $subject_table;

    /**
     * Construct.
     */
    public function __construct(array $dbconfig)
    {
        $this->connection = mysqli_connect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']);
        
        if ($this->connection == NULL) {
            throw new \Exception('Failed to connect with database');
        }

        $this->subject_table = $dbconfig['subject_table'];
    }
}

