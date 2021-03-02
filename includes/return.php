<?php
    //include "controller/connect.php";
?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Customer Concern</h1>
</div>
<div class="shadow mb-4 p-3">
    <table id="example" style="width:1000px"  class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Date Time</th>
                <th>Total Items</th>
                <th>Courier</th>
                <th>Total Paid</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Date Time</th>
                <th>Total Items</th>
                <th>Courier</th>
                <th>Total Paid</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody id="data-trans">
            <?php include "get-transactions.php"; ?>
        </tbody>
    </table>			
</div>
<div class="modal fade" id="transmodal" tabindex="-1" role="dialog" aria-labelledby="transmodalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transmodalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 800px; overflow-y: scroll;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="dialog" style="display: none;">
  <form id="admin_pass">
    <center><p>Please Enter the Admin Password</p></center>
    <input type="password" name="password" class="form-control mb-2" placeholder="Password"/>
    <center>
      <input class="btn btn-primary" type="submit" name="submit" placeholder="Submit" value="submit"/>
    </center>
  </form>
  
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.2.0/math.js" integrity="sha512-SewEag0kt1xsJdbfAXgLyLvYXeAoGEla4M6JSitT6ocJVI+VeUbFXkgrbloNn4cVgq46caRf31un2eoalq6YOw==" crossorigin="anonymous"></script>
<script src="js/return.js"></script>