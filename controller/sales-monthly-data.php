<?php
    include "connect.php";
    if(isset($_POST["date"])){
        $header_date = new DateTime($_POST["date"]);
?>
    <center>
    <h4>JMAR Enterprise</h4>
    </center>
    <div class="row my-3">
        <h5 class="mr-auto">Daily Sales Report</h5>
        <h5 class="ml-auto"><b>Date:&nbsp;</b><u><?php echo $header_date->format("m-d-Y"); ?></u></h5>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>Item #</th>
                <th>Name & Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
<?php
        $date = $_POST["date"];
        $date_now = explode("-", $date);
        $month = $date_now[1];
        $year = $date_now[0];
        $sql = "SELECT *
                FROM transactions WHERE 
                transaction_type = 'outgoing' AND
                transaction_datetime LIKE '$month-%-$year%'
                ";
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $total = 0;
        $sub_total_discount = 0;
        if(mysqli_num_rows($result) > 0){
            while($data = $result->fetch_assoc()){
                $id = $data["transaction_id"];
                $sql1 = "SELECT * FROM items as i
                        INNER JOIN purchased_item as p
                        ON i.item_id = p.item_id
                        WHERE p.transaction_id = '$id'
                ";
                $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
                if(mysqli_num_rows($result1) > 0){
                    echo '<tr class="table-success table-borderless">
                        <td colspan="4"><b>Transaction ID:</b> <u>' . $data["transaction_id"] . '</u> <b>Reciept No:</b> <u>' . $data["reciept_no"] . '</u><td>
                    </tr>';
                while($data1 = $result1->fetch_assoc()){
                    $sub_total = $data1["item_price"] * $data1["item_count"];
?>
    <tr>
        <td><?php echo $data1["item_id"]; ?></td>
        <td><?php echo $data1["item_name"] . " " . $data1["item_desc"]; ?></td>
        <td>
            <?php  
                echo "<b>Store: </b> " . $data1["item_on_store"] . " " . $data1["item_unit_package"] . "<br>";
                echo "<b>Warehouse: </b> " . $data1["item_on_warehouse"] . " " . $data1["item_unit"];
                if($data1["item_unit"] != "Pieces"){
                    echo " (" . $data1["item_unit_divisor"] . ") " . $data1["item_unit_package"];
                }
            ?>
        </td>
        <td><?php echo "₱" . number_format($data1["item_price"], 2, '.', ','); ?></td>
        <td class="table-warning"><?php echo "₱" . number_format($sub_total, 2, '.', ','); ?></td>
    </tr>
<?php
                }
                    $sub_total_discount += floatval($sub_total - floatval($sub_total * floatval($data["discount"] / 100)));
                    echo "<tr>" .
                            "<td></td>" .
                            "<td></td>" .
                            "<td></td>" .
                            "<td class='bg-light'>Discount:</td>" .
                            "<td class='bg-light'>" .
                                $data["discount"] . "%".
                            "</td>".
                        "</tr>" .
                        "<tr>" .
                            "<td></td>" .
                            "<td></td>" .
                            "<td></td>" .
                            "<td class='bg-light'>Sub Total:</td>" .
                            "<td class='bg-light'>" .
                                "₱" . number_format($sub_total_discount, 2) .
                            "</td>".
                        "</tr>";
                    $total += $sub_total_discount;
                    $sub_total = 0;
                    $sub_total_discount = 0;
                }
            }
?>
<tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th class="table-secondary">Total</th>
        <th class="table-secondary"><?php echo "₱" . number_format($total, 2, '.', ','); ?></th>
    </tr>
</tfoot>
<?php
        }
    }
?> 

</table>
    <div class="d-flex mt-5">
        <h5 class="mr-auto">Signature:_____________________</h5>
    </div>
</div>