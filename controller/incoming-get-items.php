<?php
    include "connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.category_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
        $u1 = intval($data["item_stock"] / $data["item_unit_divisor"]);
        $u2 =  floatval($data["item_stock"] - ($u1 * $data["item_unit_divisor"]));
        if($u1 <= 2 && $u1 != 0) $color = "warning";
        else if($u1 == 0 && $u2 == 0) $color = "danger";
        else $color = "success";
        if($data["item_unit"] == "Box") $u2_name = "pieces";
        else if($data["item_unit"] == "Roll") $u2_name = "meter(s)";
        else if($data["item_unit"] == "Sack") $u2_name = "kilo(s)";
?>
<tr>
        <td><img width="100" src="img/item/<?php echo $data["item_img"]; ?>"></td>
        <td>
            <p><?php echo $data["item_name"]; ?></p>
            <p><?php echo $data["item_brand"]; ?></p>
        </td>
        <td><?php echo $data["category_name"]; ?></td>
        <td>
            <p>₱<?php echo $data["item_price"] . "/" . $u2_name; ?></p>
            <p>₱<?php echo $data["item_price_wholesale"] . "/" . $data["item_unit"]; ?></p>
        </td>
        <td width="200px">
            <div class="d-flex p-2"><b><p class="text-<?php echo $color; ?>"><?php echo $u1 . " " . $data["item_unit"] . " and " . $u2 . " " . $u2_name;?></p></b></div>
            <?php echo $data["item_stock"]; ?>
            <div class="d-flex" id="count_input_<?php echo $data["item_id"] ?>">
                <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1">
                <button class="add btn btn-success" item-div="<?php echo $data["item_unit_divisor"] ?>" value="<?php echo $data["item_id"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="alert alert-success" role="alert" style="display: none">
                Item Added!
            </div>
        </td>
</tr>

<?php
    }

?>
