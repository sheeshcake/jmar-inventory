<?php
    session_start();
    $roles = [
        "admin" => ["account", "transaction", "notification", "inventory", "transaction-new", "transfer", "transfer-history","register", "incoming", "all-items", "return", "default" =>"dashboard"],
        "encoder" => ["account","all-items","inventory", "notification", "incoming", "default" =>"inventory"],
        "accountant" => ["account", "transaction", "return", "transaction-new", "default" =>"transaction-new"]
    ];
    function guard($folder = false){
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