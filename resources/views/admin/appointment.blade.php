@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
    
 <h1>Appointment  <button type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
    create
  </button></h1>


</div>   
  

<div id="success"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Patient Id</th>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Mobile no</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                 
                </tr>
            </thead>
            <tbody >
              @if (count($appointments)> 0 )
              @foreach ($appointments as $appointment)
              <tr class="overflow-auto">
                <td>{{$appointment->id}}</td>
                  <td>{{$appointment->user_id}}</td>
                  <td>{{$appointment->fullname}}</td>
                  <td>{{$appointment->address}}</td>
                   <td>{{$appointment->email}}</td>
                   <td>{{$appointment->mobileno}}</td>
                   <td>{{$appointment->date}}</td>
                   <td>{{$appointment->time}}</td>
                   <td>{{$appointment->service}}</td>
                   <td>{{$appointment->price}}</td>
                   <td>{{$appointment->status}}</td>
                  <td>
                  <button type="button" value="{{$appointment->id}}" class="edit btn btn-primary btn-sm">Accpet</button>
                  <button type="button" value="{{$appointment->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align: center;">No appointment Found</td>
          
              </tr>
              @endif
               
            </tbody>
        </table>
    </div>
</div>
  

{{-- modal --}}
{{-- create --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Appointment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-5 pt-6  ">
              <div class=" columns-1 sm:columns-2">
                <input class="userid" id="userid"  type="hidden"> 
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Name</label><br>
              <input class=" fullname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="fullname" style="width:390px" readonly type="text"> 
              <button class="patients">Patient</button>
              <br>
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Email</label>
              <input class=" email bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="email" readonly type="text"> 
              <br>
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mobile no.</label>
              <input class=" mobile_number bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="mobile_number" readonly type="text"> 
              <br>

              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Date</label><br>
              <input class="date bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="date" style="width:350px" type="text"> 
              <button class="calendar">Calendar</button>
              <br>
     
              <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Available time:</label><br>
             <select class=" time bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="time" style="width:350px" >
              <option value="">-- select time --</option>
              <option value="">No avilable time</option>
    
             </select>
            <br>

              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class=" add_service p-2 w-30 bg-[#829460]  mt-7 rounded" >Submit</button>
      </div>
    </div>
  </div>
</div>
</div>

  {{-- edit modal --}}
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Book </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" id="appointmentcode">
                <h6>Do you want to accept this appoitnment</h6>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_appointment p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button>
        </div>
      </div>
    </div>
  </div>
</div>
    
    {{-- //delete modal --}}

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" id="appointmentid">
                <h6>Do you want to delete this data?</h6>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" delete_service p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
        </div>
      </div>
    </div>
  </div>
</div> 

{{--------------- View patients ---------------------}}

<div class="modal" id="viewpatients">
  <div class="modal-dialog modal-xl">
    <div class="modal-content viewbody">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Patients</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body ">
        <div class="mb-5 pt-6  ">
          <table class="table">
            <thead>
              <tr>
                  <th>id</th>
                  <th>First name</th>
                  <th>Middle name</th>
                  <th>Last name</th> 
                  <th>Birthday</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Mobile no.</th>
                  <th>Email</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody >
            @if (count($users) > 0)
            @foreach ($patients as $user)
            <tr class="overflow-auto" >
                <td>{{$user->id}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->mname}}</td>
                <td>{{$user->lname}}</td>
                <td>{{$user->birthday}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->mobileno}}</td>
                <td>{{$user->email}}</td>
                 <td>
                  <button class="select" id="select" value="{{$user->id}}">Select </button>
                 </td>
            @endforeach
            @else
            <tr>
              <td colspan="4" style="text-align: center;">no user Found</td>
  
            </tr>
            @endif
             
          </tbody>
          </table>

    </div>
    <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%" >
      <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>

    </div>
  </div>
</div>

{{---------------------- View calendar -----------------------}}

<div class="modal" id="viewcalendar">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="height: 650px">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Calendar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body ">
        <div class="mb-5 pt-6  ">

          <div class="">
            <div id="calendar"></div>
        </div>


    </div>
    <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%" >
      <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>

    </div>
  </div>
</div>


</div>
@endsection



@section('scripts')
<script>
    $(document).ready(function (){

      deleteall();
        
        function deleteall () {
            if (window.location.href) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/billing/addtocart/deleteall",
                datatype: "json",
                success: function(response){ 
                }
            });
                
            }
        }


        $(document).on('click', '.patients', function(e){
          $('#viewpatients').modal('show');
        })

        $(document).on('click', '.calendar', function(e){
          $('#viewcalendar').modal('show');
        })

            //show data in edit form
            $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var appointcode = $(this).val();
            $('#edit').modal('show');
            $('#appointmentcode').val(appointcode);
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
    //        $.ajax({
    //             type: "PUT",
    //             url: "/admin/appointment/book/"+appointcode,
    //             data: appointcode,
    //             datatype: "json",
    //             success: function(response){ 
    //                console.log(response);
    //                $('.table').load(location.href+' .table');
           
    //     }
    // });
        });

            //update data from database
            $(document).on('click', '.update_appointment', function(e){
            e.preventDefault();
            var appointcode = $('#appointmentcode').val();
            var data ={
                _method: 'PUT',
                'servicename' : $('#edit_servicename').val(),
                'price': $('#edit_price').val(), 
            }
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            console.log(data);
            $.ajax({
                type: "PUT",
                url: "/admin/appointment/book/"+appointcode,
                data: appointcode,
                datatype: "json",
                success: function(response){ 
                   console.log(response);
                   $('.table').load(location.href+' .table');
        }
    });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var appointmentid = $(this).val();
            $('#delete').modal('show');
            $('#appointmentid').val(appointmentid);
        });

        $(document).on('click', '.delete_service', function(e){
            e.preventDefault();
            var sercode = $('#servicecode').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/appointment/delete/"+ sercode,
                data: sercode,
                datatype: "json",
                success: function(response){ 
                    
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('deleted successfully');
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                        $('.table').load(location.href+' .table');
        }
    });
        });

        $(document).on('click', '.select', function(e){
            e.preventDefault();
            var id = $(this).val();
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET",   
                url: "/admin/appointment/getuser/"+ id, 
                datatype: "json",
                success: function(response){ //return galing sa function sa controller
                  $('#userid').val(response.users[0].id);
                  $('#fullname').val(response.fullname[0].fullname);
                  $('#email').val(response.users[0].email);
                  $('#mobile_number').val(response.users[0].mobileno);
                  $('#viewpatients').modal('hide');
                  console.log(response);
        }
    });
        });

        //-------------------- View Calendar --------------------//

    
    
    //show calendar
        var calendar = $('#calendar').fullCalendar({
            height:470,
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month'
            },
            events:'/admin/appointment',
            selectable:true,
            contentHeight:"auto",
            selectHelper: true,
            select:function(start, end, allDay)
            {
                // var title = prompt('Event Title:');
                    var date = $.fullCalendar.formatDate(start, 'MM-DD-YYYY');
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
                    $.ajax({
                        url:"/admin/appointment/Calendar-fetch",
                        type:"Get",
                        datatype: "json",
                        data:{
                            date: start,
                        },
                        success:function(response)
                        {   
                          // console.log(response.working_hours);
                          $('#date').html();
                          $('#date').val(date);
                          $('#viewcalendar').modal('hide');
                          $('#time').html('<option value="">-- select time --</option>')
                          console.log(response.working_hours.length);
                          if(response.working_hours.length > 0){
                            $.each(response.working_hours, function(index, val){
                            $('#time').append('<option value="'+val.from+'">'+val.from+'</option>')
                          });
                          }else{
                            $('#time').append('<option value="">-- no available time --</option>')
                          }
                       
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
    
        // $('#date').on('keyup', function(e){
        //         e.preventDefault();
        //         var usertype = $('#date').val();
        //         console.log(usertype);
        //         $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //     });
      
        //     })
        


});
</script>

@endsection
