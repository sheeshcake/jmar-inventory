var $last_data = "";

function AddZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = AddZero(hours) + ':' + AddZero(minutes) + ' ' + ampm;
    return strTime;
}


function reload() {
    setTimeout(function() {
        $.ajax({
            url: url(window.location.href) + "/controller/get-items-transafer.php",
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
        $('#example_wrapper').css("width", "100%");
        reload();
    }, 500);
}

function check_items(){
    if($(".item").length > 0){
        console.log($(".item").length > 0);
        $(".submit-transaction").slideDown(500);
    }else{
        $(".submit-transaction").slideUp(500);
    }
}

function update_stock_on_add(btn){
    var $id= btn.val();
    var $count = $("#item_" + $id);
    if(parseInt($count.attr("max")) >= parseInt($count.val()) && 0 < parseInt($count.val()) && parseInt(btn.parent().prev().find(".form-control").val()) > 0){
        count = math.subtract($("#stock_" + $id).val(), $count.val());
        $count.attr("max", count);
        $("#stock_" + $id).val(math.subtract($("#stock_" + $id).val(), $count.val()));
        $("#alert_" + $id).text("Item Added!");
        $("#alert_" + $id).attr('class', 'alert-danger').addClass('alert');
        $("#alert_" + $id).fadeTo(3000, 500).slideUp(500, function() {});
        return true;
    }else if(parseInt($count.val()) < 0){
        $("#item_" + $id).val($count.attr("min"));
        $("#item_" + $id).focus().addClass("border-danger");
        $("#alert_" + $id).text("Input is Invalid");
        $("#alert_" + $id).attr('class', 'alert-danger').addClass('alert');
        $("#alert_" + $id).fadeTo(3000, 500).slideUp(500, function() {});
        return false;
    }else {
        $("#item_" + $id).val($count.attr("max"));
        $("#item_" + $id).focus().addClass("border-danger");
        $("#alert_" + $id).text("Requested Item Exeeded!");
        $("#alert_" + $id).attr('class', 'alert-danger').addClass('alert');
        $("#alert_" + $id).fadeTo(3000, 500).slideUp(500, function() {});
        return false;
    }
}
$(document).ready(function() {
    $("#page-top").toggleClass("sidebar-toggled");
    $("#accordionSidebar").toggleClass("toggled");
    check_items();
    reload();
});
$(document).on("click", ".add", function() {
    if(update_stock_on_add($(this))){
        $this_btn = $(this);
        var $id = $(this).val();
        var $count = $("#item_" + $id).val();
        var $total_count = $(this).attr("unit_divisor") * $count;
        $.ajax({
            url: url(window.location.href) + "/controller/transfer-controller.php",
            method: "POST",
            data: {
                id: $id,
                type: "get-item"
            },
            success: function(d) {
                var data = JSON.parse(d);
                var has_same = false;
                $("#items").children(".item").each(function(i, obj){
                    if($(this).attr("item-id") == $id){
                        var $new_total_count = math.add($(this).attr("item-count"), $total_count);
                        var $new_count = math.add($("#item_count_" + $id).text(), $count);
                        $("#items").prepend(
                            '<div class="item card mb-1"  item-id="' + $id + '" item-count="' + parseFloat($new_total_count).toFixed(2) + '">' +
                            '<div class="card-body">' +
                            '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" item_count="' + $new_count + '">x</button>' +
                            '<div class="d-flex">' +
                            '<img style="max-width: 23% !important" src="img/item/' + data.item_img + '">' +
                            '<div class="ml-3">' +
                            '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                            '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                            '<b>' + data.item_unit + ':</b>&nbsp;<b id="item_count_' + $id + '">' + $new_count + '</b><br>' +
                            '</div>' +
                            '<div>' +
                            '</div>' +
                            '</div>'
                        );
                        $(this).remove();
                        has_same = true;
                        return false;
                    }
                });
                if(!has_same){
                    $("#items").prepend(
                        '<div class="item card mb-1"  item-id="' + $id + '" item-count="' + parseFloat($total_count).toFixed(2) + '">' +
                        '<div class="card-body">' +
                        '<button class="remove-item btn btn-danger float-right" style="height: 40px;" item_id="' + $id + '" item_count="' + $count + '">x</button>' +
                        '<div class="d-flex">' +
                        '<img style="max-width: 23% !important" src="img/item/' + data.item_img + '">' +
                        '<div class="ml-3">' +
                        '<p><b>Name:</b>&nbsp;' + data.item_name + '<br>' +
                        '<b>Brand:</b>&nbsp;' + data.item_brand + '<br>' +
                        '<b>' + data.item_unit + ':</b>&nbsp;<b id="item_count_' + $id + '">' + $count + '</b><br>' +
                        '</div>' +
                        '<div>' +
                        '</div>' +
                        '</div>'
                    );
                }
                check_items();
            }
        });
    }
});

$(document).on("click", ".remove-item", function() {
    var $id = $(this).attr("item_id");
    var count = math.add($("#stock_" + $id).val(), $(this).attr("item_count"));
    $("#item_" + $id).attr("max", count);
    $("#stock_" + $id).val(count);
    $(".submit-transaction").prop('disabled', true);
    var elem = $(this).parent().parent();
    elem.slideUp("normal", function() {
        elem.remove();
        $(".submit-transaction").prop('disabled', false);
        check_items();
    });
});

function check_inputs(){
    var driver = $("#driver_name").val();
    var plate = $("#plate_no").val();
    if(plate != "" && driver != ""){
        return true;
    }else{
        alert("Please Fill All Fields!");
        return false;
    }
}

$(".submit-transaction").click(function() {
    if(check_inputs()){
        var now = new Date();
        var strDateTime = [
            AddZero(now.getMonth() + 1),
            AddZero(now.getDate()),
            now.getFullYear()
        ].join(" ");
        var $date = strDateTime;
        var $time = formatAMPM(new Date);
        var $all = $(".item").map(function() {
            return  $(this).attr("item-id") + "," + $(this).attr("item-count");
        }).get();
        console.log($all);
        var $driver_name = $("#driver_name").val();
        var $plate_no = $("#plate_no").val();
        $.ajax({
            url: url(window.location.href) + "/controller/transfer-controller.php",
            method: "POST",
            data: {
                type: "transfer",
                date: $date,
                time: $time,
                driver_name: $driver_name,
                plate_no: $plate_no,
                data: $all
            },
            success: function(d){
                var data = JSON.parse(d);
                $("#trans-message").fadeTo(3000, 500).slideUp(500, function() {}).text(data["message"]).attr('class', 'alert-' + data['status']).addClass('alert');
                if (data["status"] == "success") {
                    $(".item").map(function() {
                        $(this).fadeTo(1000, 500).slideUp(500, function() {
                            $("#total").text(0);
                            $("#total_items").text(0);
                            $(this).remove();
                        });
                    });
                }
            }
        });
    }
});