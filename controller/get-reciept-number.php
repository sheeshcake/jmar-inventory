<?php
    include "../controller/connect.php";
    $sql = "SELECT * FROM transactions WHERE transaction_id = (SELECT MAX(transaction_id) FROM transactions)";
    $result = mysqli_query($conn, $sql);
    echo json_encode($result->fetch_assoc());
?>
