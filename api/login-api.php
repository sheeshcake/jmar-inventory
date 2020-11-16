<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $data = $result->fetch_assoc();
            return json_encode($data);
        }
        else{
            $data = (object)[
                "message" => "Wrong Username or Password",
                "status" => "danger"
            ];
            return json_encode($data);
        }
    }else{
        $data = (object)[
            "message" => "Wrong Username or Password",
            "status" => "danger"
        ];
        return json_encode($data);
    }



?>