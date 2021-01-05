<?php
    include "../controller/connect.php";
    include "../controller/core.php";
    guard();
    $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
    $date_now = $date->format("m-d-Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JMAR</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body id="page-top" class="main-content">
<div class="d-flex m-2 p-2">
    <button onclick="window.history.back();" id="back" class="btn btn-secondary mr-auto"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    <button onClick="window.print();" id="print" class="btn btn-primary ml-auto"><i class="fa fa-print" aria-hidden="true"></i> Print</button>

</div>

</br>
<div class="container">
    <center><h4>JMAR Enterprise</h4></center>
    <div class="d-flex mb-4">
        <h5 class="mr-auto">Daily Sales Report</h5>
        <h5 class="ml-auto"><b>Date:&nbsp;</b><u><?php echo $date_now; ?></u></h5>
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
        $sql = "SELECT t.transaction_datetime, t.transaction_type, t.transaction_id, p.item_type, p.transaction_id, i.item_name, i.item_desc, i.item_price, i.item_unit, i.item_price_wholesale, i.item_unit_divisor, i.item_tax_wholesale, i.item_tax, i.item_id, SUM(p.item_count) AS total_quantity
                FROM purchased_item as p
                INNER JOIN items as i
                INNER JOIN transactions as t
                ON p.item_id = i.item_id
                WHERE t.transaction_datetime LIKE '$date_now%'
                AND t.transaction_type = 'outgoing'
                AND t.transaction_id = p.transaction_id
                GROUP BY i.item_id, p.item_type
             ";
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $total = 0;
        while($data = $result->fetch_assoc()){
            if($data["item_unit"] == "Box") $item_u2 = "pieces";
            if($data["item_unit"] == "Sack") $item_u2 = "kilo(s)";
            if($data["item_unit"] == "Roll") $item_u2 = "meter(s)";
            if($data["item_type"] == "wholesale"){
                $price = (floatval(($data["item_tax_wholesale"]) / 100) * floatval($data["item_price_wholesale"])) + floatval($data["item_price_wholesale"]);
                $item_u2 = $data["item_unit"];
                $sub_total = $price * $data["total_quantity"] / floatval($data["item_unit_divisor"]);
                $quantity = $data["total_quantity"] / $data["item_unit_divisor"];
            }else{
                $price = (floatval(($data["item_tax"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price"]);
                $sub_total = $price * $data["total_quantity"];
                $quantity = $data["total_quantity"];
            }
            $total += $sub_total;
    ?>
        <tr>
            <td><?php echo $data["item_id"]; ?></td>
            <td><?php echo $data["item_name"] . " " . $data["item_desc"]; ?></td>
            <td>
                <?php echo "<b>" . $data["item_type"] . ":</b> " . $quantity . $item_u2; ?>
            </td>
            <td><?php echo "₱" . number_format($price, 2, '.', ','); ?></td>
            <td class="table-warning"><?php echo "₱" . number_format($sub_total, 2, '.', ','); ?></td>
        </tr>
    <?php
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
    </tbody>

    </table>
    <div class="d-flex mt-5">
        <h5 class="mr-auto">Signature:_____________________</h5>
    </div>
    </div>
</body>

<style>
@media print {
  #back,#print {
    display: none;
  }
}
</style>
</html>