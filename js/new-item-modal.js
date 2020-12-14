//update this then minify
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