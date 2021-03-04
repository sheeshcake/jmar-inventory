<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["type"])){
        $type = $_POST["type"];
        if($type == "sales-daily"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m-d-Y");
            $sql = "SELECT *
                    FROM transactions WHERE 
                    transaction_type = 'outgoing'AND
                    transaction_datetime LIKE '$date_now%'
                    ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $total = 0;
            $total_paid = 0;
            $sub_total_discount = 0;
            while($data = $result->fetch_assoc()){
                $id = $data["transaction_id"];
                $sql1 = "SELECT * FROM items as i
                        INNER JOIN purchased_item as p
                        ON i.item_id = p.item_id
                        WHERE p.transaction_id = '$id' AND p.item_count > 0
                ";
                $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
                while($data1 = $result1->fetch_assoc()){
                    $sub_total = $data1["item_price"] * $data1["item_count"];
                }
                $sub_total_discount += floatval($sub_total - floatval($sub_total * floatval($data["discount"] / 100)));
                $total += $sub_total_discount;
                if($data["paid"] == "true"){
                    $total_paid += $sub_total_discount;
                }
                $sub_total = 0;
                $sub_total_discount = 0;
            }
            echo number_format($total, 2) . "(" . number_format($total_paid, 2)  . ")";
        }else if($type == "sales-monthly"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $month_now = $date->format("m");
            $year_now = $date->format("Y");
            $sql = "SELECT *
                FROM transactions WHERE 
                    transaction_datetime LIKE '$month_now-%'
                AND 
                    transaction_datetime LIKE '%-$year_now%'
                AND 
                    transaction_type = 'outgoing' 
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $total = 0;
            $total_paid = 0;
            $sub_total_discount = 0;
            while($data = $result->fetch_assoc()){
                $id = $data["transaction_id"];
                $sql1 = "SELECT * FROM items as i
                        INNER JOIN purchased_item as p
                        ON i.item_id = p.item_id
                        WHERE p.transaction_id = '$id' AND p.item_count > 0
                ";
                $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
                while($data1 = $result1->fetch_assoc()){
                    $sub_total = $data1["item_price"] * $data1["item_count"];
                }
                $sub_total_discount += floatval($sub_total - floatval($sub_total * floatval($data["discount"] / 100)));
                $total += $sub_total_discount;
                if($data["paid"] == "true"){
                    $total_paid += $sub_total_discount;
                }
                $sub_total = 0;
                $sub_total_discount = 0;
            }
            echo number_format($total, 2) . "(" . number_format($total_paid, 2)  . ")";
        }else if($type == "daily-expenses"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $date_now = $date->format("m-d-Y");
            $sql = "SELECT * FROM transactions
                WHERE
                    transaction_datetime LIKE '$date_now%'
                AND 
                    transaction_type = 'incoming'
                ";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
            $total = 0;
            $sub_total = 0;
            while($data = $result->fetch_assoc()){
                $id = $data["transaction_id"];
                $sql1 = "SELECT * FROM items as i
                    INNER JOIN incoming_transaction as inc
                    ON i.item_id = inc.item_id
                    WHERE inc.transaction_id = '$id'
                ";
                $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
                while($data1 = $result1->fetch_assoc()){
                    $total_price = floatval($data1["item_capital"] * floatval($data1["item_count"] / $data1["item_unit_divisor"]));
                    $sub_total += $total_price;
                }
                    $total += $sub_total;
                    $sub_total = 0;
            }
            echo $total;
        }else if($type == "damaged"){
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