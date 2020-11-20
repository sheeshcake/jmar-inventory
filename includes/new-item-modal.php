<div class="modal fade add-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
        <div class="card">
            <h4 class="card-header">
                New Transactions
            </h4>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-2">
                        <img src="img/item.jpg" alt="item image" width="150px">
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="item-name">Item Name</label>
                        <input type="text" class="form-control" id="item-name" placeholder="Item Name" required>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="item-brand">Item Brand</label>
                        <input type="text" class="form-control" id="item-brand" placeholder="Item Brand" required>
                    </div>
                    <div class="col-md-3 my-4">
                        <label for="image-file">Item Brand</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image-file">
                            <label class="custom-file-label" for="image-file">Choose Image</label>
                        </div>
                    </div>
                </div>
                <div class="form-row m-3">
                <label for="category">Category</label>
                    <select class="form-control" id="category">
                        <?php
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql);
                            while($data = $result->fetch_assoc()){
                        ?>
                            <option value="<?php echo $data["category_name"] ?>"><?php echo $data["category_name"] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-row m-3">
                    <div class="input-group">
                        <textarea class="form-control" id="item-description" rows="3" placeholder="Item Description"></textarea>
                    </div>
                </div>
                <div class="form-row m-3">
                    
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="number" id="input-capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price">
                    </div>
                    <div class="input-group col-md-4">
                        <input type="number" id="input-tax" class="form-control" aria-label="Tax" placeholder="Tax">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" id="total-item-price" aria-label="Price" placeholder="Price" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>