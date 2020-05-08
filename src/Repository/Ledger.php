<?php

/**
 * Ledger
 * 
 * Repository for ledger. Just wrap mysqli. Not ORM/Object approach.
 * Hail SQL.
 * 
 * @package Ledger
 * @author Gemblue
 */

namespace Gemblue\TinyWallet\Repository;

class Ledger extends Repository {

    /** Table */
    protected $table = 'wallet_ledger';
    protected $transaction = 'wallet_transaction';
    
    /**
     * Construct.
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();        
    }
    
    /**
     * Save.
     */
    public function save(array $args) : bool {

        $date = date('Y-m-d H:i:s');

        $sql  = "INSERT INTO {$this->table} SET ";
        $sql .= "subject_id = \"{$args['subject_id']}\", ";
        $sql .= "transaction_id = \"{$args['transaction_id']}\", ";
        $sql .= "amount = \"{$args['amount']}\", ";
        $sql .= "entry = \"{$args['entry']}\", ";
        $sql .= "created_at = \"{$date}\" ";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to insert ..');    
        
        return mysqli_insert_id($this->connection);
    }
    
    /**
     * Get.
     */
    public function get($fields = '*', $limit = 5, $order = 0) : array {

        $sql  = "SELECT {$fields} FROM {$this->table} ";
        $sql .= "JOIN {$this->subject_table} ON {$this->subject_table}.id = {$this->table}.subject_id ";
        $sql .= "JOIN {$this->transaction} ON {$this->transaction}.id = {$this->table}.transaction_id ";
        $sql .= "LIMIT {$order},{$limit}";
        
        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    
        
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    /**
     * Get Total
     */
    public function getTotal() {
        
        $sql  = "SELECT count(id) as total FROM {$this->table}";

        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    
        
        $result = mysqli_fetch_row($query);

        if (!empty($result))
            return $result[0];

        return null;
    }

    /**
     * Get sum.
     */
    public function getSummary($subjectId) : int {
        
        $sql  = "SELECT sum(amount) AS summary FROM {$this->table} WHERE subject_id = {$subjectId}";
        
        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    
        
        $result = mysqli_fetch_row($query);
        
        if (!empty($result[0]))
            return $result[0];

        return false;
    }
}