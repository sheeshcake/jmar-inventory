<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        $item_id = $_POST["item_id"];
        $item_name = $_POST["item_name"];
        $item_brand = $_POST["item_brand"];
        $item_price = $_POST["item_capital"];
        $item_tax = $_POST["item_tax"];
        $item_price_wholesale = $_POST["item_capital_wholesale"];
        $item_tax_wholesale = $_POST["item_tax_wholesale"];
        $item_desc = $_POST["item_desc"];
        $category_id = $_POST["category_id"];
        $sql = "UPDATE items
            SET 
                item_name = '$item_name',
                item_brand = '$item_brand',
                item_price = '$item_price',
                item_tax = '$item_tax',
                item_price_wholesale = '$item_price_wholesale',
                item_tax_wholesale = '$item_tax_wholesale',
                item_desc = '$item_desc',
                category_id = '$category_id'
            WHERE
                item_id = '$item_id'
        ";
        $result = mysqli_query($conn, $sql)  or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
        if($result){
            $data= array("message"=>"Item Updated!", "status"=>"success");
            echo json_encode($data);
        }else{
            $data= array("message"=>"No Changes Were Made!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"An Error Occured!", "status"=>"danger");
        echo json_encode($data);
    }
?>