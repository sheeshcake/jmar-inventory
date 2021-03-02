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
    <td>
        <img src="img/item/<?php echo $data["item_img"] ?>" alt="" width="100" >
    </td>
    <td>
        <p><b>ID: </b><?php echo $data["item_id"];?></p>
        <p><b>Name: </b><?php echo $data["item_name"];?></p>
        <p><b>Brand: </b><?php echo $data["item_brand"];?></p>
        <p><b>Category: </b><?php echo $data["category_name"];?></p>
        <p><b>Description: </b><?php echo $data["item_desc"];?></p>
    </td>
    <td width="200px">
        <?php
            if($data["item_stock"] > 0){
        ?>
        <div class="d-flex mb-2">
            <div class="input-group">
                <input type="text" class="form-control border-success" id="stock_<?php echo $data["item_id"] ?>" value="<?php echo $total_stock ?>" readonly>
                <div class="input-group-append ">
                    <span class="input-group-text border-success"><?php echo $data["item_unit"] ?></span>
                </div>
            </div>
        </div>
        <div class="d-flex" id="count_input_<?php echo $data["item_id"] ?>">
            <div class="input-group">
                <input min="1" max="<?php echo $total_stock; ?>" type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1">
                <div class="input-group-append">
                    <span class="input-group-text"><?php echo $data["item_unit"] ?></span>
                </div>
            </div>
            <button class="add btn btn-success" unit_divisor="<?php echo $data["item_unit_divisor"];?>" value="<?php echo $data["item_id"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
        <div class="alert alert-success" role="alert" id="alert_<?php echo $data["item_id"] ?>" style="display: none">
            Item Added!
        </div>
    </td>
</tr>
<?php
    }

?>