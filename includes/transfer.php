<div class="inventory-head d-flex mb-3">
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
                        <?php include "get-items-transfer-new.php"; ?>
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
                <div class="form-group ">
                    <div class="input-group w-100">
                        <div class="input-group-prepend">
                            <span class="input-group-text">DATE:</span>
                            <input required type="text" class="form-control" id="total-item-price2"  aria-label="Price" placeholder="Price" style="border-top-left-radius: 0;border-bottom-left-radius: 0px;" readonly>
                        </div>
                        <div style="margin-right: 2px;" class="input-group-prepend">
                            <span style="margin-left: 10px;" class="input-group-text">time</span>
                            <input required type="text" class="form-control" id="total-item-price2"  aria-label="Price" placeholder="Price" style="border-top-left-radius: 0;border-bottom-left-radius: 0px;" readonly>
                        </div>
                    </div>
                </div>
            <div class="alert alert-success" id="trans-message" role="alert" style="display: none"></div>     
            <div class="overflow-auto" style="max-height: 470px; min-height: 630px;min-width: 350px" id="items"></div>
            <div class="mt-2">
                <button class="submit-transaction btn btn-primary" style="min-width: 100%">Submit</button>
            </div>
        </div>
    </div>
</div>
<script src="js/transfer.js"></script>