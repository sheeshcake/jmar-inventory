<?php
    session_start();
    if(isset($_SESSION["user"])){
        include "includes/home.php";
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
    }else{
        include "includes/login.php";
    }
?>