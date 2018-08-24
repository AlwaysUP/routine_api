<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/set.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare set object
$set = new Set($db);
 
// set ID property of set to be edited
$set->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of set to be edited
$set->readOne();
 
// create array
$set_arr = array(
    "id" =>  $set->id,
    "name" => $set->name,
    "reps" => $set->reps,
    "tempo" => $set->tempo,
    "days_id" => $set->days_id,
);
 
// make it json format
print_r(json_encode($set_arr));
?>