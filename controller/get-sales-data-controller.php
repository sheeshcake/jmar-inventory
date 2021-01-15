<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["type"])){
        $type = $_POST["type"];
        if($type == "sales-daily"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m-d-Y");
            $sql = "SELECT * FROM transactions 
                JOIN 
                    purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
                JOIN
                    items ON purchased_item.item_id = items.item_id
                WHERE 
                    transactions.transaction_datetime LIKE '$date_now%'
                AND 
                    transactions.transaction_type = 'outgoing'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($type == "sales-monthly"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $month_now = $date->format("m");
            $year_now = $date->format("Y");
            $sql = "SELECT * FROM transactions 
                JOIN 
                    purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
                JOIN
                    items ON purchased_item.item_id = items.item_id
                WHERE 
                    transactions.transaction_datetime LIKE '$month_now%'
                AND 
                    transactions.transaction_datetime LIKE '%$year_now%'
                AND 
                    transactions.transaction_type = 'outgoing'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($type == "daily-expenses"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m-d-Y");
            $sql = "SELECT * FROM transactions 
                JOIN 
                    incoming_transaction ON transactions.transaction_id  =incoming_transaction.transaction_id 
                JOIN
                    items ON incoming_transaction.item_id = items.item_id
                WHERE 
                    transactions.transaction_datetime LIKE '$date_now%'
                AND 
                    transactions.transaction_type = 'incoming'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else if($type == "damaged"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m");
            $sql = "SELECT SUM(item_count) total FROM damaged_items";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            echo json_encode($result->fetch_assoc());
        }else if($type == "sales-monthly-chart"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $month_now = $date->format("m");
            $year_now = $date->format("Y");
            $sql = "SELECT * FROM transactions 
            JOIN 
                purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
            JOIN
                items ON purchased_item.item_id = items.item_id
            WHERE 
                transactions.transaction_datetime LIKE '%$year_now%'
            AND 
                transactions.transaction_type = 'outgoing'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($type == "sales-daily-chart"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m-d-Y");
            $sql = "SELECT * FROM transactions 
                JOIN 
                    purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
                JOIN
                    items ON purchased_item.item_id = items.item_id
                WHERE
                    transactions.transaction_type = 'outgoing'
                -- AND
                --     transactions.transaction_datetime LIKE '$date_now'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($type == "number-of-items"){
            $sql = "SELECT c.category_name, COUNT(c.category_id) AS count FROM category c
                    INNER JOIN items i WHERE i.category_id=c.category_id
                    GROUP BY c.category_id
            ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($type == "calendar-daily"){
            $date = $_POST["date"];
            $date_now = date("m-d-Y", strtotime($date));
            $sql = "SELECT * FROM transactions 
                JOIN 
                    purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
                JOIN
                    items ON purchased_item.item_id = items.item_id
                WHERE 
                    transactions.transaction_datetime LIKE '$date_now%'
                AND 
                    transactions.transaction_type = 'outgoing'
                
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
    }


?>