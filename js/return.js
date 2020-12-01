var $t;


$(document).ready(function() {
    $t = $('#example').DataTable();
});

$(document).on("click", ".open", function() {
    var $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/return-controller.php",
        method: "POST",
        data: {
            id: $id,
            type: "open"
        },
        success: function(d) {
            var data = JSON.parse(d);
            $(".modal-body").html("");
            data.forEach(function(element) {
                console.log(element);
                var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                $("#transmodalLabel").text("Transaction: " + element.transaction_id);
                $(".modal-body").append(
                    '<div class="card p-2 mb-2">' +
                    '<div class="d-flex">' +
                    '<img width="100" style="max-heigth: 100px" src="img/item/' + element.item_img + '" alt="">' +
                    '<div class="p-2">' +
                    '<p><b>Name:&nbsp;</b>' + element.item_name + '</p>' +
                    '<p><b>Brand:&nbsp;</b>' + element.item_brand + '</p>' +
                    '<p><b>' + element.item_unit + ':&nbsp;</b>' + element.item_count + '</p>' +
                    '<p><b>Price:&nbsp;</b>₱' + price + '</p>' +
                    '<p><b>Total:&nbsp;</b>₱' + price * element.item_count + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div> '
                );
            });
        }
    });
});