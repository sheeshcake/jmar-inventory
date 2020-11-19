
<div class="card mb-2">
  <div class="card-header">
    Item Details
  </div>
  <div class="card-body">
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="item-name">Item Name</label>
        <input type="text" class="form-control" id="item-name" placeholder="Item Name" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="item-brand">Item Brand</label>
        <input type="text" class="form-control" id="item-brand" placeholder="Item Brand" required>
      </div>
      <div class="col-md-4 mb-3">
      <label for="image-file">Item Brand</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="image-file">
          <label class="custom-file-label" for="image-file">Choose Image</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Item Description</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  </div>
</div>
<button class="btn btn-primary" type="submit">Submit form</button>