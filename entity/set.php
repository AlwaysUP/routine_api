<?php
class Set{
 
    // database connection and table name
    private $connection;
    private $table_name = "sets";
 
    // object properties
    public $id;
    public $name;
    public $reps;
    public $tempo;
    public $days_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->connection = $db;
    }
    
    // create set
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, reps=:reps, tempo=:tempo, days_id=:days_id";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->reps=htmlspecialchars(strip_tags($this->reps));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->days_id=htmlspecialchars(strip_tags($this->days_id));
    
        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":reps", $this->reps);
        $callToDb->bindParam(":tempo", $this->tempo);
        $callToDb->bindParam(":days_id", $this->days_id);
    
        // execute query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
        
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

    
    // read for one day
    function readOne($dayId){
    
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . "
                WHERE days_id = ?";
    
        // prepare query statement
        $callToDb = $this->connection->prepare( $query );
    
        // bind id of product to be updated
        $callToDb->bindParam(1, $dayId);
    
        // execute query
        $callToDb->execute();
        return $callToDb;
        // // get retrieved row
        // $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        // // set values to object properties
        // $this->name = $row['name'];
        // $this->description = $row['description'];
    }


    // update the set
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    reps = :reps,
                    tempo = :tempo,
                    days_id = :purpose_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->reps=htmlspecialchars(strip_tags($this->reps));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->days_id=htmlspecialchars(strip_tags($this->days_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":reps", $this->reps);
        $callToDb->bindParam(":tempo", $this->tempo);
        $callToDb->bindParam(":days_id", $this->days_id);
        $callToDb->bindParam(":id", $this->id);
    
        // execute the query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
    }

    // delete the set
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

    // used for paging sets
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $callToDb = $this->connection->prepare( $query );
        $callToDb->execute();
        $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}