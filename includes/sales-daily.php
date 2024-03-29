<?php
    include "controller/connect.php";
    
    $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
    $date_now = $date->format("m-d-Y");
    $sql = "SELECT * FROM transactions 
        INNER JOIN 
            purchased_item ON transactions.transaction_id  =purchased_item.transaction_id 
        INNER JOIN
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


?>
