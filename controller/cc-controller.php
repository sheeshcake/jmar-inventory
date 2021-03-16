<?php
    include "connect.php";
    if(isset($_POST["submit"])){
        // var_dump($_POST);
        if($_POST["submit"] == "damage"){
            $item_id = $_POST["item_id"];
            $item_count = 0;
            $purchased_id = $_POST["purchased_id"];
            $sql = "SELECT item_on_$location FROM purchased_item WHERE purchased_id = '$purchased_id'";
                $get_data = mysqli_query($conn, $sql)->fetch_assoc() or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
                if(floatval($get_data["item_on_" . $location]) > 0){
                $sql = "SELECT * FROM items WHERE item_id = '$item_id'";
                $d = mysqli_query($conn, $sql)->fetch_assoc();
                if($_POST["location"] == "warehouse"){
                    $item_count = number_format(floatval($_POST["item_count"] * $d["item_unit_divisor"]), 2);
                }else{
                    $item_count = $_POST["item_count"];
                }
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
                $data = array("message"=>"Stock on " . $location . " is less than " . $_POST["item_count"] . "!", "status"=>"danger");
                echo json_encode($data);
            }
        }else{
            $item_id = $_POST["item_id"];
            $item_count = 0;
            $location = $_POST["location"];
            $item_input = $_POST["item_count"];
            $purchased_id = $_POST["purchased_id"];
            $sql = "SELECT item_on_$location FROM purchased_item WHERE purchased_id = '$purchased_id'";
            $get_data = mysqli_query($conn, $sql)->fetch_assoc() or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
            if(floatval($get_data["item_on_" . $location]) > 0 && floatval($get_data["item_on_" . $location] - $_POST["item_count"]) >= 0){
                $sql = "SELECT * FROM items WHERE item_id = '$item_id'";
                $d = mysqli_query($conn, $sql)->fetch_assoc();
                if($location == "warehouse"){
                    $item_count = number_format(floatval($_POST["item_count"] * $d["item_unit_divisor"]), 2);
                }else{
                    $item_count = $_POST["item_count"];
                }
                $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
                $damage_datetime = $date->format("m-d-Y h:i a");
                $sql = "UPDATE items
                        SET 
                            item_stock = item_stock + $item_count
                        WHERE
                            item_id = '$item_id'
                        ";
                $result = mysqli_query($conn, $sql)  or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);
                if($result){
                    $sql = "UPDATE purchased_item
                                SET 
                                    item_count = item_count - $item_count,
                                    item_on_$location = item_on_$location - $item_input
                                WHERE
                                    purchased_id = '$purchased_id'
                                ";
                    $result = mysqli_query($conn, $sql)  or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
                    if($result){
                        $sql = "SELECT * FROM purchased_item WHERE purchased_id = '$purchased_id'";
                        $result = mysqli_query($conn, $sql)  or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
                        $data = $result->fetch_assoc();
                        if($data["item_count"] > 0){
                            $data = array("message"=>"Item Voided!", "status"=>"success");
                            echo json_encode($data);
                        }else{
                            $sql = "DELETE FROM purchased_item WHERE purchased_id = '$purchased_id'";
                            $result = mysqli_query($conn, $sql)  or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($conn), E_USER_ERROR);;
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
            }else{
                $data = array("message"=>"Stock on " . $location . " is less than " . $_POST["item_count"] . "!", "status"=>"danger");
                echo json_encode($data);
            }
            
        }
    }else{
        $data = array("message"=>"Please Fill The Fields!", "status"=>"danger");
        echo json_encode($data);
    }
?>