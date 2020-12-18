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
        <td><img width="100" src="img/item/<?php echo $data["item_img"]; ?>"></td>
        <td><?php echo $data["item_name"]; ?></td>
        <td><?php echo $data["item_brand"]; ?></td>
        <td><?php echo $data["category_name"]; ?></td>
        <td>₱<?php echo $data["item_price"]; ?></td>
        <td width="200px">
            <?php echo $data["item_stock"]; ?>
            <div class="d-flex" id="count_input_<?php echo $data["item_id"] ?>">
                <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1">
                <button class="add btn btn-success" item_div="<?php echo $data["item_unit_divisor"] ?>" value="<?php echo $data["item_id"] ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="alert alert-success" role="alert" style="display: none">
                Item Added!
            </div>
        </td>
</tr>

<?php
    }

?>
