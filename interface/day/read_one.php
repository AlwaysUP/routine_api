<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/day.php';
include_once '../../entity/set.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare day object
$day = new Day($db);
 
// set ID property of day to be edited
$day->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of day to be edited
$day->readOne($day->id);
 
// create array
$day_arr = array(
    "id" =>  $day->id,
    "name" => $day->name,
    "routine_id" => $day->routine_id,
);
 
$day_arr["sets"]=array();

$setCalltoDb = new Set($db);
$sets = $setCalltoDb->readOneDay($day->id);

// retrieve our table contents
while ($row = $sets->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);

    $set_item=array(
        "id" =>  $id,
        "name" => $name,
        "reps" => $reps,
        "tempo" => $tempo,
        "day_id" => $days_id, 
    );

    array_push($day_arr["sets"], $set_item);
}

// make it json format
print_r(json_encode($day_arr));
?>