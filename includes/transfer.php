<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="inventory-head mb-3">
    <h1 class="h3 mb-0 text-gray-800">Stock Transfer</h1>
</div>
<div class="row">
    <div class="col">
        <center>
            <b><label for="name" class="control-label">WAREHOUSE</label></b>
        </center>
            <div class="shadow m-1 p-3" style="max-width: 100%; max-height: 800px; overflow-y: scroll;">
                <table id="example"  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name & Description</th>
                            <th>Selection</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Name & Description</th>
                            <th>Selection</th>
                        </tr>
                    </tfoot>
                    <tbody id="item_data">
                        <?php include "get-items-transfer.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="col-auto" style="margin-top: 0;">
        <center style="margin-bottom: 200px;">
            <b><label for="name" class="control-label">TO</label></b>
        </center>
            <div class="form-group ">
                <i class="fa fa-arrow-right fa-fw fa-4x" aria-hidden="true"></i>
            </div>
            <div class="form-group ">
                <i class="fas fa-truck fa-fw fa-4x" aria-hidden="true"></i>
            </div>
            <div class="form-group ">
                <i class="fa fa-arrow-right fa-fw fa-4x" aria-hidden="true"></i>
            </div>
            <div class="form-group ">
                <i class="fas fa-truck fa-fw fa-4x" aria-hidden="true"></i>
            </div>
            <div class="form-group ">
                <i class="fa fa-arrow-right fa-fw fa-4x" aria-hidden="true"></i>
            </div>
    </div>
    <div class="col">
        <center >
            <b><label for="name" class="control-label">STORE</label></b>
        </center>
        <div class="shadow m-1 p-3" style="max-width: 100%;min-height: 800px; max-height: 800px;">
            <div class="row mb-2">
                <div class="col">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date</span>
                        </div>
                        <input required type="date" class="form-control" id="date_now" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Driver Name</span>
                        </div>
                        <input required type="text" class="form-control" id="driver_name" value="">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Plate Number</span>
                        </div>
                        <input required type="text" class="form-control" id="plate_no" value="">
                    </div>
                </div>
            </div>
            <div class="alert alert-success" id="trans-message" role="alert" style="display: none"></div>     
            <div class="overflow-auto" style="max-height: 470px; min-height: 630px;min-width: 350px" id="items"></div>
            <div class="mt-2">
                <button class="submit-transaction btn btn-primary" style="min-width: 100%;display: none">Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.2.0/math.js" integrity="sha512-SewEag0kt1xsJdbfAXgLyLvYXeAoGEla4M6JSitT6ocJVI+VeUbFXkgrbloNn4cVgq46caRf31un2eoalq6YOw==" crossorigin="anonymous"></script>
<script src="js/transfer.js"></script>