<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $added = 0;
            $check = 0;

            foreach($_POST["subject"] as $sub){
                
                $check_subject_plot = $conn->prepare("
                    SELECT *
                    FROM subject_detail
                    LEFT JOIN subject
                    ON subject.subject_id = subject_detail.subject_detail_subject_id
                    WHERE subject_detail.subject_detail_department = ? AND subject_detail.subject_detail_semester = ? AND subject_detail.subject_detail_school_year = ? AND subject_detail.subject_detail_subject_id = ?
                ");
                $check_subject_plot->execute([
                    $_POST["department"],
                    $_POST["semester"],
                    $_POST["school_year"],
                    $sub
                ]);

                if($row = $check_subject_plot->fetch()){
                    echo "The subject has been handdled by ".$row["subject_detail_teacher_fullname"];
                    $check = 1;
                    break;
                }else {
                    continue;
                }

            }

            if($check == 0){
                foreach($_POST["subject"] as $sub){

                    $insert_subject_plot = $conn->prepare("
                        INSERT INTO subject_detail
                        (subject_detail_department, subject_detail_semester, subject_detail_school_year, subject_detail_teacher_fullname, subject_detail_subject_id)
                        VALUES
                        (?,?,?,?,?)
                    ");
                    $insert_subject_plot->execute([
                        $_POST["department"],
                        $_POST["semester"],
                        $_POST["school_year"],
                        $_POST["teacher"],
                        $sub
                    ]);

                    $added = 1;

                }

                if($added == 1){
                    echo 1;
                }
            }

        }
    }

    $check_subject_plot = null;
    $insert_subject_plot = null;
    $conn = null;
?>