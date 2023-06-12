<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $retrieve_teacher_load = $conn->prepare("
                SELECT *, 
                SUM(subject.subject_lecture_hour) as total_lecture_hours,
                SUM(subject.subject_laboratory_hour) as total_laboratory_hours
                FROM schedule
                LEFT JOIN subject
                ON subject.subject_id = schedule.schedule_subject
                WHERE schedule_department = ?
                AND schedule.schedule_semester = ?
                AND schedule.schedule_school_year = ?
                AND schedule.schedule_teacher = ?
            ");
            $retrieve_teacher_load->execute([
                $_POST["department"],
                $_POST["semester"],
                $_POST["school_year"],
                $_POST["teacher"]
            ]);

            if($row = $retrieve_teacher_load->fetch()){ ?>

                <div class="container-fluid">
                    <div class="my-2 text-center">
                        <h2>TEACHER'S LOAD</h2>
                        <h3 class="fw-light"><?=$_POST['teacher']?></h3>
                        <h3 class="fw-normal"><?=$_POST['semester']?> - <?=$_POST['school_year']?></h3>
                    </div>
                    <div class="my-2 text-start">
                        <span><strong>Total Lecture Hours: </strong><?=$row['total_lecture_hours']?></span><br>
                        <span><strong>Total Laboratory Hours: </strong><?=$row['total_laboratory_hours']?></span>
                    </div>
                    <hr>
                    <div class="my-2">
                        <div class="my-2 text-start">
                            <h2>Subjects</h2>
                        </div>
                        <div class="my-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th>
                                        <th>Subject Unit</th>
                                        <th>Subject Lecture Hour</th>
                                        <th>Subject Laboratory Hour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // JUST FETCH ALL THE DATA FOR SUBJECT BASE ON TEACHERS NAME 

                                        $countSubject = 1;

                                        $retrieve_teacher_subjects = $conn->prepare("
                                            SELECT *
                                            FROM subject_detail
                                            LEFT JOIN subject
                                            ON subject.subject_id = subject_detail.subject_detail_subject_id
                                            WHERE subject_detail_teacher_fullname = ?
                                            AND subject_detail.subject_detail_department = ?
                                            AND subject_detail.subject_detail_semester = ?
                                            AND subject_detail.subject_detail_school_year = ?
                                        ");
                                        $retrieve_teacher_subjects->execute([
                                            $_POST["teacher"],
                                            $_POST["department"],
                                            $_POST["semester"],
                                            $_POST["school_year"],
                                        ]);

                                        while($row_teacher_subject = $retrieve_teacher_subjects->fetch()){
                                            echo "
                                                <tr class='text-center'>
                                                    <td>".$countSubject++."</td>
                                                    <td>".$row_teacher_subject['subject_name']."</td>
                                                    <td>".$row_teacher_subject['subject_title']."</td>
                                                    <td>".$row_teacher_subject['subject_unit']."</td>
                                                    <td>".$row_teacher_subject['subject_lecture_hour']."</td>
                                                    <td>".$row_teacher_subject['subject_laboratory_hour']."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="my-2">
                        <div class="my-2 text-start">
                            <h2>Sections</h2>
                        </div>
                        <div class="my-2">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Section Name/Title</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>School Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php // JUST FETCH ALL THE DATA FOR SECTION BASE ON TEACHERS NAME 
                                        
                                        $sectionCount = 1;
                                        $sections = array();

                                        $retrieve_teacher_sections = $conn->prepare("
                                            SELECT *
                                            FROM schedule
                                            WHERE schedule_teacher = ?
                                            AND schedule_department = ?
                                            AND schedule_semester = ?
                                            AND schedule_school_year = ?
                                        ");
                                        $retrieve_teacher_sections->execute([
                                            $_POST['teacher'],
                                            $_POST["department"],
                                            $_POST["semester"],
                                            $_POST["school_year"],
                                        ]);

                                        while($row_teacher_section = $retrieve_teacher_sections->fetch()){
                                            if (!in_array($row_teacher_section["schedule_section"], $sections, true)) {
                                                $sections[] = $row_teacher_section["schedule_section"];
                                            }
                                        }

                                        foreach($sections as $index=>$section){
                                            echo "
                                                <tr class='text-center'>
                                                    <td>".$sectionCount++."</td>
                                                    <td>".$sections[$index]."</td>
                                                    <td>".$_POST["department"]."</td>
                                                    <td>".$_POST["semester"]."</td>
                                                    <td>".$_POST["school_year"]."</td>
                                                </tr>
                                            ";
                                        }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php }

        }
    }
?>