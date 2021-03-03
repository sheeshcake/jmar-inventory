<?php
    include "../controller/connect.php";
    include "../controller/core.php";
    guard();
    $date = new DateTime("now", new DateTimeZone('Asia/Singapore') );
    $date_now = $date->format("m-d-Y");
    $sql = "SELECT * FROM items INNER JOIN category ON items.category_id = category.category_id ";
    $result = mysqli_query($conn, $sql);
    if($result){
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
        <h5 class="mr-auto">Item Report</h5>
        <h5 class="ml-auto"><b>Date:&nbsp;</b><u><?php echo $date_now; ?></u></h5>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th>Item #</th>
                <th>Image</th>
                <th>Name & Description</th>
                <th>Item Stock</th>
                <th>Item Capital</th>
                <th>Price Retail</th>
            </tr>
        </thead>
        <tbody>
<?php
        while($data = $result -> fetch_assoc()){
            
?>
        <tr>
            <td><?php echo $data["item_id"]; ?></td>
            <td><img src="../img/item/<?php echo $data["item_img"] ?>" alt="" width="100" ></td>
            <td>
                <?php 
                    echo "<p>" . $data["item_name"] . "</p><hr><p>" . $data["item_desc"] . "</p>"; 
                    if($data["item_unit"] != "Pieces"){
                        echo "<hr>";
                        echo "<p>Net Content: " . $data["item_unit_divisor"] . " " . $data["item_unit_package"] . " per 1(one) " . $data["item_unit"] . "</p>";
                    }
                ?>
            </td>
            <td>
                Store:<p><?php echo $data["item_stock"] . " " . $data["item_unit_package"];?></p>
                <hr>
                Warehouse: <p><?php echo intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]) . " " . $data["item_unit"];?></p>
            </td>
            <td>
                <?php            
                    echo "<p>₱" . number_format($data["item_capital"], 2) . " per " . $data["item_unit"] . "</p>";
                    if($data["item_unit"] != "Pieces"){
                        echo "<hr>";
                        echo "<p>₱" . number_format($data["item_capital_retail"], 2) . " per " . $data["item_unit_package"] . "</p>";
                    }
                ?>
            </td>
            <td>
                <?php            
                    echo "<p>₱" . number_format(floatval($data["item_price"] * $data["item_unit_divisor"]), 2) . " per " . $data["item_unit"] . "</p>";
                    if($data["item_unit"] != "Pieces"){
                        echo "<hr>";
                        echo "<p>₱" . number_format($data["item_price"], 2) . " per " . $data["item_unit_package"] . "</p>";
                    }
                ?>
            </td>
        </tr>
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
</body>

<style>
@media print {
  #back,#print {
    display: none;
  }
}
</style>
</html>