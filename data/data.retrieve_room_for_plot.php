<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $retrieve_room_for_plot = $conn->prepare("
                SELECT *
                FROM room
                WHERE room_department = ?
            ");
            $retrieve_room_for_plot->execute([
                $_POST["department"]
            ]);

            echo '
                <option value="">Select Room</option>
            ';
            while($row = $retrieve_room_for_plot->fetch()){
                echo '
                    <option value="'.$row["room_name"].'">'.$row["room_name"].'</option> 
                ';
            }

        }
    }

    $retrieve_room_for_plot = null;
    $conn = null;
?>