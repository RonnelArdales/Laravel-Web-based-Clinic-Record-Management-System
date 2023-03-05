@extends('layouts.navbar')
@section('content')
    

<h1 class="text-center text-[30px]">Calendar</h1>

<div class="container">
    <div id="calendar"></div>
</div>


<script>

    $(document).ready(function () {
    
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    
    //show calendar
        var calendar = $('#calendar').fullCalendar({
            height:550,
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/patient/appointment',
            selectable:true,
            selectHelper: true,
            select:function(start, end, allDay)
            {
                // var title = prompt('Event Title:');
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
    
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log(start);
                    $.ajax({
                        url:"/patient/action",
                        type:"Post",
                        datatype: "json",
                        data:{
                  
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(response)
                        {   
                            // $('#date').html();
                            window.location.href = response;
                        //  console.log(response);
    
                        }
                    })
       
            },
            editable:true,
            // eventResize: function(event, delta)
            // {
            //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            //     var title = event.title;
            //     var id = event.id;
            //     $.ajax({
            //         url:"/full-calender/action",
            //         type:"POST",
            //         data:{
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id,
            //             type: 'update'
            //         },
            //         success:function(response)
            //         {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Updated Successfully");
            //         }
            //     })
            // },
            // eventDrop: function(event, delta)
            // {
            //     var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            //     var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            //     var title = event.title;
            //     var id = event.id;
            //     $.ajax({
            //         url:"/full-calender/action",
            //         type:"POST",
            //         data:{
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id,
            //             type: 'update'
            //         },
            //         success:function(response)
            //         {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Updated Successfully");
            //         }
            //     })
            // },
    
            // eventClick:function(event)
            // {
            //     if(confirm("Are you sure you want to remove it?"))
            //     {
            //         var id = event.id;
            //         $.ajax({
            //             url:"/full-calender/action",
            //             type:"POST",
            //             data:{
            //                 id:id,
            //                 type:"delete"
            //             },
            //             success:function(response)
            //             {
            //                 calendar.fullCalendar('refetchEvents');
            //                 alert("Event Deleted Successfully");
            //             }
            //         })
            //     }
            // }
        });
    
    });
      
    </script>

@endsection