var $t, $last_data, $counter = 0;

function reload() { setTimeout(function() { 0 == $(".item").length && $.ajax({ url: url(window.location.href) + "/controller/incoming-get-items.php", method: "GET", success: function(t) { $last_data != t.replace(/\s/g, "") && ($last_data = t.replace(/\s/g, ""), $("#item_data").html(t), $t = $("#example").DataTable()) } }), $("#example_wrapper").css("width", "100%"), reload() }, 500) }

function AddZero(t) { return t >= 0 && t < 10 ? "0" + t : t + "" }

function formatAMPM(t) { var e = t.getHours(),
        a = t.getMinutes(),
        s = e >= 12 ? "pm" : "am"; return a = a < 10 ? "0" + a : a, AddZero(e = (e %= 12) || 12) + ":" + AddZero(a) + " " + s }
$(document).ready(function() { reload() }), $(document).on("click", ".add", function() { var t = $(this).val(),
        e = $("#item_" + t);
    $(".submit-transaction").slideDown(), $("#stock_" + t).val(parseFloat(parseFloat($("#stock_" + t).val()) - parseFloat(e.val())).toFixed(2)), $("#item_" + t).removeClass("border-danger"), $("#item_" + t).addClass("border-success"), $(this).parent().next().text("Item Added!"), $(this).parent().next().attr("class", "alert-success").addClass("alert"), $(this).parent().next().fadeTo(3e3, 500).slideUp(500, function() {}), 0 == parseFloat($("#stock_" + t).val()) && ($("#count_input_" + t).removeClass("d-flex"), $("#stock_" + t).removeClass("border-success"), $("#stock_" + t).addClass("is-invalid"), $("#count_input_" + t).fadeOut()), $counter++, $.ajax({ url: url(window.location.href) + "/controller/transaction-new-controller.php", method: "POST", data: { id: t, type: "get-item" }, success: function(a) { var s = JSON.parse(a),
                i = s.item_price,
                n = e.val(),
                o = (parseFloat(i) * parseFloat(n)).toFixed(2);
            $("#items").prepend('<div class="item card mb-1" price="' + o + '" item-id="' + t + '" item-count="' + parseFloat(e.val()).toFixed(2) + '"><div class="card-body"><div class="d-flex"><img style="max-width: 100px" src="img/item/' + s.item_img + '"><div class="ml-3"><p><b>Name:</b>&nbsp;' + s.item_name + "</p><p><b>Brand:</b>&nbsp;" + s.item_brand + "</p><p><b>Price:</b>&nbsp;₱&nbsp;" + i + "</p><p><b>" + s.item_unit + ":</b>&nbsp;" + e.val() + "</p><p><b>Sub Total:</b>&nbsp;₱&nbsp;" + o + '</p></div><button class="remove-item btn btn-danger" style="height: 40px;" item_id="' + t + '" value="' + e.val() + '">x</button><div></div></div>'), $("#total").text((parseFloat($("#total").text()) + parseFloat(i) * parseFloat(n)).toFixed(2)), $("#total_items").text($counter) } }) }), $(".submit-transaction").click(function() { $counter = 0; var t = new Date,
        e = [
            [AddZero(t.getMonth() + 1), AddZero(t.getDate()), t.getFullYear()].join("-"), formatAMPM(new Date)
        ].join(" "),
        a = $(".item").map(function() { return $(this).attr("price") + "," + $(this).attr("item-id") + "," + $(this).attr("item-count") }).get();
    $.ajax({ url: url(window.location.href) + "/controller/incoming-transaction-controller.php", method: "POST", data: { date: e, type: "transaction", trans_type: "incoming", data: a }, success: function(t) { var e = JSON.parse(t); "success" == e.status && ($(".item").map(function() { $(this).fadeTo(1e3, 500).slideUp(500, function() { $("#total").text(0), $("#total_items").text(0), $(this).remove() }) }), $(".submit-transaction").slideUp(), $("#trans-message").fadeTo(3e3, 500).slideUp(500, function() {}).text(e.message).attr("class", "alert-" + e.status).addClass("alert")) } }) }), $(document).on("click", ".remove-item", function() { $btn = $(this), $(".submit-transaction").prop("disabled", !0), $("#count_input_" + $btn.attr("item_id")).addClass("d-flex"), $("#stock_" + $btn.attr("item_id")).removeClass("is-invalid"), $("#stock_" + $btn.attr("item_id")).addClass("border-success"), $("#count_input_" + $btn.attr("item_id")).fadeIn(); var t = parseFloat($btn.val()),
        e = parseFloat($("#stock_" + $(this).attr("item_id")).val());
    $("#stock_" + $(this).attr("item_id")).val((t + e).toFixed(2)); var a = $(this).parent().parent().parent();
    a.slideUp("normal", function() { $(this).remove(), $(".submit-transaction").prop("disabled", !1), $(".item").length ? $(".submit-transaction").slideDown() : $(".submit-transaction").slideUp() }), $counter--, $("#total").text((parseFloat($("#total").text()) - parseFloat(a.attr("price"))).toFixed(2)), $("#total_items").text($counter) });