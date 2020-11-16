<?php
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
?>