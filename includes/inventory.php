<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/inventory.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<div class="inventory-head d-flex">
    <h3>Inventory</h3>
    <div class="ml-auto p-2">
        <button class="btn btn-primary" id="add-item">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Item
        </button>
    </div>
</div>
<div class="container">
	<div class="row">
		<div class="col">
<div class="dropdown" id="stock-filter">
	<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Filter <span class="caret"></span>
	</button>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<a class="toggle-vis dropdown-item" data-column="1" data-value="option2" tabIndex="-1"><input type="checkbox" checked />&nbsp;In Stock</a>
		<a class="toggle-vis dropdown-item" data-column="2" data-value="option3" tabIndex="-1"><input type="checkbox" checked />&nbsp;Out Of Stock</a>
	</div>
</div>
<!-- <select class="form-control w-25 mb-2">
    <option>All</option>
    <option>In Stock</option>
    <option>Out Of Stock</option>
</select> -->
<table id="example" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>1</td>
                <td>Bulb1</td>
                <td>Firefly</td>
                <td>Bulbs</td>
                <td>69.00</td>
                <td>100</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Bulb1</td>
                <td>Fireflyasdasdasdd</td>
                <td>Bulbs</td>
                <td>69.00</td>
                <td>100</td>
            </tr>
        </tbody>
    </table>			
		</div>
	</div>
</div>
<script src="js/inventory.js"></script>