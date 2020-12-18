function thousands_separators(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
}
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
            console.log($data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                var $sub_total = 0;
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    $sub_total = $price * (d.item_unit_divisor / d.item_count);
                    $grand_total += $sub_total;
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    $sub_total = $price * d.item_count;
                    $grand_total += $sub_total;
                }
                console.log($sub_total);
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
        success: function(data) {
            var $data = JSON.parse(data);
            console.log($data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                var $sub_total = 0;
                var $price = d.item_price_wholesale;
                $sub_total = $price * (d.item_count / d.item_unit_divisor);
                $grand_total += $sub_total;
                console.log($price + "* (" + d.item_unit_divisor + "/" + d.item_count + ") = " + $grand_total);
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
        success: function(data) {
            var $data = JSON.parse(data);
            var $grand_total = 0;
            $data.forEach(function(d) {
                var $sub_total = 0;
                if (d.item_type == "wholesale") {
                    var $price = (((parseFloat(d.item_tax_wholesale) / 100) * parseFloat(d.item_price_wholesale)) + parseFloat(d.item_price_wholesale)).toFixed(2);
                    $sub_total = $price * (d.item_unit_divisor / d.item_count);
                    $grand_total += $sub_total;
                } else {
                    var $price = (((parseFloat(d.item_tax) / 100) * parseFloat(d.item_price)) + parseFloat(d.item_price)).toFixed(2);
                    $sub_total = $price * d.item_count;
                    $grand_total += $sub_total;
                }
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
        success: function(d) {
            var data = JSON.parse(d);
            if (data.total != null) {
                $("#damaged").text(data.total);
            } else {
                $("#damaged").text(0);
            }

        }
    });
});