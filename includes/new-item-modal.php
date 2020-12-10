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
                                <input type="text" class="form-control" id="item-name" name="item_name" placeholder="Item Name" required>
                            </div>
                            <div class="form-group mr-auto">
                                <label for="item-brand">Item Brand</label>
                                <input type="text" class="form-control" id="item-brand" name="item_brand" placeholder="Item Brand" required>
                            </div>
                            <div class="form-group ">
                                <label for="image-file">Item Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="item_img" id="image-file">
                                    <label class="custom-file-label" for="image-file">Choose Image</label>
                                </div>
                            </div>
                       </div>
                       <div class="form-group flex-fill m-1">
                            <div class="input-group">
                                <textarea class="form-control" id="item-description" rows="10" name="item_desc" placeholder="Item Description"></textarea>
                            </div>
                            <label for="item-unit">Supplier </label>
                        <select class="form-control" id="item-unit" name="item_unit" style="width:">
                                            <option value="kilogram">kilogram</option>
                                            <option value="liter">liter</option>
                                            <option value="gallon">gallon</option>
                                            <option value="pieces">pieces</option>
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
                            
                                <div class="input-group w-100">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    
                                    <input type="number" id="input-capital" name="item_capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price" style="margin-right: 2%;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" id="input-capital" name="item_capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price">
                                    
                                </div>
                            </div>

                            <div class="d-flex bd-highlight mb-3">
                                <div class="input-group w-100">
                                    
                                    <input type="number" id="input-tax" class="form-control" name="item_tax" aria-label="Tax" placeholder="Tax">
                                    <div class="input-group-append" style="margin-right: 2%;">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" id="input-tax" class="form-control" name="item_tax" aria-label="Tax" placeholder="Tax">
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
                                    <input type="text" class="form-control" id="total-item-price" aria-label="Price" placeholder="Price" style="margin-right: 2%;" readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id="total-item-price" aria-label="Price" placeholder="Price" readonly>
                                    
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
                            <!-- <div class="col-md-3 my-4">
                            <label for="item-unit">Unit</label>
                            <select class="form-control" id="item-unit" name="item_unit">
                                <option value="meter">meter</option>
                                <option value="grams">grams</option>
                                <option value="kilogram">kilogram</option>
                                <option value="liter">liter</option>
                                <option value="gallon">gallon</option>
                                <option value="pieces">pieces</option>
                            </select>
                            </div> ---->
                            <div class="d-flex bd-highlight mb-3">
                                <div class="col-md-6 my-1">
                                    <label for="item-unit">Unit</label>
                                        <select class="form-control" id="item-unit" name="item_unit" style="width:">
                                            <option value="kilogram">kilogram</option>
                                            <option value="liter">liter</option>
                                            <option value="gallon">gallon</option>
                                            <option value="pieces">pieces</option>
                                        </select>
                                        <input type="number" name="item_stock" class="form-control" placeholder="Stock">
                                </div>
                                    <div class="col-md-6 my-1">
                                        <label for="item-unit">Pieces</label>
                                            <select class="form-control" id="item-unit" name="item_unit" style="">
                                                <option value="meter">meter</option>
                                                <option value="grams">grams</option>
                                                <option value="pieces">pieces</option>
                                            </select>
                                            <input type="number" name="item_stock" class="form-control" placeholder="Stock">
                             
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit"  class="btn btn-primary" name="submit" id="btn-add-item" data-target=".add-item-modal" data-toggle="modal" value="Submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="js/new-item-modal.js"></script>