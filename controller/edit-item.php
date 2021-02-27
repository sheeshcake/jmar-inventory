<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_POST["submit"])){
        // var_dump($_POST);
        $item_id = $_POST["item_id"];
        $sql = "SELECT * FROM items WHERE item_id = '$item_id'";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_assoc();
        $item_name = $_POST["item_name"];
        $item_brand = $_POST["item_brand"];
        $item_capital = $_POST["item_capital"];
        $item_tax = $_POST["item_tax"];
        $item_capital_retail = number_format(floatval($item_capital / $data["item_unit_divisor"]));
        $item_price = number_format(floatval(floatval($item_capital_retail) + floatval(floatval($item_capital_retail) * floatval(floatval($item_tax) / 100))));
        $item_desc = $_POST["item_desc"];
        $category_id = $_POST["category_id"];
        $sql = "UPDATE items
            SET 
                item_name = '$item_name',
                item_brand = '$item_brand',
                item_capital = '$item_capital',
                item_capital_retail = '$item_capital_retail',
                item_price = '$item_price',
                item_tax = '$item_tax',
                item_price = '$item_price',
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