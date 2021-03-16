function update(){
    var date = $("#date").val();
    $.ajax({
        url: url(window.location.href) + "/controller/incoming-history.php",
        method: "POST",
        data: {
            date: date
        },
        success: function(d){
            $("#table-data").html(d);
        }
    });
}

$(document).ready(function(){
    update();
});

$("#date").on("change", function(){
    update();
});
function printContent(){
    var restorepage = $('body').html();
    var printcontent = $('#table-data').clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
}

$("#print").click(function(){
    printContent();
});