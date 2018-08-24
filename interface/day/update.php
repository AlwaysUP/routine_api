<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/day.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare day object
$day = new Day($db);
 
// get id of day to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of day to be edited
$day->id = $data->id;
 
// set day property values
$day->name = $data->name;
$day->routine_id = $data->routine_id;
$day->sets = $data->sets;
 
// update the day
if($day->update()){
    echo '{';
        echo '"message": "day was updated."';
    echo '}';
}
 
// if unable to update the day, tell the user
else{
    echo '{';
        echo '"message": "Unable to update day."';
    echo '}';
}
?>