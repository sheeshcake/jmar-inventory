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