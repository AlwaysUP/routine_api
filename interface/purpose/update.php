<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/purpose.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare purpose object
$purpose = new Purpose($db);
 
// get id of purpose to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of purpose to be edited
$purpose->id = $data->id;
 
// set purpose property values
$purpose->name = $data->name;
$purpose->description = $data->description;
 
// update the purpose
if($purpose->update()){
    echo '{';
        echo '"message": "purpose was updated."';
    echo '}';
}
 
// if unable to update the purpose, tell the user
else{
    echo '{';
        echo '"message": "Unable to update purpose."';
    echo '}';
}
?>