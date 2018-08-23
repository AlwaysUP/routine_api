<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/purpose.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare purpose object
$purpose = new Purpose($db);
 
// set ID property of purpose to be edited
$purpose->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of purpose to be edited
$purpose->readOne();
 
// create array
$purpose_arr = array(
    "id" =>  $purpose->id,
    "name" => $purpose->name,
    "description" => $purpose->description, 
);
 
// make it json format
print_r(json_encode($purpose_arr));
?>