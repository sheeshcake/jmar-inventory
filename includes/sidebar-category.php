<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card p-3">
                    <h4>Add Category</h4>
                    <hr class="divider"></hr>
                    <div id="category-message"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="input-category" placeholder="New Category">
                    </div>
                    <button class="btn btn-primary btn-sm" id="add-cat-btn" style="display: none;">Add</button>
                </div>
                <hr class="divider"></hr>
                <div class="card p-3">
                    <h4>Manage Category</h4>
                    <hr class="divider"></hr>
                    <div id="cat-alert"></div>
                    <table class="table table-striped" id="cat-table">
                        <thead>
                            <td>ID</td>
                            <td>Name</td>
                            <td></td>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM category";
                                $result = mysqli_query($conn, $sql);
                                while($data = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo $data["category_id"] ?></td>
                                    <td contenteditable><?php echo $data["category_name"] ?></td>
                                    <td>
                                        <button class="cat-del btn btn-danger btn-sm">Delete</button>
                                        <button class="cat-up btn btn-success btn-sm">Update</button>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/category.js"></script>