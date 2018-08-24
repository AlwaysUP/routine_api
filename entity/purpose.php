<?php
class Purpose{
 
    // database connection and table name
    private $connection;
    private $table_name = "purpose";
 
    // object properties
    public $id;
    public $name;
    public $description;
 
    public function __construct($db){
        $this->connection = $db;
    }

    // create purpose
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description";
    
        // prepare query
        $callToDb = $this->connection->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
    
        // bind values
        $callToDb->bindParam(":name", $this->name);
        $callToDb->bindParam(":description", $this->description);
    
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

    
    // read specific purpose
    function readOne(){
    
        // query to read single record
        $query = "SELECT *
                FROM
                    " . $this->table_name . "
                WHERE id = ?";
    
        // prepare query statement
        $callToDb = $this->connection->prepare( $query );
    
        // bind id of product to be updated
        $callToDb->bindParam(1, $this->id);
    
        // execute query
        $callToDb->execute();
    
        // get retrieved row
        $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->name = $row['name'];
        $this->description = $row['description'];
    }

    function search($keywords){
        // select all query
        $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            WHERE
                name LIKE ? OR description LIKE ?
            ORDER BY
                name ASC";

        // prepare query statement
        $callToDb = $this->connection->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $callToDb->bindParam(1, $keywords);
        $callToDb->bindParam(2, $keywords);

        // execute query
        $callToDb->execute();

        return $callToDb;
    }

    // update the purpose
    function update(){
    
        // update query
        $query = "UPDATE 
                    " . $this->table_name . " 
                SET
                    name = :name,
                    description = :description
                WHERE
                    id = :id";
    
        // prepare query statement
        $callToDb = $this->connection->prepare($query);
        
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $callToDb->bindParam(':name', $this->name);
        $callToDb->bindParam(':description', $this->description);
        $callToDb->bindParam(':id', $this->id);
    
        // execute the query
        if($callToDb->execute()){
            return true;
        }
        
        return false;
    }

    // delete the purpose
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

    // used for paging purposes
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $callToDb = $this->connection->prepare( $query );
        $callToDb->execute();
        $row = $callToDb->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>