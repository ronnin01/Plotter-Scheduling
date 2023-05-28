<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){
            
            $check_a_y = $conn->prepare("
                SELECT *
                FROM school_a_y
                WHERE ay_year = ? AND ay_semester = ?
            ");
            $check_a_y->execute([
                $_POST["academic_year"],
                $_POST["semester"]
            ]);
            
            if($row = $check_a_y->fetch()){
                echo "ay_added";
            }else{

                $add_a_y = $conn->prepare("
                    INSERT INTO school_a_y
                    (ay_year, ay_semester)
                    VALUES(?, ?)
                ");
                $added = $add_a_y->execute([
                    $_POST["academic_year"],
                    $_POST["semester"]
                ]);

                if($added){
                    echo 1;
                }else{
                    echo 0;
                }

            }
            
        }
    }

    $check_a_y = null;
    $add_a_y = null;
    $conn = null;
?>