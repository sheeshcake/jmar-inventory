<div class="modal fade add-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                    <input required type="file" class="custom-file-input" name="item_img" id="image-file">
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
<<<<<<< HEAD
                                    
                                    <input required type="number" min="0"  id="input-capital-wholesale" name="item_capital_wholesale" class="form-control" aria-label="Capital Price" placeholder="Capital Price" style="margin-right: 2%;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input required type="number" min="0"  id="input-capital" name="item_capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price">
                                    
=======
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
                                        <center>
                                            <input type="checkbox"  id="manual-input" data-toggle="tooltip" data-placement="top" title="Manual Input">
                                        </center>
                                    </div>
>>>>>>> 7631ae686ae6ec00f82df2b8ec0eaef6bd3719f7
                                </div>
                            </div>

                            <div class="d-flex bd-highlight mb-3">
                                <div class="input-group w-100">
                                    
<<<<<<< HEAD
                                    <input required type="number" min="0"  id="input-tax-wholesale" class="form-control" name="item_tax_wholesale" aria-label="Tax" placeholder="Revenue">
                                    <div class="input-group-append" style="margin-right: 2%;">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input required type="number" min="0"  id="input-tax" class="form-control" name="item_tax" aria-label="Tax" placeholder="Revenue">
=======
                                    <input required type="number" min="0" value="0" id="input-tax-wholesale" class="form-control" name="item_tax_wholesale" aria-label="Revenue" placeholder="Revenue">
                                    <div class="input-group-append" style="margin-right: 2%;">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input required type="number" min="0" value="0" id="input-tax" class="form-control" name="item_tax" aria-label="Revenue" placeholder="Revenue">
>>>>>>> 7631ae686ae6ec00f82df2b8ec0eaef6bd3719f7
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
                                        <div class="row pl-2 pr-2">
                                            <select class="form-control w-50" id="item-unit" name="item_unit" required  >
                                                <option selected disabled>Select</option>
                                                <option value="Sack">Sack</option>
                                                <option value="Roll">Roll</option>
                                                <option value="Box">Box</option>
                                            </select>
                                            <input required type="number" name="item_unit_divisor" id="divisor" class="form-control w-50" placeholder="U1/U2" data-toggle="tooltip" data-placement="top" title="How Many U2 in U1?">
                                        </div>
                                        <input required type="number" id="u1-val" class="form-control" placeholder="Stock">
                                </div>
                                    <div class="col-md-6 my-1">
                                        <label for="item-unit">Unit - 2</label>
                                        <input required type="text" class="form-control" id="unit-2" value="U2" readonly>
                                        <input required type="number" id="u2-val" class="form-control" placeholder="Stock">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input required type="submit"  class="btn btn-primary" name="submit" id="btn-add-item" data-target=".add-item-modal" data-toggle="modal" value="Submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="js/new-item-modal.js"></script>