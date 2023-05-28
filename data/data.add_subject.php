<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $check_subject = $conn->prepare("
                SELECT * FROM
                subject 
                WHERE subject_name = ? OR subject_title = ?
            ");
            $check_subject->execute([
                $_POST["subject_name"],
                $_POST["subject_title"]
            ]);

            if($check_subject->fetch()){
                echo "subject_already_added";
            }else{

                $insert_subject = $conn->prepare("
                    INSERT INTO subject
                    (subject_name, subject_title, subject_unit, subject_lecture_hour, subject_laboratory_hour)
                    VALUES
                    (?,?,?,?,?)
                ");
                $added = $insert_subject->execute([
                    $_POST["subject_name"],
                    $_POST["subject_title"],
                    $_POST["subject_unit"],
                    $_POST["subject_lecture_hour"],
                    $_POST["subject_laboratory_hour"]
                ]);

                if($added){
                    echo 1;
                }else{
                    echo 0;
                }

            }

        }
    }

    $check_subject = null;
    $insert_subject = null;
    $conn = null;
?>