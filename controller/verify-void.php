<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $password = $_POST["password"];
        $sql = "SELECT * FROM user WHERE role = 'admin'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $data = $result->fetch_assoc();
            if(password_verify($password, $data['password'])){
                echo json_encode(true);
            }else{
                echo json_encode(false);
            }
        }
        else{
            echo json_encode(false);
        }
    }else{
        echo json_encode(false);
    }



?>