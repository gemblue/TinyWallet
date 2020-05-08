<?php

/**
 * Transaction
 * 
 * Repository for transaction. Just wrap mysqli. Not ORM/Object approach.
 * Hail SQL.
 * 
 * @package Transaction
 * @author Gemblue
 */

namespace Gemblue\TinyWallet\Repository;

class Transaction extends Repository {

    /** Table */
    protected $table = 'wallet_transaction';

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
    public function save(array $args) : int{

        $date = date('Y-m-d H:i:s');

        $sql  = "INSERT INTO {$this->table} SET ";
        $sql .= "subject_id = \"{$args['subject_id']}\", ";
        $sql .= "type = \"{$args['type']}\", ";
        $sql .= "currency = \"{$args['currency']}\", ";
        $sql .= "amount = \"{$args['amount']}\", ";
        $sql .= "code = \"{$args['code']}\", ";
        $sql .= "metadata = \"{$args['metadata']}\", ";
        $sql .= "created_at = \"{$date}\" ";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to insert ..');    

        return mysqli_insert_id($this->connection);
    }

    /**
     * Get.
     */
    public function get($fields = '*', $limit = 5, $order = 0) : array {
        
        $sql  = "SELECT {$fields} FROM {$this->table} WHERE deleted_at IS NULL LIMIT {$limit}";
        
        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    /**
     * Update.
     */
    public function update(int $id, array $args) : bool {
        
        $date = date('Y-m-d H:i:s');
        
        $sql  = "UPDATE {$this->table} SET ";

        foreach($args as $key => $value) {
            if (isset($args[$key])) {
                $sql .= "{$key} = \"{$value}\", ";
            }
        }
        
        $sql .= "updated_at = '{$date}'";
        $sql .= "WHERE id = {$id} ";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to update ..');    
        
        return true;

    }

    /**
     * Delete.
     */
    public function delete(int $id) : bool {

        $date = date('Y-m-d H:i:s');
        
        $sql  = "UPDATE {$this->table} SET ";
        $sql .= "deleted_at = \"{$date}\" ";
        $sql .= "WHERE id = {$id}";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to delete ..');    
        
        return true;
    }
}