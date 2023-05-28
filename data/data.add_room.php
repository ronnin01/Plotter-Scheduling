<?php
    // DATABASE CONNECTION
    include_once("database.php");

    if(isset($_POST["submit"])){
        if(!empty($_POST["submit"])){

            $check_room = $conn->prepare("
                SELECT *
                FROM ROOM
                WHERE room_name = ?
            ");
            $check_room->execute([
                $_POST["room_name"],
            ]);

            if($check_room->fetch()){
                echo "room_already_added";
            }else{

                $insert_room = $conn->prepare("
                    INSERT INTO room
                    (room_department, room_name, room_building, room_capacity, room_room_type)
                    VALUES
                    (?,?,?,?,?)
                ");
                $added = $insert_room->execute([
                    $_POST["room_department"],
                    $_POST["room_name"],
                    $_POST["room_building"],
                    $_POST["room_capacity"],
                    $_POST["room_type"]
                ]);

                if($added){
                    echo 1;
                }else{
                    echo 0;
                }

            }

        }
    }

    $check_room = null;
    $insert_room = null;
    $conn = null;
?>