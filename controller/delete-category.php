<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST["submit"]) && $_POST["id"] != ""){
        logs("delete-category", $_SESSION['user']['user_id']);
        $id = $_POST["id"];
        $sql = "SELECT * FROM category WHERE category_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $data1 = $result->fetch_assoc();
        if(mysqli_num_rows($result) == 1){
            $sql = "DELETE FROM category WHERE category_id = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = array("message"=>"Category Deleted!", "status"=>"success", "id"=>$data1["category_id"], "name"=>$data1["category_name"]);
                echo json_encode($data);
            }
        }else{
            $data= array("message"=>"Category Already Deleted!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"An Error Occured!", "status"=>"danger");
        echo json_encode($data);
    }
?>