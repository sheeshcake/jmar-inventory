<?php
    include "controller/connect.php";
?>
<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->

<li class="nav-item">
    <a class="nav-link" href="?p=transaction">
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
    Account
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="?p=account">
        <i class="fas fa-fw fa-user"></i>
        <span>My Account</span>
    </a>
</li>
<?php include "includes/sidebar-category.php"; ?>  
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script>
$(document).ready(function() {
    $("#cat-table").DataTable();
});
</script>