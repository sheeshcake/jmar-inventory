<?php
    include "../controller/connect.php";
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
        <h5 class="mr-auto">Damaged Items Report</h5>
        <h5 class="ml-auto"><b>Date:&nbsp;</b><u><?php echo $date_now; ?></u></h5>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>Item #</th>
                <th>Name & Description</th>
                <th>Date & Time</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $sql = "SELECT * FROM damaged_items
                INNER JOIN items
                ON damaged_items.item_id=items.item_id
             ";
        $result = mysqli_query($conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
        $total = 0;
        while($data = $result->fetch_assoc()){
            $total += $data["item_count"];
    ?>
        <tr>
            <td><?php echo $data["item_id"]; ?></td>
            <td><?php echo $data["item_name"] . " " . $data["item_desc"]; ?></td>
            <td><?php echo $data["damage_datetime"] ?></td>
            <td><?php echo $data["item_count"]; ?></td>
        </tr>
    <?php
        }
    ?> 
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th class="table-secondary">Total</th>
                <th class="table-secondary"><?php echo $total . " items"; ?></th>
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