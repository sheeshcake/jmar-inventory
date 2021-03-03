<?php
    include "connect.php";
    if(isset($_POST["date"])){
        $header_date = new DateTime($_POST["date"]);
?>
    <center>
    <h4>JMAR Enterprise</h4>
    </center>
    <div class="row my-3">
        <h5 class="mr-auto">Stock Transfer Report</h5>
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
        $day = $date_now[2];
        $month = $date_now[1];
        $year = $date_now[0];
        $sql = "SELECT *
                FROM stock_transfer WHERE 
                transfer_date LIKE '$month $day $year'
                ";
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $total = 0;
        $sub_total = 0;
        if(mysqli_num_rows($result) > 0){
            while($data = $result->fetch_assoc()){
                $id = $data["transfer_id"];
                echo '<tr class="table-success table-borderless">
                            <td colspan="2"><b>Transfer ID:</b> <u>' . $data["transfer_id"] . '</u><td>
                            <td ><b>Transfer Time:</b> <u>' . $data["transfer_time"] . '</u><td>
                        </tr>';
                $sql1 = "SELECT * FROM items as i
                        INNER JOIN transfered_items as trs
                        ON i.item_id = trs.item_id
                        WHERE trs.transfer_id = '$id'
                ";
                $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
                while($data1 = $result1->fetch_assoc()){
                    $total_items = intval($data1["item_count"] / $data1["item_unit_divisor"]);
                    $price = $data1["item_capital"];
                    $sub_total += $price * $total_items;
    ?>
        <tr>
            <td><?php echo $data1["item_id"]; ?></td>
            <td><?php echo $data1["item_name"] . " " . $data1["item_desc"]; ?></td>
            <td>
                <?php echo "<b>" . $data1["item_unit"] . ":</b> " . $total_items . $data1["item_unit"]; ?>
            </td>
            <td><?php echo "₱" . number_format($price, 2, '.', ','); ?></td>
            <td class="table-warning"><?php echo "₱" . number_format(floatval($price * $total_items), 2, '.', ','); ?></td>
        </tr>
    <?php
                }
                echo 
                    "<tr>" .
                        "<td></td>" .
                        "<td></td>" .
                        "<td></td>" .
                        "<td class='bg-light'>Sub Total:</td>" .
                        "<td class='bg-light'>" .
                            "₱" . number_format($sub_total, 2) .
                        "</td>".
                    "</tr>";
                $total += $sub_total;
                $sub_total = 0;
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
    </tbody>

    </table>
    <div class="d-flex mt-5">
        <h5 class="mr-auto">Signature:_____________________</h5>
    </div>
</div>