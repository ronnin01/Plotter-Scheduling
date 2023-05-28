<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $retrieve_subject_for_plot = $conn->prepare("
                SELECT *
                FROM subject_detail
                LEFT JOIN subject
                ON subject.subject_id = subject_detail.subject_detail_subject_id
                WHERE subject_detail_department = ? AND subject_detail_semester = ? AND subject_detail_school_year = ? AND subject_detail_teacher_fullname = ?
            ");
            $retrieve_subject_for_plot->execute([
                $_POST["department"],
                $_POST["semester"],
                $_POST["school_year"],
                $_POST["teacher"]
            ]);

            echo '
                <option value="">Select Subject</option>
            ';
            while($row = $retrieve_subject_for_plot->fetch()){
                echo '
                    <option value="'.$row["subject_detail_subject_id"].'">'.$row["subject_title"].' ('.$row["subject_name"].')</option>
                ';
            }
            
        }
    }

    $retrieve_subject_for_plot = null;
    $conn = null;
?>