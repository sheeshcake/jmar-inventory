$(document).on("click", ".cat-del", function() {
    var t = $t.row($(this).parents("tr")).data();
    $(document).find(".cat:contains('" + t[1] + "')").remove(), $.ajax({
        url: url(window.location.href) + "/controller/delete-category.php",
        method: "POST",
        data: { submit: "submit", id: t[0] },
        success: function(t) {
            var e = JSON.parse(t);
            console.log(t);
            $("#cat-alert").html('<div class="m-alert alert alert-' + e.status + ' role="alert" style="display:none">' + e.message + "</div>"), $(".m-alert").show(500);
            $("#category option[value='" + e.id + "']").each(function() {
                $(this).remove();
            });
            $("#sc_" + e.id).remove();
        }
    }), $t.row($(this).parents("tr")).remove().draw()
});