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
        <td><?php echo $data["item_id"]; ?></td>
        <td><?php echo $data["item_name"]; ?></td>
        <td><?php echo $data["item_brand"]; ?></td>
        <td><?php echo $data["category_name"]; ?></td>
        <td><?php echo $data["item_stock"]; ?></td>
        <td>
            <button class="btn btn-success">Add</button>
        </td>
</tr>

<?php
    }

?>
