<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $user_id = $_SESSION["user"]["user_id"];
        $num = $_POST["num"];
        $id = $_POST["id"];
        $location = "";
        $sql = "SELECT * FROM items WHERE item_id = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            $item_data = $result->fetch_assoc();
            if($item_data["item_stock"] > 0){
                $sql = "UPDATE items
                SET item_stock = item_stock - $num
                WHERE item_id = '$id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $sql = "SELECT * FROM items WHERE item_id='$id'";
                    $result = mysqli_query($conn, $sql);
                    $data = $result->fetch_assoc();
                    $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
                    $trans_datetime = $date->format("m-d-Y h:i a");
                    $sql1 = "INSERT INTO outgoing_transaction (item_id, user_id, item_count, outgoing_datetime) VALUES ('$id', '$user_id', '$num', '$trans_datetime')";
                    $result1 = mysqli_query($conn, $sql1);
                    if($result1){
                        $data1 = array("message"=>"Item Updated!", "status"=>"success", "stock"=>$data["item_stock"]);
                        echo json_encode($data1);
                    }
                }
            }else{
                $data1 = array("message"=>"Out Of Stock!", "status"=>"danger");
                echo json_encode($data1);
            }
        }
    }else{
        $data1   = array("message"=>"An Error Occured!", "status"=>"warning");
        echo json_encode($data1);
    }
?>