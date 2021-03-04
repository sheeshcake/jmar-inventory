<?php
    include "connect.php";
    if(isset($_POST["value"])){
        $value = $_POST["value"];
        $id = $_POST["id"];
        $total = 0;
        $sub_total = 0;
        $sub_total_discount = 0;
        $sql = "SELECT * FROM transactions WHERE transaction_id='$id'";
        $data = mysqli_query($conn, $sql)->fetch_assoc();
        $sql = "SELECT * FROM items as i
        INNER JOIN purchased_item as p
        ON i.item_id = p.item_id
        WHERE p.transaction_id = '$id'";
        $result = mysqli_query($conn, $sql);
        while($data1 = $result->fetch_assoc()){
            $sub_total = $data1["item_price"] * $data1["item_count"];
            $sub_total_discount += floatval($sub_total - floatval($sub_total * floatval($data["discount"] / 100)));
            $total += $sub_total_discount;
        }
        if(floatval($total - floatval($value + $data['cash'])) < 0){
            $sql = "UPDATE transactions
            SET 
                cash = cash + $value,
                paid = 'true'
            WHERE
                transaction_id = '$id'
            ";
        }
        else{
            $sql = "UPDATE transactions
            SET 
                cash = cash + $value,
                paid = 'false'
            WHERE
                transaction_id = '$id'
            ";
        }
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Transaction Updated!";
        }else{
            echo "Transaction Error!!";
        }
    }
?>