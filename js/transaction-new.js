var $t;
$(document).ready(function() {
    $t = $('#example').DataTable();
    $('#example_wrapper').css("width", "100%");
    // $('#example_wrapper').removeAttr('class');
});

var $counter = 0;

$(".add").click(function() {
    $(".submit-transaction").slideDown();
    var $id = $(this).val();
    var $count = $("#item_" + $id);
    $(this).parent().next().fadeTo(3000, 500).slideUp(500, function() {});
    $counter++;
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            id: $id,
            type: "get-item"
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
    var now = new Date();
    var strDateTime = [
        [
            AddZero(now.getMonth() + 1),
            AddZero(now.getDate()),
            now.getFullYear()
        ].join("-"), formatAMPM(new Date)
    ].join(" ");
    var $date = strDateTime;
    console.log($date);
    var $all = $(".item").map(function() {
        return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("item-count");
    }).get();
    console.log($all.join());
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            date: $date,
            trans_type: "incoming",
            data: $all
        },
        success: function(d) {
            var data = JSON.parse(d);
            console.log(d);
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
    if (!$(".mydivclass")[0]) {
        $(".submit-transaction").slideUp();
    }
    var elem = $(this).parent().parent().parent()
    elem.slideUp("normal", function() { $(this).remove(); });
    $counter--;
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text($counter);
});