<?php
    // DATABASE CONNECTION
    include_once("database.php");

    $data = array();

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $retrieve_teacher_schedule = $conn->prepare("
                SELECT * 
                FROM schedule
                LEFT JOIN subject
                ON subject.subject_id = schedule.schedule_subject
                WHERE schedule_department = ? AND schedule_semester = ? AND schedule_school_year = ? AND schedule_teacher = ?
            ");
            $retrieve_teacher_schedule->execute([
                $_POST["department"],
                $_POST["semester"],
                $_POST["school_year"],
                $_POST["teacher"]
            ]);

            while($row = $retrieve_teacher_schedule->fetch()){
                $data[] = $row;
            }

            json_encode($data);

        }
    }

    $weeks = [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
    ];
    $times = [
        "07:00","07:30","08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30",
        "12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30",
        "17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00","21:30",
    ];

    $time_proper = [
        "07:00","07:30","08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30",
        "12:00","12:30","01:00","01:30","02:00","02:30","03:00","03:30","04:00","04:30",
        "05:00","05:30","06:00","06:30","07:00","07:30","08:00","08:30","09:00","09:30", "10:00", "10:30", "11:00"
    ];

?>

<table class="table table-bordered border-dark">
    <thead>
        <tr class="text-center">
            <th style='font-size: 12px;'>Time</th>
            <?php
                foreach($weeks as $week){
                    echo "
                        <th style='font-size: 12px;' width='180px' class='bg-primary'>".$week."</th>
                    ";
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($times as $i=>$time){ ?>
                <tr class="text-center">
                    <?php
                        if($i % 2 == 0){
                            echo "
                                <th rowspan='2' width='150px' style='font-size: 9px;'>".$time_proper[$i]."-".$time_proper[$i+2]."</th>
                            ";
                        }
                        foreach($weeks as $week){
                            if($time >= "12:00" && $time < "13:00"){
                                echo "
                                    <td style='background-color: gray;'></td>
                                ";
                            }else{
                                echo "<td>";
                                foreach($data as $val){
                                    if($week == $val["schedule_week_day"] && date("H:i", strtotime($time)) >= date("H:i", strtotime($val['schedule_start_time'])) && date("H:i", strtotime($time)) < date("H:i", strtotime($val['schedule_end_time']))){
                                        if(date("H:i", strtotime($time)) == date("H:i", strtotime($val['schedule_start_time']))){
                                            echo "
                                                <div class='item row-span-".$val['schedule_rowspan']."'>
                                                    <p style='font-size: 10px;' class='text-center sched' data-id='".$val['schedule_id']."'>
                                                        ".$val["schedule_teacher"]."
                                                        <br>
                                                        ".$val["schedule_section"]." - ".$val["schedule_room"]."
                                                    </p>
                                                </div>
                                            ";
                                        }
                                    }
                                }
                                echo "</td>";
                            }
                        }
                    ?>
                    
                </tr>
            <?php }
        ?>
    </tbody>
</table>

<?php 
    $retrieve_teacher_schedule = null;
    $conn = null;
?>