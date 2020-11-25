<?php
    include "../controller/connect.php";
    session_start();

    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "SELECT * FROM items WHERE item_id = $id";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }
?>