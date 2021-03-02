<?php
    include "connect.php";
    if(isset($_POST["value"])){
        $value = $_POST["value"];
        $id = $_POST["id"];
        $sql = "UPDATE transactions
                SET 
                    cash = '$value',
                    paid = 'true'
                WHERE
                    transaction_id = '$id'
            ";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Transaction Updated!";
        }else{
            echo "Transaction Error!!";
        }
    }
?>