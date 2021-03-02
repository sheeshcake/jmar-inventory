<?php
    include "controller/connect.php";
?>
<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="?p=dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="?p=transaction-new">
        <i class="fa fa-exchange" aria-hidden="true"></i>  
        <span>Transaction</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="?p=return">
    <i class="fa fa-comments-o" aria-hidden="true"></i>  
        <span>Customer Concern</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Tools
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-archive"></i>
        <span>Inventory</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inventory Tools:</h6>
            <a class="collapse-item" href="?p=inventory">Inventory</a>
            <a class="collapse-item" href="?p=incoming">Incoming Items</a>
            <a class="collapse-item" href="?p=transfer">Stock Transfer</a>
            <a class="collapse-item" href="?p=damaged">Damaged Items</a>
            <a class="collapse-item" href="includes/all-items.php">All Items</a>
            <h6 class="collapse-header">Categories:</h6>
            <?php
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                while($data = $result->fetch_assoc()){
            ?>
                <a id="sc_<?php echo $data["category_id"] ?>" class="collapse-item cat" href="?p=inventory&cat=<?php echo $data["category_name"] ?>"><?php echo $data["category_name"] ?></a>
            <?php
                }

            ?>
            <button id="open-cat" class="collapse-item btn btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Category</button>
        </div>
    </div>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsehistory" aria-expanded="true" aria-controls="collapsehistory">
        <i class="fa fa-history" aria-hidden="true"></i>
        <span>History</span>
    </a>
    <div id="collapsehistory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?p=sale-daily-history">Sales Daily</a>
            <a class="collapse-item" href="?p=sale-monthly-history">Sales Monthly</a>
            <a class="collapse-item" href="?p=incoming-history">Incoming</a>
            <a class="collapse-item" href="?p=stock-transfer-history">Stock Transfer</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Account
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a  class="nav-link" href="#" id="b-reg">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span>Create an Account</span>
    </a>
    <a class="nav-link" href="?p=account">
        <i class="fas fa-fw fa-user"></i>
        <span>My Account</span>
    </a>
    <a class="nav-link" id="note-button">
    <i class="fa fa-sticky-note" aria-hidden="true"></i>
        <span>Open Stickynotes</span>
    </a>
</li>
<div id="notes" style="z-index: 100">
    <div class="bg-warning border-rounded">
        <h5 class="float-left">Notes</h5>
        <button class="btn float-right" id="minimize-note"><i class="fa fa-window-minimize" aria-hidden="true"></i></button>
        <?php
            $sql = "SELECT * FROM notes WHERE user_id = '" . $_SESSION["user"]["user_id"] . "'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $data = $result->fetch_assoc();
            }
        ?>
        <input type="text" id="note_note_id" value="<?php if(isset($data))echo $data["note_id"] ?>" hidden>
        <input type="text" id="note_user_id" value="<?php echo $_SESSION["user"]["user_id"] ?>" hidden>
        <div class="card-body" id="note-data" style="min-heigth: 200px">
            <textarea name="note" id="note-field" style="width:100%;"><?php if(isset($data))echo $data["note_data"]; ?></textarea>
        </div>
    </div>
</div>
<?php include "includes/sidebar-category.php"; ?>
<script src="js/note.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
