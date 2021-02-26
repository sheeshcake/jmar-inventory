<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["type"])){
        if($_POST["type"] == "get-item"){
            $id = $_POST["id"];
            $sql = "SELECT * FROM items WHERE item_id = $id";
            $result = mysqli_query($conn, $sql);
            $data = $result->fetch_assoc();
            echo json_encode($data);
        }else if($_POST["type"] == "transaction"){
            $arr = $_POST["data"];
            $date_time = $_POST["date"];
            $type = $_POST["trans_type"];
            $user_id = $_SESSION["user"]["user_id"];
            $courier = $_POST["courier"];
            $discount = $_POST["discount"];
            $payment = $_POST["payment"];
            $customer = $_POST["customer"];
            $cash = $_POST["cash"];
            $reciept_no = $_POST["reciept_no"];
            $sql = "INSERT INTO transactions (reciept_no, transaction_type, transaction_datetime, user_id, courier, payment, customer, cash, discount)
                VALUES ('$reciept_no','$type','$date_time', '$user_id', '$courier','$payment','$customer','$cash', '$discount')
            ";
            $result = mysqli_query($conn, $sql);
            $last_id = mysqli_insert_id($conn);
            $count = 0;
            foreach ($arr as &$value) {
                $value = explode(",", $value);
                $item_id = $value[1];
                $item_count = $value[2];
                $item_on_store = $value[3];
                $item_on_warehouse = $value[4];
                // Get item data
                $sql = "SELECT * FROM items WHERE item_id = $item_id";
                $result = mysqli_query($conn, $sql);
                $data = $result->fetch_assoc();
                // Get The Items to Warehouse or Store Algorithm
                $remaining_store = $data["item_stock"] - $item_on_store;
                $remaining_warehouse = $data["item_stock_warehouse"] - $item_on_warehouse;
                // Update Item Stock
                $sql1 = "UPDATE items
                SET 
                    item_stock = $remaining_store,
                    item_stock_warehouse = $remaining_warehouse
                WHERE item_id = '$item_id'";
                $result = mysqli_query($conn, $sql1);
                //Insert Purchased Item
                $sql1 = "INSERT INTO purchased_item (transaction_id, item_id, item_count, item_on_warehouse, item_on_store) 
                VALUES ($last_id, '$item_id', '$item_count', '$item_on_warehouse', '$item_on_store')";
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
    }else{
        $sql ="SELECT transaction_id FROM transactions ORDER BY transaction_id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        echo json_encode($result->fetch_assoc());
    }

?>