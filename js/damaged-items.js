function refresh(){
    $.ajax({
        url: url(window.location.href) + "/controller/get-damaged-items.php",
        method: "GET",
        success: function(d){
            $("#damaged-items").html(d);
            $t = $('#example1').DataTable();
            $(document).find("#example1_filter").css("position", "sticky");
            $(document).find("#example1_filter").css("top", "0");
            $(document).find("#example1_filter").css("background", "white");
            $(document).find("#example1_filter").css("z-index", "100");
        }
    });
    $.ajax({
        url: url(window.location.href) + "/controller/get-items-damaged.php",
        method: "GET",
        success: function(d){
            $("#items-damaged").html(d);
            $t = $('#example2').DataTable();
            $(document).find("#example2_filter").css("position", "sticky");
            $(document).find("#example2_filter").css("top", "0");
            $(document).find("#example2_filter").css("background", "white");
            $(document).find("#example2_filter").css("z-index", "100");
        }
    });
}

$(document).ready(function(){
    refresh();
});

function alert(id, message, status, name){
    $("#alert_" + name + "_" + id).addClass("alert-" + status);
    $("#alert_" + name + "_"  + id).text(message);
    $("#alert_" + name + "_"  + id).fadeTo(3000, 500).slideUp(500, function() {
        $("#alert_" + name + "_"  + id).slideUp(500);
        refresh();
    });
}

$(document).on("click", ".add", function(){
    $count = $("#item_report_" + $(this).val()).val();
    $id = $(this).val();
    $.ajax({
        url: url(window.location.href) + "/controller/damage-controller.php",
        method: "POST",
        data: {
            id: $id,
            count: $count,
            submit: "report"
        },
        success: function(d){
            var data = JSON.parse(d);
            alert($id, data.message, data.status, "report");
        }
    });
});
$(document).on("click", ".replace", function(){
    $count = $("#item_damaged_" + $(this).val()).val();
    $item_id = $(this).val();
    $damage_id = $(this).attr("damage_id");
    $.ajax({
        url: url(window.location.href) + "/controller/damage-controller.php",
        method: "POST",
        data: {
            item_id: $item_id,
            damage_id: $damage_id,
            count: $count,
            submit: "replace"
        },
        success: function(d){
            var data = JSON.parse(d);
            alert($item_id, data.message, data.status, "damaged");
        }
    });
});



$(document).on("input", ".damage-count", function(){
    if(math.subtract($(this).attr("max"), $(this).val()) < 0){
        $(this).val($(this).attr("max"));
    }else if($(this).val() < 0){
        $(this).val(1);
    }
});