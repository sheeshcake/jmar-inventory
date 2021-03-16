var $t;
$(document).ready(function() { $t = $("#example").DataTable(), $("#example_wrapper").css("width", "100%") }), $(".min").click(function() {
    var e = $(this).text(),
        t = $(this).val(),
        r = $(this).prev().val(),
        a = $(this);
    $.ajax({ url: url(window.location.href) + "/controller/transaction-controller.php", method: "POST", data: { submit: "submit", type: e, id: t, num: r }, success: function(e) { var t = JSON.parse(e); "danger" == t.status ? (a.prev().prev().prev().val("Out Of Stock"), a.hide(), a.prev().hide(), a.prev().prev().hide()) : 0 == t.stock ? (a.prev().prev().prev().val("Out Of Stock").addClass("is-invalid"), a.hide(), a.prev().hide(), a.prev().prev().hide()) : (a.prev().val(1), a.prev().prev().prev().val(t.stock)), a.parent().next().next().removeClass().addClass("alert alert-" + t.status), a.parent().next().next().html(t.message), a.parent().next().next().fadeTo(3e3, 500).slideUp(500, function() { a.prev().prev().prev().removeClass("border-success") }) } })
});