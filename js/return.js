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
        var $unit = "";
        var $item_count = 0;
        var $item_price = 0;
        var $location = "";
        if(parseInt(data[i].item_on_store) > 0){
            $unit = data[i].item_unit_package;
            $item_count = data[i].item_on_store;
            $item_price = data[i].item_price;
            $location = "store";
        }else{
            $unit = data[i].item_unit;
            $item_count = data[i].item_on_warehouse;
            $item_price = math.multiply(data[i].item_price, data[i].item_unit_divisor);
            $location = "warehouse";
        }
        $(".modal-body").append(
            '<div class="card p-2 mb-2">' +
            '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + data[i].purchased_id + '">' +
            '</div>' +
            '<div class="d-flex mb-2">' +
            '<img width="100" style="max-heigth: 100px" src="img/item/' + data[i].item_img + '" alt="">' +
            '<div class="p-2">' +
            '<p><b>Name:&nbsp;</b>' + data[i].item_name + '</p>' +
            '<p><b>Brand:&nbsp;</b>' + data[i].item_brand + '</p>' +
            '<p id="item_count_' + data[i].purchased_id + '"><b>' + $unit + ':&nbsp;</b>' + $item_count + '</p>' +
            '<p><b>Price:&nbsp;</b>' + formatter($item_price) + '</p>' +
            '<p><b>Total:&nbsp;</b>' + formatter($item_price * $item_count) + '</p>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex mb-2">' +
            '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + $item_count + '" />' +
            '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + data[i].item_id + '" purchased_void_id="' + data[i].purchased_id + '" location="' + $location + '">Void</button>' +
            '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + data[i].item_id + '" purchased_damage_id="' + data[i].purchased_id + '">Damage</button>' +
            '<div class="form-check m-2">' +
            '</div>' +
            '</div> ' +
            '</div> '
        );
        $total = (parseFloat($total) + parseFloat($item_price * $item_count)).toFixed(2);
    }
    $(".modal-body").append(
        "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
        "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
        "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
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
        $(".modal-body").append("<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>");
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
    var count = $(this).attr("item_count");
    var void_count = $(this).val();
    var diff = count - void_count;
    if (diff < 0) {
        $(this).val(count);
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
    var $void_count = $btn.prev().val();
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
                        console.log(d);
                        var data = JSON.parse(d);
                        var $total = 0;
                        $(".modal-body").html("");
                        $(".modal-body").append("<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>");
                        for(var i = 1; i < data.length; i++){
                            console.log(data[i]);
                            var $unit = "";
                            var $item_count = 0;
                            var $item_price = 0;
                            if(parseInt(data[i].item_on_store) > 0){
                                $unit = data[i].item_unit_package;
                                $item_count = data[i].item_on_store;
                                $item_price = data[i].item_price;
                            }else{
                                $unit = data[i].item_unit;
                                $item_count = data[i].item_on_warehouse;
                                $item_price = math.multiply(data[i].item_price, data[i].item_unit_divisor);
                            }
                            $("#transmodalLabel").text("Transaction: " + data[i].transaction_id);
                            $(".modal-body").append(
                                '<div class="card p-2 mb-2">' +
                                '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + data[i].purchased_id + '">' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<img width="100" style="max-heigth: 100px" src="img/item/' + data[i].item_img + '" alt="">' +
                                '<div class="p-2">' +
                                '<p><b>Name:&nbsp;</b>' + data[i].item_name + '</p>' +
                                '<p><b>Brand:&nbsp;</b>' + data[i].item_brand + '</p>' +
                                '<p id="item_count_' + data[i].purchased_id + '"><b>' + $unit + ':&nbsp;</b>' + $item_count + '</p>' +
                                '<p><b>Price:&nbsp;</b>' + formatter($item_price) + '</p>' +
                                '<p><b>Total:&nbsp;</b>' + formatter($item_price * $item_count) + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + $item_count + '" />' +
                                '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + data[i].item_id + '" purchased_void_id="' + data[i].purchased_id + '">Void</button>' +
                                '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + data[i].item_id + '" purchased_damage_id="' + data[i].purchased_id + '">Damage</button>' +
                                '<div class="form-check m-2">' +
                                '</div>' +
                                '</div> ' +
                                '</div> '
                            );
                            $total = (parseFloat($total) + parseFloat($item_price * $item_count)).toFixed(2);
                        }
                        $(".modal-body").append(
                            "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
                            "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
                            "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
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
                            $(".modal-body").append("<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>");
                        }
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
    var $damaged_count = $btn.prev().prev().val();
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
                        console.log(d);
                        var data = JSON.parse(d);
                        var $total = 0;
                        $(".modal-body").html("");
                        $(".modal-body").append("<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>");
                        for(var i = 1; i < data.length; i++){
                            console.log(data[i]);
                            var $unit = "";
                            var $item_count = 0;
                            var $item_price = 0;
                            if(parseInt(data[i].item_on_store) > 0){
                                $unit = data[i].item_unit_package;
                                $item_count = data[i].item_on_store;
                                $item_price = data[i].item_price;
                            }else{
                                $unit = data[i].item_unit;
                                $item_count = data[i].item_on_warehouse;
                                $item_price = math.multiply(data[i].item_price, data[i].item_unit_divisor);
                            }
                            $("#transmodalLabel").text("Transaction: " + data[i].transaction_id);
                            $(".modal-body").append(
                                '<div class="card p-2 mb-2">' +
                                '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + data[i].purchased_id + '">' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<img width="100" style="max-heigth: 100px" src="img/item/' + data[i].item_img + '" alt="">' +
                                '<div class="p-2">' +
                                '<p><b>Name:&nbsp;</b>' + data[i].item_name + '</p>' +
                                '<p><b>Brand:&nbsp;</b>' + data[i].item_brand + '</p>' +
                                '<p id="item_count_' + data[i].purchased_id + '"><b>' + $unit + ':&nbsp;</b>' + $item_count + '</p>' +
                                '<p><b>Price:&nbsp;</b>' + formatter($item_price) + '</p>' +
                                '<p><b>Total:&nbsp;</b>' + formatter($item_price * $item_count) + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + $item_count + '" />' +
                                '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + data[i].item_id + '" purchased_void_id="' + data[i].purchased_id + '">Void</button>' +
                                '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + data[i].item_id + '" purchased_damage_id="' + data[i].purchased_id + '">Damage</button>' +
                                '<div class="form-check m-2">' +
                                '</div>' +
                                '</div> ' +
                                '</div> '
                            );
                            $total = (parseFloat($total) + parseFloat($item_price * $item_count)).toFixed(2);
                        }
                        $(".modal-body").append(
                            "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
                            "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
                            "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
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
                            $(".modal-body").append("<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>");
                        }
                    }
                });
            });
        }
    });
}
function success(d){
    var $btn = $button;
    var result = d == "true";
    if(result){
        if ($btn.prev().prev().val() == "") {
            $btn.prev().prev().focus();
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