<?php
    include "../controller/connect.php";
    include "core.php";
    session_start();
    if(isset($_POST["submit"])){
        // var_dump($_POST);
        // var_dump($_FILES);
        // Add Code 
        logs("edit-item", $_SESSION['user']['user_id']);
        $item_name = $_POST["item_name"];
        $item_brand = $_POST["item_brand"];
        $item_desc = $_POST["item_desc"];
        $item_unit = $_POST["item_unit"];
        $item_unit_package = $_POST["item_unit_package"];
        $item_unit_divisor = $_POST["item_unit_divisor"];
        $item_price = $_POST["item_price"];
        $item_capital = $_POST["item_capital"];
        $item_capital_retail = $_POST["retail_capital"];
        $item_tax_type = $_POST["item_tax_type"];
        $item_tax = $_POST["item_tax"];
        $item_stock = $_POST["item_stock"];
        $item_stock_warehouse = $_POST["item_stock_warehouse"] * $item_unit_divisor;
        $supplier_id = $_POST["supplier"];
        $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
        $item_added = $date->format("m-d-Y h:i a");
        $category_id = $_POST["category_id"];
        $sql = "SELECT * FROM items WHERE item_name = '$item_name' and item_brand='$item_brand'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $item_img = "item.jpg";
            if(isset($_FILES["item_img"])){
                $item_img = urldecode($_FILES["item_img"]["name"]);
                move_uploaded_file($_FILES["item_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/item/" . $item_img);
            }
            $sql = "INSERT INTO items (item_img, item_name, item_brand, item_desc, item_unit, item_unit_package, item_price, item_tax, item_tax_type, item_capital, item_capital_retail, item_unit_divisor, item_stock, item_added, category_id, supplier_id,  item_stock_warehouse) VALUES (
                '$item_img', '$item_name', '$item_brand', '$item_desc', '$item_unit', '$item_unit_package', '$item_price', '$item_tax', '$item_tax_type', '$item_capital', '$item_capital_retail', '$item_unit_divisor', '$item_stock', '$item_added', '$category_id', '$supplier_id', '$item_stock_warehouse')";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if($result){
                $last_id = $conn->insert_id;
                $sql = "SELECT * FROM items WHERE item_id = $last_id";
                $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
                $data = array("message"=>"Item Added! Refreshing Items Please wait..", "status"=>"success", "id"=>"$conn->insert_id");
                echo json_encode($data);
                // echo json_encode($result->fetch_assoc());
            }
        }else{
            $data= array("message"=>"Item Already Added!", "status"=>"warning");
            echo json_encode($data);
        }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>