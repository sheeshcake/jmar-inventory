//update this then minify
$("form#add-item-form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
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