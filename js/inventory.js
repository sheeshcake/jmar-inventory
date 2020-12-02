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
$(document).ready(function() {
    $t = $('#example').DataTable({
        "responsive": true
            // // scrollY: "300px",
            // scrollX: true,
            // // "columnDefs": [
            // //     { "width": "20%", "targets": 0 }
            // // ],
            // scrollCollapse: true,
            // paging: false,
            // fixedColumns: {
            //     leftColumns: 1,
            //     rightColumns: 1
            // }
    });
    // $('#example_wrapper').css("margin", "0");
    // $('#example').css("width", "2000px");
    // $('tbody').css("overflow-x", "auto");
    // $('tbody,tr,td').attr("width", "300px");
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
            $(".alert").addClass("alert" + data.status);
            $(".alert").text(data.message);
            $(".alert").fadeTo(3000, 500).slideUp(500, function() {
                $(".alert").slideUp(500);
                location.reload();
            });
        }
    });

});
$(document).on("click", ".delete", function() {
    var $id = $(this).val();
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
            item_capital: parseFloat($("#capital" + $id).text()).toFixed(2),
            item_name: $("#name" + $id).text(),
            item_brand: $("#brand" + $id).text(),
            item_tax: parseFloat($("#tax" + $id).text()).toFixed(2),
            item_desc: $("#desc" + $id).text(),
            item_category: $("#cat" + $id).attr("cat-id"),
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
    var name = $('input[type=file]').val().split('\\').pop();
    var shortname = "";
    if (name.length > 20) {
        var shortname = name.substring(0, 20) + " ...";
    }
    $(".custom-file-label").text(shortname);
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