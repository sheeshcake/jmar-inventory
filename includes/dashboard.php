<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <a href="#" id="ds-btn" class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div  class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Sales (Daily)</div>
                        <div id="daily-total" class="h5 mb-0 font-weight-bold text-gray-800">₱00.00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a href="#" id="ms-btn" class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sales (Monthly)</div>
                        <div id="monthly-total" class="h5 mb-0 font-weight-bold text-gray-800">₱00.00</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Earnings (Monthly) Card Example -->
    <a href="#" id="de-btn" class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daily Expenses
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div id="daily-expenses" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">₱00.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <!-- Pending Requests Card Example -->
    <a href="#" id="d-btn" class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Damage</div>
                        <div id="damaged" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-chain-broken fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Sales(Yearly) Overview</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myAreaChart" style="display: block; width: 400px; height: 160px;" width="400" height="160" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Number Of Items</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myPieChart" width="400" height="208" class="chartjs-render-monitor" style="display: block; width: 400px; height: 208px;"></canvas>
                </div>
                <div class="mt-4 text-center small" id="legend">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Item Monitoring</h6>
        </div>
        <div class="card-body">
            <?php
                include "controller/connect.php";
                $sql = "SELECT * FROM items INNER JOIN category ON items.category_id = category.category_id ORDER BY items.item_stock ASC";
                $result = mysqli_query($conn, $sql);
            ?>
            <table class="table table-striped" id="table-item-monitor">
                <thead>
                    <th>Item ID</th>
                    <th>Image</th>
                    <th>Item Name & Description</th>
                    <th>Item Status</th>
                    <th></th>
                </thead>
                <tbody>
                <?php
                while($data = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $data["item_id"] ?></td>
                        <td>
                            <img style="width: 100px; height: 100px" src="img/item/<?php echo $data["item_img"] ?>" alt="">
                            
                        </td>
                        <td>
                            <p><b><?php echo $data["item_name"] ?></b></p>
                            <p><?php echo $data["item_desc"] ?></p>
                        </td>
                        <td>
                            <?php
                                if((int)$data["item_stock"] == 0){
                                    echo '<input type="text" class="form-control is-invalid" value="Out Of Stock" readonly="">';
                                }else if((int)$data["item_stock"] <= 2){
                                    echo '<input type="text" class="form-control border border-warning is-invalid" value="' . $data["item_stock"] . '" readonly="">';
                                }else{
                                    echo '<input type="text" class="form-control is-valid" value="' . $data["item_stock"] . '" readonly="">';
                                }
                            ?>
                        </td>
                        <td>
                                <button class="btn btn-primary">Report</button>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Calender Chart</h6>
    </div>
    <div class="card-body">
        <div class="input-group mb-3 row">
            <div class="input-group-prepend pl-1">
                <span class="input-group-text" id="date_label">Date</span>
            </div>
            <input type="date" class="form-control mx-1" aria-label="Date" aria-describedby="date_label" id="date-pick">
            <button class="btn btn-secondary mx-1" id="remove-chart">Remove Last</button>
            <button class="btn btn-danger mx-1" id="clear-chart">Clear All</button>
        </div>
        <div id="container">
            <canvas id="canvas"></canvas>
        </div>
    </div>
</div>
<div style="filter: blur(8px);">
<!-- <div> -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sales(Weekly) Overview</h6>
    </div>
    <div class="card-body">
        <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="myBarChart" width="400" height="160" class="chartjs-render-monitor" style="display: block; width: 400px; height: 160px;"></canvas>
        </div>
    </div>
</div>
</div>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/dashboard.js"></script>