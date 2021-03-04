<?php
    include "connect.php";
    if(isset($_POST["submit"])){
        if($_POST["submit"] == "report"){
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $damage_added = $date->format("m-d-Y h:i a");
            $damage_count = $_POST["count"];
            $id = $_POST["id"];
            // report the damaged items
            $sql = "INSERT INTO damaged_items (item_id, item_count, damage_datetime)
                    VALUES ('$id', '$damage_count', '$damage_added')
                ";
            $result = mysqli_query($conn, $sql);
            if($result){
                // update stocks
                $sql = "UPDATE items
                        SET 
                        item_stock = item_stock - $damage_count
                        WHERE item_id = '$id'
                        ";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $data= array("message"=>"Item Reported!", "status"=>"success");
                    echo json_encode($data);
                }else{
                    $data= array("message"=>"An Error Occured!", "status"=>"warning");
                    echo json_encode($data);
                }
            }else{
                $data= array("message"=>"An Error Occured!", "status"=>"warning");
                echo json_encode($data);
            }

        }else{
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $damage_added = $date->format("m-d-Y h:i a");
            $damage_count = $_POST["count"];
            $item_id = $_POST["item_id"];
            $damage_id = $_POST["damage_id"];
            // report the damaged items
            $sql = "UPDATE damaged_items 
                    SET 
                        item_count = item_count - $damage_count,
                        damage_datetime = '$damage_added'
                    WHERE damage_id = '$damage_id'
                ";
            $result = mysqli_query($conn, $sql);
            if($result){
                // update stocks
                $sql = "UPDATE items
                        SET 
                        item_stock = item_stock + $damage_count
                        WHERE item_id = '$item_id'
                        ";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $data= array("message"=>"Item Reported!", "status"=>"success");
                    echo json_encode($data);
                }else{
                    $data= array("message"=>"An Error Occured!", "status"=>"warning");
                    echo json_encode($data);
                }
            }else{
                $data= array("message"=>"An Error Occured!", "status"=>"warning");
                echo json_encode($data);
            }
        }
    }