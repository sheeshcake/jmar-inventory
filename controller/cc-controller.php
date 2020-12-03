<?php
    include "connect.php";
    if(isset($_POST["submit"])){
        var_dump($_POST);
        // if($_POST["submit"] == "damage"){
        //     $item_id = $_POST["item_id"];
        //     $item_count = $_POST["item_count"];
        //     $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
        //     $damage_datetime = $date->format("m-d-Y h:i a");
        //     $sql = "INSERT INTO 
        //                 damaged_items (item_id, item_count, damage_datetime)
        //             VALUES
        //                 ('$item_id', '$item_count', '$damage_datetime')
        //             ";
        //     $result = mysqli_query($conn, $sql);
        //     if($result){
        //         if($_POST["replace"] == true){
        //             $sql = "UPDATE items
        //                     SET 
        //                         item_stock = item_stock - $item_count
        //                     WHERE
        //                         item_id = '$item_id'
        //                     ";
        //             $result = mysqli_query($conn, $sql);
        //         }else{
        //             $data = array("message"=>"Damage Reported and Replaced!", "status"=>"success");
        //             echo json_encode($data);
        //         }    
        //     }else{
        //         $data = array("message"=>"Damage Reported!", "status"=>"success");
        //         echo json_encode($data);
        //     }
        // }else{

        // }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>