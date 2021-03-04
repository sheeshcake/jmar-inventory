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
<div class="shadow m-1 p-3" style="max-width: 65%; max-height: 800px; overflow-y: scroll;">
        <h4 id="transaction" >Report Damaged Item</h4> 
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name & Description</th>
                    <th>Selection</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name & Description</th>
                    <th>Selection</th>
                </tr>
            </tfoot>
            
        </table>
        
    </div>
    <div class="shadow mb-1 ml-2 p-3" style="max-width: 60%; max-height: 800px; overflow-y: scroll;">
        <table id="example" style="width:1000px;"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Damaged Date Time</th>
                    <th>Total Items</th>
                    <th>Courier</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Transaction ID</th>
                    <th>Damaged Date Time</th>
                    <th>Total Items</th>
                    <th>Courier</th>
                </tr>
            </tfoot>
            <tbody id="data-trans">
                <?php include "get-damaged-items.php"; ?>
            </tbody>
        </table>			
    </div>
    
</div>
