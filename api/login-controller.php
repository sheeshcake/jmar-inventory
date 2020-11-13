<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['user'] = $result->fetch_assoc();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
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