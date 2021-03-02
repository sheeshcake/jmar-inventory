var $t;
var $last_data;
var $counter = 0;

function check_if_ready(){
    if($(".items")){
        $(".submit-transaction").slideDown(500);
    }else{
        $(".submit-transaction").slideUp(500);
    }
}

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

function alert(id, message, status){
    $("#alert_" + id).addClass("alert-" + status);
    $("#alert_" + id).text(message);
    $("#alert_" + id).fadeTo(3000, 500).slideUp(500, function() {
        $("#alert_" + id).slideUp(500);
    });
}

$(document).on("click", ".add", function() {
    var $id = $(this).val();
    var $item_unit_divisor = $(this).attr("item-div");
    var $item_count_input = $("#item_" + $id).val();
    var $total_count = math.multiply($item_unit_divisor, $item_count_input);
    var $storage = $("#location_" + $id).val();
    if(parseInt($total_count) > 0){
        $.ajax({
            url: url(window.location.href) + "/controller/transaction-new-controller.php",
            method: "POST",
            data: {
                id: $id,
                type: "get-item"
            },
            success: function(d) {
                check_if_ready();
                var data = JSON.parse(d);
                var sub_total = math.multiply(data.item_capital, $item_count_input);
                var $added_to_store = 0;
                var $added_to_warehouse = 0;
                if($storage == "store"){
                    $added_to_store = $total_count;
                }else{
                    $added_to_warehouse = $total_count;
                }
                $("#items").prepend(
                    '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '" a_store="' + $added_to_store + '" a_warehouse="' + $added_to_warehouse + '">' +
                    '<div class="card-body">' +
                    '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '">x</button>' +
                    '<div class="d-flex">' +
                    '<img style="max-width: 23% !important" src="img/item/' + data.item_img + '">' +
                    '<div class="ml-3">' +
                    '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                    '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                    '<b>Price:</b>&nbsp;₱&nbsp;' + data.item_capital + '<br>' +
                    '<b>' + data.item_unit + ':</b>&nbsp;' + $item_count_input + '<br>' +
                    '<b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                    '</div>' +
                    '<div>' +
                    '</div>' +
                    '</div>'
                );
                $counter++;
                var total = $("#total").text();
                $("#total").text(math.add(total, sub_total));
                $("#total_items").text($counter);
            }
        });
    }else{
        alert($id, "Input Error!", "danger");
    }

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
        return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("a_store") + "," + $(this).attr("a_warehouse") + "," + $(this).attr("item-count");
    }).get();
    $.ajax({
        url: url(window.location.href) + "/controller/incoming-transaction-controller.php",
        method: "POST",
        data: {
            date: $date,
            type: "transaction",
            driver_name: $("#driver_name").val(),
            supplier_name: $("#supplier_name").val(),
            plate_no: $("#plate_no").val(),
            terms_of_payment: $("#terms_of_payment").val(),
            address: $("#address").val(),
            contact_no: $("#contact_no").val(),
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
    $btn.attr("disabled", true);
    $(".submit-transaction").prop('disabled', true);
    var elem = $(this).parent().parent();
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
    var price = $btn.parent().parent().attr("price");
    var total = $("#total").text();
    $("#total").text(math.subtract(total, price));
    $("#total_items").text($counter);
    check_if_ready();
});