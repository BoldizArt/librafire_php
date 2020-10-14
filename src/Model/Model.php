<?php
/**
 * @file contains Boldizar\LibraFire\Model\Model;
 */
namespace Boldizar\LibraFire\Model;

use PDO;

class Model
{	
    /** @var mixed $conn */
    private $connection;

    /**
     * Class constructor
     */	
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};", $_ENV['USERNAME'], $_ENV['PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }
    }
    
    /**
     * Fetch all records from the database
     * 
     * @return array|Exception
     */
    public function fetchAll() : array
    {
        try {
            $query = 'SELECT * FROM `'.static::TABLE_NAME.'`';
            $stmt = $this->execute($query);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }
    }

    /**
     * Find a row by $id
     * @param int $id;
     * 
     * @return stdClass::Object|Exception
     */
    public function find(int $id)
    {
        try {
            $query = 'SELECT * FROM `'.static::TABLE_NAME.'` WHERE id = :id';
            $params = [
                ':id' => (int) $id
            ];
            $stmt = $this->execute($query, $params);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }
    }

    /**
     * Insert a row/s into the Database Table
     * @param string $query;
     * @param array $params;
     * 
     * @return int|Exception
     */
    public function insert(string $query = "", array $params = []) {
        try {
            $this->execute($query, $params);
            return $this->connection->lastInsertId();
            
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }		
    }
    
    /**
     * Update a row/s in a Database Table
     * @param string $query;
     * @param array $params;
     * 
     * @return bool|Exception
     */
    public function Update(string $query = "", array $params = [])
    {
        try {
            $this->execute($query, $params);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }		
    }		

    /**
     * Delete a row from a table by $id
     * @param int $id;
     * 
     * @return bool|Exception
     */
    public function delete(int $id)
    {
        $query = "DELETE FROM `'.static::TABLE_NAME.'` WHERE id = :id";
        $params = [
            ':id' => (int) $id
        ];
        return $this->execute($query, $params);
    }	
    
    /**
     * Execute statement
     * @param string $query;
     * @param array $params;
     * 
     * @return $stmt;
     */
    private function execute(string $query = "", array $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());   
        }		
    }
}
