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
            <p><?php echo $data["item_desc"]; ?></p>
        </td>
        <td>
            <div class="row">
                <div class="row">
                    <b>Store: <p class="text-<?php echo $color; ?>"><?php echo $data["item_stock"] . " " . $data["item_unit_package"];?></p></b>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control damage-count" value="1" min="1" max="<?php echo $data["item_stock"] ?>">
                    <div class="input-group-append input-group-prepend">
                        <span class="input-group-text"><?php echo $data["item_unit_package"] ?></span>
                    </div>
                    <div class="input-group-append">
                        <button class="add btn btn-danger" value="<?php echo $data["item_id"] ?>"><i class="fa fa-chain-broken" aria-hidden="true"></i>Damaged</button>
                    </div>
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
