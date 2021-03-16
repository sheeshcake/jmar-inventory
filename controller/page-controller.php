<?php
    include "../controller/connect.php";
    include "../controller/core.php";
    if(isset($_POST["page"]) && guard()){
        $_SESSION["page"] = $_POST["page"];
        include "../includes/" . $_POST["page"] . ".php";
    }
?>