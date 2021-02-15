<div class="modal fade add-item-modal" id="add-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
        <div class="card">
            <h4 class="card-header">
                Add Item
            </h4>
            <div class="card-body">
                <form id="add-item-form" method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex">
                        <div class="m-1">
                            <img src="img/item.jpg" alt="item image" id="item-image-selected" width="200px">
                        </div>
                        <div class="flex-fill m-1">
                            <div class="form-group ">
                                <label for="item-name">Item Name</label>
                                <input required type="text" class="form-control" id="item-name" name="item_name" placeholder="Item Name">
                            </div>
                            <div class="form-group mr-auto">
                                <label for="item-brand">Item Brand</label>
                                <input required type="text" class="form-control" id="item-brand" name="item_brand" placeholder="Item Brand">
                            </div>
                            <div class="form-group ">
                                <label for="image-file">Item Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="item_img" id="image-file" value="item.img">
                                    <label class="custom-file-label" for="image-file">Choose Image</label>
                                </div>
                            </div>
                       </div>
                       <div class="form-group flex-fill m-1">
                            <div class="input-group">
                                <textarea class="form-control" id="item-description" rows="10" name="item_desc" placeholder="Item Description"></textarea>
                            </div>
                            <label for="item-unit">Supplier </label>
                            <select class="form-control" id="supplier" name="supplier" style="width:">
                            <?php
                                $sql = "SELECT * FROM supplier";
                                $result = mysqli_query($conn, $sql);
                                while($data = $result->fetch_assoc()){
                            ?>
                                <option value="<?php echo $data["supplier_id"]; ?>"><?php echo $data["supplier_name"]; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <label for="capital_wholesale">Captial Wholesale</label>
                        <div class="input-group w-25">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input required type="number" min="0" value="0" id="capital_wholesale" name="item_capital_wholesale" class="form-control w-25" aria-label="Capital Price" placeholder="Capital Price" style="margin-right: 2%;">
                        </div>
                    </center>

<!---------------------- For Capital Input ----->                    
                    <div class="form-group d-flex">    
                        <div class="flex-fill m-1">
                            <div class="d-flex">
                                <label for="item-unit">WHOLE SALE</label>
                                <div class="ml-auto" style="margin-right: 40%;">
                                    <label for="item-unit" >RETAIL</label>
                                </div>
                            </div>    
                            <div class="d-flex bd-highlight mb-3">
                                <div class="input-group w-50">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input required type="number" min="0" value="0" id="input-capital-wholesale" name="item_capital_wholesale" class="form-control w-25" aria-label="Capital Price" placeholder="Capital Price" style="margin-right: 2%;">
                                </div>
                                <div class="w-50 d-flex pl-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input required type="number" min="0" value="0" id="input-capital" name="item_capital" class="form-control w-25" aria-label="Capital Price" placeholder="Capital Price" readonly="true">
                                    </div>
                                    <div class="p-2">
                                    <div class="custom-control custom-switch pt-2">
                                        <input type="checkbox" class="custom-control-input" id="manual-input" >
                                        <label class="custom-control-label" for="manual-input" data-toggle="tooltip" data-placement="top" title="Manual Input"></label>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex bd-highlight mb-3">
                                <div class="input-group w-100">
                                    <input required type="number" min="0" value="0" id="input-tax-wholesale" class="form-control" name="item_tax_wholesale" aria-label="Revenue" placeholder="Revenue">
                                    <div class="input-group-append" style="margin-right: 2%;">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input required type="number" min="0" value="0" id="input-tax" class="form-control" name="item_tax" aria-label="Revenue" placeholder="Revenue">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex bd-highlight mb-3">
                                <div class="input-group w-100">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input required type="text" class="form-control" id="total-item-price1" aria-label="Price" placeholder="Price" style="margin-right: 2%;" readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input required type="text" class="form-control" id="total-item-price2"  aria-label="Price" placeholder="Price" readonly>
                                    
                                </div>
                            </div>
                        </div>
                    
                        <!----------------- CATEGORY- STOCK------->
                
                        <div class="form-group flex-fill m-1">
                            <div class="col-md-12">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                <?php
                                    $sql = "SELECT * FROM category";
                                    $result = mysqli_query($conn, $sql);
                                    while($data = $result->fetch_assoc()){
                                ?>
                                    <option value="<?php echo $data["category_id"] ?>"><?php echo $data["category_name"] ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="d-flex bd-highlight mb-3">
                                <div class="col-md-6 my-1">
                                    <label for="item-unit">Unit - 1</label>
                                    <input type="hidden" id="item_stock" name="item_stock" class="form-control" placeholder="Stock">
                                    <div class="form-group d-flex m-0">
                                        <input required type="number" id="u1-val" class="form-control" placeholder="Stock">
                                        <select class="form-control " id="item-unit" name="item_unit" required  >
                                            <option disabled>Select</option>
                                            <option value="Sack">Sack</option>
                                            <option value="Roll">Roll</option>
                                            <option value="Box">Box</option>
                                            <option value="Box">Bundle</option>
                                            <option value="Box">Bag</option>
                                            <option value="Box"></option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex m-0">
                                        <input required type="number" name="item_unit_divisor" id="divisor" class="form-control w-50" placeholder="U1/U2" data-toggle="tooltip" data-placement="top" title="How Many U2 in U1?">
                                        <select name="unit_name" id="unit_name" class="form-control w-50">
                                            <option value="Kg">kg</option>
                                            <option value="Kg">ml</option>
                                            <option value="Kg">cm</option>
                                            <option value="Kg">m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 my-1">
                                    <label for="item-unit">Unit - 2</label>
                                    <input required type="text" class="form-control" id="unit-2" value="U2" readonly>
                                    <input required type="number" id="u2-val" class="form-control" placeholder="Stock" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input required type="submit"  class="btn btn-primary" name="submit" id="btn-add-item" value="Submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="js/new-item-modal.js"></script>