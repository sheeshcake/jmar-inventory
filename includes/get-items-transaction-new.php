<?php
    include "controller/connect.php";
    $sql = "SELECT * FROM items 
    INNER JOIN
    category ON category.category_id = items.category_id
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
        $r_price = (floatval(($data["item_tax"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price"]);
        $w_price = (floatval(($data["item_tax_wholesale"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price_wholesale"]);
        $u1 = intval($data["item_stock"] / $data["item_unit_divisor"]);
        $u2 =  floatval($data["item_stock"] - ($u1 * $data["item_unit_divisor"]));
        $u2_name = "";
        if($data["item_unit"] == "Box") $u2_name = "pieces";
        else if($data["item_unit"] == "Roll") $u2_name = "meter(s)";
        else if($data["item_unit"] == "Sack") $u2_name = "kilo(s)";
?>
<tr>
    <td>
        <img src="img/item/<?php echo $data["item_img"] ?>" alt="" width="100" >
    </td>
    <td>
        <?php echo $data["item_name"] ?>
    </td>
    <td>
        <?php echo $data["item_brand"] ?>
    </td>
    <td>
        <?php echo $data["category_name"] ?>
    </td>
    <td>
        <?php            
            $price = (floatval(($data["item_tax"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price"]); 
            echo "₱" . $price;
        ?>
    </td>
    <td width="200px">

    <div class="d-flex p-2"><b><p><?php echo $u1 . " " . $data["item_unit"] . " and " . $u2 . " " . $u2_name;?></p></b></div>
        <?php
            if($data["item_stock"] > 0){
        ?>
        <div class="d-flex mb-2">
            <input type="text" class="form-control border-success" id="stock_<?php echo $data["item_id"] ?>" value="<?php echo $data["item_stock"] ?>" readonly>
        </div>
        <div class="d-flex" id="count_input_<?php echo $data["item_id"] ?>">
            <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1">
            <select id="unit" class="custom-select unit-select">
                <option value="1"><?php echo $u2_name; ?></option>
                <option value="2"><?php echo $data["item_unit"] ?></option>
            </select>
            <button class="add btn btn-success" value="<?php echo $data["item_id"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
        <div class="alert alert-success" role="alert" style="display: none">
            Item Added!
        </div>
    </td>
</tr>
<?php
    }

?>
