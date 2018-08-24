<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/routine.php';
 
// instantiate database and routine object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$routine = new Routine($db);
 
// query routine
$callToDb = $routine->read();
$num = $callToDb->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // routine array
    $routine_arr=array();
    $routine_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $callToDb->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $routine_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
        );
 
        array_push($routine_arr["records"], $routine_item);
    }
 
    echo json_encode($routine_arr);
}
 
else{
    echo json_encode(
        array("message" => "No routine found.")
    );
}
?>