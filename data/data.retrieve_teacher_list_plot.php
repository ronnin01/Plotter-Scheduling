<?php
    // DATABASE CONNECTION
    include_once("database.php");

    $retrieve_teacher_list_plot = $conn->prepare("
        SELECT * 
        FROM teacher
    ");
    $retrieve_teacher_list_plot->execute([]);

    while($row = $retrieve_teacher_list_plot->fetch()){
        echo '
            <tr class="text-center">
                <td>
                    <input type="checkbox" name="" id="">
                </td>
                <td>'.$row["teacher_firstname"].'</td>
                <td>'.$row["teacher_middlename"].'</td>
                <td>'.$row["teacher_lastname"].'</td>
                <td>'.$row["teacher_status"].'</td>
            </tr>
        ';
    }

    $retrieve_teacher_list_plot = null;
    $conn = null;
?>