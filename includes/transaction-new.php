<?php
    include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/inventory.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
</div>
<div class="alert alert-success" role="alert" style="display: none">
  This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="d-flex mb-4">
    <div class="shadow m-1 p-3">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </tfoot>
            <tbody id="item_data">
                <?php include "get-items-transaction-new.php"; ?>
            </tbody>
        </table>			
    </div>
    <div class="shadow m-1 p-3">
        <h4>New Transaction</h4>
        <div class="alert alert-success" id="trans-message" role="alert" style="display: none">
        </div>
        <div class="overflow-auto" style="height: 350px;" id="items">
        </div>
        <div class="mt-2">
            <div class="d-flex"><b>Total Items:&nbsp;</b><p id="total_items">0</p></div>
            <div class="d-flex"><b>Total:&nbsp;</b>₱ <p id="total">0</p></div>
            <button class="submit-transaction btn btn-primary" style="display: none; width: 100%;">Submit</button>
        </div>
    </div>

</div>
<?php include "new-item-modal.php"; ?>
<script src="js/transaction-new.js"></script>