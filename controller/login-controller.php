<?php
    include "../controller/connect.php";
    include "../controller/core.php";
    session_start();
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM user WHERE username = '" . $username . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['user'] = $result->fetch_assoc();
            logs("login", $_SESSION['user']['user_id']);
            if(password_verify($password, $_SESSION['user']['password'])){
                $_SESSION["page"] = "home";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['data'] = "Wrong Username or Password";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        else{
            $_SESSION['data'] = "Wrong Username or Password";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        $_SESSION['data'] = "Please Fill The Fields";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }



?>