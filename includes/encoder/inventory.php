<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="css/inventory.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
    <div class="ml-auto p-2">
        <button class="btn btn-primary btn-sm" id="add-item">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Add Item
        </button>
    </div>
</div>
<div class="container card shadow mb-4 p-3">
	<div class="row">
		<div class="col">
<div class="dropdown" id="stock-filter">
	<button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <th>Item Capital</th>
                <th>Item ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Tax</th>
                <th>Price</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Item Capital</th>
                <th>ID</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Tax</th>
                <th>Price</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>55.2</td>
                <td>1</td>
                <td>Bulb1</td>
                <td>Firefly</td>
                <td>Bulbs</td>
                <td>20%</td>
                <td>
                    <div class="form-group">
                        <input type="number" value="69" class="form-control w-50">
                    </div>
                </td>
                <td>                
                    <div class="form-group">
                        <input type="number" value="100" class="form-control w-50">
                    </div>
                </td>
                <td>
                    <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <button class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>55.2</td>
                <td>2</td>
                <td>Bulb1</td>
                <td>Fireflyasdasdasdd</td>
                <td>Bulbs</td>
                <td>20%</td>
                <td>
                    <div class="form-group">
                        <input type="number" value="69" class="form-control w-50">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="number" value="100" class="form-control w-50">
                    </div>
                </td>
                <td>
                <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <button class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </td>
            </tr>
        </tbody>
    </table>			
		</div>
	</div>
</div>
<script src="js/inventory.js"></script>