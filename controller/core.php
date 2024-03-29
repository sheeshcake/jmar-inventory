<?php
    $roles = [
        "admin" => ["account", "transaction", "notification", "inventory", "transaction-new", "transfer", "transfer-history", "sale-daily-history", "sale-monthly-history", "incoming-history", "stock-transfer-history", "register", "incoming", "all-items", "return", "damaged-items", "logs", "default" =>"dashboard"],
        "encoder" => ["account","all-items","inventory", "notification", "incoming", "damaged-items", "default" =>"inventory"],
        "accountant" => ["account", "transaction", "return", "transaction-new", "default" =>"transaction-new"]
    ];
    function guard($folder = false){
        session_start();
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
        if(!isset($_SESSION["user"])){
            header('Location:' . $actual_link);
        }else if($folder){
            header('Location:' . $actual_link);
        }else{
            return true;
        }
    }
    function page(){
        session_start();
        if(isset($_SESSION["page"])){
            include "includes/" . $_SESSION["page"] . ".php";
        }else{
            if(isset($_SESSION["user"])){
                include "includes/home.php";
            }else{
                include "includes/login.php";
            }
        }
    }

    function logs($action, $id){
        include "connect.php";
        $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
        $datetime = $date->format("m-d-Y h:i a");
        $sql = "INSERT INTO logs (action, datetime, user_id) 
                VALUES ('$action', '$datetime', '$id') ";
        $result = mysqli_query($conn, $sql);
    }

    function dashboard_core($action){
        include "includes/$action.php";
    }

    function home_core($reason = NULL, $reason2 = NULL){
        if($reason != NULL){
            if($reason == "get"){
                return $GLOBALS['roles'][$_SESSION["user"]["role"]]["default"];
            }else if($reason == "get_roles"){
                return $GLOBALS['roles'][$reason2];
            }else{
                return "hhmmmm... not today..";
            }
        }else{
            if(isset($_SESSION["user"])){
                if(isset($_GET["p"])){
                    if(in_array($_GET["p"], $GLOBALS['roles'][$_SESSION["user"]["role"]])){
                        if(file_exists("includes/" . $_GET["p"] . ".php")){
                            include "includes/" . $_GET["p"] . ".php";
                        }
                        else{
                            include "includes/error404.php";
                        }
                    }else{
                        include "includes/error404.php";
                    }
                }
                else{
                    include "includes/" . $GLOBALS['roles'][$_SESSION["user"]["role"]]["default"] . ".php";
                }
            }
        }
    }
    function sidebar_core(){
        if(file_exists("includes/" . $_SESSION["user"]["role"] . "/sidebar.php")){
            include "includes/" . $_SESSION["user"]["role"] . "/sidebar.php";
        }
    }
?>