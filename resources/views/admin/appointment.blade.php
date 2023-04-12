@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>Appointment  </h1>
</div>   

<div id="success" class="success alert alert-success" role="alert" style="display:none">
  <p id="message-success">sdfsdf</p> 
</div>


<div class="main-spinner" style="
	  position:fixed;
		width:100%;
		left:0;right:0;top:0;bottom:0;
		background-color: rgba(255, 255, 255, 0.279);
		z-index:9999;
		display:none;"> 
	<div class="spinner">
		<div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
		  <span class="visually-hidden">Loading...</span>
		</div>
	    </div>
</div>	

<div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
	<div class="me-auto">
	<i class="fa fa-search"></i>
	  <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" > 
	</div>
    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 show-create" >
	create
    </button>
    </div>

    

<div class="card"  style="background:#EDDBC0;border:none; " >
	<div class="table-appointment" style="padding: 0%" >
	  <div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
		<table class="table table-bordered table-striped "  style="background-color: white" >
		    <thead>
			  <tr>
				<th>id</th>
				<th>Patient Id</th>
				<th>Fullname</th>
				<th>Date</th>
				<th>Time</th>
				<th>Service</th>
				<th>Price</th>
				<th>Status</th>
				<th style="width: 230px">Action</th>
			  </tr>
		    </thead>
		    <tbody class="error">
			@if (count($appointments)> 0 )
			@foreach ($appointments as $appointment)
			<tr class="overflow-auto">
			  <td>{{$appointment->id}}</td>
			    <td>{{$appointment->user_id}}</td>
			    <td>{{$appointment->fullname}}</td>
			     <td>{{date('m/d/Y', strtotime($appointment->date))}}</td>
			     <td>{{date('h:i A', strtotime($appointment->time))}}</td>
			     <td>{{$appointment->service}}</td>
			     <td>{{$appointment->price}}</td>
			     <td>{{$appointment->status}}</td>
			    <td style="text-align: center">
			    <button type="button" value="{{$appointment->id}}" id="accept" class="accept btn btn-success btn-sm">Accept</button>
			    <button type="button" value="{{$appointment->id}}" id="cancel" class="cancel btn btn-primary btn-sm">Cancel</button>
			    <button type="button" value="{{$appointment->id}}" class="delete btn  btn-danger btn-sm">Delete</button></td>
			</tr>
			@endforeach
			@else
			<tr>
			  <td colspan="9" style="text-align: center;">No appointment Found</td>
		  
			</tr>
			@endif
			 
		    </tbody>
		</table>
	 
	
	  </div>
	  <div class="">
	    {!! $appointments->links() !!}
	 </div>
	</div>
    </div>

  

{{-- create --}}
<div class="modal fade create-form" id="create-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: Poppins;">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #EDDBC0;">
      <div class="modal-header" style="border-bottom-color: gray">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Create Appointment</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div class="modal-body">
          <div class="mb-5 pt-6  ">
              <div class=" columns-1 sm:columns-2 create-refresh" >
                <input class="userid" id="userid"  type="text" hidden> 
                <input class="gender" id="gender"  type="text" hidden > 
                <input class="modal-status" id="modal-status"  type="text" hidden> 
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Name</label><br>
              <input class=" fullname  rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="fullname" style="width:390px" readonly type="text"> 
              <button class="patients btn btn-outline-success" style="border: 1px solid #829460;"><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 20px ;
                width: 20px ;" alt="" ></button>
              <br>
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5   text-danger" id="error_user"></span>
            </div>
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Date</label><br>
              <input class="date rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="date" style="width:390px" type="text" readonly> 
              <button class="calendar btn btn-outline-secondary"><img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" style="height: 20px ;
                width: 20px ;" alt=""></button>
              <br>
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5   text-danger" id="error_date"></span>
            </div>
     
              <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Available time:</label><br>
             <select class=" available-time  rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="available-time" style="width:435px">
              <option value="">-- select time --</option>
              <option value="">No avilable time</option>
             </select>
            <br>
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5   text-danger" id="error_time"></span>
          </div>
     
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Services</label><br>
          <input class="servicename" id="servicename"  type="text" hidden > 
          <select class=" service  rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="service" style="width:435px" >
            <option value="">-- select services --</option>
            @foreach ($services as $service)
                <option value="{{$service->servicecode}}">{{$service->servicename}}</option>
            @endforeach
           </select>
          <br>
          <div class="mt-0 mb-2">
            <span  role="alert" class="block mt-5   text-danger" id="error_service"></span>
        </div>

        <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Price</label><br>
        <input class="price  rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="price" style="width:435px" readonly type="text"> 
        </div>
      </div>
      <div class="modal-footer" style="border-top-color: gray">
        <button type="button" class=" close " style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
        <button class=" store_appointment" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Add</button>
      </div>
    </div>
  </div>
</div>
</div>

  {{-- accept confirmation --}}
  <div class="modal fade" id="accept-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: #EDDBC0;"> 
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Accept Confirmation </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" id="appointmentcode" hidden>
                <h5>Do you want to accept this appointnment?</h5>
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          {{-- <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_appointment p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button> --}}
          <button type="button" class="  "style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
          <button class=" update_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Accept</button>
        </div>
      </div>
    </div>
  </div>
</div>

  {{-- cancel confirmation --}}
  <div class="modal fade" id="cancel-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Book </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" id="appointmentcode" hidden>
                <h5>Do you want to cancel this appointnment?</h5>
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button type="button" class=" close btn btn-secondary"  style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
          {{-- <button class=" cancel_appointment p-2 w-30 bg-[#829460]  mt-7 rounded" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; "  >Cancel</button> --}}
          <button class=" update_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
    

{{-- //delete modal --}}

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:5%;">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #EDDBC0;">
      <div class="modal-header" style="border-bottom-color: gray">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-5 pt-6  ">
              <div class=" columns-1 sm:columns-2">
                  <input type="text" hidden id="appointmentid">
              <h6>Do you want to delete this data?</h6>
      </div>
      </div>
      <div class="modal-footer" style="border-top-color: gray">
        <button type="button" class=" close " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
        <button class=" delete_appointment " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>

{{--------------- View patients ---------------------}}

<div class="modal fade viewpatients " id="viewpatients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content viewbody" style="background: #EDDBC0;">

      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom-color: gray">
        <h4 class="modal-title">Patients</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body " >
        <i class="fa fa-search"></i>
        <input type="search" name="fullname_patient" id="fullname_patient" placeholder="search" style="font-family:Poppins;font-size:1.1vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; margin-bottom:10px"> 
    
        <div class="patient overflow-auto container-fluid" style="height:380px" >
          <table class="table table-bordered table-striped" >
  
              <thead>
                  <tr>
                      <th>id</th>
                      <th>First name</th>
                      <th>Middle name</th>
                      <th>Last name</th> 
                      <th>Address</th>
                      <th>Gender</th>
                      <th>Mobile no.</th>
                      <th>Email</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody class="nofound" >
                @if (count($patients) > 0)
                @foreach ($patients as $user)
                <tr class="overflow-auto">
             
                    <td>{{$user->id}}</td>
                    <td>{{$user->fname}}</td>
                    <td>{{$user->mname}}</td>
                    <td>{{$user->lname}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->mobileno}}</td>
                    <td>{{$user->email}}</td>
               
                    <td>
                    <button type="button" value="{{$user->id}}" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " class="select btn2 btn btn-primary ">Select</button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <div>
                    <td colspan="4" style="text-align: center;">no user Found</td>
                  </div>
                </tr>
                @endif
                 
              </tbody>
          </table>
          <div style="">
            {!! $patients->links() !!}
         </div>
        </div>
    <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97% ;border-top-color: gray" >
      <button type="button" class="  " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
    </div>
  </div>
    </div>
  </div>
</div>



{{---------------------- View calendar -----------------------}}

<div class="alert error-calendar alert-danger" role="alert" style="width:250px; right:25px; display:none;  position:fixed; z-index:9999;">
  <p id="message-error">sdfsdf</p> 
</div>



<div class="modal" id="viewcalendar">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content" style="height: 650px; background:#EDDBC0;">

      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom-color: gray">
        <h4 class="modal-title"  style="font-weight: 700;">Calendar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body ">
        <div class="mb-5 pt-6  ">

          <div class="">
            <div id="calendar"  style="background: #EDDBC0;"></div>
        </div>


    </div>
    <div class="modal-footer w-5 col-sm" style="position:absolute;justify-content:space-between ; bottom:1%; width:97% ;border-top-color: gray" >
      <table>
      <td class="border-end border-dark" style="justify-content: center; padding-right:10px; padding-top:20px"> 
        <p>
         <b>Legends:</b> 
        </p>
   
      </td>
      <td style="text-align: center; "  >
        <div class="col-sm" style="text-align: center; margin-left:5px; margin-right:5px;" >
          <p style="margin-bottom: 10px ">Available day</p>
          <div  style="height: 30px;margin-left:30% ;width:30px; background-color:#829460; " >
          </div>
        </div>
      </td>

      <td >
        <div class="col-sm  justify-content-center" style="text-align: center; margin-right:5px;" >
          <p style="margin-bottom: 10px">Not available</p>
          <div  style="height: 30px;margin-left:30%  ;width:30px; background-color: #DDDDDD;  text-align: center;" >

          </div>
        </div>
      </td>

      <td>
        <div class="col-sm" style="text-align: center; " >
          <p style="margin-bottom: 10px">Date today</p>
          <div  style="height: 30px;margin-left:30% ;width:30px; background-color: white ;  text-align: center;" >

          </div>
        </div>
      </td>
    </table>
        {{-- <div class="col">
          <div>
            legends:
          </div>
      
        </div> --}}
      <button type="button" class=" " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal" data-bs-dismiss="modal">Close</button>
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

      // $('.pagination').addClass('');
      setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);

        var day_off = {!! json_encode($day_array) !!} ;
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#available-time').empty()
        $('#available-time').append('<option value="0" disabled selected></option>');

      deleteall();

      $('.show-create').on('click', function(e){
        e.preventDefault();
        $('.create-form').modal('show')
        $('#available-time').empty()
        $('#available-time').append('<option value="0" disabled selected></option>');
      })

      $(".create-form").on("hidden.bs.modal", function(e){
        e.preventDefault();
        $('.create-form').find('input').val("");
        $('.create-refresh').load(location.href+' .create-refresh');
        });

        $(".create-form").on("hidden.bs.modal", function(e){
        e.preventDefault();
       
        $('.patient').load(location.href+' .patient');
        });

        $(".viewpatients").on("hidden.bs.modal", function(e){
          e.preventDefault();
          $('.fullname_patient').val();
          $('.modal-status').val("");
        $('.patient').load(location.href+' .patient');
        });
        
        // -------------service --------------//
     
        $(document).on('change', '.service', function(e){
          e.preventDefault();
          var id = $(this).val();
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "Get",
                url: "/admin/appointment/get_appointment_service/"+id ,
                datatype: "json",
                success: function(response){ 
                    $('.servicename').val(response.service.servicename);
                    $('.price').val(response.service.price);
                }
            });
        })
        
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
          $('#modal-status').val('show')
        })

        $(".viewpatients").on("hidden.bs.modal", function(){
          $('#modal-status').val('');
        });
        
        $(document).on('click', '.calendar', function(e){
          $('#viewcalendar').modal('show');
        })

        //---------------store appointment--------------------------//
        $(document).on('click', '.store_appointment', function(e){
          e.preventDefault();
          var data ={
                'userid' : $('#userid').val(),
                'fullname': $('#fullname').val(),
                'date': $('#date').val(),
                'time': $('#available-time').val(),
                'service' : $('#servicename').val(),  
                'price': $('#price').val(),
            }
         
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "POST",
                url: "/admin/appointment/create/",
                data: data,
                datatype: "json",
                success: function(response){ 
                  if(response.status == 400){
                    $('#error_user, #error_time, #error_time' ).html("");
                        $.each(response.errors.userid, function (key, err_values){
                          $('#error_user').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.date, function (key, err_values){
                            $('#error_date').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.time, function (key, err_values){
                            $('#error_time').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.service, function (key, err_values){
                            $('#error_service').append('<span>'+err_values+'</span>');
                        })
                  }else{
                    
                        $('#message-success').text(response.message);
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                  
                        $('#create-form').modal('hide');
                        $('#create-form').find('input').val("");
                         $('.table-appointment').load(location.href+' .table-appointment');
                        $('.create-refresh').load(location.href+' .create-refresh');
                  }
                   
              
              }
          });
        })


            //show accept confirmation
            $(document).on('click', '.accept', function(e){
              // alert('hello');
            e.preventDefault();
            var status = "Booked";
            var appointcode = $(this).val();
            $('#appointmentcode').val(appointcode);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $.ajax({
                type: "GET",
                url: "/admin/appointment/status/"+appointcode,
                data: {status: status},
                datatype: "json",
                success: function(response){
                  if(response.status == 400){
                    $('#error').html();
                    $('#error').text('The appointment is already Booked');
                      $('#error').show();
                      setTimeout(function() {
                                $("#error").fadeOut(800);
                            }, 2000);
                  }else{
                   $('#accept-confirmation').modal('show');
                  }
        }
    });
        });

        $(document).on('click', '.cancel', function(e){
          e.preventDefault();
            var appointcode = $(this).val();
            $('#appointmentcode').val(appointcode);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $.ajax({
                type: "GET",
                url: "/admin/appointment/status/"+appointcode,
                data: {status: status},
                datatype: "json",
                success: function(response){
                  if(response.status == 400){
                    $('#error').html();
                    $('#error').text('The appointment is already cancelled');
                      $('#error').show();
                      setTimeout(function() {
                                $("#error").fadeOut(800);
                            }, 2000);
                  }else{
                   $('#cancel-confirmation').modal('show');
                  }
        }
    });
        })

            //update data from database
            $('.update_appointment').on('click', function(e){
            e.preventDefault();
            var appointcode = $('#appointmentcode').val();
            var status = "Booked"
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "PUT",
                url: "/admin/appointment/change_status/"+appointcode,
                datatype: "json",
                data: {status:status},
                beforeSend: function(){
                  $('#accept-confirmation').modal('hide');
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){ 
                  $('#success').html();
                    $('#success').text('Booked successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
               
                   $('.table-appointment').load(location.href+' .table-appointment');
        }
    });
        });

        $('.cancel_appointment').on('click', function(e){
            e.preventDefault();
            var status = "Cancelled"
            var appointcode = $('#appointmentcode').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: "PUT",
                url: "/admin/appointment/change_status/"+appointcode,
                data: {status:status},
                datatype: "json",
                beforeSend: function(){
                  $('#cancel-confirmation').modal('hide');
                    $(".spinner").show();
                },
                complete: function(){
                    $(".spinner").hide();
                },
                success: function(response){ 
                  $('#success').html();
                    $('#success').text('Cancel successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                   $('.table-appointment').load(location.href+' .table-appointment');
        }
    });
        });
 
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var appointmentid = $(this).val();
            $('#delete').modal('show');
            $('#appointmentid').val(appointmentid);
        });

        $(document).on('click', '.delete_appointment', function(e){
            e.preventDefault();
            var appointmentid = $('#appointmentid').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/appointment/delete/"+ appointmentid,
                datatype: "json",
                success: function(response){ 
                  $('#message-success').text('');
                  $('#message-success').text('Deleted successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                  
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                        $('.table-appointment').load(location.href+' .table-appointment');
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
                  $('#gender').val(response.users[0].gender);
                  $('#viewpatients').modal('hide');
            
        }
    });
        });

        //-------------------- View Calendar --------------------//

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
           
            color: 'red',
            contentHeight:"auto",
            selectHelper: true,
            viewRender: function(view, element,) {
      if(day_off.includes("0")){
              $('.fc-day.fc-sun').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-sun').css('backgroundColor', '#829460');
      }

      if(day_off.includes("1")){
              $('.fc-day.fc-mon').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-mon').css('backgroundColor', '#829460');
      }

      if(day_off.includes("2")){
              $('.fc-day.fc-tue').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-tue').css('backgroundColor', '#829460');
      }

      if(day_off.includes("3")){
              $('.fc-day.fc-wed').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-wed').css('backgroundColor', '#829460');
      }

      if(day_off.includes("4")){
              $('.fc-day.fc-thu').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-thu').css('backgroundColor', '#829460');
      }

      if(day_off.includes("5")){
              $('.fc-day.fc-fri').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-fri').css('backgroundColor', '#829460');
      }

      if(day_off.includes("6")){
              $('.fc-day.fc-sat').css('backgroundColor', '#D9D9D9');
      }else{
        $('.fc-day.fc-sat').css('backgroundColor', '#829460');
      }

      $('.fc-day.fc-today').css('backgroundColor', 'white');
    },

    select:function(start, end, allDay)
      {
        var startDate = moment(start);
                date = startDate.clone();
           
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                    const dayOfWeek = $.fullCalendar.moment(date).day();
                    
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
                            start: start,
                        },
                        beforeSend: function(){
                        $('#accept-confirmation').modal('hide');
                            $(".main-spinner").show();
                        },
                        complete: function(){
                            $(".main-spinner").hide();
                        },
                        success:function(response)
                        {   
                         
                          $('#date').val("");
                          $('#available-time').empty();
                          $('#available-time').append('<option value="0" disabled selected></option>');
                          if(response.status == "405"){
                                $('#message-error').text(response.message);
                            $(".error-calendar").show();
                            setTimeout(function() {
                                $(".error-calendar").fadeOut(500);
                            }, 3000);
                            
                            }else{
                           
                          $('#date').val(start);
                              $('#viewcalendar').modal('hide');
                                $('#date').val(response.date);
                                $('#form-dateselected').val(response.date);
                                $.each(response.available_time, function(index, val){ 
                                    $("#available-time").append("<option value='"+val+"'>"+val+"</option>");
                                } )
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
        
                     //pagination
            $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
            let status = $('#modal-status').val()

            if( status == "show" ){
              let page = $(this).attr('href').split('patient=')[1]
              patient(page);
            }else{
                let page = $(this).attr('href').split('appointment=')[1]
              appointment(page);
            }
        });

        function patient(page){
          let data = page;
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
              $.ajax({
                type: "GET",  
                url: "/admin/modal_patient/pagination/paginate-data?patient="+page ,
                data: {data: data}, 
                datatype: "json",
                success: function(response){
                  console.log(response);
                $('.patient').html(response);
                  }
              });
        }

        
        function appointment(page){
          let data = page;
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
       
              $.ajax({
                type: "GET",  
                url: "/admin/appointment/pagination/paginate-data?appointment="+page ,
                data: {data: data}, 
                datatype: "json",
                success: function(response){
            
                $('.table-appointment').html(response);
                  }
              });
        }

        $('#appointment_name').on('keyup', function(e){
          e.preventDefault();
          let search = $('#appointment_name').val();
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/appointment/search-name',
            method:'GET',
            data: {search:search,},
            success:function(response){
              $('.table-appointment').html(response);
              if(response.message == 'Nofound'){

                $('.table-appointment').append('<div class="card-body" style="width:100%; height:68vh; overflow-x: auto;  font-size: 15px;">\
                                      <div class="" style="width:100%; ">\
                                        <table class="table table-bordered table-striped ">\
                                            <thead>\
                                                <tr>\
                                                    <th>id</th>\
                                                    <th>Patient Id</th>\
                                                    <th>Fullname</th>\
                                                    <th>Date</th>\
                                                    <th>Time</th>\
                                                    <th>Service</th>\
                                                    <th>Price</th>\
                                                    <th>Status</th>\
                                                    <th style="width: 205px">Action</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody >\
                                              <tr>\
                                                <td colspan="9" style="text-align: center;">No appointment Found</td>\
                                              </tr>\
                                            </tbody>\
                                        </table>\
                                      </div>\
                                    </div>');
               }
            }
          });
        })

        $('#fullname_patient').on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname_patient').val();
          // console.log(search);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/modal_profile/search-name',
            method:'GET',
            data: {search:search,},
            success:function(response){
              console.log(response);
             
              $('.patient').html(response);
              if(response.message == 'Nofound'){       
                $('.patient').append('<table class="table table-bordered table-striped" >\
                                                            <thead>\
                                                                <tr>\
                                                                    <th>id</th>\
                                                                    <th>First name</th>\
                                                                    <th>Middle name</th>\
                                                                    <th>Last name</th> \
                                                                    <th>Birthday</th>\
                                                                    <th>Address</th>\
                                                                    <th>Gender</th>\
                                                                    <th>Mobile no.</th>\
                                                                    <th>Email</th>\
                                                                    <th>Action</th>\
                                                                </tr>\
                                                            </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="10" style="text-align: center;">no user Found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>');
               }
            }
          });
        })


});
</script>

@endsection
