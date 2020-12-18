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
                '<div class="alert alert-' + data.status + ' role="alert" style="display:none">' +
                data.message +
                '</div>'
            );
            $(".alert").show(500);
            if (typeof data.name !== 'undefined') {
                var new_cat = $('<a style="display: none" class="collapse-item" href="?p=inventory&cat=' + data.name + '">' + data.name + '</a>');
                new_cat.insertAfter('.cat:last');
                new_cat.show(500);
                var rowNode = $t.row.add([
                    data.id + '',
                    data.name + '',
                    '<button class="cat-del btn btn-danger btn-sm">Delete</button>' +
                    '<button class="cat-up btn btn-success btn-sm">Update</button>'
                ]).draw();
                $t.draw();
            }
        }
    });
});