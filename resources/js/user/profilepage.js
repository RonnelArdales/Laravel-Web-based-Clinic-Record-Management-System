$(document).ready(function(e){


    $('#reschedtime').empty()
    $('#reschedtime').append('<option value="0" disabled selected></option>');

    setTimeout(function() {
        $(".success").fadeOut(800);
    }, 2000);

    $("#calendar").on("hidden.bs.modal", function(e){
        e.preventDefault();
        $('#reschedcalendar').find('.refresh').val("");
        $('#reschedtime').empty()
        $('#reschedtime').append('<option value="0" disabled selected></option>');
        $(' #error_resched_date, #error_resched_tim' ).html("");
    });

    $('#calendar').fullCalendar({
        height:350,
        editable:true,
        header:{
                left:'prev,next today',
                right:'null',
                center:'title',
            },
        selectable:true,
        selectHelper: true,
        contentHeight:"auto",
        selectHelper: true,
        viewRender: function(view, element,) {
            if(day_off.includes("0")){
            $('.fc-day.fc-sun').css('backgroundColor', '#cc6666');
            }
            if(day_off.includes("1")){
                $('.fc-day.fc-mon').css('backgroundColor', '#cc6666');
            } 
            if(day_off.includes("2")){
                $('.fc-day.fc-tue').css('backgroundColor', '#cc6666');
            }
            if(day_off.includes("3")){
                $('.fc-day.fc-wed').css('backgroundColor', '#cc6666');
            }
            if(day_off.includes("4")){
                $('.fc-day.fc-thu').css('backgroundColor', '#cc6666');
            }
            if (day_off.includes("5")){
                $('.fc-day.fc-fri').css('backgroundColor', '#cc6666');
            }
            if (day_off.includes("6")){
                $('.fc-day.fc-sat').css('backgroundColor', '#cc6666');
            }

            element.find('.fc-day').each(function() {
                var date = $(this).data('date');
                if (date_off.includes(date)) {
                    $(this).css('backgroundColor', '#cc6666'); // Red for dates in the array
                } else {
                    // $(this).css('background-color', '#829460'); // Green for dates not in the array
                }
            });

            element.find('.fc-day').each(function() {
                var currentDate = new Date();
                var date = $(this).data('date');
                var day = new Date(date);

                // Check if the date is in the past
                if (day < currentDate) {
                    $(this).css('backgroundColor', '#cc6666'); 
                    $('.fc-day.fc-today').css('backgroundColor', 'white');
                } 
            });

            $('.fc-day.fc-today').css('backgroundColor', 'white');
        },
        select:function(start, end, allDay) {
            var startDate = moment(start);
            date = startDate.clone();
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss'); 
            const dayOfWeek = $.fullCalendar.moment(date).day();
            let currentDate = new Date(Date.now());
            let year = currentDate.getFullYear();
            let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if necessary
            let day = currentDate.getDate().toString().padStart(2, '0'); // Add leading zero if necessary

            let formattedDate = `${year}-${month}-${day}`;
            var selected_date = new Date(start);

            if(formattedDate == start){
                return false;
            }else{
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"/patient/action",
                    type:"Post",
                    datatype: "json",
                    data:{
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    beforeSend: function(){
                        $('#accept-confirmation').modal('hide');
                        $(".main-spinner").show();
                    },
                    complete: function(){
                        $(".main-spinner").hide();
                    },
                    success:function(response){   
                        $('#resched_date').val("");
                        $('#reschedtime').empty();
                        $('#reschedtime').empty();
                        if(date_off.includes(start)){
                            $('#reschedtime').append('<option value="0" disabled selected></option>');
                            $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text("This day is not available");
                        }else{
                            if (selected_date < currentDate) {
                                    $('#available-time').append('<option value="0" disabled selected></option>');
                                    $('#available-time').append('<option value="0" disabled selected></option>');
                                    $('#errormodal').modal('show');
                                    $('#errormessage').text(" ");
                                    $('#errormessage').text("This day is not available");
                            } else {
                                if(response.status == "405"){
                                    $('#reschedtime').append('<option value="0" disabled selected></option>');
                                        $('#errormodal').modal('show');
                                        $('#errormessage').text(" ");
                                        $('#errormessage').text("This day is full");
                                }else{
                                    $('#resched_date').val(response.date);
                                    $("#reschedtime").append("<option value=''>-- select --</option>");
                                    $.each(response.available_time, function(index, val){ 
                                        $('#reschedtime').append("<option value='"+val+"'>"+val+"</option>");
                                    } )
                                }
                            }
                        }  
                    }
                })
            }
        },
    });
 
    $('.cancel-confirmation').on('click', function(e){
        e.preventDefault();
        var id = $(this).val();
        $('#appointment-id').val(id);
        $('#delete').modal('show');
    });

    $('.cancel_appointment').on('click', function(e){
        e.preventDefault();
        var id = $('#appointment-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT', 
            url: "/patient/appointment/cancel/"+ id,
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $('#delete').modal('hide');
                $(".main-spinner").hide();
            },
            success: function(response){ 
                console.log(response);
                $(".success").show();
                $('#message-success').text('Cancel Successfully');
                setTimeout(function() {
                    $(".success").fadeOut(500);
                }, 2000);
                $('.appointment').load(location.href+' .appointment');    
            }
        });
    });

    $(document).on('click', '.view', function(e) {
        e.preventDefault();
        var id = $(this).val();
        console.log(id);
        $('#view').modal('show');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",   
            url: "/patient/document/view/"+ id, 
            datatype: "json",
            success: function(response){ 
                console.log(response)
                $('#fileview').html("");
                $('#view').find('input, textarea').html("");
                $('#view_appointemntid').val(response.document.appointment_id);
                $('#view_fullname').val(response.document.fullname);
                $('#view_date').val(response.document.appointment_date);
                $('#view_doc_file').val(response.document.documenttype);
                $('#view_file').val(response.document.filename);
                $('#view_note').val(response.document.note);
                $('#fileview').append('  <a href="/patient/document/download/' + response.document.id+'" class=" p-2 w-30 bg-[#829460]  mt-7 " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; text-decoration:none; " >Download</a>\
                ');
            }
        });
    });

    $(document).on('click', '.reschedule', function(e){
        e.preventDefault();
        var id = $(this).val();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",   
            url: "/patient/resched_count/"+ id, 
            datatype: "json",
            success: function(response){ 
                console.log(response);
                $('#reschedid').val("");
                if(response.status == 400){
                    $('#errormodal').modal('show');
                    $('#errormessage').text(" ");
                    $('#errormessage').text('You already reschedule your appointment');
                }else{
                    $('#reschedid').val(id);
                    $('#viewcalendar').modal('show');
                }
            }
        });
    });

    $('.resched_button').on('click', function(e){
        $('#reschedid').val();
        $('#resched_date').val();
        $('#reschedtime').val();
        let id =  $('#reschedid').val();
        data = {
            "date": $('#resched_date').val(),
            "time": $('#reschedtime').val(),
            "status" : "rescheduled",
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: "/patient/appointment/" + id,
            datatype: "json",
            data: data,
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){ 
                console.log(response);
                if(response.status == 400){
                    $('#error_date, #error_time' ).html("");
                    $.each(response.errors.date, function (key, err_values){
                        $('#error_date').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.time, function (key, err_values){
                        $('#error_time').append('<span>'+err_values+'</span>');
                    })
                }else{
                    $('.appointment_table').load(location.href+' .appointment_table');
                    $('#viewcalendar').modal('hide');   
                }
            }
        });
    });

  $("#viewcalendar").on("hidden.bs.modal", function(e){
        e.preventDefault();
        $('#viewcalendar').find('.refresh').val("");
        $(' #error_date, #error_time' ).html("");
    });
})