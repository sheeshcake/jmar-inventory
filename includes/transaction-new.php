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
<div class="row mb-4">
    <div class="shadow m-1 p-3" style="max-width: 65%; max-height: 800px; overflow-y: scroll;">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Name & Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Name & Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </tfoot>
            <tbody id="item_data">
                <?php include "get-items-transaction-new.php"; ?>
            </tbody>
        </table>			
    </div>
    <div class="shadow m-1 p-3" style="max-height: 1000px; width: 34%;">
        <div class="d-flex">
            <div>
                <h4 id="transaction" >New Transaction</h4>
                <div class="custom-control custom-switch pt-2">
                    <input type="checkbox" class="custom-control-input" id="delivery">
                    <label class="custom-control-label" for="delivery">Delivery</label>
                </div>
            </div>
            <div class="form-group ml-auto">
                <label for="reciept">Reciept Number</label>
                <input type="number" class="form-control" id="reciept" name="reciept_no" placeholder="Reciept No.">
            </div>
            
        </div>
        <div class="alert alert-success" id="trans-message" role="alert" style="display: none">
        </div>
        <div class="d-flex" style="margin-bottom: -2%;">
                    <input style="display:none; margin-right: 2%;" required type="text" class="form-control mb-1" id="courier" name="courier" placeholder="Courier Name">
                    <select class="form-control w-50" id="payment" name="payment" style="display:none;" data-toggle="tooltip" data-placement="top" title="Mode of Payment">
                                    <option value="cod">COD</option>
                                    <option value="term-7">Term 7(days)</option>
                                    <option value="term-15">Term 15(days)</option>
                                    <option value="term-30">Term 30(days)</option>
                                    <option value="term-60">Term 60(days)</option>
                                    <option value="term-90">Term 90(days)</option>
                                    <option value="cash">Cash</option>
                    </select>
                </div>
                    <div class="d-flex" >
                        <input  style="margin-right: 2%; display:none;" required type="text" class="form-control mb-1 w-50" id="customer-name" name="customer-name" placeholder="Customer's Name">
                        <input  style="margin-right: 2%; display:none;" required type="text" class="form-control mb-1 w-50" id="customer-address" name="customer-address" placeholder="Address" data-toggle="tooltip" data-placement="top" title="Customer Address">
                        <input  style="display:none;" required type="text" class="form-control mb-1 w-50" id="customer-contact" name="customer-contact" placeholder="Contact No." data-toggle="tooltip" data-placement="top" title="Customer Contact Number">
                    </div>
        <div class="overflow-auto" style="max-height: 470px; min-height: 470px;min-width: 350px" id="items">
        </div>
        <hr>
        <div >
            <div class="d-flex">
                <p class="my-0">
                    <b>Items:&nbsp;</b>
                </p>
                <p class="my-0" id="total_items">0</p>
            </div>
            <div class="d-flex">
                <p class="my-0">
                    <b>SUB TOTAL:&nbsp;</b>₱
                </p>
                <p class="my-0" id="total">0</p>
            </div>
            <div class="d-flex">
                <p class="my-0">
                    <b>DISCOUNT:</b>
                </p>
                <input required type="number" class="form-control my-0" id="discount" value="0" max="100" min="0">
            </div>
            <div class="d-flex">
                <p class="my-0">
                    <b>TOTAL:&nbsp;</b>₱
                </p>
                <p class="my-0" id="total_amount">0</p>
            </div>
            <div class="d-flex">
                <p class="my-0"><b>CASH:</b></p>
                <input required type="number" class="form-control my-0" id="cash" value="0">
            </div>
            <div id="show_change">
                <div class="d-flex">
                    <p class="my-0"><b>CHANGE:</b></p>
                    <p class="my-0"><b id="change"></b></p>
                </div>
            </div>
            <hr>
            <button class="submit-transaction btn btn-primary" style="display: none; min-width: 100%">Submit</button>
        </div>
    </div>

</div>
<?php include "new-item-modal.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.2.0/math.js" integrity="sha512-SewEag0kt1xsJdbfAXgLyLvYXeAoGEla4M6JSitT6ocJVI+VeUbFXkgrbloNn4cVgq46caRf31un2eoalq6YOw==" crossorigin="anonymous"></script>
<script src="js/transaction-new.js"></script>