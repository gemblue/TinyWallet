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

class Transaction {

    /** Props */
    protected $connection;
    protected $subjectTable;

    /** Table */
    protected $table = 'wallet_transaction';
    protected $logTable = 'wallet_transaction_log';
    
    /**
     * Construct
     */
    public function __construct($connection, $subjectTable) {
        $this->connection = $connection;
        $this->subjectTable = $subjectTable;
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
        $sql .= "metadata = '" . $args['metadata'] . "', ";
        $sql .= "created_at = \"{$date}\" ";
        
        if (!mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to insert ..');    

        return mysqli_insert_id($this->connection);
    }

    /**
     * Get.
     */
    public function get(array $where = [], $limit = 5, $offset = 0) : array {
        
        $sql  = "SELECT {$this->table}.*, {$this->logTable}.*, {$this->table}.id as id, {$this->table}.created_at as created_at 
            FROM {$this->table} 
            JOIN {$this->subjectTable} ON {$this->subjectTable}.id = {$this->table}.subject_id 
            JOIN {$this->logTable} ON {$this->logTable}.transaction_id = {$this->table}.id 
            WHERE deleted_at IS NULL ";
        if($where){
            foreach ($where as $field => $value) {
                $sql .= "AND $field = '$value' ";
            }
        }
        $sql .= "ORDER BY {$this->table}.created_at desc LIMIT {$offset},{$limit}";
        
        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    /**
     * Get Total
     */
    public function getTotal() {
        
        $sql  = "SELECT count(id) as total FROM {$this->table} WHERE deleted_at IS NULL";

        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    
        
        $result = mysqli_fetch_row($query);

        if (!empty($result))
            return $result[0];

        return null;
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

    /**
     * Is Exist.
     */
    public function isExist(int $id) : bool {
        
        $sql  = "SELECT id FROM {$this->table} WHERE id = {$id}";
        
        if (!$query = mysqli_query($this->connection, $sql))
            throw new \Exception('Failed to get ..');    

        $result = mysqli_fetch_row($query);
        
        if (!$result)
            return false;
        
        return true;
    }
}