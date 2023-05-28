<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $added = 0;
            $check = 0;
            
            foreach($_POST["teacher_name"] as $teacher){
                $check_teacher_plot = $conn->prepare("
                    SELECT *
                    FROM teacher_detail
                    WHERE teacher_fullname = ? AND teacher_department = ? AND teacher_semester = ? AND teacher_school_year = ?
                ");
                $check_teacher_plot->execute([
                    $teacher,
                    $_POST["department"],
                    $_POST["semester"],
                    $_POST["school_year"]
                ]);

                if($check_teacher_plot->fetch()){
                    echo $teacher." is already added.";
                    $check = 1;
                    break;
                }else {
                    continue;
                }
            }

            if($check == 0){
                foreach($_POST["teacher_name"] as $teacher){
                    $insert_teacher_plot = $conn->prepare("
                        INSERT INTO teacher_detail
                        (teacher_fullname, teacher_department, teacher_semester, teacher_school_year)
                        VALUES
                        (?,?,?,?)
                    ");
                    $insert_teacher_plot->execute([
                        $teacher,
                        $_POST["department"],
                        $_POST["semester"],
                        $_POST["school_year"]
                    ]);
    
                    $added = 1;
                }
    
                if($added == 1){
                    echo 1;
                }
            }

        }
    }

    $check_teacher_plot = null;
    $insert_teacher_plot = null;
    $conn = null;
?>