var $t;
var $last_data;
var $counter = 0;


function reload() {
    setTimeout(function() {
        $.ajax({
            url: url(window.location.href) + "/controller/incoming-get-items.php",
            method: "GET",
            success: function(d) {
                if ($last_data != d.replace(/\s/g, '')) {
                    $last_data = d.replace(/\s/g, '');
                    $("#item_data").html(d);
                    $t = $('#example').DataTable();
                    $(document).find("#example_filter").css("position", "sticky");
                    $(document).find("#example_filter").css("top", "0");
                    $(document).find("#example_filter").css("background", "white");
                    $(document).find("#example_filter").css("z-index", "100");
                }
            }
        });
        $('#example_wrapper').css("width", "100%");
        reload();
    }, 500);
}
$(document).ready(function() {
    $("#page-top").toggleClass("sidebar-toggled");
    $("#accordionSidebar").toggleClass("toggled");
    reload();
});

$(document).on("click", ".add", function() {
    var $id = $(this).val();
    var $count = $("#item_" + $id);
    var $item_divisor = $(this).attr("item-div");
    $(".submit-transaction").slideDown();
    $("#stock_" + $id).val((parseFloat(parseFloat($("#stock_" + $id).val()) - parseFloat($count.val()))).toFixed(2));
    $("#item_" + $id).removeClass("border-danger");
    $("#item_" + $id).addClass("border-success");
    $(this).parent().next().text("Item Added!");
    $(this).parent().next().attr('class', 'alert-success').addClass('alert');
    $(this).parent().next().fadeTo(3000, 500).slideUp(500, function() {});
    if (parseFloat($("#stock_" + $id).val()) == 0) {
        $("#count_input_" + $id).removeClass("d-flex");
        $("#stock_" + $id).removeClass("border-success");
        $("#stock_" + $id).addClass("is-invalid");
        $("#count_input_" + $id).fadeOut();
    }
    $counter++;
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            id: $id,
            type: "get-item"
        },
        success: function(d) {
            var data = JSON.parse(d);
            var item_price = data.item_price_wholesale;
            var item_count_in_div = $item_divisor * $count.val();
            var item_count = $count.val();
            var sub_total = (parseFloat(item_price) * parseFloat($count.val())).toFixed(2);
            $("#items").prepend(
                '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($count.val()).toFixed(2) + '">' +
                '<div class="card-body">' +
                '<div class="d-flex">' +
                '<img style="max-width: 100px" src="img/item/' + data.item_img + '">' +
                '<div class="ml-3">' +
                '<p><b>Name:</b>&nbsp;' + data.item_name + '</p>' +
                '<p><b>Brand:</b>&nbsp;' + data.item_brand + '</p>' +
                '<p><b>Price:</b>&nbsp;₱&nbsp;' + item_price + '</p>' +
                '<p><b>' + data.item_unit + ':</b>&nbsp;' + item_count + '</p>' +
                '<p><b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                '</div>' +
                '<button class="remove-item btn btn-danger" style="height: 40px;" item_id="' + $id + '" value="' + item_count + '">x</button>' +
                '<div>' +
                '</div>' +
                '</div>'
            );
            $("#total").text((parseFloat($("#total").text()) + (parseFloat(item_price) * parseFloat(item_count))).toFixed(2));
            $("#total_items").text(parseInt($("#total_items").html()) + 1);
        }
    });
});

function AddZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = AddZero(hours) + ':' + AddZero(minutes) + ' ' + ampm;
    return strTime;
}
$(".submit-transaction").click(function() {
    $counter = 0;
    var now = new Date();
    var strDateTime = [
        [
            AddZero(now.getMonth() + 1),
            AddZero(now.getDate()),
            now.getFullYear()
        ].join("-"), formatAMPM(new Date)
    ].join(" ");
    var $date = strDateTime;
    var $all = $(".item").map(function() {
        return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("item-count");
    }).get();
    $.ajax({
        url: url(window.location.href) + "/controller/incoming-transaction-controller.php",
        method: "POST",
        data: {
            date: $date,
            type: "transaction",
            trans_type: "incoming",
            data: $all
        },
        success: function(d) {
            var data = JSON.parse(d);
            if (data["status"] == "success") {
                $(".item").map(function() {
                    $(this).fadeTo(1000, 500).slideUp(500, function() {
                        $("#total").text(0);
                        $("#total_items").text(0);
                        $(this).remove();
                    });
                });
                $(".submit-transaction").slideUp();
                $("#trans-message").fadeTo(3000, 500).slideUp(500, function() {}).text(data["message"]).attr('class', 'alert-' + data['status']).addClass('alert');
            } else {

            }
        }
    })
});
$(document).on("click", ".remove-item", function() {
    $btn = $(this);
    $(".submit-transaction").prop('disabled', true);
    $("#count_input_" + $btn.attr("item_id")).addClass("d-flex");
    $("#stock_" + $btn.attr("item_id")).removeClass("is-invalid");
    $("#stock_" + $btn.attr("item_id")).addClass("border-success");
    $("#count_input_" + $btn.attr("item_id")).fadeIn();
    var d1 = parseFloat($btn.val());
    var d2 = parseFloat($("#stock_" + $(this).attr("item_id")).val());
    $("#stock_" + $(this).attr("item_id")).val((d1 + d2).toFixed(2));
    var elem = $(this).parent().parent().parent()
    elem.slideUp("normal", function() {
        $(this).remove();
        $(".submit-transaction").prop('disabled', false);
        if (!$(".item").length) {
            $(".submit-transaction").slideUp();
        } else {
            $(".submit-transaction").slideDown();
        }
    });
    $counter--;
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text(parseInt($("#total_items").html()) - 1);
});