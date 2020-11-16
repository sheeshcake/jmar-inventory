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
                if(isset($_GET["p"])){
                    if(file_exists("includes/" . $_GET["p"] . ".php")){
                        include "includes/" . $_GET["p"] . ".php";
                    }
                    else{
                        include "includes/error404.php";
                    }
                }
                else{
                    include "includes/dashboard.php";
                }
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