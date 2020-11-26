var $t;
$(document).ready(function() {
    $t = $('#example').DataTable();
    $('#example_wrapper').css("width", "100%");
    // $('#example_wrapper').removeAttr('class');
});

$(".min").click(function() {
    var $type = $(this).text();
    var $id = $(this).val();
    var $num = $(this).prev().val();
    var $btn = $(this);
    $.ajax({
        url: url(window.location.href) + "/controller/transaction-controller.php",
        method: "POST",
        data: {
            submit: "submit",
            type: $type,
            id: $id,
            num: $num
        },
        success: function(d) {
            console.log(d);
            var data = JSON.parse(d);
            if (data.status == "danger") {
                $btn.prev().prev().prev().val("Out Of Stock");
                $btn.hide();
                $btn.prev().hide();
                $btn.prev().prev().hide();
            } else {
                if (data.stock == 0) {
                    $btn.prev().prev().prev().val("Out Of Stock").addClass("is-invalid");;
                    $btn.hide();
                    $btn.prev().hide();
                    $btn.prev().prev().hide();
                } else {
                    $btn.prev().val(1);
                    $btn.prev().prev().prev().val(data.stock);
                }
            }
            $btn.parent().next().next().removeClass().addClass("alert alert-" + data.status);
            $btn.parent().next().next().html(data.message);
            $btn.parent().next().next().fadeTo(3000, 500).slideUp(500, function() {
                $btn.prev().prev().prev().removeClass("border-success");
            });
        }
    });
})