<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            // CHECK ID NUMBER
            $check_id_number = $conn->prepare("
                SELECT teacher_id_number
                FROM teacher
                WHERE teacher_id_number = ?
            ");
            $check_id_number->execute([
                $_POST["id_number"]
            ]);

            if($check_id_number->fetch()){
                echo "id_number_error";
            }else{
                $insert_teacher = $conn->prepare("
                    INSERT INTO teacher
                    (teacher_id_number, teacher_firstname, teacher_lastname, teacher_middlename, teacher_bachelor, teacher_master, teacher_doctor, teacher_special, teacher_major, teacher_minor, teacher_designation, teacher_status, teacher_research, teacher_production, teacher_extension, teacher_others)
                    VALUES
                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
                ");
                $teacher_added = $insert_teacher->execute([
                    $_POST["id_number"],
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["middlename"],
                    $_POST["bachelor"],
                    $_POST["master"],
                    $_POST["doctor"],
                    $_POST["special"],
                    $_POST["major"],
                    $_POST["minor"],
                    $_POST["designation"],
                    $_POST["status"],
                    $_POST["research"],
                    $_POST["production"],
                    $_POST["extension"],
                    $_POST["others"]
                ]);

                if($teacher_added){
                    echo 1;
                }else{
                    echo 0;
                }
            }

        }
    }

    $check_id_number = null;
    $insert_teacher = null;
    $conn = null;

?>