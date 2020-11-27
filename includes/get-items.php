<?php
    include "controller/connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.category_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
?>
<tr>
    <td>
        <img src="img/item/<?php echo $data["item_img"] ?>" alt="" width="100" >
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">₱</div>
                </div>
                <input type="number" id="capital<?php echo $data["item_id"]; ?>" value="<?php echo $data["item_price"]; ?>" class="form-control" placeholder="Capital">
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <input type="text" class="form-control" id="name<?php echo $data["item_id"]; ?>" value="<?php echo $data["item_name"] ?>" placeholder="Name">
            </div>
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <input type="text" id="brand<?php echo $data["item_id"]; ?>" class="form-control" value="<?php echo $data["item_brand"] ?>" placeholder="Brand">
            </div>
            </div>
        </div>
    </td>
    <td>
        <div class="col-auto">
            <div class="input-group">
            <div class="input-group-append">
                <label class="sr-only" for="inlineFormInputGroup">Tax</label>
                <input type="number" id="tax<?php echo $data["item_id"]; ?>" class="form-control" value="<?php echo $data["item_tax"] ?>" placeholder="Tax">
                <div class="input-group-text">%</div>
            </div>
            </div>
        </div>
    </td>
    <td>                
        <div class="col-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="unit<?php echo $data["item_id"]; ?>"><?php echo $data["item_stock"]; ?></label>
                </div>
                <select class="custom-select" id="unit<?php echo $data["item_id"]; ?>">
                    <?php 
                        $unit_data = ["meter", "grams", "kilogram", "liter", "gallon", "pieces"];
                        for($i = 0; $i < count($unit_data); $i++){
                            if($unit_data[$i] == $data["item_unit"]){
                    ?>
                                <option selected value="<?php echo $data["item_unit"] ?>"><?php echo $data["item_unit"] ?></option>";
                    <?php
                            }else{
                    ?>
                                <option selected value="<?php echo $unit_data[$i] ?>"><?php echo $unit_data[$i] ?></option>";
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
    </td>
    <td>
        <p>
        <?php $price = (($data["item_tax"] / 100) * $data["item_price"]) + $data["item_price"]; echo "₱" . $price; ?>
        </p>
    </td>
    <td><?php echo $data["item_id"] ?></td>
    <td>
        <select class="custom-select" id="cat<?php echo $data["item_id"]; ?>">
            <?php 
                $sql1 = "SELECT * FROM category";
                $result1 = mysqli_query($conn, $sql1);
                while($category_data = $result1->fetch_assoc()){
                    if($category_data["category_name"] == $data["category_name"]){
            ?>
                <option selected value="<?php echo $category_data["category_id"];?>"><?php echo $data["category_name"] ?></option>
            <?php
                    }else{
            ?>
                <option value="<?php echo $category_data["category_id"];?>"><?php echo $category_data["category_name"] ?></option>
            <?php
                    }
                }
            ?>
        </select>
    </td>
    <td>
        <div class="form-group">
            <label for="desc<?php echo $data["item_id"]; ?>">Description</label>
            <textarea class="form-control" id="desc<?php echo $data["item_id"]; ?>" rows="3"><?php echo $data["item_desc"] ?></textarea>
        </div>
    </td>
    <td>
        <!-- <div class="d-flex"> -->
            <button class="btn btn-danger delete" data-target="#logoutModal" data-toggle="modal" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
            <button class="btn btn-success update" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        <!-- </div> -->
    </td>
</tr>
<?php
    }

?>
