<?php
    include "connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.category_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
        $total_stock = intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]);
        if($total_stock<= 2 && $total_stock != 0) $color = "warning";
        else if($data["item_stock"] == 0 && $total_stock == 0) $color = "danger";
        else $color = "success";
?>
<tr>
        <td><img width="100" src="img/item/<?php echo $data["item_img"]; ?>"></td>
        <td>
            <p><?php echo $data["item_name"]; ?></p>
            <p><?php echo $data["item_brand"]; ?></p>
        </td>
        <td><?php echo $data["category_name"]; ?></td>
        <td>
            <p>₱<?php echo $data["item_capital"]; ?></p>
        </td>
        <td>
            <div class="row">
                <div class="row">
                    <b>Warehouse: <p class="text-<?php echo $color; ?>"><?php echo $total_stock . " " . $data["item_unit"];?></p></b>
                </div>
                <div class="row">
                    <b>Store: <p class="text-<?php echo $color; ?>"><?php echo $data["item_stock"] . " " . $data["item_unit_package"];?></p></b>
                </div>
            </div>
            <div class="row" id="count_input_<?php echo $data["item_id"] ?>">
                <div class="input-group">
                    <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1" min="1">
                    <div class="input-group-append">
                        <span class="input-group-text" id="item_<?php echo $data["item_id"] ?>"><?php echo $data["item_unit"] ?></span>
                    </div>
                </div>
                <div class="d-flex">
                    <select name="location" id="location_<?php echo $data["item_id"];  ?>" class="custom-select">
                        <option value="store">Store</option>
                        <option value="warehouse">Warehouse</option>
                    </select>
                    <button class="add btn btn-success" item-div="<?php echo $data["item_unit_divisor"] ?>" value="<?php echo $data["item_id"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="alert alert-success" id="alert_<?php echo $data["item_id"];  ?>" role="alert" style="display: none">
                Item Added!
            </div>
        </td>
</tr>

<?php
    }

?>
