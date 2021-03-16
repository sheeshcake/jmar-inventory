
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="inventory-head d-flex mb-3">
    <h1 class="h3 mb-0 text-gray-800">Stock Transfer History</h1>
</div>

<div class="card p-3">
    <div class="row mb-3">
        <div class="input-group mx-auto w-50">
            <div class="input-group-prepend">
                <span class="input-group-text">Date</span>
            </div>
            <input type="date" class="form-control" id="date" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <button class="btn btn-primary" id="print">
            <i class="fa fa-print" aria-hidden="true"></i>
            Print
        </button>
    </div>
    <div class="col p-5" id="table-data">

    </div>
</div>

<script src="js/stock-transfer-history.js"></script>