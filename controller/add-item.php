<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        // Add Code 
        if(mysqli_num_rows($result) == 0){
            // Add Code
            if($result){
                $data = array("message"=>"Item Added!", "status"=>"success", "name"=>"$category", "id"=>"$conn->insert_id");
                echo json_encode($data);
            }
        }else{
            $data= array("message"=>"Item Already Added!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>