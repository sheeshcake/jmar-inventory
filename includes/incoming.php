<?php
    include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" href="css/incoming.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Incoming</h1>
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
<div class="row">
    <div class="shadow mb-4 p-3" style="max-width: 1200px; min-width: 59%; max-height: 800px; overflow-y: scroll;">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Capital</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Capital</th>
                    <th>Stock</th>
                </tr>
            </tfoot>
            <tbody id="item_data">
                <?php include "incoming-get-items.php"; ?>
            </tbody>
        </table>		
    </div>
    <div class="shadow mb-1 ml-2 p-3" style="max-height: 800px">
        <h4 id="transaction" >Incoming Transaction</h4>
        <div class="alert alert-success" id="trans-message" role="alert" style="display: none">
        </div>
        <div class="flex-fill m-1">
                    <div class="d-flex" style="margin-bottom: -2%;">
                        <input  style="margin-right: 2%;" required type="text" class="form-control mb-1" id="supplier_name" name="supplier" placeholder="Supplier Name">
                        <input  style="margin-right: 2%;" required type="text" class="form-control mb-1" id="address" name="supplier-address" placeholder="Address" data-toggle="tooltip" data-placement="top" title="Supplier Address">
                        <input  required type="text" class="form-control mb-1" id="contact_no" name="supplier-contact" placeholder="Contact No." data-toggle="tooltip" data-placement="top" title="Supplier Contact Number">
                    </div>
                    <div class="d-flex">
                        <select  style="margin-right: 2%;" class="form-control w-25" id="terms_of_payment" name="payment" data-toggle="tooltip" data-placement="top" title="Mode of Payment">
                                    <option value="cod">COD</option>
                                    <option value="term-7">Term 7(days)</option>
                                    <option value="term-15">Term 15(days)</option>
                                    <option value="term-30">Term 30(days)</option>
                                    <option value="term-60">Term 60(days)</option>
                                    <option value="term-90">Term 90(days)</option>
                                    <option value="cash">Cash</option>
                        </select>
                        <div class="d-flex" style="margin-bottom: -2%;">
                            <input  style="margin-right: 2%;" required type="text" class="form-control mb-1 w-50" id="driver_name" name="delivery-details" placeholder="Driver's Name">
                            <input  required type="text" class="form-control mb-1 w-50" id="plate_no" name="delivery-details" placeholder="Plate No." data-toggle="tooltip" data-placement="top" title="Truck Plate Number">
                        </div>
                    </div>
                </div>
            
           

        <div class="overflow-auto" style="max-height: 515px; min-height: 515px; min-width: 400px;" id="items">
        </div>
        <div class="mt-2">
            <div class="d-flex"><b>Total Items:&nbsp;</b><p id="total_items">0</p></div>
            <div class="d-flex"><b>Total:&nbsp;</b>₱ <p id="total">0</p></div>
            <button class="submit-transaction btn btn-primary" style="display: none; min-width: 100%">Submit</button>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.2.0/math.js" integrity="sha512-SewEag0kt1xsJdbfAXgLyLvYXeAoGEla4M6JSitT6ocJVI+VeUbFXkgrbloNn4cVgq46caRf31un2eoalq6YOw==" crossorigin="anonymous"></script>
<?php include "new-item-incoming-modal.php"; ?>
<script src="js/incoming.js"></script>