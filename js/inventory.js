$(document).on("click", ".odd, .even", function() {
    // Add this later
    var item_data;
    // $.ajax({
    //     url: url(window.location.href) + "/api/page-controller.php",
    //     method: "POST",
    //     data: {
    //         "id": $(this).children().first().text()
    //     },
    //     success: function(data) {
    //         item_data = JSON.parse(data);
    //     }
    // });
    // var $new = $('.item-data');
    // $new.attr("colspan", "6");
    // $(this).after($new);
    // $new.show('slow');
    var el = $("<td class='item-data' colspan='6' style='display: none'></td>");
    $(this).after(el);
    el.show("slow");
});
$(function() {

    //     $('a.toggle-vis').on( 'click', function (e) {
    //         e.preventDefault();
    //         // Get the column API object
    //         var column = table.column( $(this).attr('data-column') );
    //         // Toggle the visibility
    //         column.visible( ! column.visible() );
    //     } );
    var table = $('#example').DataTable({
            responsive: true,
            "dom": '<"toolbar">frtip'
        }),
        options = ['option1', 'option2', 'option3', 'option4', 'option5', 'option6'];

    $("div.toolbar").append($('#stock-filter'));

    $('.dropdown-menu a').on('click', function(event) {
        var $target = $(event.currentTarget),
            val = $target.attr('data-value'),
            col = table.column($target.attr('data-column')),
            $inp = $target.find('input'),
            idx;
        console.log(options.indexOf(val))
        if ((idx = options.indexOf(val)) > -1) {
            options.splice(idx, 1);
            setTimeout(function() {
                $inp.prop('checked', false)
            }, 0);
        } else {
            options.push(val);
            setTimeout(function() {
                $inp.prop('checked', true)
            }, 0);
        }
        col.visible(!col.visible());
        $(event.target).blur();
        console.log(options);
        return false;
    });
});