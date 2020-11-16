$(document).on("click", "#b-reg", function() {
    $.ajax({
        url: url(window.location.href) + "/controller/page-controller.php",
        method: "POST",
        data: {
            "page": "register"
        },
        success: function(data) {
            $(".main-content").fadeIn(500).html(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            if (textStatus == 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    //try again
                    $.ajax(this);
                    return;
                }
                return;
            }
            if (xhr.status == 500) {
                //handle error
            } else {
                //handle error
            }
        }
    });
});
$(document).ready(function() {
    setTimeout(function() {
        $("#lgn-alert").fadeOut(300);
    }, (3000));
});