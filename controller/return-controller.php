<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["id"])){
        if($_POST["type"] == "open"){
            $id = $_POST["id"];
            $sql = "SELECT 
                        * 
                    FROM 
                        transactions 
                    WHERE 
                        transactions.transaction_id = $id";
            $result = mysqli_query($conn, $sql);
            $data = $result->fetch_assoc();
            $all_data = [$data];
            $id = $data["transaction_id"];
            $sql1 = "SELECT * FROM purchased_item as p
                    INNER JOIN items as i 
                    ON
                        p.item_id = i.item_id
                    WHERE p.transaction_id = '$id'
            ";
            $result1 = mysqli_query($conn, $sql1);
            while($data1 = $result1->fetch_assoc()){
                array_push($all_data, $data1);
            }
            echo json_encode($all_data);
        }
    }



?>