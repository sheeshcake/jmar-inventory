// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
var $name_data = [];
var $count_data = [];
var $color_data = [];

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
$(document).ready(function() {
    $.ajax({
        url: url(window.location.href) + "/controller/get-sales-data-controller.php",
        method: "POST",
        data: {
            type: "number-of-items",
        },
        success: function(d) {
            var data = JSON.parse(d);
            data.forEach(function(item, index) {
                console.log(item);
                $name_data[index] = item.category_name;
                $count_data[index] = item.count;
                $color_data[index] = getRandomColor();
                $("#legend").append(
                    '<span class="mr-2">' +
                    '<i class="fas fa-circle" style="color: ' + $color_data[index] + '"></i>' + $name_data[index] +
                    '</span>'
                );
            });
            init_pie();
        }
    });
});


function init_pie() {
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: $name_data,
            datasets: [{
                data: $count_data,
                backgroundColor: $color_data,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 50,
        },
    });

}