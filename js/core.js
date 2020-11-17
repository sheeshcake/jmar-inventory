function url(the_url) {
    var the_arr = the_url.split('/');
    the_arr.pop();
    return (the_arr.join('/'));
}

function getData(div) {
    var inputValues = $(div + ' :input').map(function() {
        var type = $(this).prop("type");

        // checked radios/checkboxes
        if ((type == "checkbox" || type == "radio") && this.checked) {
            return $(this).val();
        }
        // all other fields, except buttons
        else if (type != "button" && type != "submit") {
            return $(this).val();
        }
    })
    return inputValues.join(',');
}
$(document).on("click", "#logout", function() {
    window.location.href = url(window.location.href) + "/controller/logout-controller.php";
});

$(document).on("click", "#logout-modal", function() {
    $("#exampleModalLabel").text("Ready to Leave?");
    $(".modal-label").text('Select "Logout" below if you are ready to end your current session.');
    $(".modal-footer").html(
        '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
        '<a class="btn btn-primary" id="logout">Logout</a>'
    );
});
$(document).ready(function() {
    $("#cat-table").DataTable();
});

// $(document).ready(function() {
//     // localStorage.setItem("user", 1);
//     if (localStorage.getItem("user") === null) {
//         $.ajax({
//             url: url(window.location.href) + "/includes/login.php",
//             method: "GET",
//             success: function(data) {
//                 $("#main-content").html(data);
//             },
//             error: function(xhr, textStatus, errorThrown) {
//                 if (textStatus == 'timeout') {
//                     this.tryCount++;
//                     if (this.tryCount <= this.retryLimit) {
//                         //try again
//                         $.ajax(this);
//                         return;
//                     }
//                     return;
//                 }
//                 if (xhr.status == 500) {
//                     //handle error
//                 } else {
//                     //handle error
//                 }
//             }
//         });
//     } else {
//         $.ajax({
//             url: url(window.location.href) + "/includes/home.php",
//             method: "GET",
//             success: function(data) {
//                 $("#main-content").html(data);
//             },
//             error: function(xhr, textStatus, errorThrown) {
//                 if (textStatus == 'timeout') {
//                     this.tryCount++;
//                     if (this.tryCount <= this.retryLimit) {
//                         //try again
//                         $.ajax(this);
//                         return;
//                     }
//                     return;
//                 }
//                 if (xhr.status == 500) {
//                     //handle error
//                 } else {
//                     //handle error
//                 }
//             }
//         });
//     }
// });