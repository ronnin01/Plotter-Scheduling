<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $check_department = $conn->prepare("
                SELECT * 
                FROM department
                WHERE dept_code = ?
            ");
            $check_department->execute([
                $_POST["department_code"],
            ]);

            if($row = $check_department->fetch()){
                if($row["dept_title"] == $_POST["department_title"]){
                    echo "dept-title-error";
                }else if($row["dept_designation"] == $_POST["department_designation"]){
                    echo "dept-designation-error";
                }else{
                    echo "dept-code-error";
                }
            }else{
                
                $add_department = $conn->prepare("
                    INSERT INTO department 
                    (dept_code, dept_title, dept_designation)
                    VALUES(?,?,?)
                ");
                $added = $add_department->execute([
                    $_POST["department_code"],
                    $_POST["department_title"],
                    $_POST["department_designation"]
                ]);

                if($added){
                    echo 1;
                }else{
                    echo 0;
                }

            }

        }
    }

    $check_department = null;
    $add_department = null;
    $conn = null;
?>