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
            $sql = "INSERT INTO transactions (transaction_type, transaction_datetime)
                VALUES ('$type','$date_time')
            ";
            $result = mysqli_query($conn, $sql);
            $last_id = mysqli_insert_id($conn);
            $driver_name = $_POST["driver_name"];
            $supplier_name = $_POST["supplier_name"];
            $plate_no = $_POST["plate_no"];
            $terms_of_payment = $_POST["terms_of_payment"];
            $address = $_POST["address"];
            $contact_no = $_POST["contact_no"];
            $sql = "INSERT INTO incoming_details 
                        (transaction_id, driver_name, supplier_name, plate_no, terms_of_payment, address, contact_no)
                        VALUES
                        ('$last_id', '$driver_name', '$supplier_name', '$plate_no', '$terms_of_payment', '$address', '$contact_no')";
            mysqli_query($conn, $sql);
            $count = 0;
            foreach ($arr as &$value) {
                $value = explode(",", $value);
                $item_id = $value[1];
                $user_id = $_SESSION["user"]["user_id"];
                $sql = "SELECT item_unit_divisor FROM items WHERE item_id='$item_id'";
                $data2 = mysqli_query($conn, $sql) -> fetch_assoc();
                $a_store = $value[2];
                $a_warehouse = $value[3];
                $item_count = $value[4];
                // Update Item Stock
                $sql1 = "UPDATE items
                SET 
                    item_stock = item_stock + $a_store,
                    item_stock_warehouse = item_stock_warehouse + $a_warehouse
                WHERE item_id = '$item_id'";
                $result = mysqli_query($conn, $sql1);
                //Insert Purchased Item
                $sql1 = "INSERT INTO incoming_transaction (transaction_id, item_id, item_count, user_id, item_on_warehouse, item_on_store) VALUES ($last_id, '$item_id', '$item_count', '$user_id', '$a_warehouse', '$a_store')";
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