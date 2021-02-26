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
        $sql = "SELECT *
                FROM transactions WHERE 
                transaction_type = 'outgoing' AND
                transaction_datetime LIKE '$date_now%'
                ";
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $total = 0;
        $sub_total_discount = 0;
        while($data = $result->fetch_assoc()){
            $id = $data["transaction_id"];
            echo '<tr class="table-success table-borderless">
                        <td colspan="4"><b>Transaction ID:</b> <u>' . $data["transaction_id"] . '</u> <b>Reciept No:</b> <u>' . $data["reciept_no"] . '</u><td>
                    </tr>';
            $sql1 = "SELECT * FROM items as i
                    INNER JOIN purchased_item as p
                    ON i.item_id = p.item_id
                    WHERE p.transaction_id = '$id'
            ";
            $result1 = mysqli_query($conn, $sql1) or trigger_error("Query Failed! SQL: $sql1 - Error: ".mysqli_error($conn), E_USER_ERROR);
            while($data1 = $result1->fetch_assoc()){
                $sub_total = $data1["item_price"] * $data1["item_count"];
    ?>
        <tr>
            <td><?php echo $data1["item_id"]; ?></td>
            <td><?php echo $data1["item_name"] . " " . $data1["item_desc"]; ?></td>
            <td>
                <?php echo "<b>" . $data1["item_unit_package"] . ":</b> " . $data1["item_count"] . $data1["item_unit_package"]; ?>
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