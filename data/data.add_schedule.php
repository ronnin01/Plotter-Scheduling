<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            // CONVERT STRING START TIME AND ENDTIME TO DATE
            $schedule_start_time = date("H:i", strtotime($_POST["plot_start_time_hour"].$_POST["plot_start_time_minute"]));
            $schedule_end_time = date("H:i", strtotime($_POST["plot_end_time_hour"].$_POST["plot_end_time_minute"]));

            // COMPUTE ROWSPAN OF TIME
            $start = date("H", strtotime($schedule_start_time));
            $end = date("H", strtotime($schedule_end_time));;
            $count=0;
            $rowspan=0;

            // COUNT HOW MUCH TIME TO BE EQUALS TO END TIME
            for($i=(int)$start; $i<=(int)$end;$i++){
                $count++;
            }

            if((int)date("i", strtotime($schedule_start_time)) == (int)date("i", strtotime($schedule_end_time))){
                $rowspan = ($count*2)-2;
            }else{
                $rowspan = ($count*2)-1;
            }
            
            // CHECK SECTION SCHEDULE
            $check_section_time = $conn->prepare("
                SELECT *
                FROM schedule
                WHERE schedule_start_time < ? AND schedule_end_time > ? AND schedule_department = ? AND schedule_semester = ? AND schedule_school_year = ? AND schedule_section = ? AND schedule_week_day = ?
            ");
            $check_section_time->execute([
                $schedule_end_time,
                $schedule_start_time,
                $_POST["plot_department"],
                $_POST["plot_semester"],
                $_POST["plot_school_year"],
                $_POST["plot_section"],
                $_POST["plot_week_day"]
            ]);

            // CHECK TEACHER SCHEDULE
            $check_teacher_time = $conn->prepare("
                SELECT * 
                FROM schedule
                WHERE schedule_start_time < ? AND schedule_end_time > ? AND schedule_department = ? AND schedule_semester = ? AND schedule_school_year = ? AND schedule_teacher = ? AND schedule_week_day = ?
            ");
            $check_teacher_time->execute([
                $schedule_end_time,
                $schedule_start_time,
                $_POST["plot_department"],
                $_POST["plot_semester"],
                $_POST["plot_school_year"],
                $_POST["plot_teacher"],
                $_POST["plot_week_day"]
            ]);

            // CHECK ROOM SCHEDULE
            $check_room_schedule = $conn->prepare("
                SELECT * 
                FROM schedule
                WHERE schedule_start_time < ? AND schedule_end_time > ? AND schedule_department = ? AND schedule_semester = ? AND schedule_school_year = ? AND schedule_room = ? AND schedule_week_day = ?
            ");
            $check_room_schedule->execute([
                $schedule_end_time,
                $schedule_start_time,
                $_POST["plot_department"],
                $_POST["plot_semester"],
                $_POST["plot_school_year"],
                $_POST["plot_room"],
                $_POST["plot_week_day"]
            ]);

            if($section_row = $check_section_time->fetch()){
                echo "Conflict time in section ".$section_row["schedule_section"]." and time has handled by ".$section_row["schedule_teacher"]."";
            }else if($teacher_row = $check_teacher_time->fetch()){
                echo "Conflict time, ".$teacher_row["schedule_teacher"]." has already handled ";
            }else if($room_row = $check_room_schedule->fetch()){
                echo "Time Conflict room.";
            }else{

                $insert_section_schedule = $conn->prepare("
                    INSERT INTO schedule
                    (schedule_department, schedule_semester, schedule_school_year, schedule_room, schedule_section, schedule_week_day, schedule_teacher, schedule_subject, schedule_start_time, schedule_end_time, schedule_rowspan)
                    VALUES
                    (?,?,?,?,?,?,?,?,?,?,?)
                ");
                $added = $insert_section_schedule->execute([
                    $_POST["plot_department"],
                    $_POST["plot_semester"],
                    $_POST["plot_school_year"],
                    $_POST["plot_room"],
                    $_POST["plot_section"],
                    $_POST["plot_week_day"],
                    $_POST["plot_teacher"],
                    $_POST["plot_subject"],
                    $schedule_start_time,
                    $schedule_end_time,
                    $rowspan
                ]);

                if($added){
                    echo 1;
                }else{
                    echo 0;
                }

            }

        }
    }

    $check_section_time = null;
    $check_teacher_time = null;
    $check_room_schedule = null;
    $insert_section_schedule = null;
    $conn = null;
?>