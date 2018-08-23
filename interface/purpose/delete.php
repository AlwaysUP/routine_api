<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../../config/database.php';
include_once '../../entity/purpose.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare purpose object
$purpose = new Purpose($db);
 
// get purpose id
$data = json_decode(file_get_contents("php://input"));
 
// set purpose id to be deleted
$purpose->id = $data->id;
 
// delete the purpose
if($purpose->delete()){
    echo '{';
        echo '"message": "Purpose was deleted."';
    echo '}';
}
 
// if unable to delete the purpose
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>