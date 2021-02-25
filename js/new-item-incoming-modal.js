//update this then minify
function calculate(type) {
    var capital = $("#input-capital-wholesale").val();
    var revenue = $("#input-tax").val();
    var total = 0;
    total = math.add(capital, math.multiply(math.divide(revenue, 100), capital)).toFixed(2);
    $("#input-capital").val(total);
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip(
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
    var $count_by_u2 = parseFloat($(this).find("#u1-val").val()) * parseFloat($(this).find("#divisor").val());
    var $count = parseFloat($(this).find("#u1-val").val());
    if (validateForm()) {
        $('#add-item-modal-incoming').modal('toggle');
        var formData = new FormData(this);
        if ($("#item-wholesale").attr("checked")) formData.append("sell_in_wholesale", "true");
        else formData.append("sell_in_wholesale", "false");
        formData.set("submit", "submit");
        console.log(formData);
        $.ajax({
            url: url(window.location.href) + "/controller/add-item-incoming.php",
            method: "POST",
            data: formData,
            success: function(d) {
                console.log(d);
                var data = JSON.parse(d);
                if (typeof data.message !== 'undefined') {
                    $(".alert").addClass("alert" + data.status);
                    $(".alert").text(data.message);
                    $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                        $(".alert").slideUp(500);
                    });
                } else {
                    var item_price = data.item_price_wholesale;
                    var item_count = $count_by_u2;
                    var $id = data.item_id;
                    var sub_total = (parseFloat(item_price) * parseFloat($count)).toFixed(2);
                    $("#items").prepend(
                        '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($count).toFixed(2) + '">' +
                        '<div class="card-body">' +
                        '<div class="d-flex">' +
                        '<img style="max-width: 100px" src="img/item/' + data.item_img + '">' +
                        '<div class="ml-3">' +
                        '<p><b>Name:</b>&nbsp;' + data.item_name + '</p>' +
                        '<p><b>Brand:</b>&nbsp;' + data.item_brand + '</p>' +
                        '<p><b>Price:</b>&nbsp;₱&nbsp;' + item_price + '</p>' +
                        '<p><b>' + data.item_unit + ':</b>&nbsp;' + $count + '</p>' +
                        '<p><b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                        '</div>' +
                        '<button class="remove-item btn btn-danger" style="height: 40px;" item_id="' + $id + '" value="' + item_count + '">x</button>' +
                        '<div>' +
                        '</div>' +
                        '</div>'
                    );
                    var $counter = parseInt($("#total_items").html()) + 1;
                    $("#total").text((parseFloat($("#total").text()) + (parseFloat(item_price) * parseFloat($count))).toFixed(2));
                    $("#total_items").text($counter);
                    $(".submit-transaction").slideDown();
                    $('#add-item-form')[0].reset();
                }
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
