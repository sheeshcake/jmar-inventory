<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $id = $_POST["item_id"];
        $sql = "DELETE FROM items WHERE item_id=$id";
        $result = mysqli_query($conn, $sql);
        if($result){
            $data= array("message"=>"Item Deleted! Refreshing Items Please wait..", "status"=>"success");
            echo json_encode($data);
        }else{
            $data= array("message"=>"Item Already Deleted!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"An Error Occured!", "status"=>"danger");
        echo json_encode($data);
    }
?>