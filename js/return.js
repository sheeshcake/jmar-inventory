var $t;
var $replace;
var $id;
var verified = false;

$(document).ready(function() {
    $t = $('#example').DataTable();
});
$(document).on('hidden.bs.modal', '#transmodal', function() {
    $.ajax({
        url: url(window.location.href) + "/controller/get-transactions.php",
        method: "GET",
        success: function(d) {
            $("#data-trans").html(d);
            $t = $('#example').DataTable();
        }
    });
    $('#dialog').dialog('close');
});
function open_data(d, btn){
    $id = btn.val();
    var data = d;
    var $total = 0;
    $(".modal-body").html("");
    $("#transmodalLabel").text("Transaction: " + data[0].transaction_id + "/ Reciept No.:" + data[0].reciept_no);
    $(".modal-body").append(
        "<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>" +
        "<p><b>Payment:&nbsp;</b>" + data[0].payment + "</b></p>" +
        "<p><b>Customer Name:&nbsp;</b>" + data[0].customer + "</b></p>" +
        "<p><b>Customer Address:&nbsp;</b>" + data[0].address + "</b></p>" +
        "<p><b>Customer Contact Number:&nbsp;</b>" + data[0].contact_no + "</b></p>" 
    );
    for(var i = 1; i < data.length; i++){
        console.log(data[i]);
        $(".modal-body").append(
            '<div class="card p-2 mb-2">' +
            '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + data[i].purchased_id + '">' +
            '</div>' +
            '<div class="d-flex mb-2">' +
            '<img width="100" style="max-heigth: 100px" src="img/item/' + data[i].item_img + '" alt="">' +
            '<div class="p-2">' +
            '<p><b>Name:&nbsp;</b>' + data[i].item_name + '</p>' +
            '<p><b>Brand:&nbsp;</b>' + data[i].item_brand + '</p>' +
            '<p><b>' + data[i].item_unit_package + ':&nbsp;</b>' + data[i].item_count + '</p>' +
            '<p><b>Store:&nbsp;</b><b id="item_count_store_' + data[i].item_id + '">' + data[i].item_on_store + '</b>' + data[i]["item_unit_package"] + '</p>' +
            '<p><b>Warehouse:&nbsp;</b><b id="item_count_warehouse_' + data[i].item_id + '">' + data[i].item_on_warehouse + '</b>' + data[i]["item_unit"] + '</p>' +
            '<p><b>Price:&nbsp;</b>' + formatter(data[i].item_price) + '</p>' +
            '<p><b>Total:&nbsp;</b>' + formatter(data[i].item_price * data[i].item_count) + '</p>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex mb-2">' +
            '<input class="form-control m-2 void-count" id="input_data_' + data[i].item_id + '" type="number" item_count="' + data[i].item_count + '" />' +
            '<select class="custom-select m-2 location_select"/>' +
            '<option value="store">Store</option>' +
            '<option value="warehouse">Warehouse</option>' +
            '</select>' +
            '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + data[i].item_id + '" purchased_void_id="' + data[i].purchased_id + '" location="store">Void</button>' +
            '<div class="form-check m-2">' +
            '</div>' +
            '</div> ' +
            '</div> '
        );
        $total = math.add(parseFloat($total) , parseFloat(data[i].item_price * data[i].item_count)).toFixed(2);
    }
    var all_total = 0;
    var discount = "";
    if(data[0].discount_type == "percent"){
        all_total = ($total - ($total * data[0].discount / 100)).toFixed(2);
        discount = data[0].discount + "%";
    }else{
        all_total = ($total - data[0].discount).toFixed(2);
        discount = "₱" + data[0].discount;
    }
    $(".modal-body").append(
        "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
        "<p><b>Discount:&nbsp;</b><b class='float-right'>" + discount + "</b></p>" +
        "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + all_total + "</b></p>" +
        "<p><b>Cash:&nbsp;</b><b class='float-right'>₱" + data[0].cash + "</b></p>" +
        "<hr class='sidebar-divider'>"
    );
    if(data[0].paid == "false"){
        $(".modal-body").append(
            '<div class="d-flex">' +
            '<input class="form-control m-2" id="amount_' + data[0].transaction_id + '" type="number" value="0" />' +
            '<button class="btn btn-primary paid" transaction_id="' + data[0].transaction_id + '">Paid</button>' +
            '</div>'
        );
    }else{
        $(".modal-body").append("<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - all_total).toFixed(2) + "</b></p>");
    }
}
$(document).on("click", ".open", function() {
    $replace = false;
    $btn = $(this);
    $.ajax({
        url: url(window.location.href) + "/controller/return-controller.php",
        method: "POST",
        data: {
            id: $btn.val(),
            type: "open"
        },
        success: function(d) {
            open_data(JSON.parse(d), $btn);
        }
    });
});
$(document).on("click", ".paid", function() {
    var id = $(this).attr("transaction_id");
    $btn = $(this);
    var value = $(this).prev().val();
    $.ajax({
        url: url(window.location.href) + "/controller/payment-controller.php",
        method: "POST",
        data: {
            id: id,
            value: value
        },
        success: function(d){
            $b = $btn;
            $.ajax({
                url: url(window.location.href) + "/controller/return-controller.php",
                method: "POST",
                data: {
                    id: id,
                    type: "open"
                },
                success: function(d) {
                    open_data(JSON.parse(d), $btn);
                }
            });
            alert(d);
        }
    });
});
$(document).on("input", ".void-count", function() {
    var count = $(this).val();
    var loc = $(this).next().val();
    var id = $(this).next().next().val();
    if (parseInt(count) < 0) {
        $(this).val(0);
    }else if(parseInt(count) > parseInt($("#item_count_" + loc + "_" + id).text())){
        $(this).val($("#item_count_" + loc + "_" + id).text());
    }
});
$(document).on("change", ".form-check-input", function() {
    $replace == false ? $replace = true : $replace = false;
});
var $button;
var type;
function verify(btn, t){
    $button = btn;
    type = t;
    $( "#dialog" ).dialog();
    $(".ui-button").text("x");
}
function void_item($btn){
    var $item_id = $btn.val();
    var $purchased_id = $btn.attr("purchased_void_id");
    var $void_count = $("#transmodal").find("#input_data_" + $btn.val()).val();
    var $location = $btn.attr("location");
    $.ajax({
        url: url(window.location.href) + "/controller/cc-controller.php",
        method: "POST",
        data: {
            submit: type,
            purchased_id: $purchased_id,
            item_id: $item_id,
            location: $location,
            item_count: $void_count
        },
        success: function(d) {
            var data = JSON.parse(d);
            $btn.parent().prev().prev().html(data.message);
            $btn.parent().prev().prev().attr('class', 'alert alert-' + data.status);
            $btn.parent().prev().prev().fadeTo(3000, 500).slideUp(500, function() {
                $(".modal-body").html("");
                $.ajax({
                    url: url(window.location.href) + "/controller/return-controller.php",
                    method: "POST",
                    data: {
                        id: $id,
                        type: "open"
                    },
                    success: function(d) {
                        open_data(JSON.parse(d), $btn);
                    }
                });
            });
        }
    });
}
function rep_damage($btn){
    var $btn = $btn;
    var $item_id = $btn.val();
    $purchased_id = $btn.attr("purchased_damage_id");
    var $damaged_count = $("#transmodal").find("#input_data_" + $btn.val()).val();
    $.ajax({
        url: url(window.location.href) + "/controller/cc-controller.php",
        method: "POST",
        data: {
            submit: type,
            purchased_id: $purchased_id,
            item_id: $item_id,
            item_count: $damaged_count,
            replace: $replace
        },
        success: function(d) {
            var data = JSON.parse(d);
            $btn.parent().prev().prev().html(data.message);
            $btn.parent().prev().prev().attr('class', 'alert alert-' + data.status);
            $btn.parent().prev().prev().fadeTo(3000, 500).slideUp(500, function() {
                $(".modal-body").html("");
                $.ajax({
                    url: url(window.location.href) + "/controller/return-controller.php",
                    method: "POST",
                    data: {
                        id: $id,
                        type: "open"
                    },
                    success: function(d) {
                        open_data(JSON.parse(d), $btn);
                    }
                });
            });
        }
    });
}
function success(d){
    var $btn = $button;
    var result = d == "true";
    console.log($("#transmodal").find("#input_data_" + $btn.val()).val());
    if(result){
        if ($("#transmodal").find("#input_data_" + $btn.val()).val() == "") {
            $("#transmodal").find("#input_data_" + $btn.val()).focus();
        } else if(type == "void"){
            void_item($btn);
            $('#dialog').dialog('close');
            $("#admin_pass")[0].reset();
        }else {
            rep_damage($btn);
            $('#dialog').dialog('close');
            $("#admin_pass")[0].reset();
        }
    }else{
        alert("Wrong Admin Password!");
        $('#dialog').dialog('close');
        $("#admin_pass")[0].reset();
    }
}
$("#admin_pass").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        url: url(window.location.href) + "/controller/verify-void.php",
        method: "POST",
        data: $('#admin_pass').serialize() + "&submit=submit",
        success: function(d){
            success(d);
        }
    });
});
var $purchased_id;
$(document).on("click", ".void", function() {
    var $btn = $(this);
    verify($btn, "void");
});
$(document).on("click", ".damage", function() {
    var $btn = $(this);
    verify($btn, "damage");
});

$(document).on("change", ".location_select", function(){
    var value = $(this).val();
    console.log(value);
    $(this).next().attr("location", value);
    $(this).next().next().attr("location", value);
});