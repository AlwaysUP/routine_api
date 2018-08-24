<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../../config/database.php';
include_once '../../entity/set.php';
 
// instantiate database and set object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$set = new Set($db);
 
// query set
$callToDb = $set->read();
$num = $callToDb->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // set array
    $set_arr=array();
    $set_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $callToDb->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $set_item=array(
            "id" =>  $id,
            "name" => $name,
            "reps" => $reps,
            "tempo" => $tempo,
            "days_id" => $days_id,
        );
 
        array_push($set_arr["records"], $set_item);
    }
 
    echo json_encode($set_arr);
}
 
else{
    echo json_encode(
        array("message" => "No set found.")
    );
}
?>