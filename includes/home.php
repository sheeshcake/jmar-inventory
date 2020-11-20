<div id="wrapper">
    <?php include "sidebar.php" ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php include "topbar.php"; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

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
<script>
$(document).ready(function() {
    $(document).on("click", "#sidebarToggleTop", function() {
        $("#page-top").toggleClass("sidebar-toggled");
        $("#accordionSidebar").toggleClass("toggled");
    });
    $(document).on("click", "#sidebarToggle", function() {
        $("#page-top").toggleClass("sidebar-toggled");
        $("#accordionSidebar").toggleClass("toggled");
    });
});
</script>