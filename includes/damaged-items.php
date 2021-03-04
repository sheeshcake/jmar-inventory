<?php
    //include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Damaged Item History</h1>
</div>
<div class="row">
    <div class="col-6">
        <div class="shadow m-1 p-3" style=" max-height: 800px; overflow-y: scroll;">
            <h4>Report Damaged Item</h4> 
            <hr>
            <table id="example1"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name & Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="items-damaged">
                    <?php include "controller/get-items-damaged.php"; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Name & Description</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-6">
        <div class="shadow mb-1 ml-2 p-3" style="max-height: 800px; overflow-y: scroll;">
            <h4>Damaged Items</h4> 
            <hr>
            <table id="example2"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Damaged Date Time</th>
                        <th>Total Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Damaged Date Time</th>
                        <th>Total Items</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody id="damaged-items">
                    <?php include "controller/get-damaged-items.php"; ?>
                </tbody>
            </table>			
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.2.0/math.js" integrity="sha512-SewEag0kt1xsJdbfAXgLyLvYXeAoGEla4M6JSitT6ocJVI+VeUbFXkgrbloNn4cVgq46caRf31un2eoalq6YOw==" crossorigin="anonymous"></script>
<script src="js/damaged-items.js"></script>
