<?php
    // DATABASE CONNECTION
    include_once("database.php");

    $retrieve_department = $conn->prepare("
        SELECT *
        FROM department
    ");
    $retrieve_department->execute([]);

    echo "
        <option value='' selected>Select Department</option>
    ";
    while($row = $retrieve_department->fetch()){
        echo '
            <option value="'.$row["dept_code"].'">'.$row["dept_title"].'('.$row["dept_code"].')</option>
        ';
    }

    $retrieve_department = null;
    $conn = null;
?>  