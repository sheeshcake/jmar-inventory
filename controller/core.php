<?php
    session_start();
    // var_dump(in_array($_GET["p"], $roles[$_SESSION["user"]["role"]]));
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

    function home_core(){
        $roles = [
            "admin" => ["account", "transaction", "inventory", "transaction-new", "incoming", "return", "default" =>"dashboard"],
            "encoder" => ["account","inventory", "incoming", "return", "default" =>"inventory"],
            "accountant" => ["account", "transaction", "transaction-new", "default" =>"transaction"]
        ];
        if(isset($_SESSION["user"])){
            if(isset($_GET["p"]) && in_array($_GET["p"], $roles[$_SESSION["user"]["role"]])){
                if(file_exists("includes/" . $_GET["p"] . ".php")){
                    include "includes/" . $_GET["p"] . ".php";
                }
                else{
                    include "includes/error404.php";
                }
            }
            else{
                include "includes/" . $roles[$_SESSION["user"]["role"]]["default"] . ".php";
            }
        }
    }
    function sidebar_core(){
        if(file_exists("includes/" . $_SESSION["user"]["role"] . "/sidebar.php")){
            include "includes/" . $_SESSION["user"]["role"] . "/sidebar.php";
        }
    }
?>