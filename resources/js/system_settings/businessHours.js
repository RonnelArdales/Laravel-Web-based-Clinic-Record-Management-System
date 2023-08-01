$(document).ready(function (){

    $('.add_businesshours').on('click', function(e){
        let url = (usertype === "admin") ?  "/admin/business_hours/store" :  "/secretary/business_hours/store";
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: { 'business_date' : $('.create_businessday').val(),
                    'business_time': $('.create_businesstime').val(), },
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){
                if(response.status == 400){
                    $('#error_day, #error_time' ).html("");
                    $.each(response.errors.business_date, function (key, err_values){
                        $('#error_day').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.business_time, function (key, err_values){
                        $('#error_time').append('<span>'+err_values+'</span>');
                    });
                }else{
                    $('#message-success').text('Created successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('.modal-asd').load(location.href+' .modal-asd');
                    $('.businessHours').load(location.href+' .businessHours');
                    $('#businessdays').val('Monday');
                    $('#create').modal('hide');
                }
            }
        });
    })

    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        let url = (usertype === "admin") ?  "/admin/business_hours/day/delete" :  "/secretary/business_hours/day/delete";
        const day_id = [];
        $('.day_id').each(function (){
            if($(this).is(":checked")){
                day_id.push($(this).val());
            }
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(day_id == ""){
            // console.log('please eme');
        }else{ 
            $.ajax({
                type: "DELETE",
                url: url,
                data: {day_id : day_id},
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){
                    $('#days').find('select').val("Monday");
                    $('#message-success').text('Deleted successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('.businessHours').load(location.href+' .businessHours');
                }
            });
        }
    })

    $('#businessdays').on('change', function(e){
        e.preventDefault();
        var businessdays = $('#businessdays').val();
        let url = (usertype === "admin") ?  "/admin/business_hours/get_hours" :  "/secretary/business_hours/get_hours"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: {businessdays : businessdays},
            datatype: "json",
            success: function(response){
                $('.businessHours').html(response);
            }
        });
    })

    $(document).on('click','.off_day', function(e){
        e.preventDefault();
        let url = (usertype === "admin") ?  "/admin/business_hours/off_status" :  "/secretary/business_hours/off_status";
        var days =  $('#businessdays').val();
        const day_id = []
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if($('.checked_off').is(":checked")){
            day_id.push($(this).val());
            var status = "checked"
        }else{
            day_id.push($(this).val());
            var status = "unchecked"
        }  
        
        $.ajax({
                type: "PUT",
                url: url,
                data: {day_id : day_id,
                        status: status,
                                            },
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){
                    console.log(response);
                $('#message-success').text('Updated successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#days').find('select').val("Monday");
                    $('.businessHours').load(location.href+' .businessHours');
                    $('.refresh_off').load(location.href+' .refresh_off');
                }
            });
    })

    $('.add_date').on('click', function(e){
        e.preventDefault();
        let url = (usertype === "admin") ?  "/admin/business_hours/store_date" :  "/secretary/business_hours/store_date";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: url,
            data: {date : $('.date').val() },
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){
                $('.date').val(" ");
                $('.dayoff_dates').load(location.href+' .dayoff_dates');
            }
        });
    });

    $(".modal").on("hidden.bs.modal", function(){
        $('#create').find('input').val("");
        $('#create_businessday').val("");
        $('#error_day, #error_time').html("");
    });

    $(document).on('click', '.delete_date'  ,function(e){
        e.preventDefault();
        const date_id = [];
        let url = (usertype === "admin") ?  "/admin/business_hours/date/delete" :  "/secretary/business_hours/date/delete";
        $('.date_id').each(function (){
            if($(this).is(":checked")){
                date_id.push($(this).val());
            }
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(date_id == ""){
            console.log(date_id);
        }else{
            $.ajax({
                type: "DELETE",
                url: url,
                data: {date_id : date_id},
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){
                    $('#message-success').text('Deleted successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('.dayoff_dates').load(location.href+' .dayoff_dates');
                }
            });
        }
    })
});