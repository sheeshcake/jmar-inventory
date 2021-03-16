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
                            <div class="form-group ">
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
                       </div>
                       <div class="form-group flex-fill m-1">
                            <div class="input-group">
                                <textarea class="form-control" id="item-description" rows="10" name="item_desc" placeholder="Item Description"></textarea>
                            </div>
                            <label style="margin-top: 8.5px;"for="item-unit">Supplier </label>
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
                    
<!---------------------- For Capital Input -----> 
                    <div class="row">
                            <div class="col">
                                <style>
                                .movable{
                                    transition: 1s;
                                }
                                    .move-up{
                                        transform: translate(1px, 0px);
                                    }
                                    .move-down{
                                        transform: translate(0px,10px);
                                    }
                                </style>
                                <div class="row bd-highlight mb-3">
                                    <div class="col pl-1 movable" id="no_qpp">
                                        <label for="input-capital-wholesale">Capital Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend" >
                                                <span  id="peso-sign" class="input-group-text">₱</span>
                                            </div>
                                            <input required type="number" min="0" step="any" id="input-capital-wholesale" name="item_capital" class="form-group form-control" aria-label="Capital Price" placeholder="Capital">
                                        </div>
                                    </div>
                                    
                                    <!---RETAIL--->
                                    <div class="row bd-highlight mb-2 movable" id="rev">
                                        <div id="retail-capital" class="col" style="display: none">
                                            <label for="input-capital-wholesale" id="naming">Retail per Pieces</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span  class="input-group-text">₱</span>
                                                </div>
                                                <input required type="number" min="0" step="any" class="form-control" id="r_capital" name="retail_capital" aria-label="Retail Capital" placeholder="Retail Capital" value="0">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="input-capital-wholesale">Percent Revenue</label>
                                            <div class="input-group">
                                                <input required type="number" min="0"  id="input-tax" step="any" class="form-control" name="item_tax" aria-label="Revenue" placeholder="Revenue" value="0">
                                                    <div class="input-group-append">
                                                        <span  class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex bd-highlight mb-3 movable" style="margin-left: 35px;" id="retail_p">
                                            <label style="margin-right: 2%;" class="py-2" for="item-unit">RETAIL PRICE</label>
                                            <div class="input-group w-50">
                                                <div class="input-group-prepend">
                                                    <span style="margin-bottom: 70%;"class="input-group-text">₱</span>
                                                </div>
                                                <input  required type="number" min="0" value="0" id="input-capital" step="any" name="item_price" class="form-control w-25" aria-label="Capital Price" placeholder="Capital Price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="item-store">STORE</label>
                                            <div class="input-group">
                                                    <input required type="number" min="0" step="any" class="form-control" id="item-store" name="item_stock" placeholder="Stock in store" data-toggle="tooltip" data-placement="top" title="how many stock in your store?">
                                                    <div class="input-group-append" id="q2-name">
                                                        <label class="input-group-text" for="item-store" id="u2-selected">Pieces</label>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <label for="inputGroupSelect01">WAREHOUSE</label>
                                                <div class="input-group">
                                                    <input required type="number" min="0" step="any" class="form-control" id="item-warehouse" name="item_stock_warehouse" placeholder="Stock in warehouse" data-toggle="tooltip" data-placement="top" title="how many stock in your warehouse?">
                                                    <div class="input-group-append" id="q1-name">
                                                        <label class="input-group-text" for="item-warehouse" id="u1-selected">Pieces</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col mb-3">
                                        <div class="input-group-append">
                                            <div class="custom-control custom-switch pt-2">
                                                <input type="checkbox" class="custom-control-input" id="item-quantity" >
                                                <label class="custom-control-label" for="item-quantity">Quantity per-Package</label>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col bd-highlight">
                                                <div style="display: none;" id="quantity-per-package">
                                                    <div class="input-group">
                                                        <input required type="number" value="1" name="item_unit_divisor" id="u1-val" class="form-control">
                                                        <select id="unit_name" name="item_unit_package" class="form-control" for="u1-val">
                                                            <option selected value="Pieces">pieces</option>
                                                            <option value="kilogram">kg</option>
                                                            <option value="milliliter">ml</option>
                                                            <option value="centimeter">cm</option>
                                                            <option value="meter">m</option>
                                                        </select>
                                                        <div class="input-group-append input-group-prepend">
                                                            <label class="input-group-text">Per 1(one)</label>
                                                        </div>
                                                        <select class="form-control " id="item-unit" name="item_unit" required>
                                                            <option selected value="Pieces">Select</option>
                                                            <option value="Sack">Sack</option>
                                                            <option value="Roll">Roll</option>
                                                            <option value="Box">Box</option>
                                                            <option value="Bundle">Bundle</option>
                                                            <option value="Bag">Bag</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                    <div class="form-group d-flex">    
                        <div class="flex-fill m-1">

                            <!---- REVENUE--->
                            
                        </div>
                    
                        <!----------------- CATEGORY- STOCK------->
            
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