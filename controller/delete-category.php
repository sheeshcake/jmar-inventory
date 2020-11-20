<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"]) && $_POST["id"] != ""){
        $id = $_POST["id"];
        $sql = "SELECT * FROM category WHERE category_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $sql = "DELETE FROM category WHERE category_id = '$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = array("message"=>"Category Deleted!", "status"=>"success");
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