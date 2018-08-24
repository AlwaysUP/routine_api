<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate set object
include_once '../../entity/set.php';

$database = new Database();
$db = $database->getConnection();
 
$set = new Set($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set set property values
$set->name = $data->name;
$set->reps = $data->reps;
$set->days_id = $data->days_id;
$set->tempo = $data->tempo;
 
// create the set
if($set->create()){
    echo '{';
        echo '"message": "set was created."';
    echo '}';    
}
 
// if unable to create the set, tell the user
else{
    echo '{';
        echo '"message": "Unable to create set."';
    echo '}';
}
?>