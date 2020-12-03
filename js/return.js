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
                    '<div class="d-flex mb-2">' +
                    '<img width="100" style="max-heigth: 100px" src="img/item/' + element.item_img + '" alt="">' +
                    '<div class="p-2">' +
                    '<p><b>Name:&nbsp;</b>' + element.item_name + '</p>' +
                    '<p><b>Brand:&nbsp;</b>' + element.item_brand + '</p>' +
                    '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + element.item_unit + ':&nbsp;</b>' + element.item_count + '</p>' +
                    '<p><b>Price:&nbsp;</b>₱' + price + '</p>' +
                    '<p><b>Total:&nbsp;</b>₱' + price * element.item_count + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="d-flex mb-2">' +
                    '<input class="form-control m-2 void-count" type="number" item_count="' + element.item_count + '" void_id="' + element.purchased_id + '" id="void_count' + element.purchased_id + '" />' +
                    '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_id="' + element.purchased_id + '">Void</button>' +
                    '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_id="' + element.purchased_id + '">Damage</button>' +
                    '<div class="form-check m-2">' +
                    '<input type="checkbox" class="form-check-input" id="replace_' + element.purchased_id + '">' +
                    '<label class="form-check-label" for="replace">Replace Damaged</label>' +
                    '</div>' +
                    '</div> ' +
                    '</div> '
                );
            });
        }
    });
});
$(document).on("input", ".void-count", function() {
    var count = $(this).attr("item_count");
    var void_count = $(this).val();
    var diff = count - void_count;
    if (diff < 0) {
        $(this).val(count);
    }
});

$(document).on("click", ".void", function() {

});
$(document).on("click", ".damage", function() {
    var $item_id = $(this).val();
    var $purchased_id = $(this).attr("purchased_id");
    var $damaged_count = $("#replace_" + $(this).attr("purchased_id")).val();
    var $replace = false;
    $("#replace_" + $(this).attr("purchased_id")).is(':checked') ? $replace = true : $replace = false;
    $.ajax({
        url: url(window.location.href) + "/controller/cc-controller.php",
        method: "POST",
        data: {
            submit: "damage",
            purchased_id: $purchased_id,
            item_id: $item_id,
            item_count: $damaged_count,
            replace: $replace
        },
        success: function(d) {
            console.log(d);
        }
    })

});