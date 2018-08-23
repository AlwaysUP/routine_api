<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/purpose.php';
 
// instantiate database and purpose object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$purpose = new Purpose($db);
 
// query purpose
$callToDb = $purpose->read();
$num = $callToDb->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // purpose array
    $purpose_arr=array();
    $purpose_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $callToDb->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $purpose_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
        );
 
        array_push($purpose_arr["records"], $purpose_item);
    }
 
    echo json_encode($purpose_arr);
}
 
else{
    echo json_encode(
        array("message" => "No purpose found.")
    );
}
?>