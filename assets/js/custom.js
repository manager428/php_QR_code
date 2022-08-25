$(document).ready(function() {

    $('.datetimepicker').ejDateTimePicker({
        locale: "es-ES",
        width: '100%',
        buttonText: { today: "hoy", timeNow: "ahora", done: "hecho", timeTitle: "tiempo" },
    });

    $('.datetimepicker').attr("placeholder", "Seleccione día y hora");

    $(".qr-creator").on("click", function(e) {
       
        e.preventDefault();
        //initQRResultData();
        $(".qr_preview").removeAttr("src");
        $(".qre-primary").css("display", "none");
        $(".qre-success").css("display", "none");
        $(".qre-danger").css("display", "none");
        $(".spinner-box").show();
        var full_name = $(this).parents('form').find('.full_name').val(); 
        var number_pax = $(this).parents('form').find('.number_pax').val();
        var car_plate = $(this).parents('form').find('.car_plate').val();
        var car_model = $(this).parents('form').find('.car_model').val();
        var check_in = $(this).parents('form').find('.check_in').val();
        var check_out = $(this).parents('form').find('.check_out').val();
        var visit_reason = $(this).parents('form').find('.visit_reason').val();
        var address = $(this).parents('form').find('.address').val();
        var hostname = $(this).parents('form').find('.hostname').val();
        var level = $(this).parents('form').find('.level').val();
        var size = $(this).parents('form').find('.size').val();
        $.ajax({
            url: '../modules/qrcode/QrEncoder/index.php',
            type: 'POST',
            data: {
                full_name: full_name,
                number_pax: number_pax,
                car_plate: car_plate,
                car_model: car_model,
                check_in: check_in,
                check_out: check_out,
                visit_reason: visit_reason,
                address: address,
                hostname: hostname,
                level: level,
                size: size
            },

            success: function(data) {
                $(".spinner-box").hide();
                //initQRdata();
                if(data["success"] == 1){
                    $(".qre-success").css("display", "block");
                    $(".qre-success").html(data["message"]);

                }else if(data["error"] == 1){

                    $(".qre-danger").css("display", "block");
                    $(".qre-danger").html(data["message"]);

                }
                
                $(".qr_download").attr("href", data["img_link"]);
                $(".qr-img").attr("src", data["img_link"]);

            },

            error: function(data) {
                $(".spinner-box").hide();
                $(".qre-danger").css("display", "block");
                $(".qre-danger").html("Please check your internet connection!");
            }
        });
    });

});