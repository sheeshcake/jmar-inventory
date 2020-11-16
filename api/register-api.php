<?php
    include "../controller/connect.php";


    function check($username, $email){
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' OR email ='" . $email . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) >= 1){
            return false;
        }
        else{
            return true;
        }
    }

    if(isset($_POST['submit'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(check($username, $email)){

        }else{
            $data = (object) [
                "message" => "Account Already Registred!",
                "status" => "warning"
            ];
            return json_encode($data);
        }
    }


?>