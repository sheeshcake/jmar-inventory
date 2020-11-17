        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    Logo here
                </div> -->
                <div class="sidebar-brand-text mx-3">JMAR Enterprise</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="?p=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tools
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Inventory</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventory Tools:</h6>
                        <a class="collapse-item" href="?p=inventory">Show All Items</a>
                        <a class="collapse-item" href="?p=incoming">Incoming Items</a>
                        <a class="collapse-item" href="?p=outgoing">Outgoing Items</a>
                        <h6 class="collapse-header">Categories:</h6>
                        <a class="collapse-item" href="?p=inventory&cat=nails">Nails</a>
                        <a class="collapse-item" href="?p=inventory&cat=paints">Paints</a>
                        <a class="collapse-item" href="?p=inventory&cat=bars">Bars</a>
                        <button class="collapse-item btn btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Category</button>
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
                <a class="nav-link" href="?p=account">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Account</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Manage Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card p-3">
                            <h4>Add Category</h4>
                            <hr class="divider"></hr>
                            <div class="form-group">
                                <input type="text" class="form-control" id="category" placeholder="New Category">
                            </div>
                            <button class="btn btn-primary btn-sm">Add</button>
                        </div>
                        <hr class="divider"></hr>
                        <div class="card p-3">
                            <h4>Manage Category</h4>
                            <hr class="divider"></hr>
                            <table class="table table-striped" id="cat-table">
                                <thead>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td></td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td contenteditable>1</td>
                                        <td contenteditable>Nails</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                            <button class="btn btn-success btn-sm">Update</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td contenteditable>2</td>
                                        <td contenteditable>Paints</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                            <button class="btn btn-success btn-sm">Update</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td contenteditable>3</td>
                                        <td contenteditable>Bars</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                            <button class="btn btn-success btn-sm">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/sidebar.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <script src="js/sidebar.js"></script>