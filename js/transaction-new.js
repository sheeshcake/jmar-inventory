var $t;
$(document).ready(function() {
    $t = $('#example').DataTable();
    $('#example_wrapper').css("width", "100%");
    // $('#example_wrapper').removeAttr('class');
});

var $counter = 0;

$(".add").click(function() {
    var $id = $(this).val();
    var $count = $("#item_" + $id);
    $(this).parent().next().fadeTo(3000, 500).slideUp(500, function() {});
    $counter++;
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            id: $id,
        },
        success: function(d) {
            console.log(d);
            var data = JSON.parse(d);
            var item_price = (((data.item_tax / 100) * data.item_price) + data.item_price);
            var item_count = $count.val();
            var sub_total = (parseFloat(item_price) * parseFloat(item_count)).toFixed(2);
            $("#items").prepend(
                '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + $count.val() + '">' +
                '<div class="card-body">' +
                '<div class="d-flex">' +
                '<img style="max-width: 100px" src="img/item/' + data.item_img + '">' +
                '<div class="ml-3">' +
                '<p><b>Name:</b>&nbsp;' + data.item_name + '</p>' +
                '<p><b>Brand:</b>&nbsp;' + data.item_brand + '</p>' +
                '<p><b>Price:</b>&nbsp;₱&nbsp;' + item_price + '</p>' +
                '<p><b>Count:</b>&nbsp;' + $count.val() + '</p>' +
                '<p><b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                '</div>' +
                '<button class="remove-item btn btn-danger" style="height: 40px;" value="' + $counter + '">x</button>' +
                '<div>' +
                '</div>' +
                '</div>'
            );
            $("#total").text((parseFloat($("#total").text()) + (parseFloat(item_price) * parseFloat(item_count))).toFixed(2));
            $("#total_items").text($counter);
        }
    });
});
$(document).on("click", ".remove-item", function() {
    var elem = $(this).parent().parent().parent()
    elem.slideUp();
    $counter--;
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text($counter);
});