var $t;
var $last_data;

function reload() {
    setTimeout(function() {
        if (!$(".item").length) {
            $.ajax({
                url: url(window.location.href) + "/controller/get-items.php",
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
        }
        $.ajax({
            url: url(window.location.href) + "/controller/transaction-new-controller.php",
            method: "GET",
            success: function(d) {
                $("#transaction").text("Transaction ID: " + (parseInt(JSON.parse(d).transaction_id) + 1));
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

var $counter = 0;
$(document).on("input", "#cash", function() {
    var $total = $("#total").html();
    var $cash = $(this).val();
    var $change = (parseFloat($cash) - parseFloat($total)).toFixed(2);
    if ($change < 0 || $change == "NaN") {
        $("#change").html("Please Input Valid Cash");
        $("#change").removeClass("text-success");
        $("#change").addClass("text-danger");
        $(".submit-transaction").slideUp();
    } else {
        $("#change").removeClass("text-danger");
        $("#change").addClass("text-success");
        $("#change").html($change);
        $(".submit-transaction").slideDown();
    }
});
$(document).on("click", ".add", function() {
    var $id = $(this).val();
    var $count = $(this).prev().prev();
    var $item_unit = $(this).prev();
    console.log($count.val());
    console.log($item_unit.prop("options")[$item_unit.prop("options").selectedIndex]["value"] * $count.val());
    var $total_count = $item_unit.prop("options")[$item_unit.prop("options").selectedIndex]["value"] * $count.val();
    if (parseFloat($total_count) <= parseFloat($("#stock_" + $id).val()).toFixed(2) && parseFloat($total_count).toFixed(2) > 0) {
        $("#stock_" + $id).val((parseFloat(parseFloat($("#stock_" + $id).val()) - parseFloat($total_count))).toFixed(2));
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
                var item_count = $count.val();
                if ($item_unit.prop("options").selectedIndex == 0) {
                    var item_unit = "retail";
                    var item_price = (parseFloat(data.item_tax) / 100 * parseFloat(data.item_price) + parseFloat(data.item_price)).toFixed(2);
                    var sub_total = (parseFloat(item_price) * parseFloat(item_count)).toFixed(2);
                } else {
                    var item_unit = "wholesale";
                    var item_price = (parseFloat(data.item_tax_wholesale) / 100 * parseFloat(data.item_price_wholesale) + parseFloat(data.item_price_wholesale)).toFixed(2);
                    var sub_total = (parseFloat(item_price) * parseFloat(item_count)).toFixed(2);
                }
                console.log(item_price);
                console.log(item_count);
                $("#items").prepend(
                    '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '" item-unit="' + item_unit + '">' +
                    '<div class="card-body">' +
                    '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" value="' + $total_count + '">x</button>' +
                    '<div class="d-flex">' +
                    '<img style="max-width: 100px" src="img/item/' + data.item_img + '">' +
                    '<div class="ml-3">' +
                    '<p><b>Name:</b>&nbsp;' + data.item_name + '</p>' +
                    '<p><b>Brand:</b>&nbsp;' + data.item_brand + '</p>' +
                    '<p><b>Price:</b>&nbsp;₱&nbsp;' + item_price + '</p>' +
                    '<p><b>' + $item_unit.prop("options")[$item_unit.prop("options").selectedIndex]["label"] + ':</b>&nbsp;' + $count.val() + '</p>' +
                    '<p><b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                    '</div>' +
                    '<div>' +
                    '</div>' +
                    '</div>'
                );
                $("#total").text((parseFloat($("#total").text()) + (parseFloat(item_price) * parseFloat(item_count))).toFixed(2));
                $("#total_items").text($counter);
            }
        });
    } else {
        $("#item_" + $id).val($("#stock_" + $id).val());
        $("#item_" + $id).focus().addClass("border-danger");
        $(this).parent().next().text("Requested Item Exeeded!");
        $(this).parent().next().attr('class', 'alert-danger').addClass('alert');
        $(this).parent().next().fadeTo(3000, 500).slideUp(500, function() {});
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

function send_transaction(courier) {
    $counter = 0;
    var now = new Date();
    var strDateTime = [
        [
            AddZero(now.getMonth() + 1),
            AddZero(now.getDate()),
            now.getFullYear()
        ].join("-"), formatAMPM(new Date)
    ].join(" ");
    var $courier = courier;
    var $date = strDateTime;
    var $all = $(".item").map(function() {
        return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("item-count") + "," + $(this).attr("item-unit");
    }).get();
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            date: $date,
            type: "transaction",
            trans_type: "outgoing",
            cash: $("#cash").val(),
            courier: $courier,
            data: $all
        },
        success: function(d) {
            console.log(d);
            var data = JSON.parse(d);
            if (data["status"] == "success") {
                $(".item").map(function() {
                    $(this).fadeTo(1000, 500).slideUp(500, function() {
                        $("#total").text(0);
                        $("#total_items").text(0);
                        $(this).remove();
                    });
                });
                $("#change").html("");
                $("#cash").val(0);
                $(".submit-transaction").slideUp();
                $("#trans-message").fadeTo(3000, 500).slideUp(500, function() {}).text(data["message"]).attr('class', 'alert-' + data['status']).addClass('alert');
            } else {

            }
        }
    });
}
$(".submit-transaction").click(function() {
    if ($("#courier").val() != "" && $('#delivery').is(':checked')) {
        send_transaction($("#courier").val());
    } else if (!$('#delivery').is(':checked')) {
        send_transaction("counter");
    } else {
        alert("Please Enter The Courier Name");
        $("#courier").focus();
    }
});
$(document).on("click", ".remove-item", function() {
    $btn = $(this);
    $btn.prop('disabled', true);
    $(".submit-transaction").prop('disabled', true);
    $("#count_input_" + $btn.attr("item_id")).addClass("d-flex");
    $("#stock_" + $btn.attr("item_id")).removeClass("is-invalid");
    $("#stock_" + $btn.attr("item_id")).addClass("border-success");
    $("#count_input_" + $btn.attr("item_id")).fadeIn();
    var d1 = parseFloat($btn.val());
    var d2 = parseFloat($("#stock_" + $(this).attr("item_id")).val());
    $("#stock_" + $(this).attr("item_id")).val((d1 + d2).toFixed(2));
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
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text($counter);
});

$(document).ready(function() {
    $("input[type='radio']").change(function() {
        if ($(this).val() == "yes") {
            $("#courier").show();
        } else {
            $("#courier").hide();
        }
    });
});
// $(document).on("change", ".unit-select", function() {
//     $(this).prev().attr("max", $(this).val());
// });