        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo "?p=" . $GLOBALS['roles'][$_SESSION["user"]["role"]]["default"]  ?>">
                <div class="sidebar-brand-icon">
                    <img src="img/icon-logo.png" alt="" height="50">
                </div>
                <div class="sidebar-brand-text mx-3">JMAR Enterprise</div>
            </a>

            <?php sidebar_core() ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
