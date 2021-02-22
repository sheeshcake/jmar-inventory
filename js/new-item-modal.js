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
    $('[data-toggle="tooltip"]').tooltip(
        {
            container: "body"
         }
    );
});

function validateForm() {
    console.log("checking..");
    $("form#add-item-form :input").each(function() {
        var data = $(this).val();
        console.log(data);
        if (data == '') {
            $(this).addClass("border,border-danger");
            return false
        }
    });
    return true;
}
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    if (validateForm()) {
        $('#add-item-modal').modal('toggle');
        var formData = new FormData(this);
        if ($("#item-wholesale").attr("checked")) formData.append("sell_in_wholesale", "true");
        else formData.append("sell_in_wholesale", "false");
        if ($("#item-wholesale").attr("checked")) formData.append("sell_in_wholesale", "true");
        else formData.append("sell_in_wholesale", "false");
        formData.set("submit", "submit");
        $.ajax({
            url: url(window.location.href) + "/controller/add-item.php",
            method: "POST",
            data: formData,
            success: function(d) {
                var data = JSON.parse(d);
                console.log(d);
                $(".alert").addClass("alert" + data.status);
                $(".alert").html(data.message);
                $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                    $(".alert").slideUp(500);
                });
                $('#add-item-form')[0].reset();
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
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
    $("#u1-selected").text($unit);
});
$(document).on("input", "#u1-val,#u2-val,#divisor", function() {
    var u1 = $("#u1-val").val();
    var u2 = $("#u2-val").val();
    var divisor = $("#divisor").val();
    var total = (u1 * divisor) + Number(u2);
    $("#item_stock").val(total);
});
$("#show_per_unit").change(function(){
    if($(this).is(":checked")){
        $("#per_unit").slideDown(500);
    }else{
        $("#per_unit").slideUp(500);
    }
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
$(document).ready(function() {
    $("#item-wholesale").click(function() {
        if ($(this).is(':checked')) {
            $("#input-revenue-wholesale").slideDown(500);
            $("#item-wholesale-percentage").slideDown(500);
            $("#total-item-price1").slideDown(500); 
            $("#input-peso-sign").slideDown(500);
        } else {
            $("#input-revenue-wholesale").slideUp(500);
            $("#item-wholesale-percentage").slideUp(500);
            $("#total-item-price1").slideUp(500);
            $("#input-peso-sign").slideUp(500);
        }
    });
});
$(document).ready(function() {
    $("#item-quantity").click(function() {
        if ($(this).is(':checked')) {
            $("#quantity-per-package").slideDown(500);
            $("#q1-name").slideDown(500);
            $("#u1-selected").text($("#item-unit").val());
        } else {
            $("#quantity-per-package").slideUp(500);
            $("#q1-name").slideUp(500);
        }
    });
});
