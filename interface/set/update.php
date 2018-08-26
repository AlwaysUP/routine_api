<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/set.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare set object
$set = new Set($db);
 
// get id of set to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of set to be edited
$set->id = $data->id;
 
// set set property values
$set->name = $data->name;
$set->reps = $data->reps;
$set->tempo = $data->tempo;
$set->days_id = $data->days_id;
 
// update the set
if($set->update()){
    echo '{';
        echo '"message": "set was updated."';
    echo '}';
}
 
// if unable to update the set, tell the user
else{
    echo '{';
        echo '"message": "Unable to update set."';
    echo '}';
}
?>