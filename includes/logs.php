<?php
    include "controller/connect.php";
        $sql = "SELECT * FROM logs ORDER BY log_id DESC LIMIT 100;";
        $result = mysqli_query($conn, $sql);
        while($data = $result->fetch_assoc()){
            $verb = "";
            $id = $data["user_id"];
            $sql = "SELECT * FROM user WHERE user_id = '$id'";
            $user = mysqli_query($conn, $sql)->fetch_assoc();
            switch($data["action"]){
                case "login": $verb = " Logged in at "; break;
                case "edit-item": $verb = " Edited an Item at "; break;
                case "delete-item": $verb = " Deleted an Item at "; break;
                case "add-item": $verb = " Added an Item at "; break;
                case "register-account": $verb = " Added a new Account at "; break;
                case "transfer-item": $verb = " Transfered an Items at "; break;
                case "update-category": $verb = " Updated a Category at "; break;
                case "add-category": $verb = " Added a Category at "; break;
                case "delete-account": $verb = " Removed a Category at "; break;
            }
?>
<center>
    <div class="alert alert-secondary w-25" role="alert">
        <center>
            <?php echo  $user["f_name"] . $verb . $data["datetime"] ?>
        </center>
    </div>
</center>


<?php
        }
?>