<?php
    include "../controller/connect.php";
    session_start();
    if(isset($_FILES["item_img"]["name"])){
        // Add Code 
        $item_img = urldecode($_FILES["item_img"]["name"]);
        move_uploaded_file($_FILES["item_img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/jmar-inventory-1/img/item/" . $item_img);
        $item_name = $_POST["item_name"];
        $item_brand = $_POST["item_brand"];
        $item_desc = $_POST["item_desc"];
        $item_unit = $_POST["item_unit"];
        $item_price = $_POST["item_capital"];
        $item_tax = $_POST["item_tax"];
        $item_stock = $_POST["item_stock"];
        $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
        $item_added = $date->format("m-d-Y h:i a");
        $category_id = $_POST["category_id"];
        $sql = "SELECT * FROM items WHERE item_name = '$item_name' and item_brand='$item_brand'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO items (item_img, item_name, item_brand, item_desc, item_unit, item_price, item_tax, item_stock, item_added, category_id) VALUES (
                '$item_img', '$item_name', '$item_brand', '$item_desc', '$item_unit', '$item_price', '$item_tax', '$item_stock', '$item_added', '$category_id')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = array("message"=>"Item Added! Refreshing Items Please wait..", "status"=>"success", "id"=>"$conn->insert_id");
                echo json_encode($data);
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