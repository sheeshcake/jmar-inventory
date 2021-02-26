var $t;
var $replace;
var $id;
var verified = false;

$(document).ready(function() {
    $t = $('#example').DataTable();
});
$(document).on('hidden.bs.modal', '#transmodal', function() {
    $('#dialog').dialog('close');
    $.ajax({
        url: url(window.location.href) + "/controller/get-transactions.php",
        method: "GET",
        success: function(d) {
            $("#data-trans").html(d);
            $t = $('#example').DataTable();
        }
    });
})
$(document).on("click", ".open", function() {
    $replace = false;
    $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/return-controller.php",
        method: "POST",
        data: {
            id: $id,
            type: "open"
        },
        success: function(d) {
            var data = JSON.parse(d);
            var $total = 0;
            $(".modal-body").html("");
            $(".modal-body").append("<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>");
            for(var i = 1; i < data.length; i++){
                console.log(data[i]);
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
                    '<p unit="' + data[i].item_unit + '" id="item_count_' + data[i].purchased_id + '"><b>' + data[i].item_unit_package + ':&nbsp;</b>' + data[i].item_count + '</p>' +
                    '<p><b>Price:&nbsp;</b>' + formatter(data[i].item_price) + '</p>' +
                    '<p><b>Total:&nbsp;</b>' + formatter(data[i].item_price * data[i].item_count) + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="d-flex mb-2">' +
                    '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + data[i].item_count + '" />' +
                    '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + data[i].item_id + '" purchased_void_id="' + data[i].purchased_id + '">Void</button>' +
                    '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + data[i].item_id + '" purchased_damage_id="' + data[i].purchased_id + '">Damage</button>' +
                    '<div class="form-check m-2">' +
                    '</div>' +
                    '</div> ' +
                    '</div> '
                );
                $total = (parseFloat($total) + parseFloat(formatter(data[i].item_price * data[i].item_count))).toFixed(2);
            }
            $(".modal-body").append(
                "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
                "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
                "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
                "<p><b>Cash:&nbsp;</b><b class='float-right'>₱" + data[0].cash + "</b></p>" +
                "<hr class='sidebar-divider'>" +
                "<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>"
            );
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
    $.ajax({
        url: url(window.location.href) + "/controller/cc-controller.php",
        method: "POST",
        data: {
            submit: type,
            purchased_id: $purchased_id,
            item_id: $item_id,
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
                        var data = JSON.parse(d);
                        console.log(d);
                        var $total = 0;
                        $(".modal-body").html("");
                        $(".modal-body").append("<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>");
                        data.forEach(function(element) {
                            if (element.item_type == "retail") {
                                var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                                var unit_count = element.item_count * 1;
                                var unit_count_str = element.item_count * 1;
                                if (element.item_unit == "Box") var item_unit = "pieces";
                                else if (element.item_unit == "Sack") var item_unit = "kilo(s)";
                                else if (element.item_unit == "Roll") var item_unit = "meter(s)";
                            } else {
                                var price = (((parseFloat(element.item_tax_wholesale) / 100) * parseFloat(element.item_price_wholesale)) + parseFloat(element.item_price_wholesale)).toFixed(2);
                                var unit_div = element.item_count / element.item_unit_divisor;
                                if (element.item_unit == "Box") var item_unit1 = "pieces";
                                else if (element.item_unit == "Sack") var item_unit1 = "kilo(s)";
                                else if (element.item_unit == "Roll") var item_unit1 = "meter(s)";
                                var unit_count_str = unit_div + " contains " + element.item_count + " " + item_unit1;
                                var unit_count = unit_div;
                                var item_unit = element.item_unit;
                                console.log(unit_div);
                            }
                            $("#transmodalLabel").text("Transaction: " + element.transaction_id);
                            $(".modal-body").append(
                                '<div class="card p-2 mb-2">' +
                                '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + element.purchased_id + '">' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<img width="100" style="max-heigth: 100px" src="img/item/' + element.item_img + '" alt="">' +
                                '<div class="p-2">' +
                                '<p><b>Name:&nbsp;</b>' + element.item_name + '</p>' +
                                '<p><b>Brand:&nbsp;</b>' + element.item_brand + '</p>' +
                                '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + item_unit + ':&nbsp;</b>' + unit_count_str + '</p>' +
                                '<p><b>Price:&nbsp;</b>' + formatter(price) + '</p>' +
                                '<p><b>Total:&nbsp;</b>' + formatter(price * unit_count) + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + element.item_count + '" />' +
                                '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_void_id="' + element.purchased_id + '">Void</button>' +
                                '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_damage_id="' + element.purchased_id + '">Damage</button>' +
                                '<div class="form-check m-2">' +
                                '</div>' +
                                '</div> ' +
                                '</div> '
                            );
                            $total = (parseFloat($total) + parseFloat(formatter(price * unit_count))).toFixed(2);
                        });
                        $(".modal-body").append(
                            "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
                            "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
                            "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
                            "<p><b>Cash:&nbsp;</b><b class='float-right'>₱" + data[0].cash + "</b></p>" +
                            "<hr class='sidebar-divider'>" +
                            "<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>"
                        );
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
                        var data = JSON.parse(d);
                        console.log(d);
                        var $total = 0;
                        $(".modal-body").html("");
                        $(".modal-body").append("<p><b>Courier:&nbsp;</b>" + data[0].courier + "</b></p>");
                        data.forEach(function(element) {
                            if (element.item_type == "retail") {
                                var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                                var unit_count = element.item_count * 1;
                                var unit_count_str = element.item_count * 1;
                                if (element.item_unit == "Box") var item_unit = "pieces";
                                else if (element.item_unit == "Sack") var item_unit = "kilo(s)";
                                else if (element.item_unit == "Roll") var item_unit = "meter(s)";
                            } else {
                                var price = (((parseFloat(element.item_tax_wholesale) / 100) * parseFloat(element.item_price_wholesale)) + parseFloat(element.item_price_wholesale)).toFixed(2);
                                var unit_div = element.item_count / element.item_unit_divisor;
                                if (element.item_unit == "Box") var item_unit1 = "pieces";
                                else if (element.item_unit == "Sack") var item_unit1 = "kilo(s)";
                                else if (element.item_unit == "Roll") var item_unit1 = "meter(s)";
                                var unit_count_str = unit_div + " contains " + element.item_count + " " + item_unit1;
                                var unit_count = unit_div;
                                var item_unit = element.item_unit;
                                console.log(unit_div);
                            }
                            $("#transmodalLabel").text("Transaction: " + element.transaction_id);
                            $(".modal-body").append(
                                '<div class="card p-2 mb-2">' +
                                '<div class="alert alert-success" style="display: none" role="alert" id="alert_' + element.purchased_id + '">' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<img width="100" style="max-heigth: 100px" src="img/item/' + element.item_img + '" alt="">' +
                                '<div class="p-2">' +
                                '<p><b>Name:&nbsp;</b>' + element.item_name + '</p>' +
                                '<p><b>Brand:&nbsp;</b>' + element.item_brand + '</p>' +
                                '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + item_unit + ':&nbsp;</b>' + unit_count_str + '</p>' +
                                '<p><b>Price:&nbsp;</b>' + formatter(price) + '</p>' +
                                '<p><b>Total:&nbsp;</b>' + formatter(price * unit_count) + '</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex mb-2">' +
                                '<input class="form-control m-2 void-count" type="number" value="0" item_count="' + element.item_count + '" />' +
                                '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_void_id="' + element.purchased_id + '">Void</button>' +
                                '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_damage_id="' + element.purchased_id + '">Damage</button>' +
                                '<div class="form-check m-2">' +
                                '</div>' +
                                '</div> ' +
                                '</div> '
                            );
                            $total = (parseFloat($total) + parseFloat(formatter(price * unit_count))).toFixed(2);
                        });
                        $(".modal-body").append(
                            "<p><b>Sub Total:&nbsp;</b><b class='float-right'>₱" + $total + "</b></p>" +
                            "<p><b>Discount:&nbsp;</b><b class='float-right'>" + data[0].discount + "%</b></p>" +
                            "<p><b>Total:&nbsp;</b><b class='float-right'>₱" + ($total - ($total * data[0].discount / 100)).toFixed(2) + "</b></p>" +
                            "<p><b>Cash:&nbsp;</b><b class='float-right'>₱" + data[0].cash + "</b></p>" +
                            "<hr class='sidebar-divider'>" +
                            "<p><b>Change:&nbsp;</b><b class='float-right'>₱" + (parseFloat(data[0].cash) - ($total - ($total * data[0].discount / 100))).toFixed(2) + "</b></p>"
                        );
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