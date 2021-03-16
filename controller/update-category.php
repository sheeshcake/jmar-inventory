<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST["submit"]) && isset($_POST["id"]) && isset($_POST["name"])){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $sql = "SELECT * FROM category WHERE category_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $data1 = $result->fetch_assoc();
        logs("update-category", $_SESSION['user']['user_id']);
        if(mysqli_num_rows($result) == 1){
            $sql = "UPDATE category SET category_name = '$name' WHERE category_id='$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = array("message"=>"Category Updated!", "status"=>"success", "id"=>$data1["category_id"], "name"=>$data1["category_name"]);
                echo json_encode($data);
            }
        }else{
            $data= array("message"=>"Category Already Updated!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"An Error Occured!", "status"=>"danger");
        echo json_encode($data);
    }
?>