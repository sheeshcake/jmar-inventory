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
            <h4 id="transaction" >New Transaction</h4>
            <div class="form-group ml-auto">
                <label for="reciept">Reciept Number</label>
                <input type="number" class="form-control" id="reciept" name="reciept_no" placeholder="Reciept No.">
            </div>
            
        </div>
        <div class="alert alert-success" id="trans-message" role="alert" style="display: none">
        </div>
        <div class="d-flex"><p>FOR DELIVERY?</p>
            <input type="radio" id="delivery" name="answer" value="yes" />YES&nbsp;&nbsp;<br>
        <input type="radio" name="answer" value="no">
        <label for="male">NO</label><br>
        </div>
            <div class="flex-fill m-1">
                <div class="d-flex">
                    <input style="display:none;" required type="text" class="form-control mb-1" id="courier" name="courier" placeholder="Courier Name">
                    <select class="form-control w-50" id="payment" name="payment" style="display:none;">
                                <option value="cod">COD</option>
                                <option value="Roll">Term 7(days)</option>
                                <option value="Box">Term 15(days)</option>
                                <option value="Box">Term 30(days)</option>
                                <option value="Box">Term 60(days)</option>
                                <option value="Box">Term 90(days)</option>
                                <option value="Box"></option>
                    </select>
                    <input style="display:none;" required type="text" class="form-control mb-1" id="customer" name="customer" placeholder="Customer Details" data-toggle="tooltip" data-placement="bottom" title="Customer Name, Adderess & Contact No.">
                    
                </div>
            </div>
        <div class="overflow-auto" style="max-height: 470px; min-height: 470px;min-width: 350px" id="items">
        </div>
        <div class="mt-2">
            <div class="d-flex"><p><b>Items:&nbsp;</b></p><p id="total_items">0</p></div>
            <div class="d-flex"><p><b>TOTAL AMOUNT:&nbsp;</b>₱</p><p id="total">0</p></div>
            <div class="d-flex">
                <p><b>CASH:</b></p>
                <input required type="number" class="form-control mb-1" id="cash">
            </div>
            <div class="d-flex">
                <p><b>CHANGE:</b></p>
                <p><b id="change"></b></p>
            </div>
            <button class="submit-transaction btn btn-primary" style="display: none; min-width: 100%">Submit</button>
        </div>
    </div>

</div>
<?php include "new-item-modal.php"; ?>
<script src="js/transaction-new.js"></script>