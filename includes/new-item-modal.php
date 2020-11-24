<div class="modal fade add-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl ">
    <div class="modal-content">
        <div class="card">
            <h4 class="card-header">
                Add Item
            </h4>
            <div class="card-body">
                <form id="add-item-form" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-2">
                            <img src="img/item.jpg" alt="item image" id="item-image-selected" width="150px">
                        </div>
                        <div class="col-md-3 my-4">
                            <label for="item-name">Item Name</label>
                            <input type="text" class="form-control" id="item-name" name="item_name" placeholder="Item Name" required>
                        </div>
                        <div class="col-md-3 my-4">
                            <label for="item-brand">Item Brand</label>
                            <input type="text" class="form-control" id="item-brand" name="item_brand" placeholder="Item Brand" required>
                        </div>
                        <div class="col-md-3 my-4">
                            <label for="image-file">Item Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="item_img" id="image-file">
                                <label class="custom-file-label" for="image-file">Choose Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="col-md-6 my-4">
                            <div class="input-group">
                                <textarea class="form-control" id="item-description" rows="3" name="item_desc" placeholder="Item Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 my-4">
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
                        <div class="col-md-3 my-4">
                            <label for="item-unit">Unit</label>
                            <select class="form-control" id="item-unit" name="item_unit">
                                <option value="meter">meter</option>
                                <option value="grams">grams</option>
                                <option value="kilogram">kilogram</option>
                                <option value="liter">liter</option>
                                <option value="gallon">gallon</option>
                                <option value="pieces">pieces</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row m-3">
                        <div class="input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="number" id="input-capital" name="item_capital" class="form-control" aria-label="Capital Price" placeholder="Capital Price">
                        </div>
                        <div class="input-group col-md-4">
                            <input type="number" id="input-tax" class="form-control" name="item_tax" aria-label="Tax" placeholder="Tax">
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
                    <div class="d-flex justify-content-center">
                        <input type="submit"  class="btn btn-primary" name="submit" id="btn-add-item" data-target=".add-item-modal" data-toggle="modal" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
$('#image-file').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
        {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#item-image-selected').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    else
    {
        $('#item-image-selected').attr('src', '/img/item.jpg');
    }
});
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);    
    $.ajax({
        url: url(window.location.href) + "/controller/add-item.php",
        method: "POST",
        data: formData,
        success: function (d) {
            var data = JSON.parse(d);
            $(".alert").addClass("alert" + data.status);
            $(".alert").text(data.message);
            $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
                location.reload();
            });
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>