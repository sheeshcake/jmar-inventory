<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <a href="http://localhost/jmar-inventory-1/includes/daily-sales.php" class="col-xl-3 col-md-6 mb-4">
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
    <a href="?p=dashboard&action=sales-monthly" class="col-xl-3 col-md-6 mb-4">
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
    <a href="?p=dashboard&action=earnings-monthly" class="col-xl-3 col-md-6 mb-4">
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
    <a href="?p=dashboard&action=earnings-monthly" class="col-xl-3 col-md-6 mb-4">
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

<div class="shadow p3">
    <script>
        function thousands_separators(num){
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
        // var $data = <?php //dashboard_core(isset($_GET["action"]) ? $_GET["action"] : 'sales-daily') ?>;
        // var $page = '<?php //echo isset($_GET["action"]) ? $_GET["action"] : 'sales-daily'; ?>';
        // console.log($page);
        // var $grand_total = 0;
        // if($page == "sales-daily"){
        //     $data.forEach(function(d) {
        //         var $price = ((d.item_tax / 100) * d.item_price) + d.item_price;
        //         var $sub_total = $price * d.item_count;
        //         $grand_total += $sub_total;
        //     });
        //     $("#daily-total").text("₱" + $grand_total.toFixed(2));
        //     console.log($grand_total);
        // }else if($page == "sales-monthly"){
        //     $data.forEach(function(d) {
        //         var $price = ((d.item_tax / 100) * d.item_price) + d.item_price;
        //         var $sub_total = $price * d.item_count;
        //         $grand_total += $sub_total;
        //     });
        //     $("#monthly-total").text("₱" + $grand_total.toFixed(2));
        //     console.log($grand_total);
        // }
        $(document).ready(function(){
            var $now = new Date();
            var strDateTime = [
                [
                    $now.getMonth() + 1,
                    $now.getDate(),
                    $now.getFullYear()
                ].join("-")
            ].join(" ");
            var $date = strDateTime;
            var $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var $d = new Date(strDateTime);
            var dayName = $days[$d.getDay()];
            console.log(dayName);
            $.ajax({
                url: url(window.location.href) + "/controller/get-sales-data-controller.php",
                method: "POST",
                data: {
                    type: "sales-daily",
                },
                success: function(data){
                    var $data = JSON.parse(data);
                    console.log($data);
                    var $grand_total = 0;
                    $data.forEach(function(d) {
                        var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                        var $sub_total = $price * d.item_count;
                        $grand_total += $sub_total;
                        console.log(d.transaction_datetime);
                        console.log($days[new Date(d.transaction_datetime).getDay()]);
                    });

                    $("#daily-total").text("₱" + thousands_separators($grand_total.toFixed(2)));
                }
            });
            $.ajax({
                url: url(window.location.href) + "/controller/get-sales-data-controller.php",
                method: "POST",
                data: {
                    type: "daily-expenses",
                },
                success: function(data){
                    var $data = JSON.parse(data);
                    console.log($data);
                    var $grand_total = 0;
                    $data.forEach(function(d) {
                        var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                        var $sub_total = $price * d.item_count;
                        $grand_total += $sub_total;
                        console.log(d.transaction_datetime);
                        console.log($days[new Date(d.transaction_datetime).getDay()]);
                    });

                    $("#daily-expenses").text("₱" + thousands_separators($grand_total.toFixed(2)));
                }
            });
            $.ajax({
                url: url(window.location.href) + "/controller/get-sales-data-controller.php",
                method: "POST",
                data: {
                    type: "sales-monthly",
                },
                success: function(data){
                    console.log(data);
                    var $data = JSON.parse(data);
                    var $grand_total = 0;
                    $data.forEach(function(d) {
                        var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                        var $sub_total = $price * d.item_count;
                        $grand_total += $sub_total;
                        console.log(d.transaction_datetime);
                        console.log($days[new Date(d.transaction_datetime).getDay()]);
                    });
                    $("#monthly-total").text("₱" + thousands_separators($grand_total.toFixed(2)));
                }
            });
            $.ajax({
                url: url(window.location.href) + "/controller/get-sales-data-controller.php",
                method: "POST",
                data: {
                    type: "damaged",
                },
                success: function(d){
                    var data = JSON.parse(d);
                    if(data.total != null){
                        $("#damaged").text(data.total);
                    }else{
                        $("#damaged").text(0);
                    }
                    
                }
            });
        });
    </script>
</div>


<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview(Daily)</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="myAreaChart" style="display: block; width: 411px; height: 320px;" width="411" height="320" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>