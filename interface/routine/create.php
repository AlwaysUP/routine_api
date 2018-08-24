<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../../config/database.php';
 
// instantiate routine object
include_once '../../entity/routine.php';
include_once '../../entity/day.php';
include_once '../../entity/set.php';

$database = new Database();
$db = $database->getConnection();
 
$routine = new Routine($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set routine property values
$routine->name = $data->name;
$routine->description = $data->description;
$routine->days = $data->days;
$routine->purpose_id = $data->purpose_id;
 
// create the routine
if($routine->create()){
    echo '{';
        echo '"message": "routine was created."';
    echo '}';
    $day_arr = (array) $data->day;
    for ($i=0; $i < $data->days; $i++){
        $day = new Day($db);
        // set routine property values
        $day->name = $day_arr[$i]->name;
        $day->routine_id = $routine->getId();
        $day->sets = $day_arr[$i]->sets;

        if($day->create()){
            echo '{';
                echo '"message": "Day was created."';
            echo '}';
            $set_arr = (array) $day_arr[$i]->set;
            for ($j=0; $j < count($set_arr); $j++){
                $set = new Set($db);
                // set routine property values
                $set->name = $set_arr[$j]->name;
                $set->reps = $set_arr[$j]->reps;
                $set->tempo = $set_arr[$j]->tempo;
                $set->days_id = $day->getId();       
                if($set->create()){
                    echo '{';
                        echo '"message": "Set was created."';
                    echo '}';
                }
                else{
                    echo '{';
                        echo '"message": "Unable to create Set."';
                    echo '}';
                }
            }
        }
        else{
            echo '{';
                echo '"message": "Unable to create Day."';
            echo '}';
        }
    }

}
 
// if unable to create the routine, tell the user
else{
    echo '{';
        echo '"message": "Unable to create routine."';
    echo '}';
}
?>