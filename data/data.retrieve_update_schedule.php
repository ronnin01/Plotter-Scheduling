<?php

    // DATABASE CONNECTION
    include_once("database.php");

    function retrieveSchedule($conn, $schedule_id){
        $retrieve_update_schedule = $conn->prepare("
            SELECT *
            FROM schedule
            WHERE schedule_id = ?
        ");
        $retrieve_update_schedule->execute([
            $schedule_id
        ]);

        return $retrieve_update_schedule->fetch();
    }

    $weekDay = array(
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
    );
    $timeHour = array(
        "07",
        "08",
        "09",
        "10",
        "11",
        '12',
        "13",
        "14",
        "15",
        "16",
        "17",
        "18",
        "19",
        "20",
        "21",
        "22"
    );
    $properTimeHour = array(
        "07am",
        "08am",
        "09am",
        "10am",
        "11am",
        '12pm',
        "01pm",
        "02pm",
        "03pm",
        "04pm",
        "05pm",
        "06pm",
        "07pm",
        "08pm",
        "09pm",
        "10pm"
    );
    $timeMinute = array(
        "00",
        "30"
    );

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            if($row = retrieveSchedule($conn, $_POST["schedule_id"])){ ?>

                <div class="my-2">
                    <form id="update-schedule-form">
                        <div class="my-2">
                            <label class="form-label">Select Room</label>
                            <select required name="schedule_room" class="form-select shadow-none rounded-0"> <?php
                                $retrieve_rooms = $conn->prepare("
                                    SELECT * 
                                    FROM room
                                ");
                                $retrieve_rooms->execute([]);

                                echo '
                                    <option value="">Select Room</option>
                                ';
                                while($rooms = $retrieve_rooms->fetch()){
                                    if($rooms["room_name"] == $row["schedule_room"]){
                                        echo '
                                            <option value="'.$row["schedule_room"].'" selected>'.$row["schedule_room"].'</option>
                                        ';
                                    }else{
                                        echo '
                                            <option value="'.$retrieve_rooms["room_name"].'" selected>'.$retrieve_rooms["room_name"].'</option>
                                        ';
                                    }
                                }
                            ?> </select>
                        </div>
                        <div class="my-2">
                            <label class="form-label">Select Week Day</label>
                            <select required name="schedule_week_day" class="form-select shadow-none rounded-0"> <?php

                                echo "
                                    <option value=''>Select Week Day</option>
                                ";
                                if($week_day = retrieveSchedule($conn, $_POST["schedule_id"])){
                                    for($i=0;$i<count($weekDay);$i++){
                                        if($week_day["schedule_week_day"] == $weekDay[$i]){
                                            echo '
                                                <option value="'.$week_day["schedule_week_day"].'" selected>'.$week_day["schedule_week_day"].'</option>
                                            ';
                                        }else{
                                            echo "
                                                <option value='".$weekDay[$i]."'>".$weekDay[$i]."</option>
                                            ";
                                        }
                                    }
                                }

                            ?> </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <label class="form-label">Select Start Time Hour</label>
                                <select required name="schedule_start_time_hour" class="form-select rounded-0 shadow-none"> <?php

                                    echo "
                                        <option value=''>Select Start Time Hour</option>
                                    ";
                                    if($retrieve_start_time_hour = retrieveSchedule($conn, $_POST["schedule_id"])){
                                        for($i=0;$i<count($timeHour);$i++){
                                            if($timeHour[$i] == date("H", strtotime($retrieve_start_time_hour['schedule_start_time']))){
                                                echo '
                                                    <option value="'.$timeHour[$i].'" selected>'.$properTimeHour[$i].'</option>
                                                ';
                                            }else{
                                                echo '
                                                    <option value="'.$timeHour[$i].'">'.$properTimeHour[$i].'</option>
                                                ';
                                            }
                                        }
                                    }

                                ?> </select>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="form-label">Select Start Time Minute</label>
                                <select required name="schedule_start_time_minute" class="form-select rounded-0 shadow-none"> <?php

                                    echo "
                                        <option value=''>Select Start Time Minute</option>
                                    ";

                                    if($retrieve_start_time_minute = retrieveSchedule($conn, $_POST["schedule_id"])){
                                        for($i=0;$i<count($timeMinute);$i++){
                                            if($timeMinute[$i] == date("i", strtotime($retrieve_start_time_minute["schedule_start_time"]))){
                                                echo "
                                                    <option value='".$timeMinute[$i]."' selected>".$timeMinute[$i]."</option>
                                                ";
                                            }else{
                                                echo "
                                                    <option value='".$timeMinute[$i]."'>".$timeMinute[$i]."</option>
                                                ";
                                            }
                                        }
                                    }

                                ?> </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <label class="form-label">Select End Time Hour</label>
                                <select required name="schedule_end_time_hour" class="form-select rounded-0 shadow-none"> <?php 

                                    echo "
                                        <option value=''>Select End Time Hour</option>
                                    ";
                                    if($retrieve_start_time_hour = retrieveSchedule($conn, $_POST["schedule_id"])){
                                        for($i=0;$i<count($timeHour);$i++){
                                            if($timeHour[$i] == date("H", strtotime($retrieve_start_time_hour['schedule_end_time']))){
                                                echo '
                                                    <option value="'.$timeHour[$i].'" selected>'.$properTimeHour[$i].'</option>
                                                ';
                                            }else{
                                                echo '
                                                    <option value="'.$timeHour[$i].'">'.$properTimeHour[$i].'</option>
                                                ';
                                            }
                                        }
                                    } 

                                ?> </select>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="form-label">Select End Time Minute</label>
                                <select required name="schedule_end_time_minute" class="form-select shadow-none rounded-0"> <?php 

                                    echo "
                                        <option value=''>Select End Time Minute</option>
                                    ";

                                    if($retrieve_start_time_minute = retrieveSchedule($conn, $_POST["schedule_id"])){
                                        for($i=0;$i<count($timeMinute);$i++){
                                            if($timeMinute[$i] == date("i", strtotime($retrieve_start_time_minute["schedule_end_time"]))){
                                                echo "
                                                    <option value='".$timeMinute[$i]."' selected>".$timeMinute[$i]."</option>
                                                ";
                                            }else{
                                                echo "
                                                    <option value='".$timeMinute[$i]."'>".$timeMinute[$i]."</option>
                                                ";
                                            }
                                        }
                                    }

                                ?> </select>
                            </div>
                        </div>
                        <div class="my-3 row">
                            <div class="col-6 d-grid">
                                <button type="submit" class="btn btn-primary rounded-0 shadow-none">Update</button>
                            </div>
                            <div class="col-6 d-grid">
                                <button type="button" class="btn btn-danger rounded-0 shadow-none" id="delete-schedule" data-id="<?=$_POST["schedule_id"] ?>">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            
            <?php }

        }
    }

?>