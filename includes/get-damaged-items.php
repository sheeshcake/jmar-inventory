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
        $total_items = mysqli_num_rows($result1);
        if($total_items > 0){
            $total = 0;
            $sub_total = 0;
            while($data1 = $result1->fetch_assoc()){
                if($data["paid"] == "true"){
                    $total_price = $data1["item_price"] * $data1["item_count"];
                    $sub_total = floatval($total_price + $sub_total);
                }
            }
            $sub_total = floatval($sub_total - floatval($sub_total * floatval($data["discount"] / 100)));
?>
            <tr>
                <td>
                    <?php 
                        echo $data["transaction_id"] . "/" . $data["reciept_no"];
                        if($data["paid"] == "true"){
                            echo '<span class="badge badge-success">Paid</span>';
                        }else{
                            echo '<span class="badge badge-danger">Unpaid</span>';
                        }
                    ?>
                </td>
                <td><?php echo $data["transaction_datetime"] ?></td>
                <td><?php echo $total_items ?></td>
                <td><?php echo $data["courier"] ?></td>
                
            </tr>
<?php   
        }
    }

?>