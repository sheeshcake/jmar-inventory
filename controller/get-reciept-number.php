<?php
    include "../controller/connect.php";
    $sql = "SELECT * FROM transactions ORDER BY reciept_no DESC limit 1";
    $result = mysqli_query($conn, $sql);
    echo json_encode($result->fetch_assoc());
?>
