<?php
class Day{
 
    // database connection and table name
    private $connection;
    private $table_name = "day";
 
    // object properties
    public $id;
    public $name;
    public $routine_id;
    public $sets;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->connection = $db;
    }

    // create day
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, routine_id=:routine_id, sets=:sets";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->routine_id=htmlspecialchars(strip_tags($this->routine_id));
        $this->sets=htmlspecialchars(strip_tags($this->sets));
    
        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":routine_id", $this->routine_id);
        $callToDb->bindParam(":sets", $this->sets);
    
        // execute query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
        
    }

    function getId(){
        return $this->connection->lastInsertId();
    }

    function read(){

        //return all rows
        $query = "SELECT * FROM "
                    . $this->table_name . "
                    ORDER BY name";

        $callToDb = $this->connection->prepare( $query );
        $callToDb->execute();

        return $callToDb;

    }

    
    // read for one routine
    function readOne($routineId){
    
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . "
                WHERE routine_id = ?";
    
        // prepare query statement
        $callToDb = $this->connection->prepare( $query );
    
        // bind id of product to be updated
        $callToDb->bindParam(1, $routineId);
    
        // execute query
        $callToDb->execute();
        return $callToDb;
        // // get retrieved row
        // $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        // // set values to object properties
        // $this->name = $row['name'];
        // $this->description = $row['description'];
    }

    // update the day
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name=:name, routine_id=:routine_id, sets=:sets
                WHERE
                    id = :id";
    
        // prepare query statement
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->routine_id=htmlspecialchars(strip_tags($this->routine_id));
        $this->sets=htmlspecialchars(strip_tags($this->sets));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":routine_id", $this->routine_id);
        $callToDb->bindParam(":sets", $this->sets);
        $callToDb->bindParam(":id", $this->id);
    
        // execute the query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
    }

    // delete the day
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $callToDb->bindParam(1, $this->id);
    
        // execute query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
        
    }

    // used for paging days
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $callToDb = $this->connection->prepare( $query );
        $callToDb->execute();
        $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

}