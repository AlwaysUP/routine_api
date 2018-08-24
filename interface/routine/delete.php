<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../../config/database.php';
include_once '../../entity/routine.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare routine object
$routine = new Routine($db);
 
// get routine id
$data = json_decode(file_get_contents("php://input"));
 
// set routine id to be deleted
$routine->id = $data->id;
 
// delete the routine
if($routine->delete()){
    echo '{';
        echo '"message": "routine was deleted."';
    echo '}';
}
 
// if unable to delete the routine
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>