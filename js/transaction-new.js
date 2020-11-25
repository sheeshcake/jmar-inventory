var $t;
$(document).ready(function() {
    $t = $('#example').DataTable();
    $('#example_wrapper').css("width", "100%");
    // $('#example_wrapper').removeAttr('class');
});



$(".add").click(function() {
    var $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            id: $id,
        },
        success: function(d) {
            console.log(d);
            var data = JSON.parse(d);
            $("#items").prepend(
                '<div class="card mb-1">' +
                '<div class="card-body">' +
                '<div class="d-flex">' +
                '<img width="100px" src="img/item/' + data.item_img + '">' +
                '<div class="ml-3">' +
                '<p><b>Name:</b>&nbsp;' + data.item_name + '</p>' +
                '<p><b>Brand:</b>&nbsp;' + data.item_brand + '</p>' +
                '<p><b>Price:</b>&nbsp;' + ((data.item_tax / 100) * data.item_price) + data.item_price + '</p>' +
                '</div>' +
                '<div>' +
                '</div>' +
                '</div>'
            );
        }
    });
});