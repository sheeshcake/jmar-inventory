$(document).on("click", ".open-details", function() {
    // Add this later
    var $t = $(this);
    $(".item-data").remove();
    $(".details-toggle").html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
    $(".details-toggle").addClass("open-details");
    $(".details-toggle").removeClass("close-details");
    $t.html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
    $t.addClass("close-details");
    $t.removeClass("open-details");
    $.ajax({
        url: url(window.location.href) + "/includes/item-details.php",
        method: "POST",
        data: {
            "id": $(this).children().first().text()
        },
        success: function(data) {
            var el = $(data);
            $t.parent().children(".child").hide();
            $t.parent().parent().after(el);
            el.show("slow");
        }
    });
});

$(document).on("click", ".close-details", function() {
    $(".item-data").remove();
    $(this).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
    $(this).addClass("open-details");
    $(this).removeClass("close-details");
});
var $t;
var $t_id1;
var $t_id2;
$(document).ready(function() {
    $t = $('#example').DataTable({
        "responsive": true,
    });
    $('#example_wrapper').css("width", "100%");
    // $('#example_wrapper').removeAttr('class');

});
$(document).on("click", "#confirm-delete", function() {
    var $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/delete-item.php",
        method: "POST",
        data: {
            submit: "submit",
            item_id: $id,
        },
        success: function(d) {
            var data = JSON.parse(d);
            $t_id1.fadeOut(500);
            $t_id2.fadeOut(500);
            $(".alert").addClass("alert" + data.status);
            $(".alert").text(data.message);
            $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
                // location.reload();
            });
        }
    });

});
$(document).on("click", ".delete", function() {
    var $id = $(this).val();
    $t_id1 = $(this).parent().parent().parent().parent().parent().parent();
    $t_id2 = $t_id1.prev();
    $('.alert').alert('show');
    $("#exampleModalLabel").text("Please Confirm Item Delete");
    $(".modal-body").html(
        '<b>Item Name:</b> ' + $("#name" + $id).val() + "</br>" +
        '<b>Item Brand:</b> ' + $("#brand" + $id).val() + "</br>" +
        '<b>Description:</b> ' + $("#desc" + $id).val() + "</br>"
    );
    $(".modal-footer").html(
        '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
        '<button class="btn btn-primary" value="' + $id + '" data-dismiss="modal" id="confirm-delete" >Delete</button>'
    );

});
$(document).on("click", ".update", function() {
    $('.toast').toast('show');
    var $id = $(this).val();
    console.log($id);
    $.ajax({
        url: url(window.location.href) + "/controller/edit-item.php",
        method: "POST",
        data: {
            submit: "submit",
            item_id: $id,
            item_capital: $("#capital" + $id).val(),
            item_name: $("#name" + $id).val(),
            item_brand: $("#brand" + $id).val(),
            item_tax: $("#tax" + $id).val(),
            item_desc: $("#desc" + $id).val(),
            item_category: $("#cat" + $id).val(),
            item_unit: $("#unit" + $id).val(),
        },
        success: function(d) {
            var data = JSON.parse(d);
            $(".alert").addClass("alert" + data.status);
            $(".alert").text(data.message);
            $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
            });
        }
    });
});


$(document).on('change', '.custom-file-input', function(e) {
    var filename = $('input[type=file]').val().split('\\').pop();
    $(".custom-file-label").text(filename);
})

function calculate() {
    var price = parseFloat($("#input-capital").val());
    var tax = parseFloat($("#input-tax").val());
    var total = ((tax / 100) * price) + price;
    console.log(total + " " + price + " " + tax);
    $("#total-item-price").val(total);
}
$(document).on("input", "#input-capital", function() {
    calculate();
});
$(document).on("input", "#input-tax", function() {
    calculate();
});