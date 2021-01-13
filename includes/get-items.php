<?php
    include "controller/connect.php";
    $result;
    if(isset($_GET["cat"])){
        $cat = $_GET["cat"];
        $sql = "SELECT * FROM items 
        INNER JOIN
        category ON category.category_id = items.category_id
        WHERE
            category.category_name = '$cat'
        ";
        $result = mysqli_query($conn, $sql);
    }else{
        $sql = "SELECT * FROM items 
        INNER JOIN
        category ON category.category_id = items.category_id
        ";
        $result = mysqli_query($conn, $sql);
    }
    while($data = $result->fetch_assoc()){
        $r_price = (floatval(($data["item_tax"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price"]);
        $w_price = (floatval(($data["item_tax_wholesale"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price_wholesale"]);
        $u1 = intval($data["item_stock"] / $data["item_unit_divisor"]);
        $u2 =  floatval($data["item_stock"] - ($u1 * $data["item_unit_divisor"]));
        if($u1 <= 2 && $u1 != 0) $color = "warning";
        else if($u1 == 0 && $u2 == 0) $color = "danger";
        else $color = "success";
        $u2_name = "";
        if($data["item_unit"] == "Box") $u2_name = "pieces";
        else if($data["item_unit"] == "Roll") $u2_name = "meter(s)";
        else if($data["item_unit"] == "Sack") $u2_name = "kilo(s)";
?>
<tr>
    <td>
        <img id="img<?php echo $data["item_id"]?>" src="img/item/<?php echo $data["item_img"] ?>" alt="" width="200" >
    </td>
    <td>
        <div class="p-2">
            <div class="d-flex p-2"><b>ID:&nbsp;</b><p><?php echo $data["item_id"]?></p></div>
            <div class="d-flex p-2"><b>Name:&nbsp;</b><p id="name<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_name"]?></p></div>
            <div class="d-flex p-2"><b>Brand:&nbsp;</b><p id="brand<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_brand"]?></p></div>
            <div class="d-flex p-2"><b>Description:&nbsp;</b><p id="desc<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_desc"]?></p></div>
            <div class="d-flex p-2">
                <b>Category:&nbsp;</b>
                <p style="width: 1px">
                    <div class="form-group">
                        <select class="form-control" style="width: 200px" id="category<?php echo $data["item_id"]?>">
                        <?php
                            $sql1 = "SELECT * FROM category";
                            $result1 = mysqli_query($conn, $sql1);
                            while($data1 = $result1->fetch_assoc()){
                        ?>
                            <option value="<?php echo $data1["category_id"]; ?>" <?php if($data1["category_id"] == $data["category_id"]) echo "selected"; ?>><?php echo $data1["category_name"] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </p>
            </div>
            <div class="d-flex p-2"><b>Stock:&nbsp;</b><p class="text-<?php echo $color; ?>"><?php echo $u1 . " " . $data["item_unit"] . " and " . $u2 . " " . $u2_name;?></p></div>
        </div>
    </td>
    <td>
        <div class="p-2" style="width: 200px">
            <center><h5><b>Retail</b></h5></center>
            <div class="d-flex p-2"><b>Capital:&nbsp;₱</b><p id="capital<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_price"]?></p></div>
            <div class="d-flex p-2"><b>Tax:&nbsp;</b><p id="tax<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_tax"]?></p>%</div>
            <div class="d-flex p-2"><b>Price:&nbsp;₱<?php echo $r_price?></b></div>
            <hr class="sidebar-divider">
            <center><h5><b>Wholesale</b></h5></center>
            <div class="d-flex p-2"><b>Capital:&nbsp;₱</b><p id="capital_w<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_price_wholesale"]?></p></div>
            <div class="d-flex p-2"><b>Tax:&nbsp;</b><p id="tax_w<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_tax_wholesale"]?></p>%</div>
            <div class="d-flex p-2"><b>Price:&nbsp;₱<?php echo $w_price?></b></div>
        </div>
    </td>
    <td>
        <div class="col p-2">
            <button class="btn btn-danger delete m-1" style="width: 100%" data-target="#logoutModal" data-toggle="modal" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
            <button class="btn btn-success update m-1" style="width: 100%" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
        </div>
    </td>
</tr>
<?php
    }

?>
