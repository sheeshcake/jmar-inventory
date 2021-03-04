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
    $('[data-toggle="tooltip"]').tooltip({
        container: "body"
    });
});

function validateForm() {
    console.log("checking..");
    var is_true = true;
    $("#add-item-form *").filter(":input").each(function(i, obj) {
        console.log($(obj).attr("type"));
        if ($(obj).val() == '' && $(obj).attr("type") == "text") {
            $(obj).addClass("border border-danger");
            is_true = false;
            return false;
        }
        if($(obj).attr("type") == "number" && $(obj).val() < 0){
            $(obj).addClass("border border-danger");
            is_true = false;
            return false;
        }
        $(obj).removeClass("border border-danger").addClass("border border-success");
    });
    return is_true;
}
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    if (validateForm()) {
        $('#add-item-modal').modal('toggle');
        var formData = new FormData(this);
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