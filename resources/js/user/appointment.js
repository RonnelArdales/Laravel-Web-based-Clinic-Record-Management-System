$(document).ready(function () {

    setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#available-time').empty()
    $('#available-time').append('<option value="0" disabled selected></option>')

    $('#calendar').fullCalendar({
        height:600,
        editable:true,
        header:{
                left:'prev,next today',
                right:'null',
                center:'title',  
            },
        selectable:true,
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

        select:function(start, end, allDay, jsEvent,) {

            // jsEvent.preventDefault();
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
                    success:function(response) {   
                        $('#date').val("");
                        $('#available-time').empty()            
                        if(date_off.includes(start)){
                            $('#available-time').append('<option value="0" disabled selected></option>');
                            $('#available-time').append('<option value="0" disabled selected></option>')
                            $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text("This day is not available");
                        }else{
                            if (selected_date < currentDate) {
                                    $('#available-time').append('<option value="0" disabled selected></option>');
                                    $('#available-time').append('<option value="0" disabled selected></option>')
                                    $('#errormodal').modal('show');
                                    $('#errormessage').text(" ");
                                    $('#errormessage').text("This day is not available");
                            } else {
                                if(response.status == "405"){
                                    $('#available-time').append('<option value="0" disabled selected></option>')
                                    $('#errormodal').modal('show');
                                    $('#errormessage').text(" ");
                                    $('#errormessage').text("This day is not available");
                                }else{
                                    $('#available-time').focus(); 
                                    $('#date').val(response.date);
                                    $("#available-time").append("<option value = ''>-- select --</option>");
                                    $.each(response.available_time, function(index, val){ 
                                        $("#available-time").append("<option value='"+val+"'>"+val+"</option>");
                                    } );
                                }
                            }
                        }
                    }
                })
            }
        },
    });

    $('#available-time').on('change', function(){
        var time = $(this).val();
        $('#form-timeselected').val(time);
    });

    $('.appointment-confirm').on('click', function(){
        var date = $('.date').val();
        var time = $("#available-time").val();
        var services = $('#services').val();
        if($('#agree').is(":checked")){
            if(date.length === 0 ){
                $('#errormodal').modal('show');
                $('#errormessage').text(" ");
                $('#errormessage').text('Please select date in calendar.');
            }else if(time.length === 0){
                $('#errormodal').modal('show');
                $('#errormessage').text(" ");
                $('#errormessage').text('Please select available time.');
            }else{
                $('#form-dateselected, #form-timeselected').val("");
                $('#form-dateselected').val($('#date').val());
                $('#form-timeselected').val($('#available-time').val());
                $('#appointment-confirmation').modal('show');
            }
        }else{
            $('#errormodal').modal('show');
            $('#errormessage').text(" ");
            $('#errormessage').text('Please read and accept the terms and condition to proceed.');
        }
    });
});