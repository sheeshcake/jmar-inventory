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
        <?php echo $data["item_price"]; ?>    </td>
    <td>
        <?php echo $data["item_name"] ?>
    </td>
    <td>
        <?php echo $data["item_brand"] ?>
    </td>
    <td>
        <?php echo $data["item_tax"] ?>
    </td>
    <td>
        <?php $price = (($data["item_tax"] / 100) * $data["item_price"]) + $data["item_price"]; echo "₱" . $price; ?>
    </td>
    <td><?php echo $data["item_id"] ?></td>
    <td>
        <?php echo $data["category_name"] ?>
    </td>
    <td>
        <?php echo $data["item_desc"] ?>
    </td>
    <td width="300px">
        <div class="d-flex">
            <?php
                if($data["item_stock"] > 0){
            ?>
                <input type="text" class="form-control border-success" value="<?php echo $data["item_stock"] ?>" readonly>
                <i class="fa fa-minus p-2" aria-hidden="true"></i>
                <input type="text" class="form-control mr-1" value="1">
                <button class="min btn btn-success mb-2" value="<?php echo $data["item_id"] ?>">OK</button>
            <?php
                }else{
            ?>
                <input type="text" class="form-control is-invalid mb-2" value="Out Of Stock" readonly>
            <?php
                }
            ?>
        </div>
        <button class="min btn btn-danger" value="<?php echo $data["item_id"] ?>">Damaged</button>
        <div class="alert alert-success" role="alert" style="display: none">
            This is a success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
    </td>
</tr>
<?php
    }

?>
