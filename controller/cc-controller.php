<?php
    include "connect.php";
    if(isset($_POST["submit"])){
        // var_dump($_POST);
        if($_POST["submit"] == "damage"){
            $item_id = $_POST["item_id"];
            $item_count = $_POST["item_count"];
            $purchased_id = $_POST["purchased_id"];
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $damage_datetime = $date->format("m-d-Y h:i a");
            $sql = "INSERT INTO 
                        damaged_items (item_id, item_count, damage_datetime)
                    VALUES
                        ('$item_id', '$item_count', '$damage_datetime')
                    ";
            $result = mysqli_query($conn, $sql);
            if($result){
                if($_POST["replace"] == true){
                    $sql = "UPDATE items
                            SET 
                                item_stock = item_stock - $item_count
                            WHERE
                                item_id = '$item_id'
                            ";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $data = array("message"=>"Damage Reported and Replaced!", "status"=>"success");
                        echo json_encode($data);
                    }
                    else{
                        $data = array("message"=>"An Error Occured!", "status"=>"danger");
                        echo json_encode($data);
                    }
                }else{
                    $sql = "UPDATE purchased_items
                            SET 
                                item_count = item_count - $item_count
                            WHERE
                                purchased_id = '$purchased_id'
                            ";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $data = array("message"=>"Damage Reported and Replaced!", "status"=>"success");
                        echo json_encode($data);
                    }
                    else{
                        $data = array("message"=>"An Error Occured!", "status"=>"danger");
                        echo json_encode($data);
                    }
                }    
            }else{
                $data = array("message"=>"Damage Reported!", "status"=>"success");
                echo json_encode($data);
            }
        }else{
            $item_id = $_POST["item_id"];
            $item_count = $_POST["item_count"];
            $purchased_id = $_POST["purchased_id"];
            $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
            $damage_datetime = $date->format("m-d-Y h:i a");
            $sql = "UPDATE items
                    SET 
                        item_stock = item_stock + $item_count
                    WHERE
                        item_id = '$item_id'
                    ";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sql = "UPDATE purchased_item
                            SET 
                                item_count = item_count - $item_count
                            WHERE
                                purchased_id = '$purchased_id'
                            ";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $sql = "SELECT * FROM purchased_item WHERE purchased_id = '$purchased_id'";
                    $result = mysqli_query($conn, $sql);
                    $data = $result->fetch_assoc();
                    if($data["item_count"] > 0){
                        $data = array("message"=>"Item Voided!", "status"=>"success");
                        echo json_encode($data);
                    }else{
                        $sql = "DELETE FROM purchased_item WHERE purchased_id = '$purchased_id'";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            $data = array("message"=>"Item Voided!", "status"=>"success");
                            echo json_encode($data);
                        }else{
                            $data = array("message"=>"An Error Occured!", "status"=>"danger");
                            echo json_encode($data);
                        }
                    }
                }   
            }else{
                $data = array("message"=>"An Error Occured!", "status"=>"danger");
                echo json_encode($data);
            }
        }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>