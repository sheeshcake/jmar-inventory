//update this then minify
function calculate(type) {
    if (type == "retail") {
        var price = parseFloat($("#input-capital").val());
        var tax = parseFloat($("#input-tax").val());
        var total = ((tax / 100) * price) + price;
        $("#total-item-price2").val(total.toFixed(2));
    } else {
        var price = parseFloat($("#input-capital-wholesale").val());
        var tax = parseFloat($("#input-tax-wholesale").val());
        var total = ((tax / 100) * price) + price;
        $("#total-item-price1").val(total.toFixed(2));
    }
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url: url(window.location.href) + "/controller/add-item.php",
        method: "POST",
        data: formData,
        success: function(d) {
            var data = JSON.parse(d);
            $(".alert").addClass("alert" + data.status);
            $(".alert").text(data.message);
            $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
                location.reload();
            });
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
$('#image-file').change(function() {
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#item-image-selected').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#item-image-selected').attr('src', '/img/item.jpg');
    }
});
$(document).on("change", "#item-unit", function() {
    var $unit = $(this).val();
    if ($unit == "Roll") {
        $("#unit-2").val("Meter");
    } else if ($unit == "Sack") {
        $("#unit-2").val("Kilo");
    } else {
        $("#unit-2").val("Pieces");
    }
});
$(document).on("input", "#u1-val,#u2-val,#divisor", function() {
    var u1 = $("#u1-val").val();
    var u2 = $("#u2-val").val();
    var divisor = $("#divisor").val();
    var total = (u1 * divisor) + Number(u2);
    $("#item_stock").val(total);
});
$(document).on("input", "#input-capital", function() {
    calculate("retail");
});
$(document).on("input", "#divisor, #input-tax", function() {
    $("#input-capital").val(($("#input-capital-wholesale").val() / $("#divisor").val()).toFixed(2));
    calculate("retail");
});
$(document).on("input", "#input-capital-wholesale, #input-tax-wholesale", function() {
    $("#input-capital").val(($("#input-capital-wholesale").val() / $("#divisor").val()).toFixed(2));
    calculate("wholesale");
});
$("#manual-input").change(function() {
    if ($(this).is(':checked')) {
        $(this).parent().parent().prev().children().last().attr("readonly", false);
    } else {
        $(this).parent().parent().prev().children().last().attr("readonly", true);
        $("#input-capital").val(($("#input-capital-wholesale").val() / $("#divisor").val()).toFixed(2));
        calculate("retail");
    }
});