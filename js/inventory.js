$(document).on("click", ".open-details", function() {
    // Add this later
    var $t = $(this);
    $(".item-data").remove();
    $(".details-toggle").html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
    $(".details-toggle").addClass("open-details");
    $(".details-toggle").removeClass("close-details");
    $t.html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    $t.addClass("close-details");
    $t.removeClass("open-details");
    $.ajax({
        url: url(window.location.href) + "/includes/item-details.php",
        method: "POST",
        data: {
            "id": $(this).children().first().text()
        },
        success: function(data) {
            var el = $(data);
            $t.parent().children(".child").hide();
            $t.parent().parent().after(el);
            el.show("slow");
        }
    });
});

$(document).on("click", ".close-details", function() {
    $(".item-data").remove();
    $(this).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
    $(this).addClass("open-details");
    $(this).removeClass("close-details");
});
$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 4, targets: 3 }
        ]
    });
    $("div.toolbar").append($('#stock-filter'));
});
$(document).on("click", ".delete", function() {

});
$(document).on("click", ".update", function() {

});