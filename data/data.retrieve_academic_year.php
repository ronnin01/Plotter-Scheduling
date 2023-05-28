<?php
    // DATABASE CONNECTION
    include_once("database.php");

    $retrieve_academic_year = $conn->prepare("
        SELECT * 
        FROM school_a_y
    ");
    $retrieve_academic_year->execute([]);

    echo "
        <option value='' selected>Select A.Y.</option>
    ";
    while($row = $retrieve_academic_year->fetch()){
        echo '
            <option value="'.$row["ay_year"].'">'.$row["ay_year"].'</option>
        ';
    }

    $retrieve_academic_year = null;
    $conn = null;
?>