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
        <?php echo $data["item_name"] ?>
    </td>
    <td>
        <?php echo $data["item_brand"] ?>
    </td>
    <td>
        <?php echo $data["category_name"] ?>
    </td>
    <td>
        <?php $price = (($data["item_tax"] / 100) * $data["item_price"]) + $data["item_price"]; echo "₱" . $price; ?>
    </td>
    <td width="200px">
        <?php
            if($data["item_stock"] > 0){
        ?>
        <div class="d-flex mb-2">
            <input type="text" class="form-control border-success" value="<?php echo $data["item_stock"] ?>" readonly>
        </div>
        <div class="d-flex">
            <input type="text" id="item_<?php echo $data["item_id"] ?>" class="form-control" value="1">
            <button class="add btn btn-success" value="<?php echo $data["item_id"] ?>">Add</button>
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
