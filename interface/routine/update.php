<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/routine.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare routine object
$routine = new Routine($db);
 
// get id of routine to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of routine to be edited
$routine->id = $data->id;
 
// set routine property values
$routine->name = $data->name;
$routine->description = $data->description;
$routine->days = $data->days;
$routine->purpose_id = $data->purpose_id;
 
// update the routine
if($routine->update()){
    echo '{';
        echo '"message": "routine was updated."';
    echo '}';
}
 
// if unable to update the routine, tell the user
else{
    echo '{';
        echo '"message": "Unable to update routine."';
    echo '}';
}
?>