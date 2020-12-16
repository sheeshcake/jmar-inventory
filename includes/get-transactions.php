<?php
    include "controller/connect.php";
    $sql = "SELECT * FROM transactions WHERE transaction_type = 'outgoing'";
    $all_data = [];
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
        $id = $data["transaction_id"];
        $sql1 = "SELECT 
                    * 
                FROM 
                    purchased_item 
                INNER JOIN
                    items
                ON
                    purchased_item.item_id = items.item_id
                WHERE 
                    transaction_id = '$id'";
        $result1 = mysqli_query($conn, $sql1);
        $total_items = 0;
        $total_paid = 0;
        while($data1 = $result1->fetch_assoc()){
            $total_items = mysqli_num_rows($result1);
            $total_paid += ((($data1["item_tax"] / 100) * $data1["item_price"]) + $data1["item_price"]) * $data1["item_count"];
        }
?>
            <tr>
                <td><?php echo $data["transaction_id"] ?></td>
                <td><?php echo $data["transaction_datetime"] ?></td>
                <td><?php echo $total_items ?></td>
                <td>₱<?php echo number_format($total_paid, 2) ?></td>
                <td><button class="open btn btn-primary" value="<?php echo $data["transaction_id"] ?>" data-toggle="modal" data-target="#transmodal">Open</button></td>
            </tr>
<?php
    }

?>