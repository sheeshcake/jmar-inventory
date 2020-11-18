<?php
    include "controller/connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.item_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
?>
<tr>
    <td>
        <img src="img/<?php echo $data["item_img"] ?>" alt="" width="100" >
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">₱</div>
                </div>
                <input type="number" value="<?php echo $data["item_price"]; ?>" class="form-control" placeholder="Capital">
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <input type="text" class="form-control w-50" value="<?php echo $data["item_name"] ?>" placeholder="Name">
            </div>
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <input type="text" class="form-control w-50" value="<?php echo $data["item_brand"] ?>" placeholder="Name">
            </div>
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <label class="sr-only" for="inlineFormInputGroup">Tax</label>
                <input type="number" class="form-control w-50" value="<?php echo $data["item_tax"] ?>" placeholder="Tax">
                <div class="input-group-text">%</div>
            </div>
            </div>
        </div>
    </td>
    <td>                
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <label class="sr-only" for="inlineFormInputGroup">Tax</label>
                <input type="number" class="form-control w-75" value="<?php echo $data["item_tax"] ?>" placeholder="Tax">
                <div class="input-group-text"><?php echo $data["item_unit"] ?></div>
            </div>
            </div>
        </div>
    </td>
    <td>
        <p>
        <?php $price = (($data["item_tax"] / 100) * $data["item_price"]) + $data["item_price"]; echo "₱" . $price; ?>
        </p>
    </td>
    <td><?php echo $data["item_id"] ?></td>
    <td><?php echo $data["category_name"] ?></td>
    <td>
    <p>
        <?php echo $data["item_desc"] ?>
    </p>
    </td>
    <td>
    <div class="d-flex">
        <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
        <button class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
    </div>
    </td>
</tr>
<?php
    }

?>
