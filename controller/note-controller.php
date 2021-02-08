<?php
    include "../controller/connect.php";
    if($_POST["note_id"] != ""){
        $note_id = $_POST["note_id"];
        $note_data = $_POST["note_data"];
        $sql = "SELECT * FROM notes WHERE note_id = '$note_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql = "UPDATE notes SET note_data = '$note_data' WHERE note_id = '$note_id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                return "true";
            }else{
                return "false";
            }
        }else{
            return "false";
        }
    }else{
        $user_id = $_POST["user_id"];
        $note_data = $_POST["note_data"];
        $sql = "INSERT INTO notes (note_data, user_id) VALUES('$note_data', '$user_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo $conn->insert_id;
        }else{
            return "false";
        }
    }
?>