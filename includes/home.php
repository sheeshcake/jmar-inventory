<div id="wrapper">
    <?php include "sidebar.php" ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column ">
    <!-- Main Content -->
    <div id="content">
        <?php include "topbar.php"; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid" style = "overflow-y: auto;">
            <!-- Page Heading -->
            <?php
                home_core();
            ?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?php 
        include "footer.php";
    ?>
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<link rel="stylesheet" href="css/home.css">
<script src="js/home.js"></script>