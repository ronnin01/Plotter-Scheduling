<?php

    // DATABASE CONNECTION
    include_once("database.php");
    // START SESSION
    session_start();

    if(isset($_POST["form_login"])){
        if(!empty($_POST["form_login"])){

            $check_login = $conn->prepare("
                SELECT * 
                FROM users
                WHERE user_username = ?
            ");
            $check_login->execute([
                $_POST['username'],
            ]);

            if($row = $check_login->fetch()){
                if($_POST["password"] == $row["user_password"]){

                    if($row["user_type"] == "Admin"){
                        echo $row["user_type"];
                    }else{
                        echo $row["user_type"];
                    }

                }else{
                    echo "error_password";
                }
            }else{
                echo "error_username_email";
            }

        }
    }

    $check_login = null;
    $conn = null;

?>