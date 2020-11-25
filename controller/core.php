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

    }

    function home_core(){
        $roles = [
            "admin" => ["transaction", "inventory", "incoming", "default" =>"dashboard"],
            "encoder" => ["inventory", "incoming", "default" =>"inventory"],
            "accountant" => ["transaction",  "default" =>"transaction"]
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