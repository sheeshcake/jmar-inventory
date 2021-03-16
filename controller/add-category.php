<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST["submit"]) && $_POST["category"] != ""){
        $category = $_POST["category"];
        $sql = "SELECT * FROM category WHERE category_name = '$category'";
        $result = mysqli_query($conn, $sql);
        logs("add-category", $_SESSION['user']['user_id']);
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO category (category_name) VALUES ('$category')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = array("message"=>"Category Added!", "status"=>"success", "name"=>"$category", "id"=>"$conn->insert_id");
                echo json_encode($data);
            }
        }else{
            $data= array("message"=>"Category Already Added!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>