<?php
    include "../controller/connect.php";
    session_start();
    $result;
    if($_POST["cat"] != "all"){
        $cat = $_POST["cat"];
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
        $u1 = intval($data["item_stock_warehouse"] / $data["item_unit_divisor"]);
        $u2 =  floatval($data["item_stock"] - ($u1 * $data["item_unit_divisor"]));
        if($u1 <= 2 && $u1 != 0) $color = "warning";
        else if($u1 == 0 && $u2 == 0) $color = "danger";
        else $color = "success";
?>
<tr>
    <td>
        <img id="img<?php echo $data["item_id"]?>" src="img/item/<?php echo ($data["item_img"] == "") ? "item.jpg" : $data["item_img"]; ?>" alt="" width="200" >
    </td>
    <td>
        <div class="p-2">
            <div class="d-flex p-2"><b>ID:&nbsp;</b><p><?php echo $data["item_id"]?></p></div>
            <div class="d-flex p-2"><b class="py-1">Name:&nbsp;</b><p id="name<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_name"]?></p></div>
            <div class="d-flex p-2"><b class="py-1">Brand:&nbsp;</b><p id="brand<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_brand"]?></p></div>
            <div class="d-flex p-2"><b class="py-1">Description:&nbsp;</b><p id="desc<?php echo $data["item_id"]?>" class="edit" contenteditable><?php echo $data["item_desc"]?></p></div>
            <div class="d-flex p-2">
                <b class="py-1">Category:&nbsp;</b>
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
                <b class="float-left py-1">Capital:&nbsp;₱&nbsp;</b><p id="item_capital_<?php echo $data["item_id"]?>" class="edit capital" item_id="<?php echo $data["item_id"]?>" contenteditable><?php echo $data["item_capital"]?></p>
            </div>
            <?php if($data["item_unit"] != "Pieces"){ ?>
            <div class="d-flex p-2"><b>Net Content:&nbsp;</b><p class="w-50"><?php echo $data["item_unit_divisor"] . " " . $data["item_unit_package"] . " per 1(one) " . $data["item_unit"]?></p></div>
            <?php }?>
            <hr>
            <div class="d-flex p-2">
                <b>Store Stock:&nbsp;</b>
                    <p class="text-<?php echo $color; ?>">
                    <?php echo $data["item_stock"] . " " . $data["item_unit_package"] ?>
                    </p>
                <b>Warehouse Stock:&nbsp;</b>
                    <p class="text-<?php echo $color; ?>">
                        <?php echo $u1 . " " . $data["item_unit"] ?>
                    </p>
            </div>
            <hr>
        </div>
    </td>
    <td>
        <div class="p-2" style="width: 200px">
            <center><h5><b>RETAIL</b></h5></center>
            <?php
                if($_SESSION["user"]["role"] == "admin"){ 
            ?>
            <div class="d-flex p-2">
                <p id="item_capital_retail<?php echo $data["item_id"]?>" item_id="<?php echo $data["item_id"]?>"><b>Capital Retail: ₱<?php echo $data["item_capital_retail"]?></b></p>
            </div>
            <hr>
            <div class="d-flex p-2"><b class="py-1">Percentage Revenue&nbsp;</b><p id="tax<?php echo $data["item_id"]?>" class="edit tax" item_id="<?php echo $data["item_id"]?>" contenteditable><?php echo $data["item_tax"]?></p><b class="py-1">%</b></div>
            <?php 
                }
            ?>
            <hr>
            <div class="d-flex p-2"><b>Price:&nbsp;₱<b id="price_<?php echo $data["item_id"]?>"><?php echo $data["item_price"]?></b></b></div>
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
