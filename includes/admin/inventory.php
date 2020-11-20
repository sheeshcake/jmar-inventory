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
<div class="container shadow mb-4 p-3">
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
<table id="example" class="table table-striped table-bordered mw-400 no-wrap" width="100%">
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
	</div>
</div>
<div class="modal fade add-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
        <div class="card">
            <h4 class="card-header">
                Add Item
            </h4>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-2">
                        <img src="img/item.jpg" alt="item image" width="150px">
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="item-name">Item Name</label>
                        <input type="text" class="form-control" id="item-name" placeholder="Item Name" required>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="item-brand">Item Brand</label>
                        <input type="text" class="form-control" id="item-brand" placeholder="Item Brand" required>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="image-file">Item Brand</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image-file">
                            <label class="custom-file-label" for="image-file">Choose Image</label>
                        </div>
                    </div>
                    
                </div>


                <div class="form-row m-3">
                    <div class="col-md-6 my-4">
                        <div class="input-group">
                            <textarea class="form-control" id="item-description" rows="3" placeholder="Item Description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="category">Category</label>
                        <select class="form-control" id="category">
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="category">Unit</label>
                        <select class="form-control" id="category">
                            <option value="1">meter (m)</option>
                            <option value="2">grams (g)</option>
                            <option value="3">milliliters (mL)</option>
                            <option value="4">kilograms (kg</option>
                            <option value="5">liters (L)</option>
                            <option value="6">centimeters (cm)</option>
                            <option value="7">density (kg/m)</option>
                            <option value="8">length</option>
                            <option value="9">inches (")</option>
                        </select>
                    </div>
                </div>


                <div class="form-row m-3">
                    
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" id="input-capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price">
                    </div>
                    <div class="input-group col-md-4">
                        <input type="number" id="input-tax" class="form-control" aria-label="Tax" placeholder="Tax">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" id="total-item-price" aria-label="Price" placeholder="Price" readonly>
                    </div>
                </div>
                <br><div class="container">
                        <button type="button" class="btn btn-success btn-lg float-right">Submit</button>
                </div></br>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="js/inventory.js"></script>