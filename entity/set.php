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
    public $day_id;
 
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
                    name=:name, reps=:reps, tempo=:tempo, day_id=:day_id";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->reps=htmlspecialchars(strip_tags($this->reps));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->day_id=htmlspecialchars(strip_tags($this->day_id));
    
        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":reps", $this->reps);
        $callToDb->bindParam(":tempo", $this->tempo);
        $callToDb->bindParam(":day_id", $this->day_id);
    
        // execute query
        if($callToDb->execute()){
            return true;
        }
    
        return false;
        
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
                    day_id = :purpose_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->reps=htmlspecialchars(strip_tags($this->reps));
        $this->tempo=htmlspecialchars(strip_tags($this->tempo));
        $this->day_id=htmlspecialchars(strip_tags($this->day_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":reps", $this->reps);
        $callToDb->bindParam(":tempo", $this->tempo);
        $callToDb->bindParam(":day_id", $this->day_id);
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