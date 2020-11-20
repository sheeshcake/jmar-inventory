//Dri sha na bug


$(document).on("click", ".cat-del", function() {
    var $row_data = $t.row($(this).parents('tr')).data();
    $(document).find(".cat:contains('" + $row_data[1] + "')").remove();
    $.ajax({
        url: url(window.location.href) + "/controller/delete-category.php",
        method: "POST",
        data: {
            submit: "submit",
            id: $row_data[0]
        },
        success: function(d) {
            var data = JSON.parse(d);
            $("#cat-alert").html(
                '<div class="m-alert alert alert-' + data.status + ' role="alert" style="display:none">' +
                data.message +
                '</div>'
            );
            $(".m-alert").show(500);
        }
    });
    $t.row($(this).parents('tr')).remove().draw();
});

// $(document).on("click", ".cat-up", function() {
//     var $row_data = $t.row($(this).parents('tr')).data();
//     $(document).find(".cat:contains('" + $row_data[1] + "')").text();
//     $.ajax({
//         url: url(window.location.href) + "/controller/delete-category.php",
//         method: "POST",
//         data: {
//             submit: "submit",
//             id: $row_data[0]
//         },
//         success: function(d) {
//             var data = JSON.parse(d);
//             $("#cat-alert").html(
//                 '<div class="m-alert alert alert-' + data.status + ' role="alert" style="display:none">' +
//                 data.message +
//                 '</div>'
//             );
//             $(".m-alert").show(500);
//         }
//     });
// });