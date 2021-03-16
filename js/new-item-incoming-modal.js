//update this then minify
function calculate_retail() {
    var capital = $("#input-capital-wholesale").val();
    var revenue = $("#input-tax").val();
    var total = 0;
    if($("#item-quantity").is(':checked')){
        console.log("checked");
        var qpp = $("#u1-val").val();
        var retail_capital = math.divide(capital, qpp);
        $("#r_capital").val(retail_capital.toFixed(2));
        total = math.add(retail_capital, math.multiply(math.divide(revenue, 100), retail_capital)).toFixed(2);
    }else{
        $("#u1-val").val(1);
        $("#r_capital").val(capital);
        total = math.add(capital, math.multiply(math.divide(revenue, 100), capital)).toFixed(2);
    }
    console.log(total);
    $("#input-capital").val(total);
}
$(function() {
    $('[data-toggle="tooltip"]').tooltip(
    );
});

function validateForm() {
    console.log("checking..");
    $("#add-item-form").filter(":input").each(function() {
        console.log($(this).attr("type"));
        if (data == '') {
            $(this).addClass("border,border-danger");
            return false
        }
        if($(this).attr("type") == "number" && $(this).val() < 0){
            $(this).addClass("border,border-danger");
            return false
        }
    });
    return true;
}
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    var $item_count = $("#item-warehouse").val();
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
                    var u2 = $this_btn.attr("unit");
                    var sub_total = 0;
                    var price = 0;
                    var item_count = 0;
                    console.log($total_count);
                    if(u2 != "Pieces"){
                        item_count = math.divide($total_count, data.item_unit_divisor).toFixed(2);
                        price = math.multiply(data.item_price, data.item_unit_divisor);
                        sub_total = math.multiply(item_count, price);
                    }else{
                        item_count = $total_count;
                        price = data.item_price;
                        sub_total = math.multiply($total_count, price).toFixed(2);
                    }
                    $("#items").prepend(
                        '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse + '">' +
                        '<div class="card-body">' +
                        '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse  +'">x</button>' +
                        '<div class="d-flex">' +
                        '<img style="max-width: 50px" src="img/item/' + data.item_img + '">' +
                        '<div class="ml-3">' +
                        '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                        '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                        '<b>Price:</b>&nbsp;₱&nbsp;' + price + '<br>' +
                        '<b>' + u2 + ':</b>&nbsp;' + item_count + '<br>' +
                        '<b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                        '</div>' +
                        '<div>' +
                        '</div>' +
                        '</div>'
                    );
                    $("#total").text((parseFloat($("#total").text()) + (parseFloat(price) * parseFloat(item_count))).toFixed(2));
                    $("#total_items").text($counter);
                    calculate();
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
    $("#u1-selected").text($unit);
});
$(document).on("change", "#unit_name", function() {
    var $unit = $(this).val();
    $("#u2-selected").text($unit);
    $("#naming").text("Retail per " + $unit);
});
$("#show_per_unit").change(function() {
    if ($(this).is(":checked")) {
        $("#per_unit").slideDown(500);
    } else {
        $("#per_unit").slideUp(500);
    }
});
$(document).on("input", "#u1-val", function() {
    calculate_retail();
});
$(document).on("input", "#input-capital-wholesale", function() {
    calculate_retail();
});
$(document).on("input", "#input-tax", function() {
    calculate_retail();
});
$(document).ready(function() {
    $("#item-quantity").click(function() {
        if ($(this).is(':checked')) {
            calculate_retail();
            $("#quantity-per-package").slideDown(500);
            $("#u1-selected").text($("#item-unit").val());
            $("#no_qpp").addClass("move-up");
            $("#rev").addClass("move-down");
            $("#retail_p").addClass("move-down");
            $("#retail-capital").slideDown(500);
        } else {
            calculate_retail();
            $("#quantity-per-package").slideUp(500);
            $("#u1-selected").text("Pieces");
            $("#u2-selected").text("Pieces");
            $("#unit_name").val("Pieces");
            $("#unit-name").val("Pieces");
            $("#item-unit").val("Pieces");
            $("#naming").text("Retail per Pieces");
            $("#no_qpp").removeClass("move-up");
            $("#rev").removeClass("move-down");
            $("#retail_p").removeClass("move-down");
            $("#retail-capital").slideUp(500);
        }
    });
});