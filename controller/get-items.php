<?php
    include "../controller/connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.category_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
        if($data["item_tax_type"] == "percent"){
            $r_price = floatval($data["item_tax"]) / 100 * floatval($data["item_price"]) + floatval($data["item_price"]);
        }else{
            $r_price = floatval($data["item_price"]);
        }
        $u1 = intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]);
        if($u1 <= 2 && $u1 != 0) $color = "warning";
        else if($data["item_stock"] == 0 && $data["item_stock_warehouse"] == 0) $color = "danger";
        else $color = "success";
        $items_on_warehouse = intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]);
        $items_on_store = $data["item_stock"];
?>
<tr>
    <td>
        <img src="img/item/<?php echo ($data["item_img"] == "") ? "item.jpg" : $data["item_img"]; ?>" alt="" width="100" >
    </td>
    <td>
        <p><b>ID: </b><?php echo $data["item_id"];?></p>
        <p><b>Name: </b><?php echo $data["item_name"];?></p>
        <p><b>Brand: </b><?php echo $data["item_brand"];?></p>
        <p><b>Category: </b><?php echo $data["category_name"];?></p>
        <p><b>Description: </b><?php echo $data["item_desc"];?></p>
        <?php if($data["item_unit"] != "Pieces"){ ?>
        <p><b>Net Content:&nbsp;</b><?php echo $data["item_unit_divisor"] . " " . $data["item_unit_package"] . " per 1(one) " . $data["item_unit"]?><p>
        <?php }?>
    </td>
    <td>
        <?php            
            echo "<b>₱" . number_format($r_price, 2) . " per " . $data["item_unit_package"] . "</b></br>";
        ?>
    </td>
    <td width="200px">
        <?php
            if($data["item_stock"] > 0 || $data["item_stock_warehouse"] > 0){
        ?>
        <div class="d-flex mb-2">
            Warehouse:&nbsp;<input type="text" class="form-control border-success" id="stock_warehouse_<?php echo $data["item_id"] ?>" value="<?php echo $items_on_warehouse ?>" readonly><b class="p-2"><?php echo $data["item_unit"] ?></b>
        </div>
        <div class="d-flex mb-2" id="count_input_<?php echo $data["item_id"] ?>">
            <input min="1" max="<?php echo intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]); ?>" type="number" id="item_warehouse_<?php echo $data["item_id"] ?>" class="form-control" value="1">
            <button class="add btn btn-success" value="<?php echo $data["item_id"] ?>" unit_divisor="<?php echo $data["item_unit_divisor"] ?>" loc="warehouse" unit="<?php echo $data["item_unit"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
        <div class="alert alert-success" id="alert_warehouse_<?php echo $data["item_id"] ?>" role="alert" style="display: none">
            Item Added!
        </div>
        <div class="d-flex mb-2">
            Store:&nbsp;<input type="text" class="form-control border-success" id="stock_<?php echo $data["item_id"] ?>" value="<?php echo $items_on_store ?>" readonly><b class="p-2"><?php echo $data["item_unit_package"] ?></b>
        </div>
        <div class="d-flex" id="count_input_<?php echo $data["item_id"] ?>">
            <input min="1" max="<?php echo $data["item_stock"] ?>" type="number" id="item_store_<?php echo $data["item_id"] ?>" class="form-control" value="1">
            <button class="add btn btn-success" value="<?php echo $data["item_id"] ?>" loc="store" unit="<?php echo $data["item_unit_package"] ?>" ><i class="fa fa-plus" aria-hidden="true"></i></button>
        </div>
        <div class="alert alert-success" id="alert_store_<?php echo $data["item_id"] ?>" role="alert" style="display: none">
            Item Added!
        </div>
        <?php
            }else{
        ?>
        <div class="d-flex mb-2">
            <input type="text" class="form-control is-invalid mb-2" value="Out Of Stock" readonly>
        </div>
        <?php
            }
        ?>
    </td>
</tr>
<?php
    }

?>