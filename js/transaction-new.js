var $t;
var $last_data;
var $id;
var $reciept_no;
var $counter = 0;
var $max = 0;
var $removed_to_warehouse = 0;
var $removed_to_store = 0;
var $paid = "false";

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
                if (d != "null") {
                    if ((parseInt(JSON.parse(d).transaction_id) + 1) != $id) {
                        $("#transaction").text("Transaction ID: " + (parseInt(JSON.parse(d).transaction_id) + 1));
                        $id = (parseInt(JSON.parse(d).transaction_id) + 1);
                    }
                } else {
                    $("#transaction").text("Transaction ID: 1");
                }
            }
        });
        $.ajax({
            url: url(window.location.href) + "/controller/get-reciept-number.php",
            method: "GET",
            success: function(d) {
                if (d != "null") {
                    $data = JSON.parse(d);
                    if(parseInt($data.reciept_no)){
                        if (parseInt($data.reciept_no) + 1 != $reciept_no) {
                            $("#reciept").val(parseInt($data.reciept_no) + 1);
                            $reciept_no = parseInt($data.reciept_no) + 1;
                        }
                    }
                }
            }
        });
        $('#example_wrapper').css("width", "100%");
        reload();
    }, 500);
}
$(document).ready(function() {
    $("#customer").tooltip();
    $("#page-top").toggleClass("sidebar-toggled");
    $("#accordionSidebar").toggleClass("toggled");
    reload();
});
function calculate(){
    var $discount = $("#discount").val();
    var $cash = $("#cash").val();
    var $total = $("#total").html();
    $("#total_amount").text(($total - ($total * $discount / 100)).toFixed(2));
    var $change = ($cash  - ($total - ($total * $discount / 100))).toFixed(2);
    console.log(parseInt($change));
    console.log(parseInt($("#total_items").text()));
    if($('#delivery').is(':checked') && $("#payment").val() != "cash"){
        if(parseInt($("#total_items").text()) != 0){
            $(".submit-transaction").slideDown();
            $paid = "false";
        }
    }else{
        if(isNaN($change) || $change < 0 || parseInt($("#total_items").text()) == 0){
            $("#change").html("Please Input Valid Cash");
            $("#change").removeClass("text-success");
            $("#change").addClass("text-danger");
            $(".submit-transaction").slideUp();
        }else {
            $("#change").removeClass("text-danger");
            $("#change").addClass("text-success");
            $("#change").html($change);
            $(".submit-transaction").slideDown();
            $paid = "true";
        }
    }

}

$(document).on("input", "#cash, #discount", function() {
    calculate();
});
function update_stock_on_add($btn){
    var $id = $btn.val();
    var $count = $btn.prev();
    var ware_house = 0, store = 0;
    if(parseInt($count.attr("max")) >= parseInt($count.val()) && 0 < parseInt($count.val()) && parseInt($btn.parent().prev().find(".form-control").val()) > 0){
        if($btn.attr("loc") == "store"){
            $removed_to_store = $count.val();
            store = math.subtract($("#stock_" + $id).val(), $removed_to_store);
            $("#stock_" + $id).val(store);
        }else{
            $removed_to_warehouse = $count.val();
            ware_house = math.subtract($("#stock_warehouse_" + $id).val(), $removed_to_warehouse);
            $("#stock_warehouse_" + $id).val(ware_house);
        }
        $("#alert_" + $btn.attr("loc") + "_" + $id).text("Item Added!");
        $("#alert_" + $btn.attr("loc") + "_" + $id).attr('class', 'alert-success').addClass('alert');
        $("#alert_" + $btn.attr("loc") + "_" + $id).slideUp(500, function() {});
        return true;
    }else if(parseInt($count.val()) < 0){
        $("#item_" + $btn.attr("loc") + "_" + $id).val($count.attr("min"));
        $("#item_" + $id).focus().addClass("border-danger");
        $("#alert_" + $btn.attr("loc") + "_" + $id).text("Input is Invalid");
        $("#alert_" + $btn.attr("loc") + "_" + $id).attr('class', 'alert-danger').addClass('alert');
        $("#alert_" + $btn.attr("loc") + "_" + $id).slideUp(500, function() {});
        return false;
    }else {
        $("#item_" + $btn.attr("loc") + "_" + $id).val($count.attr("max"));
        $("#item_" + $id).focus().addClass("border-danger");
        $("#alert_" + $btn.attr("loc") + "_" + $id).text("Requested Item Exeeded!");
        $("#alert_" + $btn.attr("loc") + "_" + $id).attr('class', 'alert-danger').addClass('alert');
        $("#alert_" + $btn.attr("loc") + "_" + $id).fadeTo(3000, 500).slideUp(500, function() {});
        return false;
    }

}

var $this_btn = "";
$(document).on("click", ".add", function() {
    $removed_to_warehouse = 0;
    $removed_to_store = 0;
    if(update_stock_on_add($(this))){
        $this_btn = $(this);
        var $id = $(this).val();
        var $total_count = 0;
        if($(this).attr("loc") == "warehouse"){
            $total_count = $(this).attr("unit_divisor") * $removed_to_warehouse;
        }else{
            $total_count = $removed_to_store;
        }
        $.ajax({
            url: url(window.location.href) + "/controller/transaction-new-controller.php",
            method: "POST",
            data: {
                id: $id,
                type: "get-item"
            },
            success: function(d) {
                var data = JSON.parse(d);
                var has_same = false;
                var u2 = $this_btn.attr("unit");
                var sub_total = 0;
                var price = 0;
                var item_count = 0;
                $("#items").children(".item").each(function(i, obj){
                    if($(this).attr("item-id") == $id){
                        if(u2 != "Pieces"){
                            item_count = math.divide($total_count, data.item_unit_divisor).toFixed(2);
                            price = math.multiply(data.item_price, data.item_unit_divisor);
                            sub_total = math.multiply(item_count, price);
                        }else{
                            item_count = $total_count;
                            price = data.item_price;
                            sub_total = math.multiply($total_count, price).toFixed(2);
                        }
                        sub_total = math.add(sub_total, $(this).attr("price"));
                        $total_count = math.add($total_count, $(this).attr("item-count"));
                        $removed_to_store = math.add($removed_to_store, $(this).attr("r_store"));
                        $removed_to_warehouse = math.add($removed_to_warehouse, $(this).attr("r_warehouse"));
                        $("#items").prepend(
                            '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse + '">' +
                            '<div class="card-body">' +
                            '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse  +'">x</button>' +
                            '<div class="d-flex">' +
                            '<img style="max-width: 23% !important" src="img/item/' + data.item_img + '">' +
                            '<div class="ml-3">' +
                            '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                            '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                            '<b>Price:</b>&nbsp;₱&nbsp;' + price + '<br>' +
                            '<b>' + u2 + ':</b>&nbsp;' + $total_count + '<br>' +
                            '<b>Warehouse:</b>&nbsp;' + $removed_to_warehouse + '<br>' +
                            '<b>Store:</b>&nbsp;' + $removed_to_store + '<br>' +
                            '<b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                            '</div>' +
                            '<div>' +
                            '</div>' +
                            '</div>'
                        );
                        $(this).remove();
                        has_same = true;
                        $("#total").text((parseFloat($("#total").text()) + (parseFloat(price) * parseFloat(item_count))).toFixed(2));
                        $("#total_items").text($counter);
                        calculate();
                    }
                });
                if(!has_same){
                    $counter++;
                    if(u2 != "Pieces"){
                        item_count = math.divide($total_count, data.item_unit_divisor).toFixed(2);
                        price = math.multiply(data.item_price, data.item_unit_divisor);
                        sub_total = math.multiply(item_count, price);
                    }else{
                        item_count = $total_count;
                        price = data.item_price;
                        sub_total = math.multiply($total_count, price).toFixed(2);
                    }
                    $("#items").prepend(
                        '<div class="item card mb-1" price="' + sub_total + '" item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse + '">' +
                        '<div class="card-body">' +
                        '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse  +'">x</button>' +
                        '<div class="d-flex">' +
                        '<img style="max-width: 23% !important" src="img/item/' + data.item_img + '">' +
                        '<div class="ml-3">' +
                        '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                        '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                        '<b>Price:</b>&nbsp;₱&nbsp;' + price + '<br>' +
                        '<b>' + u2 + ':</b>&nbsp;' + item_count + '<br>' +
                        '<b>Warehouse:</b>&nbsp;' + $removed_to_warehouse + '<br>' +
                        '<b>Store:</b>&nbsp;' + $removed_to_store + '<br>' +
                        '<b>Sub Total:</b>&nbsp;₱&nbsp;' + sub_total + '</p>' +
                        '</div>' +
                        '<div>' +
                        '</div>' +
                        '</div>'
                    );
                    $("#total").text((parseFloat($("#total").text()) + (parseFloat(price) * parseFloat(item_count))).toFixed(2));
                    $("#total_items").text($counter);
                    calculate();
                }
            }
        });
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

function send_transaction(courier, payment, customer, address, contact_no) {
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
    var $payment = payment;
    var $customer = customer;
    var $address = address;
    var $contact_no = contact_no;
    var $date = strDateTime;
    var $all = $(".item").map(function() {
        return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("item-count") + "," + $(this).attr("r_store") + "," + $(this).attr("r_warehouse");
    }).get();
    console.log($all);
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-new-controller.php",
        method: "POST",
        data: {
            date: $date,
            type: "transaction",
            trans_type: "outgoing",
            cash: $("#cash").val(),
            reciept_no: $("#reciept").val(),
            courier: $courier,
            payment: $payment,
            customer: $customer,
            address: $address,
            contact_no: $contact_no,
            paid: $paid,
            discount: $("#discount").val(),
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
                $("#total_amount").val(0);
                $("#discount").val(0);
                $(".submit-transaction").slideUp();
                $("#trans-message").fadeTo(3000, 500).slideUp(500, function() {}).text(data["message"]).attr('class', 'alert-' + data['status']).addClass('alert');
            } else {

            }
        }
    });
}
$(".submit-transaction").click(function() {
    if ($("#courier").val() != "" && $("#customer-name").val() != "" && $('#delivery').is(':checked')) {
        send_transaction($("#courier").val(), $("#payment").val(), $("#customer-name").val(), $("#customer-address").val(), $("#customer-contact").val());
    } else if (!$('#delivery').is(':checked')) {
        send_transaction("counter", "over the counter", "none", "none", "none");
    } else if ($("#courier").val() == "") {
        alert("Please Enter The Courier Name");
        $("#courier").focus();
    } else if ($("#customer-name").val() == "") {
        alert("Please Enter The Customer Details");
        $("#customer-name").focus();
    } else if ($("#customer-address").val() == "") {
        alert("Please Enter The Customer Address");
        $("#customer-address").focus();
    } else if ($("#customer-contact").val() == "") {
        alert("Please Enter The Customer Contact Number");
        $("#customer-contact").focus();
    }
});
$(document).on("click", ".remove-item", function() {
    $btn = $(this);
    $btn.prop('disabled', true);
    var r_store = $(this).attr("r_store");
    var r_warehouse = $(this).attr("r_warehouse");
    $(".submit-transaction").prop('disabled', true);
    $("#count_input_" + $btn.attr("item_id")).addClass("d-flex");
    $("#stock_" + $btn.attr("item_id")).removeClass("is-invalid");
    $("#stock_" + $btn.attr("item_id")).addClass("border-success");
    $("#count_input_" + $btn.attr("item_id")).fadeIn();
    $("#stock_" + $(this).attr("item_id")).val(math.sum($("#stock_" + $(this).attr("item_id")).val(), r_store));
    $("#stock_warehouse_" + $(this).attr("item_id")).val(math.sum($("#stock_warehouse_" + $(this).attr("item_id")).val(), r_warehouse));
    var elem = $(this).parent().parent();
    elem.slideUp("normal", function() {
        $(this).remove();
        $(".submit-transaction").prop('disabled', false);
        if($('#delivery').is(':checked') && parseInt($("#total_items").text()) == 0){
            $(".submit-transaction").slideDown();
        }
    });
    $counter--;
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text($counter);
    calculate();
});
$("#payment").on("change", function(){
    if($(this).val() == "cash"){
        $("#cash").prop("readonly", false);
        $("#show_change").slideDown(500);
    }else{
        $("#cash").prop("readonly", true);
        $("#show_change").slideUp(500);
    }
});
$(document).ready(function() {
    $("#delivery").click(function() {
        if ($(this).is(':checked')) {
            $("#courier").slideDown(500);
            $("#payment").slideDown(500);
            $("#customer-name").slideDown(500);
            $("#customer-address").slideDown(500);
            $("#customer-contact").slideDown(500);
            if($("#payment").val() != "cash"){
                $("#cash").prop("readonly", true);
                $("#cash").val(0);
                $("#show_change").slideUp(500);
            }
            calculate();
        } else {
            $("#courier").slideUp(500);
            $("#payment").slideUp(500);
            $("#customer-name").slideUp(500);
            $("#customer-address").slideUp(500);
            $("#customer-contact").slideUp(500);
            $("#cash").prop("readonly", false);
            $("#show_change").slideDown(500);
        }
    });
});