function url(the_url) {
    var the_arr = the_url.split('/');
    the_arr.pop();
    return (the_arr.join('/'));
}

function formatter(num) {
    var formatter = new Intl.NumberFormat({
        style: 'currency',
        currency: 'PHP',
    });
    return formatter.format(num);
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
$(document).ready(function(){
    document.body.style.zoom = "90%";
});
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
$(document).on("input", "#input-category", function() {
    if ($(this).val() === "") {
        $("#add-cat-btn").hide();
    } else {
        $("#add-cat-btn").show(500);
    }
});
var $t;
$(document).on("click", "#open-cat", function() {
    $t = $("#cat-table").DataTable();
})
$("#add-cat-btn").click(function() {
    $.ajax({
        url: url(window.location.href) + "/controller/add-category.php",
        method: "POST",
        data: {
            submit: $(this).val(),
            category: $("#input-category").val()
        },
        success: function(d) {
            var data = JSON.parse(d);
            $("#input-category").val("");
            $("#add-cat-btn").hide();
            $("#category-message").html(
                '<div class="alert alert-' + data.status + ' role="alert" id="category_modal_message" style="display:none">' +
                data.message +
                '</div>'
            );
            $("#category").append(
                '<option value="' + data.id + '">' + data.name + '</option>'
            );
            $("#category_modal_message").fadeTo(3000, 500).slideUp(500, function() {
                $("#category_modal_message").slideUp(500);
            });
            if (typeof data.name !== 'undefined') {
                var new_cat = $('<a class="collapse-item" id="sc_' + data.id + '" href="?p=inventory&cat=' + data.name + '">' + data.name + '</a>');
                new_cat.hide();
                new_cat.insertAfter('.cat:last');
                new_cat.show(500);
                var rowNode = $t.row.add([
                    data.id + '',
                    data.name + '',
                    '<button class="cat-del btn btn-danger btn-sm">Delete</button>' +
                    '<button class="cat-up btn btn-success btn-sm">Update</button>'
                ]).draw();
                $(rowNode.column(1).nodes()).attr("contenteditable", "true");
                console.log(rowNode.column(1).nodes());
                $t.draw();
            }
        }
    });
});