<?php
    session_start();

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

    function home_core(){
        if(isset($_SESSION["user"])){
            if(isset($_GET["p"])){
                if(file_exists("includes/" . $_GET["p"] . ".php")){
                    include "includes/" . $_GET["p"] . ".php";
                }
                else{
                    include "includes/error404.php";
                }
            }
            else{
                include "includes/dashboard.php";
            }
        }
    }
    function sidebar_core(){
        if(file_exists("includes/" . $_SESSION["user"]["role"] . "/sidebar.php")){
            include "includes/" . $_SESSION["user"]["role"] . "/sidebar.php";
        }
    }
?>