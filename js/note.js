$(document).ready(function() {
    $("#notes").draggable({
        'originalLeft': $("#draggable").css('left'),
        'origionalTop': $("#draggable").css('top'),
        drag: function(event, ui) {
            $("#minimize-note").html(
                '<i class="fa fa-window-minimize" aria-hidden="true"></i>'
            );
            $(this).css({ "min-width": "200px" });
            $("#note-button").slideUp(500);
        },
        create: function(event, ui) {
            $(this).hide();
        }
    });
    $("#minimize-note").click(function() {
        $("#notes").css({
            'left': 0,
            'top': 0,
            "display": "none"
        });
        $("#note-button").slideDown(500);
    });
    $("#note-button").click(function() {
        $("#notes").show();
        $(this).slideUp(500);
    });
    $("#note-field").on("input", function() {
        $.ajax({
            url: url(window.location.href) + "/controller/note-controller.php",
            method: "POST",
            data: {
                user_id: $("#note_user_id").val(),
                note_id: $("#note_note_id").val(),
                note_data: $("#note-field").val()
            },
            success: function(d) {
                if (parseInt(d)) {
                    $("#note_note_id").val(d);
                }
            }
        })
    });
});