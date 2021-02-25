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
                    <div class="form-group d-flex">    
                        <div class="flex-fill m-1">
                            
                                <div class="d-flex">
                                    <label for="item-unit">CAPITAL</label>
                                    <div class="ml-auto" style="margin-right: 33%;">
                                        <label for="item-unit" >REVENUE</label>
                                    </div>
                                 </div>
                               
                            <div class="d-flex bd-highlight mb-3">
                                <div class="w-50 d-flex pl-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span  id="peso-sign" class="input-group-text">₱</span>
                                        </div>
                                        <input  style="margin-right: 2%;" required type="number" min="0"  id="input-capital-wholesale" name="item_capital_wholesale" class="form-control w-25" aria-label="Capital Price" placeholder="Capital">
                                    </div>
                                    
                                    <div class="p-2">
                                    </div>
                                </div>
                                <div class="input-group-prepend" style=" margin-top: 10px;margin-right: 5px;">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                </div>
                                <!---RETAIL--->
                                <div class="d-flex bd-highlight mb-3">
                                    <div class="input-group w-100" style="margin-bottom: -19%;">
                                    <input required type="number" min="0"  id="input-tax" class="form-control" name="item_tax" aria-label="Revenue" placeholder="Revenue">
                                        <div class="input-group-append" style="margin-right: 2%; ">
                                            <span style="margin-bottom: 70%; margin-right: 3px;" class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!---- REVENUE--->
                            <div class="d-flex bd-highlight mb-3" style="margin-left: 35px;">
                                    <label style="margin-right: 2%;" class="py-2" for="item-unit">RETAIL PRICE</label>
                                    <div class="input-group w-50">
                                        <div class="input-group-prepend">
                                            <span style="margin-bottom: 70%;"class="input-group-text">₱</span>
                                        </div>
                                        <input  required type="number" min="0" value="0" id="input-capital" name="item_capital" class="form-control w-25" aria-label="Capital Price" placeholder="Capital Price">
                                    </div>
                            </div>
                            
                        </div>
                    
                        <!----------------- CATEGORY- STOCK------->
                
                        <div class="form-group flex-fill m-1">
                            <div class="col-md-12">
                                <div class="input-group w-100">
                                    <div class="form-group mr-auto">
                                        <label for="item-store">STORE</label>
                                        <input style="width: 271px;" required type="number" class="form-control" id="item-store" name="item_stock" placeholder="Stock in store" data-toggle="tooltip" data-placement="top" title="how many stock in your store?">
                                    </div>
                                    <div class="form-group mr-auto"style="margin-left: 17px;width: 265px;">
                                        <label for="inputGroupSelect01">WAREHOUSE</label>
                                        <div class="input-group">
                                        <input required type="number" class="form-control" id="item-warehouse" name="item_stock_warehouse" placeholder="Stock in warehouse" data-toggle="tooltip" data-placement="top" title="how many stock in your warehouse?">
                                            <div class="input-group-append" id="q1-name" style="display: none">
                                                <label class="input-group-text" for="item-warehouse" id="u1-selected"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex bd-highlight mb-3" style="width: 200%;">
                                <div class="col-md-6 my-1">
                                    <div class="input-group-append">
                                        <div class="custom-control custom-switch pt-2">
                                            <input type="checkbox" class="custom-control-input" id="item-quantity" >
                                            <label class="custom-control-label" for="item-quantity">Quantity per-Package</label>
                                        </div>
                                    </div>

                                    <div class="d-flex bd-highlight mb-3">
                                        <div style="display: none;"class="input-group w-100" id="quantity-per-package">
                                            <div class="input-group-prepend">
                                            <input required type="number" value="0" id="u1-val" name="item_unit_divisor" class="form-control">
                                            <select name="unit_name" id="unit_name" class="form-control w-50">
                                                <option value="kilogram">kg</option>
                                                <option value="milliliter">ml</option>
                                                <option value="centimeter">cm</option>
                                                <option value="meter">m</option>
                                                <option value="pcs">pieces</option>
                                            </select>
                                            </div>

                                            <div class="input-group-prepend" style="width: 225px;margin-left: 15px;">
                                            <p class="my-1">Per 1(one)</p>
                                            <select class="form-control " id="item-unit" name="item_unit" required  >
                                                <option disabled>Select</option>
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