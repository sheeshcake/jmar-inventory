<?php
    include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/inventory.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
    <div class="ml-auto p-2">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".add-item-modal" id="add-item">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Item
        </button>
    </div>
</div>
<div class="alert alert-success" role="alert" style="display: none">
  This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="shadow mb-4 p-3" style=" max-height: 1000px; overflow-y: scroll;">
    <table id="example"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Details</th>
                <th>Price</th>
                <th>Selection</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Image</th>
                <th>Details</th>
                <th>Price</th>
                <th>Selection</th>
            </tr>
        </tfoot>
        <tbody>
            <?php include "get-items.php"; ?>
        </tbody>
    </table>			
</div>
<?php include "new-item-modal.php"; ?>
<script src="js/inventory.js"></script>