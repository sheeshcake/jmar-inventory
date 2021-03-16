$(document).on("click", "#b-lgn", function() {
    $.ajax({
        url: url(window.location.href) + "/controller/page-controller.php",
        method: "POST",
        data: {
            "page": "home"
        },
        success: function(data) {
            location.reload();
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
    $("#b-reg").hide();
});
$(document).on("input", "#r-password", function() {
    if ($("#password").val() == $("#r-password").val()) {
        $("#b-reg").fadeIn(500);
        $("#b-reg").attr("type", "submit");
        $("#b-reg").attr("name", "submit");
    } else {
        $("#b-reg").fadeOut(500);
        $("#b-reg").removeAttr("type");
        $("#b-reg").removeAttr("name");
    }
});
$(document).ready(function() {
    setTimeout(function() {
        $("#reg-alert").fadeOut(300);
    }, (10000));
});