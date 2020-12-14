function thousands_separators(t) { var e = t.toString().split("."); return e[0] = e[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","), e.join(".") }
$("#ds-btn").click(function() { var t = window.location.href.split("/");
    t.splice(-1, 1), window.location.href = t.join("/") + "/includes/daily-sales.php" }), $("#ms-btn").click(function() { var t = window.location.href.split("/");
    t.splice(-1, 1), window.location.href = t.join("/") + "/includes/monthly-sales.php" }), $("#de-btn").click(function() { var t = window.location.href.split("/");
    t.splice(-1, 1), window.location.href = t.join("/") + "/includes/daily-expenses.php" }), $("#d-btn").click(function() { var t = window.location.href.split("/");
    t.splice(-1, 1), window.location.href = t.join("/") + "/includes/damaged.php" }), $(document).ready(function() { var t = new Date,
        e = [
            [t.getMonth() + 1, t.getDate(), t.getFullYear()].join("-")
        ].join(" ");
    new Date(e).getDay();
    $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "sales-daily" }, success: function(t) { var e = JSON.parse(t),
                a = 0;
            e.forEach(function(t) { var e = (parseFloat(t.item_tax) / 100 * parseFloat(t.item_price) + parseFloat(t.item_price)).toFixed(2) * t.item_count;
                a += e }), $("#daily-total").text("₱" + thousands_separators(a.toFixed(2))) } }), $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "daily-expenses" }, success: function(t) { var e = JSON.parse(t),
                a = 0;
            e.forEach(function(t) { var e = t.item_price * t.item_count;
                a += e }), $("#daily-expenses").text("₱" + thousands_separators(a.toFixed(2))) } }), $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "sales-monthly" }, success: function(t) { var e = JSON.parse(t),
                a = 0;
            e.forEach(function(t) { var e = (parseFloat(t.item_tax) / 100 * parseFloat(t.item_price) + parseFloat(t.item_price)).toFixed(2) * t.item_count;
                a += e }), $("#monthly-total").text("₱" + thousands_separators(a.toFixed(2))) } }), $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "damaged" }, success: function(t) { var e = JSON.parse(t);
            null != e.total ? $("#damaged").text(e.total) : $("#damaged").text(0) } }) });