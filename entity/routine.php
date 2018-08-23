<?php
class Routine{
 
    // database connection and table name
    private $connection;
    private $table_name = "routine";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $days;
    public $purpose_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->connection = $db;
    }

    // create routine
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description, purpose_id=:purpose_id, days=:days";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->purpose_id=htmlspecialchars(strip_tags($this->purpose_id));
        $this->days=htmlspecialchars(strip_tags($this->days));
    
        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":description", $this->description);
        $callToDb->bindParam(":purpose_id", $this->purpose_id);
        $callToDb->bindParam(":days", $this->days);
    
        // execute query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the routine
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    description = :description,
                    purpose_id = :purpose_id,
                    days = :days
                WHERE
                    id = :id";
    
        // prepare query statement
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->purpose_id=htmlspecialchars(strip_tags($this->purpose_id));
        $this->days=htmlspecialchars(strip_tags($this->days));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $callToDb->bindParam(':name', $this->name);
        $callToDb->bindParam(':days', $this->days);
        $callToDb->bindParam(':description', $this->description);
        $callToDb->bindParam(':purpose_id', $this->purpose_id);
        $callToDb->bindParam(':id', $this->id);
    
        // execute the query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
    }

    // used for paging routines
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $callToDb = $this->connection->prepare( $query );
        $callToDb->execute();
        $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }

}