<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST['submit'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' OR email ='" . $email . "'";
        logs("register-account", $_SESSION['user']['user_id']);
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO user 
                        (f_name, l_name, email, username, password, role) 
                        VALUES
                            ('$f_name', '$l_name', '$email', '$username', '$password', '$role')";
            if($result = mysqli_query($conn, $sql)){
                $_SESSION["data"]["message"] = "Account Registered!";
                $_SESSION["data"]["status"] = "success";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION["data"]["message"] = "Server Error!";
                $_SESSION["data"]["status"] = "danger";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $_SESSION["data"]["message"] = "Account Already Registered!";
            $_SESSION["data"]["status"] = "warning";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        echo "Error No Data!";
    }


?>