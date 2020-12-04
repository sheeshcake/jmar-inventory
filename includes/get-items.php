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
?>
<tr>
    <td>
        <img src="img/item/<?php echo $data["item_img"] ?>" alt="" width="100" >
    </td>
    <td id="capital<?php echo $data["item_id"]; ?>" contenteditable>
        <?php echo $data["item_price"]; ?>
    </td>
    <td id="name<?php echo $data["item_id"]; ?>" contenteditable>
        <?php echo $data["item_name"] ?>
    </td>
    <td id="brand<?php echo $data["item_id"]; ?>" contenteditable>
        <?php echo $data["item_brand"] ?>
    </td>
    <td id="tax<?php echo $data["item_id"]; ?>"  contenteditable>
        <?php echo $data["item_tax"] ?>
    </td>
    <td>                
        <?php echo $data["item_stock"]; ?>
    </td>
    <td>
        <?php 
            $price = (floatval(($data["item_tax"]) / 100) * floatval($data["item_price"])) + floatval($data["item_price"]); 
            echo "₱" . $price; 
        ?>
    </td>
    <td>
        <?php echo $data["item_id"] ?>
    </td>
    <td id="cat<?php echo $data["item_id"]; ?>" cat-id="<?php echo $data["category_id"]; ?>">
        <?php echo $data["category_name"] ?>
    </td>
    <td id="desc<?php echo $data["item_id"]; ?>" contenteditable>
        <?php echo $data["item_desc"] ?>
    </td>
    <td>
        <!-- <div class="d-flex"> -->
            <button class="btn btn-danger delete" data-target="#logoutModal" data-toggle="modal" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
            <button class="btn btn-success update" value="<?php echo $data["item_id"]; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        <!-- </div> -->
    </td>
</tr>
<?php
    }

?>
