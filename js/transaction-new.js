var $t;
var $last_data;
var $id;
var $reciept_no;
var $counter = 0;
var $max = 0;
var $removed_to_warehouse = 0;
var $removed_to_store = 0;

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
    }
}

$(document).on("input", "#cash, #discount", function() {
    calculate();
});
$(document).on("change", ".unit-select", function(){
    $id = $(this).next().val();
    if($(this).val() != "1"){
        $warehouse_total = $("#stock_warehouse_" + $id).val();
        $store_total = math.divide($("#stock_" + $id).val(), $(this).val());
        $max = math.add($warehouse_total, $store_total);
        $(this).prev().attr("max", $max.toFixed(2));
    }else{
        $warehouse_total = math.multiply($(this).next().attr("unit_divisor") , $("#stock_warehouse_" + $id).val());
        $store_total = $("#stock_" + $id).val();
        $max = math.add($warehouse_total , $store_total);
        $(this).prev().attr("max", $max.toFixed(2));
    }

});

function update_stock_on_add($btn){
    var $id = $btn.val();
    var $count = $btn.prev().prev();
    var $item_unit = $btn.prev();
    var ware_house = 0;
    var store = 0;
    if(parseInt($count.attr("max")) >= parseInt($count.val()) && 0 < parseInt($count.val())){
        if($btn.attr("unit_divisor") == "1"){
            store = math.subtract($("#stock_" + $id).val(), $count.val());
            if(store < 0){
                console.log(store);
                ware_house = math.subtract($("#stock_warehouse_" + $id).val(), math.abs(store));
                $removed_to_store = $("#stock_" + $id).val();
                $removed_to_warehouse = math.subtract($("#stock_warehouse_" + $id).val(), ware_house);
                store = 0;
            }else if(store == 0){
                $removed_to_store = $count.val();
                ware_house = $("#stock_warehouse_" + $id).val();
                $removed_to_warehouse = 0;
            }else{
                $removed_to_store = $count.val();
                ware_house = $("#stock_warehouse_" + $id).val();
                $removed_to_warehouse = 0;
            }
            $("#stock_warehouse_" + $id).val(ware_house);
            $("#stock_" + $id).val(store);
        }else{
            if(parseInt($item_unit.val()) != 1){
                ware_house = math.subtract($("#stock_warehouse_" + $id).val(), math.floor($count.val()));
                if(math.subtract($("#stock_warehouse_" + $id).val(), $count.val()) < 0){
                    store = math.subtract($("#stock_" + $id).val(), math.multiply($item_unit.val(), math.abs(math.subtract($("#stock_warehouse_" + $id).val(), $count.val()))));
                    ware_house = 0;
                    $removed_to_warehouse = $("#stock_warehouse_" + $id).val();
                    $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                }else if(ware_house == 0){
                    store = $("#stock_" + $id).val();
                    $removed_to_warehouse = $("#stock_warehouse_" + $id).val();
                    $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                }else{
                    var x1 = math.subtract($("#stock_warehouse_" + $id).val(), $count.val());
                    var x2 = math.subtract(math.subtract($("#stock_warehouse_" + $id).val(), $count.val()), math.floor(x1));
                    if(x2 > 0 && x1 < 0){
                        store = math.subtract($("#stock_" + $id).val(), math.multiply(x1, $btn.attr("unit_divisor")));
                        $removed_to_warehouse = ware_house;
                        $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                        
                    }else if(x1 > 0){
                        $removed_to_warehouse = math.subtract($("#stock_warehouse_" + $id).val() ,ware_house);
                        $removed_to_store = 0;
                        store = $("#stock_" + $id).val();
                    }else{
                        store = math.subtract($("#stock_" + $id).val(), math.mod($count.val(), ware_house));
                        $removed_to_warehouse = ware_house;
                        $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                    }
                }
                $("#stock_warehouse_" + $id).val(ware_house);
                $("#stock_" + $id).val(store);
            }else{
                if(parseInt($("#stock_" + $id).val()) < parseInt($count.val())){
                    store = math.subtract($("#stock_" + $id).val(),math.subtract($count.val(), $btn.attr("unit_divisor")));
                    ware_house = math.subtract($("#stock_warehouse_" + $id).val(), math.floor(math.divide($count.val(), $btn.attr("unit_divisor"))));
                    $("#stock_warehouse_" + $id).val(ware_house);
                    $removed_to_warehouse = math.floor(math.divide($count.val(), $btn.attr("unit_divisor")));
                    $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                }else{
                    store = math.subtract($("#stock_" + $id).val(), $count.val());
                    $removed_to_warehouse = 0;
                    $removed_to_store = math.subtract($("#stock_" + $id).val(), store);
                }
                $("#stock_" + $id).val(store);
            }
        }
        return true;
    }else if(parseInt($count.val()) < 0){
        $("#item_" + $id).val($count.attr("min"));
        $("#item_" + $id).focus().addClass("border-danger");
        $btn.parent().next().text("Input is Invalid");
        $btn.parent().next().attr('class', 'alert-danger').addClass('alert');
        $btn.parent().next().fadeTo(3000, 500).slideUp(500, function() {});
        return false;
    }else {
        $("#item_" + $id).val($count.attr("max"));
        $("#item_" + $id).focus().addClass("border-danger");
        $btn.parent().next().text("Requested Item Exeeded!");
        $btn.parent().next().attr('class', 'alert-danger').addClass('alert');
        $btn.parent().next().fadeTo(3000, 500).slideUp(500, function() {});
        return false;
    }

}


$(document).on("click", ".add", function() {
    if(update_stock_on_add($(this))){
        $counter++;
        var $id = $(this).val();
        var $count = $(this).prev().prev();
        var $item_unit = $(this).prev();
        var $total_count = $item_unit.prop("options")[$item_unit.prop("options").selectedIndex]["value"] * $count.val();
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
                    '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" r_store="' + $removed_to_store + '" r_warehouse="' + $removed_to_warehouse  +'">x</button>' +
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
                calculate();
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

function send_transaction(courier, payment, customer) {
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
            reciept_no: $("#reciept").val(),
            courier: $courier,
            payment: $payment,
            customer: $customer,
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
    if ($("#courier").val() != "" && $("#customer").val() != "" && $('#delivery').is(':checked')) {
        send_transaction($("#courier").val(), $("#payment").val(), $("#customer").val());
    } else if (!$('#delivery').is(':checked')) {
        send_transaction("counter", "none", "none");
    } else if ($("#courier").val() == "") {
        alert("Please Enter The Courier Name");
        $("#courier").focus();
    } else if ($("#customer").val() == "") {
        alert("Please Enter The Customer Details");
        $("#customer").focus();
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
    });
    $counter--;
    $("#total").text((parseFloat($("#total").text()) - parseFloat(elem.attr("price"))).toFixed(2));
    $("#total_items").text($counter);
    calculate();
});

$(document).ready(function() {
    $("#delivery").click(function() {
        if ($(this).is(':checked')) {
            $("#courier").slideDown(500);
            $("#payment").slideDown(500);
            $("#customer-name").slideDown(500);
            $("#customer-address").slideDown(500);
            $("#customer-contact").slideDown(500);


        } else {
            $("#courier").slideUp(500);
            $("#payment").slideUp(500);
            $("#customer-name").slideUp(500);
            $("#customer-address").slideUp(500);
            $("#customer-contact").slideUp(500);
        }
    });
});
// $(document).on("change", ".unit-select", function() {
//     $(this).prev().attr("max", $(this).val());
// });