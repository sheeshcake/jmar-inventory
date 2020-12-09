<?php
    include "connect.php";
    session_start();
    $_SESSION["account"] = array();
    // var_dump($_POST);
    if(isset($_POST["user_id"])){
        $user_id = $_POST["user_id"];
        $l_name = $_POST["l_name"];
        $f_name = $_POST["f_name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $sql = "UPDATE user
                SET
                    f_name = '$f_name',
                    l_name = '$l_name',
                    email = '$email',
                    username = '$username'
                WHERE
                    user_id = '$user_id'
                ";
        $result = mysqli_query($conn, $sql);
        if($result){
            $ud["user_data"] = array("message"=>"Details Updated!", "status"=>"success");
            array_push($_SESSION["account"], $ud);
        }else{
            $ud["user_data"] = array("message"=>"An Error Occured!", "status"=>"danger");
            array_push($_SESSION["account"], $ud);
        }
        if($_POST["new_password"] != "" && $_POST["last_password"] != ""){
            $last_password = $_POST["last_password"];
            $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $sql = "SELECT password FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user_data = $result->fetch_assoc();
            if(password_verify($last_password, $user_data["password"])){
                $sql = "UPDATE user
                    SET password = '$password'
                    WHERE username = '$username'
                    ";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $pd["password"] = array("message"=>"Password Updated!", "status"=>"success");
                        array_push($_SESSION["account"], $pd);
                    }else{
                        $pd["password"] = array("message"=>"Wrong Password!", "status"=>"danger");
                        array_push($_SESSION["account"], $pd);
                    }
            }else{
                $pd["password"] = array("message"=>"An Error Occured!", "status"=>"danger");
                array_push($_SESSION["account"], $pd);
            }
        }
        if($_FILES["user_img"]["name"] != ""){
            $user_img = urldecode($_FILES["user_img"]["name"]);
            move_uploaded_file($_FILES["user_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/jmar-inventory-1/img/" . $user_img);
            $sql = "UPDATE user
                    SET user_img = '$user_img'
                    WHERE user_id = '$user_id'
                ";
            $result = mysqli_query($conn, $sql);
            if($result){
                $id["image"] = array("message"=>"Image Updated!", "status"=>"success");
                array_push($_SESSION["account"], $id);
            }else{
                $id["image"] = array("message"=>"An Error Occured!", "status"=>"danger");
                array_push($_SESSION["account"], $id);
            }
        }
        $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['user'] = $result->fetch_assoc();
        // var_dump($_FILES);
        // var_dump($_SESSION['user']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        echo "No Data Recieved!";
    }
?>