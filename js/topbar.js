$(document).on("click", "#logout-modal", function() {
    $("#exampleModalLabel").text("Ready to Leave? Huh");
    $("#exampleModalLabel").text('Select "Logout" below if you are ready to end your current session.');
    $(".modal-footer").html(
        '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
        '<a class="btn btn-primary" id="logout">Logout</a>'
    );
});