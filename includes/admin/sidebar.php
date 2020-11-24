<?php
    include "controller/connect.php";
?>
<a class="nav-link" href="?p=transaction">
<i class="fa fa-exchange" aria-hidden="true"></i>  
    <span>Transaction</span></a>
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-archive"></i>
    <span>Inventory</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Inventory Tools:</h6>
        <a class="collapse-item" href="?p=inventory">Show All Items</a>
        <h6 class="collapse-header">Categories:</h6>
        <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);
            while($data = $result->fetch_assoc()){
        ?>
            <a class="collapse-item cat" href="?p=inventory&cat=<?php echo $data["category_name"] ?>"><?php echo $data["category_name"] ?></a>
        <?php
            }

        ?>
        <button class="collapse-item btn btn-sm" id="open-cat" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Category</button>
    </div>
</div>
<?php include "includes/sidebar-category.php"; ?>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">