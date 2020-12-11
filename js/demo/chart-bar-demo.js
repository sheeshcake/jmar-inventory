Chart.defaults.global.defaultFontFamily = "Nunito", Chart.defaults.global.defaultFontColor = "#858796";
var $chart_week_data = [];

function number_format(a, t, e, r) { a = (a + "").replace(",", "").replace(" ", ""); var o = isFinite(+a) ? +a : 0,
        n = isFinite(+t) ? Math.abs(t) : 0,
        d = void 0 === r ? "," : r,
        i = void 0 === e ? "." : e,
        l = ""; return (l = (n ? function(a, t) { var e = Math.pow(10, t); return "" + Math.round(a * e) / e }(o, n) : "" + Math.round(o)).split("."))[0].length > 3 && (l[0] = l[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, d)), (l[1] || "").length < n && (l[1] = l[1] || "", l[1] += new Array(n - l[1].length + 1).join("0")), l.join(i) }

function init_week_chart() { var a = document.getElementById("myBarChart");
    new Chart(a, { type: "bar", data: { labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], datasets: [{ label: "Sales", backgroundColor: "#4e73df", hoverBackgroundColor: "#2e59d9", borderColor: "#4e73df", data: $chart_week_data }] }, options: { maintainAspectRatio: !1, layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } }, scales: { xAxes: [{ time: { unit: "month" }, gridLines: { display: !1, drawBorder: !1 }, ticks: { maxTicksLimit: 6 }, maxBarThickness: 25 }], yAxes: [{ ticks: { min: 0, max: 15e3, maxTicksLimit: 5, padding: 10, callback: function(a, t, e) { return "₱" + number_format(a) } }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: !1, borderDash: [2], zeroLineBorderDash: [2] } }] }, legend: { display: !1 }, tooltips: { titleMarginBottom: 10, titleFontColor: "#6e707e", titleFontSize: 14, backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: "#dddfeb", borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: !1, caretPadding: 10, callbacks: { label: function(a, t) { return (t.datasets[a.datasetIndex].label || "") + ": ₱" + number_format(a.yLabel) } } } } }) }
$(document).ready(function() { $.ajax({ url: url(window.location.href) + "/controller/get-sales-data-controller.php", method: "POST", data: { type: "sales-daily-chart" }, success: function(a) { var t = JSON.parse(a),
                e = 0;
            t.forEach(function(a) { var t = a.transaction_datetime; if (e != parseInt(moment(t).format("d"))) $chart_week_data[e - 1] = 0, e = parseInt(moment(t).format("d")), console.log(e);
                else { var r = parseFloat(a.item_price),
                        o = parseFloat(a.item_count),
                        n = parseFloat(a.item_tax) / 100 * r + r;
                    $chart_week_data[e - 1] += n * o } }), console.log($chart_week_data), init_week_chart() } }) });