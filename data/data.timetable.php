<?php
    // DATABASE CONNECTION
    include_once("database.php");

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

    $data = array();
?>

<table class="table table-bordered border-dark">
    <thead>
        <tr class="text-center">
            <th style='font-size: 12px;'>Time</th>
            <?php
                foreach($weeks as $week){
                    echo "
                        <th style='font-size: 12px;' width='150px' class='bg-primary'>".$week."</th>
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
                                    if($week == $val['day'] && date("H:i", strtotime($time)) >= date("H:i", strtotime($val['start'])) && date("H:i", strtotime($time)) < date("H:i", strtotime($val['end']))){
                                        if(date("H:i", strtotime($time)) == date("H:i", strtotime($val['start']))){
                                            echo "
                                                <div class='item row-span-".$val['row']."'>
                                                    <p style='font-size: 10px;' class='text-center'>Hello world</p>
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
    $conn = null;
?>