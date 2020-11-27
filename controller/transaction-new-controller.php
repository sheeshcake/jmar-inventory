<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["type"])){
        $id = $_POST["id"];
        $sql = "SELECT * FROM items WHERE item_id = $id";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }else{
        $arr = $_POST["data"];
        $date_time = $_POST["date"];
        $type = $_POST["trans_type"];
        $sql = "INSERT INTO transactions (transaction_type, transaction_datetime)
            VALUES ('$type','$date_time')
        ";
        $result = mysqli_query($conn, $sql);
        $last_id = mysqli_insert_id($conn);
        $count = 0;
        foreach ($arr as &$value) {
            $value = explode(",", $value);
            // var_dump($value);
            $item_id = $value[1];
            $item_count = $value[2];
            // Update Item Stock
            $sql1 = "UPDATE items
            SET item_stock = item_stock - $item_count
            WHERE item_id = '$item_id'";
            $result = mysqli_query($conn, $sql1);
            //Insert Purchased Item
            $sql1 = "INSERT INTO purchased_item (transaction_id, item_id, item_count) VALUES ($last_id, '$item_id', '$item_count')";
            $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
            if(!$result1){
                $data1 = array("message"=>"An Error Occured!", "status"=>"danger");
                echo json_encode($data1);
                break;
            }
            $count++;
        }
        if($count == count($arr)){
            $data1 = array("message"=>"Transaction Completed!", "status"=>"success");
            echo json_encode($data1);
        }
    }
?>