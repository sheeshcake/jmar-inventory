<h1><i class="fa fa-wrench" aria-hidden="true"></i>Under Development</h1>


<?php
    //include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Customer Concern</h1>
</div>
<div class="shadow mb-4 p-3">
    <table id="example" style="width:1000px"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Date Time</th>
                <th>Total Items</th>
                <th>Total Paid</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Date Time</th>
                <th>Total Items</th>
                <th>Total Paid</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php include "get-transactions.php"; ?>
        </tbody>
    </table>			
</div>
<script src="js/return.js"></script>