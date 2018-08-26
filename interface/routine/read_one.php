<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/routine.php';
include_once '../../entity/day.php'; 

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare routine object
$routine = new Routine($db);
 
// set ID property of routine to be edited
$routine->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of routine to be edited
$routine->readOne();
 
// create array
$routine_arr = array(
    "id" =>  $routine->id,
    "name" => $routine->name,
    "purpose_id" => $purpose_id,
    "description" => $routine->description,
);

$routine_arr["days"]=array();

$dayCalltoDb = new Day($db);
$days = $dayCalltoDb->readOneRoutine($routine->id);

// retrieve our table contents
while ($row = $days->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);

    $day_item=array(
        "id" =>  $id,
        "name" => $name,
        "routine_id" => $routine_id, 
    );

    array_push($routine_arr["days"], $day_item);
}



// make it json format
print_r(json_encode($routine_arr));
?>