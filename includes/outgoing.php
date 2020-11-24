<?php
    include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
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
<div class="shadow mb-4 p-3">
	<!-- <div class="row">
		<div class="col">
<div class="dropdown" id="stock-filter">
	<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Filter <span class="caret"></span>
	</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<a class="toggle-vis dropdown-item" data-column="1" data-value="option2" tabIndex="-1"><input type="checkbox" checked />&nbsp;In Stock</a>
		<a class="toggle-vis dropdown-item" data-column="2" data-value="option3" tabIndex="-1"><input type="checkbox" checked />&nbsp;Out Of Stock</a>
	</div>
</div> -->
<!-- <select class="form-control w-25 mb-2">
    <option>All</option>
    <option>In Stock</option>
    <option>Out Of Stock</option>
</select> -->
    <table id="example"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Item Capital</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Tax</th>
                <th>Stock</th>
                <th>Price</th>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Item Capital</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Tax</th>
                <th>Stock</th>
                <th>Price</th>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php include "get-items.php"; ?>
        </tbody>
    </table>			
</div>
<?php include "new-item-modal.php"; ?>
<script src="js/inventory.js"></script>