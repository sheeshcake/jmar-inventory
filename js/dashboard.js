function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getCurrentDate() {
    const dateObj = new Date();
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const day = String(dateObj.getDate()).padStart(2, '0');
    const year = dateObj.getFullYear();
    const output = year + '-' + month + '-' + day;
    return output;
}

var ctx = document.getElementById('canvas').getContext('2d');
var barChartData = {};
window.myBar = new Chart(ctx, {
    type: 'bar',
    data: barChartData,
    options: {
        responsive: true,
        maintainAspectRatio: true,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Calendar Chart'
        }
    }
});

$("#ds-btn").click(function() {
    var rawurl = window.location.href;
    var res = rawurl.split("/");
    res.splice(-1, 1);
    window.location.href = res.join("/") + "/includes/daily-sales.php";
});
$("#ms-btn").click(function() {
    var rawurl = window.location.href;
    var res = rawurl.split("/");
    res.splice(-1, 1);
    window.location.href = res.join("/") + "/includes/monthly-sales.php";
});
$("#de-btn").click(function() {
    var rawurl = window.location.href;
    var res = rawurl.split("/");
    res.splice(-1, 1);
    window.location.href = res.join("/") + "/includes/daily-expenses.php";
});
$("#d-btn").click(function() {
    var rawurl = window.location.href;
    var res = rawurl.split("/");
    res.splice(-1, 1);
    window.location.href = res.join("/") + "/includes/damaged.php";
});
$(document).ready(function() {
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
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "sales-daily",
        },
        success: function(data) {
            var $data = JSON.parse(data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    var $sub_total = $price * (d.item_count / d.item_unit_divisor);
                    $grand_total += Number($sub_total);
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    var $sub_total = $price * d.item_count;
                    $grand_total += Number($sub_total);
                }
            });
            $("#daily-total").text("₱" + formatter($grand_total));
        }
    });
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "daily-expenses",
        },
        success: function(data) {
            var $data = JSON.parse(data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                var $sub_total = 0;
                var $price = d.item_price_wholesale;
                $sub_total = $price * (d.item_count / d.item_unit_divisor);
                $grand_total += $sub_total;
            });

            $("#daily-expenses").text("₱" + formatter($grand_total));
        }
    });
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "sales-monthly",
        },
        success: function(data) {
            var $data = JSON.parse(data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                var $sub_total = 0;
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    var $sub_total = $price * (d.item_count / d.item_unit_divisor);
                    $grand_total += $sub_total;
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    $sub_total = $price * d.item_count;
                    $grand_total += $sub_total;
                }
            });
            $("#monthly-total").text("₱" + formatter($grand_total));
        }
    });
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "damaged",
        },
        success: function(d) {
            var data = JSON.parse(d);
            if (data.total != null) {
                $("#damaged").text(data.total);
            } else {
                $("#damaged").text(0);
            }

        }
    });
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "calendar-daily",
            date: getCurrentDate()
        },
        success: function(d) {
            var $data = JSON.parse(d);
            var $grand_total = 0;
            $data.forEach(function(d) {
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    var $sub_total = $price * (d.item_count / d.item_unit_divisor);
                    $grand_total += Number($sub_total);
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    var $sub_total = $price * d.item_count;
                    $grand_total += Number($sub_total);
                }
            });
            var newDataset = {
                label: getCurrentDate(),
                backgroundColor: getRandomColor(),
                borderColor: getRandomColor(),
                borderWidth: 1,
                data: [$grand_total]
            };

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        }
    });

});
$("#date-pick").change(function() {
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "calendar-daily",
            date: $(this).val()
        },
        success: function(d) {
            var $data = JSON.parse(d);
            var $grand_total = 0;
            $data.forEach(function(d) {
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    var $sub_total = $price * (d.item_count / d.item_unit_divisor);
                    $grand_total += Number($sub_total);
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    var $sub_total = $price * d.item_count;
                    $grand_total += Number($sub_total);
                }
            });
            var newDataset = {
                label: getCurrentDate(),
                backgroundColor: getRandomColor(),
                borderColor: getRandomColor(),
                borderWidth: 1,
                data: [$grand_total]
            };

            barChartData.datasets.push(newDataset);
            window.myBar.update();
        }
    });
});

$("#remove-chart").click(function() {
    if (barChartData.datasets.length > 1) {
        barChartData.datasets.pop();
    }
    window.myBar.update();
});
$("#clear-chart").click(function() {
    var j = barChartData.datasets.length;
    for (var i = 1; i < j; i++) {
        barChartData.datasets.pop();
    }
    window.myBar.update();
});