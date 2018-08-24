<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/day.php';
 
// instantiate database and day object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$day = new Day($db);
 
// query day
$callToDb = $day->read();
$num = $callToDb->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // day array
    $day_arr=array();
    $day_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $callToDb->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $day_item=array(
            "id" =>  $id,
            "name" => $name,
            "routine_id" => $routine_id,
            "sets" => $sets, 
        );
 
        array_push($day_arr["records"], $day_item);
    }
 
    echo json_encode($day_arr);
}
 
else{
    echo json_encode(
        array("message" => "No day found.")
    );
}
?>