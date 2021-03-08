<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST["type"])){
        if($_POST["type"] == "get-item"){
            $id = $_POST["id"];
            $sql = "SELECT * FROM items WHERE item_id = $id";
            $result = mysqli_query($conn, $sql);
            $data = $result->fetch_assoc();
            echo json_encode($data);
        }else if($_POST["type"] == "transfer"){
            logs("transfer-item", $_SESSION['user']['user_id']);
            // var_dump($_POST);
            $date = $_POST["date"];
            $time = $_POST["time"];
            $driver_name = $_POST["driver_name"];
            $plate_no = $_POST["plate_no"];
            $user_id = $_SESSION["user"]["user_id"];
            $sql = "INSERT INTO stock_transfer (user_id, transfer_date, transfer_time, driver_name, plate_no)
                    VALUES ('$user_id', '$date', '$time', '$driver_name', '$plate_no')
            ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $last_id = mysqli_insert_id($conn);
            if($result){
                $arr = $_POST["data"];
                foreach($arr as &$value){
                    $value = explode(",", $value);
                    $item_id = $value[0];
                    $item_count = $value[1];
                    // Add Data to transfered_items table
                    $sql = "INSERT INTO transfered_items (transfer_id, item_id, item_count)
                            VALUES ('$last_id', '$item_id', '$item_count')
                    ";
                    $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    if($result){
                        //Update Items Stock
                        $sql = "UPDATE items
                            SET
                                item_stock = item_stock + $item_count,
                                item_stock_warehouse = item_stock_warehouse - $item_count
                            WHERE item_id = '$item_id'
                        ";
                        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                        if($result){
                            $data1 = array("message"=>"Transaction Completed!", "status"=>"success");
                            echo json_encode($data1);
                        }else{
                            $data1 = array("message"=>"An Error Occured!", "status"=>"danger");
                            echo json_encode($data1);
                            break;
                        }
                    }else{
                        $data1 = array("message"=>"An Error Occured!", "status"=>"danger");
                        echo json_encode($data1);
                        break;
                    }
                }
            }

        }
    }

?>