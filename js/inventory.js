var $t;
var $last_data;
var $counter = 0;


function reload() {
    setTimeout(function() {
        if ($(".item").length == 0) {
            $.ajax({
                url: url(window.location.href) + "/controller/get-item-inventory.php",
                method: "GET",
                success: function(d) {
                    if ($last_data != d.replace(/\s/g, '')) {
                        $last_data = d.replace(/\s/g, '');
                        $("#item_data").html(d);
                        $t = $('#example').DataTable();
                        $(document).find("#example_filter").css("position", "sticky");
                        $(document).find("#example_filter").css("top", "0");
                        $(document).find("#example_filter").css("background", "white");
                        $(document).find("#example_filter").css("z-index", "100");
                    }
                }
            });
        }
        $('#example_wrapper').css("width", "100%");
        reload();
    }, 500);
}
$(document).ready(function() {
    $("#page-top").toggleClass("sidebar-toggled");
    $("#accordionSidebar").toggleClass("toggled");
    reload();
});

function strtrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}
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
    $t = $('#example').DataTable({});
    $(document).find("#example_filter").css("position", "sticky");
    $(document).find("#example_filter").css("top", "0");
    $(document).find("#example_filter").css("background", "white");
    $(document).find("#example_filter").css("z-index", "100");
    $(document).find("example").css({ width: '' });
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
            });
        }
    });

});
$(document).on("click", ".delete", function() {
    var $id = $(this).val();
    $('.alert').alert('show');
    $("#exampleModalLabel").text("Please Confirm Item Delete");
    $(".modal-body").html(
        '<img src="' + url(window.location.href) + "/" + $("#img" + $id).attr("src") + '" width="200"/></br>' +
        '<b>Item Name:</b> ' + $("#name" + $id).text() + "</br>" +
        '<b>Item Brand:</b> ' + $("#brand" + $id).text() + "</br>" +
        '<b>Description:</b> ' + $("#desc" + $id).text() + "</br>"
    );
    $(".modal-footer").html(
        '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>' +
        '<button class="btn btn-primary" value="' + $id + '" data-dismiss="modal" id="confirm-delete" >Delete</button>'
    );

});
$(document).on("click", ".update", function() {
    $('.toast').toast('show');
    var $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/edit-item.php",
        method: "POST",
        data: {
            submit: "submit",
            item_id: $id,
            item_capital: parseFloat($("#capital" + $id).text()).toFixed(2),
            item_capital_wholesale: parseFloat($("#capital_w" + $id).text()).toFixed(2),
            item_name: strtrim($("#name" + $id).text()),
            item_brand: strtrim($("#brand" + $id).text()),
            item_tax: parseFloat($("#tax" + $id).text()).toFixed(2),
            item_tax_wholesale: parseFloat($("#tax_w" + $id).text()).toFixed(2),
            item_desc: strtrim($("#desc" + $id).text()),
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
});

function calculate(type) {
    if (type == "retail") {
        var price = parseFloat($("#input-capital").val());
        var tax = parseFloat($("#input-tax").val());
        var total = ((tax / 100) * price) + price;
        $("#total-item-price2").val(total.toFixed(2));
    } else {
        var price = parseFloat($("#input-capital-wholesale").val());
        var tax = parseFloat($("#input-tax-wholesale").val());
        var total = ((tax / 100) * price) + price;
        $("#total-item-price1").val(total.toFixed(2));
    }
}
$(document).on("input", "#input-capital", function() {
    calculate("retail");
});
$(document).on("input", "#input-tax", function() {
    calculate("retail");
});

$(document).on("input", "#input-capital-wholesale", function() {
    calculate("wholesale");
});
$(document).on("input", "#input-tax-wholesale", function() {
    calculate("wholesale");
});