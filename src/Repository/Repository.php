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

    public function __construct(Connection $connection) 
    {
        // Inject Connection.
        $this->connection = $connection();
    }
}