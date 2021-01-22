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
                    INNER JOIN 
                        purchased_item
                    ON
                        transactions.transaction_id = purchased_item.transaction_id
                    INNER JOIN 
                        items
                    ON
                        purchased_item.item_id = items.item_id
                    WHERE 
                        transactions.transaction_id = $id";
            $result = mysqli_query($conn, $sql);
            $all_data = [];
            while($data = $result->fetch_assoc()){
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }else if($_POST["type"] == "return"){
            
        }else if($_POST["type"] == "damaged"){

        }
    }



?>