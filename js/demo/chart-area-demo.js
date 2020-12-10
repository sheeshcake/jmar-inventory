Chart.defaults.global.defaultFontFamily = "Nunito", Chart.defaults.global.defaultFontColor = "#858796";
var $chart_data = [];

function number_format(t, a, r, e) { t = (t + "").replace(",", "").replace(" ", ""); var o = isFinite(+t) ? +t : 0,
        i = isFinite(+a) ? Math.abs(a) : 0,
        n = void 0 === e ? "," : e,
        l = void 0 === r ? "." : r,
        d = ""; return (d = (i ? function(t, a) { var r = Math.pow(10, a); return "" + Math.round(t * r) / r }(o, i) : "" + Math.round(o)).split("."))[0].length > 3 && (d[0] = d[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, n)), (d[1] || "").length < i && (d[1] = d[1] || "", d[1] += new Array(i - d[1].length + 1).join("0")), d.join(l) }

function init_chart() { var t = document.getElementById("myAreaChart");
    new Chart(t, { type: "line", data: { labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], datasets: [{ label: "Sales", lineTension: .3, backgroundColor: "rgba(78, 115, 223, 0.05)", borderColor: "rgba(78, 115, 223, 1)", pointRadius: 3, pointBackgroundColor: "rgba(78, 115, 223, 1)", pointBorderColor: "rgba(78, 115, 223, 1)", pointHoverRadius: 3, pointHoverBackgroundColor: "rgba(78, 115, 223, 1)", pointHoverBorderColor: "rgba(78, 115, 223, 1)", pointHitRadius: 10, pointBorderWidth: 2, data: $chart_data }] }, options: { maintainAspectRatio: !1, layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } }, scales: { xAxes: [{ time: { unit: "date" }, gridLines: { display: !1, drawBorder: !1 }, ticks: { maxTicksLimit: 12 } }], yAxes: [{ ticks: { maxTicksLimit: 5, padding: 10, callback: function(t, a, r) { return "₱" + number_format(t) } }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: !1, borderDash: [2], zeroLineBorderDash: [2] } }] }, legend: { display: !1 }, tooltips: { backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", titleMarginBottom: 10, titleFontColor: "#6e707e", titleFontSize: 12, borderColor: "#dddfeb", borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: !1, intersect: !1, mode: "index", caretPadding: 10, callbacks: { label: function(t, a) { return (a.datasets[t.datasetIndex].label || "") + ": ₱" + number_format(t.yLabel) } } } } }) }
$(document).ready(function() { $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "sales-monthly-chart" }, success: function(t) { var a, r = JSON.parse(t),
                e = 0,
                o = 0;
            r.forEach(function(t) { a = t.transaction_datetime.split("-"); var r = parseFloat(t.item_tax),
                    i = parseFloat(t.item_price),
                    n = parseFloat(t.item_count),
                    l = r / 100 * i + i;
                a[0] != e ? (o = 0, o += l * n, $chart_data[e - 1] = o, e = a[0]) : (o += l * n, $chart_data[e - 1] = o) }), init_chart() } }) });