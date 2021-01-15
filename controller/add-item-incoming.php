<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_FILES["item_img"]["name"])){
        // var_dump($_POST);
        // var_dump($_FILES);
        // Add Code 
        $item_img = urldecode($_FILES["item_img"]["name"]);
        move_uploaded_file($_FILES["item_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/item/" . $item_img);
        $item_name = $_POST["item_name"];
        $item_brand = $_POST["item_brand"];
        $item_desc = $_POST["item_desc"];
        $item_unit = $_POST["item_unit"];
        $item_unit_divisor = $_POST["item_unit_divisor"];
        $item_price = $_POST["item_capital"];
        $item_tax = $_POST["item_tax"];
        $item_price_wholesale = $_POST["item_capital_wholesale"];
        $item_tax_wholesale = $_POST["item_tax_wholesale"];
        $item_stock = $_POST["item_stock"];
        $supplier_id = $_POST["supplier"];
        $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
        $item_added = $date->format("m-d-Y h:i a");
        $category_id = $_POST["category_id"];
        $sql = "SELECT * FROM items WHERE item_name = '$item_name' and item_brand='$item_brand'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO items (item_img, item_name, item_brand, item_desc, item_unit, item_price, item_tax, item_price_wholesale, item_unit_divisor, item_tax_wholesale, item_stock, item_added, category_id, supplier_id) VALUES (
                '$item_img', '$item_name', '$item_brand', '$item_desc', '$item_unit', '$item_price', '$item_tax', '$item_price_wholesale', '$item_unit_divisor', '$item_tax_wholesale', '$item_stock', '$item_added', '$category_id', '$supplier_id')";
            $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if($result){
                $last_id = $conn->insert_id;
                $sql = "SELECT * FROM items WHERE item_id = $last_id";
                $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
                // $data = array("message"=>"Item Added! Refreshing Items Please wait..", "status"=>"success", "id"=>"$conn->insert_id");
                echo json_encode($result->fetch_assoc());
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