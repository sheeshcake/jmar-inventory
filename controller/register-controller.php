<?php
    include "../controller/connect.php";

    if(isset($_POST['submit'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' OR email ='" . $email . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO user 
                        (f_name, l_name, email, username, password) 
                        VALUES
                            ('$f_name', '$l_name', '$email', '$username', '$password')";
            if($result = mysqli_query($conn, $sql)){
                $_SESSION["message"] = "Account Registered!";
                $_SESSION["status"] = "primary";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

        }else{
            $_SESSION["message"] = "Account Already Registered!";
            $_SESSION["status"] = "warning";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        echo "Error No Data!";
    }


?>