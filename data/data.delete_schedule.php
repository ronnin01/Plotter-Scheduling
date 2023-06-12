<?php

    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["deleteScheduleID"])){
        if(!empty($_POST["deleteScheduleID"])){

            $delete_schedule = $conn->prepare("
                DELETE FROM schedule
                WHERE schedule_id = ?
            ");
            $delete_schedule->execute([
                $_POST["deleteScheduleID"]
            ]);

            if($delete_schedule){
                echo 1;
            }else{
                echo 0;
            }

        }
    }

?>