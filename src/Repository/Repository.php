<?php

/**
 * Repository
 * 
 * Parent class of all repository.
 * Repository is responsible to wrap mysqli extension / persistence.
 * 
 * @package Repository
 * @author Gemblue
 */

namespace Gemblue\TinyWallet\Repository;

use Gemblue\TinyWallet\Connection;

class Repository {

    protected $connection;

    public function __construct() {
        
        // Inject Connection.
        $connection = new Connection;

        $this->connection = mysqli_connect($connection->host, $connection->username, $connection->password, $connection->database);
        
        if ($this->connection == NULL) {
            throw new \Exception('Failed to connect with database');
        }
    }
}