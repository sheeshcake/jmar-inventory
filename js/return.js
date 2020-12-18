var $t;
var $replace;
var $id;

function formatter(num) {
    var formatter = new Intl.NumberFormat({
        style: 'currency',
        currency: 'PHP',
    });
    return formatter.format(num);
}
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
            $(".modal-body").html("");
            data.forEach(function(element) {
                if (element.item_type == "retail") {
                    var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                    var unit_count = element.item_count * 1;
                    if (element.item_unit == "Box") var item_unit = "pieces";
                    else if (element.item_unit == "Sack") var item_unit = "kilo(s)";
                    else if (element.item_unit == "Roll") var item_unit = "meter(s)";
                } else {
                    var price = (((parseFloat(element.item_tax_wholesale) / 100) * parseFloat(element.item_price_wholesale)) + parseFloat(element.item_price_wholesale)).toFixed(2);
                    var unit_div = element.item_unit_divisor / element.item_count;
                    var unit_count = unit_div + " contains " + element.item_count;
                    var item_unit = element.item_unit;
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
                    '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + item_unit + ':&nbsp;</b>' + unit_count + '</p>' +
                    '<p><b>Price:&nbsp;</b>' + formatter(price) + '</p>' +
                    '<p><b>Total:&nbsp;</b>' + formatter(price * element.item_count) + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="d-flex mb-2">' +
                    '<input class="form-control m-2 void-count" type="number" item_count="' + element.item_count + '" />' +
                    '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_void_id="' + element.purchased_id + '">Void</button>' +
                    '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_damage_id="' + element.purchased_id + '">Damage</button>' +
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
$(document).on("change", ".form-check-input", function() {
    $replace == false ? $replace = true : $replace = false;
});
var $purchased_id;
$(document).on("click", ".void", function() {
    var $btn = $(this);
    if ($(this).prev().prev().val() == "") {
        $(this).prev().prev().focus();
    } else {
        var $item_id = $(this).val();
        $purchased_id = $(this).attr("purchased_void_id");
        var $void_count = $(this).prev().val();
        $.ajax({
            url: url(window.location.href) + "/controller/cc-controller.php",
            method: "POST",
            data: {
                submit: "void",
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
                            $(".modal-body").html("");
                            data.forEach(function(element) {
                                if (element.item_type == "retail") {
                                    var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                                    var unit_count = element.item_count * 1;
                                    if (element.item_unit == "Box") var item_unit = "pieces";
                                    else if (element.item_unit == "Sack") var item_unit = "kilo(s)";
                                    else if (element.item_unit == "Roll") var item_unit = "meter(s)";
                                } else {
                                    var price = (((parseFloat(element.item_tax_wholesale) / 100) * parseFloat(element.item_price_wholesale)) + parseFloat(element.item_price_wholesale)).toFixed(2);
                                    var unit_div = element.item_unit_divisor / element.item_count;
                                    var unit_count = unit_div + " contains " + element.item_count;
                                    var item_unit = element.item_unit;
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
                                    '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + item_unit + ':&nbsp;</b>' + unit_count + '</p>' +
                                    '<p><b>Price:&nbsp;</b>' + formatter(price) + '</p>' +
                                    '<p><b>Total:&nbsp;</b>' + foramtter(price * element.item_count) + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex mb-2">' +
                                    '<input class="form-control m-2 void-count" type="number" item_count="' + element.item_count + '" />' +
                                    '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_void_id="' + element.purchased_id + '">Void</button>' +
                                    '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_damage_id="' + element.purchased_id + '">Damage</button>' +
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
            }
        });
    }
});
$(document).on("click", ".damage", function() {
    if ($(this).prev().prev().val() == "") {
        $(this).prev().prev().focus();
    } else {
        var $btn = $(this);
        var $item_id = $(this).val();
        $purchased_id = $(this).attr("purchased_damage_id");
        var $damaged_count = $(this).prev().prev().val();
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
                            $(".modal-body").html("");
                            data.forEach(function(element) {
                                if (element.item_type == "retail") {
                                    var price = (((parseFloat(element.item_tax) / 100) * parseFloat(element.item_price)) + parseFloat(element.item_price)).toFixed(2);
                                    var unit_count = element.item_count * 1;
                                    if (element.item_unit == "Box") var item_unit = "pieces";
                                    else if (element.item_unit == "Sack") var item_unit = "kilo(s)";
                                    else if (element.item_unit == "Roll") var item_unit = "meter(s)";
                                } else {
                                    var price = (((parseFloat(element.item_tax_wholesale) / 100) * parseFloat(element.item_price_wholesale)) + parseFloat(element.item_price_wholesale)).toFixed(2);
                                    var unit_div = element.item_unit_divisor / element.item_count;
                                    var unit_count = unit_div + " contains " + element.item_count;
                                    var item_unit = element.item_unit;
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
                                    '<p unit="' + element.item_unit + '" id="item_count_' + element.purchased_id + '"><b>' + item_unit + ':&nbsp;</b>' + unit_count + '</p>' +
                                    '<p><b>Price:&nbsp;</b>' + formatter(price) + '</p>' +
                                    '<p><b>Total:&nbsp;</b>' + formatter(price * element.item_count) + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex mb-2">' +
                                    '<input class="form-control m-2 void-count" type="number" item_count="' + element.item_count + '" />' +
                                    '<button style="width: 100%;" class="void btn btn-warning m-2" value="' + element.item_id + '" purchased_void_id="' + element.purchased_id + '">Void</button>' +
                                    '<button style="width: 100%;" class="damage btn btn-danger m-2" value="' + element.item_id + '" purchased_damage_id="' + element.purchased_id + '">Damage</button>' +
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
            }
        });
    }
});