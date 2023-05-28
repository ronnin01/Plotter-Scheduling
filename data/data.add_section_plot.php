<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $added = 0;
            $check = 0;

            foreach($_POST["section_id"] as $section){

                $check_section_plot = $conn->prepare("
                    SELECT *
                    FROM section_detail
                    LEFT JOIN section
                    ON section.section_id = section_detail_section_id
                    WHERE section_detail_semester = ? AND section_detail_school_year = ? AND section_detail_section_id = ?
                ");
                $check_section_plot->execute([
                    $_POST["semester"],
                    $_POST["school_year"],
                    $section
                ]);

                if($row = $check_section_plot->fetch()){
                    echo "The ".$row["section_name"]." Section has already added.";
                    $check = 1;
                    break;
                }else{
                    continue;
                }

            }

            if($check == 0){
                foreach($_POST["section_id"] as $section){

                    $insert_section_plot = $conn->prepare("
                        INSERT INTO section_detail
                        (section_detail_section_id, section_detail_semester, section_detail_school_year)
                        VALUES
                        (?,?,?)
                    ");
                    $insert_section_plot->execute([
                        $section,
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

    $check_section_plot = null;
    $insert_section_plot = null;
    $conn = null;
?>