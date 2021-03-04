<?php
    include "connect.php";
    $sql = "SELECT * FROM damaged_items
            INNER JOIN items 
            ON items.item_id = damaged_items.item_id
            WHERE item_count > 0
    ";
    $result = mysqli_query($conn, $sql);
    while($data = $result->fetch_assoc()){
?>
<tr>
        <td>
            <p><?php echo $data["item_id"]; ?></p>
        </td>
        <td>
            <p><?php echo $data["item_name"]; ?></p>
        </td>
        <td>
            <p><?php echo $data["damage_datetime"]; ?></p>
        </td>
        <td>
            <div class="row">
                    <p><?php echo $data["item_count"] . " " . $data["item_unit_package"];?></p>
                </div>
        </td>
        <td>
            <div class="row">
                <div class="input-group">
                    <input type="number" id="item_<?php echo $data["item_id"] ?>" class="form-control damage-count" value="1" min="1" max="<?php echo $data["item_count"] ?>">
                    <div class="input-group-append input-group-prepend">
                        <span class="input-group-text"><?php echo $data["item_unit_package"] ?></span>
                    </div>
                    <div class="input-group-append">
                        <button class="replace btn btn-success" damage_id="<?php echo $data["damage_id"] ?>" value="<?php echo $data["item_id"] ?>"><i class="fa fa-exchange" aria-hidden="true"></i> Replaced</button>
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
