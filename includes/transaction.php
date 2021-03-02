<?php
    include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/inventory.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
</div>
<div class="alert alert-success" role="alert" style="display: none">
  This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="shadow mb-4 p-3">
    <table id="example"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Item Capital</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Revenue</th>
                <th>Price</th>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Item Capital</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Revenue</th>
                <th>Price</th>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Stock</th>
            </tr>
        </tfoot>
        <tbody>
            <?php include "get-items-transaction.php"; ?>
        </tbody>
    </table>			
</div>
<?php include "new-item-modal.php"; ?>
<script src="js/transaction.js"></script>