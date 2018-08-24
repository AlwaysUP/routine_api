<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate day object
include_once '../../entity/day.php';

$database = new Database();
$db = $database->getConnection();
 
$day = new Day($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set day property values
$day->name = $data->name;
$day->routine_id = $data->routine_id;
$day->sets = $data->sets;

if($day->create()){
    echo '{';
        echo '"message": "Day was created."';
    echo '}';
}
// if unable to create the day, tell the user
else{
    echo '{';
        echo '"message": "Unable to create Day."';
    echo '}';
}
?>