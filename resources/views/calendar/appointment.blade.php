@extends('layouts.patient_navbar')
@section('content')
<div >
    <div class="alert error alert-danger" role="alert" style="width:250px; right:25px; display:none;  position:fixed">
        <p id="message-error">sdfsdf</p> 
      </div>
      @if (session('success'))
      <div class="alert success alert-success" role="alert" style="width:250px; right:25px;  position:fixed">
        <p id="message-error"> {{ session('success') }}</p> 
      </div>
  @endif
    
      <div class="main-spinner" style="
	    position:fixed;
		width:100%;
		left:0;right:0;top:0;bottom:0;
		background-color: rgba(255, 255, 255, 0.279);
		z-index:9999;
		display:none;
   	"> 
	<div class="spinner">
		<div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
		  <span class="visually-hidden">Loading...</span>
		</div>
	    </div>
</div>	
    <div>
        <div style="background-color:#DDDDDD ;  height:150px" class="d-flex justify-content-center">
           <img style="width:90%;" src="{{url('guestpage/appointment.jpg')}}" alt="">
        </div>
        
        <div class="container" style="margin-top: 20px; margin-bottom:20px"> 
            Home >> <b>BOOK NOW</b>
        </div>
        
        <div class="container ">
            <div class="row"  >
                <p style="margin-bottom:5px">Click your preffered Date to view availability</p>
                <div   style="padding:0px; width:1100px" >

                    <div class="" style=" background-color: #EDDBC0; margin-left:15px; margin-right:15px" id="calendar"></div>
                    
                </div>    
                <div class="col-sm" style="margin-left: 20px"  >
                    <div >
                        {{-- justify-content-center  --}}
                        <h2>Legends:</h2>
                        <hr class="line">
        
                        <div class="row  d-flex  align-items-center" style="margin-left:12px">
                            <div style="background-color: #cc6666; height:50px; width:50px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Not Available.
                        </div>
                        <div class="row  d-flex  align-items-center" style="margin-left:12px; margin-top:10px">
                            <div style="background-color: #829460 ; height:50px; width:50px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Available day.
                        </div>
                        <div class="row  d-flex  align-items-center" style="margin-left:12px; margin-top:10px">
                            <div style="background-color: white ; height:50px; width:50px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Date Today.
                        </div>
              
                    </div>
                
                </div>
            
            </div>
        </div>

    </div>

    <div class="container" style=" margin-bottom:60px; margin-top:10px">
        <div class="row">
            <p style="margin-bottom:20px; margin-top:25px">Please, complete the appointment details below to continue.</p>
            <div class="rounded   col-sm-9 row" style=" padding:30px; margin:0px; background: #EDDBC0;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">  
                <div class="col-sm " >
                    <label style="color: red; margin-bottom:15px"  for="">Please note: There will be a non-refundable reservation fee of 500.</label>
                    <div class="form-group">
                        <label for="">Date selected:</label><br>
                        <input type="text" class="date rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:20vw" readonly id="date">
                      </div>
    
                      <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputEmail1">Time selected:</label><br>
                        <select name="" id="available-time" class="rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;width:20vw" >
                            <option value="">--select--</option>
                        </select>
                      </div>
                        
                      <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px">
                      
                            <p style="margin-bottom: 4px">    <input type="checkbox" style="margin-right: 10px"  name="" id="agree">I agree to the<button type="button" data-bs-toggle="modal" data-bs-target="#privacy"class="logoutbutton" style="outline: none" ><strong>Terms Condition & Privacy Policy </strong> of the clinic</button></p>
                            <x-privacyact/>
                      
                            <button  class="appointment-confirm" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px; height: 37px; margin-bottom:10px ">Submit</button>
                      </div>
                </div>


            
      
        </div>
        <div class="col-sm  " style=" padding:0px">
          {{-- <button id="refresh-calendar">Refresh Calendar</button> --}}
        </div>
    </div>

  
</div>

<div class="modal fade" id="appointment-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">HOLD ON!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="hidden" id="discountcode">
                <h6>Are you sure you want to continue?</h6>

        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button type="button" class=" close " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
          <form action="/patient/billing/payment" method="GET">
            @csrf
            <input type="text" hidden name="date" id="form-dateselected">
            <input type="text" hidden name="time"id="form-timeselected">
            {{-- <input type="text" hidden name="servicecode"  id="form-servicecode">
            <input type="text" hidden name="servicename"  id="form-servicename"> --}}
          <button type="submit" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Yes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="errormodal" tabindex="-1" role="alert" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #EDDBC0;">
      <div class="modal-header" style="border-bottom-color: #EDDBC0;">
      </div>
      <div class="modal-body">
          <div class="mb-5 mt-5  ">
              <div class=" columns-1 sm:columns-2">
              <h3   id="errormessage"  style="text-align: center" ></h3>
      </div>
      </div>
      <div class="modal-footer" style="border-top-color: gray">
        <button class="cancel_appointment "  data-bs-dismiss="modal"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Close</button>
      </div>
    </div>
  </div>
</div>
</div>

</div>

<script>

    $(document).ready(function () {

      // $('#refresh-calendar').click(function() {
      //       $('#calendar').fullCalendar('refetchEvents');
      //   });

        setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);

        var day_off = {!! json_encode($day_array) !!} ;
        var walkin = {!! json_encode($walkin_array) !!} ;

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
      }else{
        $('.fc-day.fc-sun').css('backgroundColor', '#829460');
      }

      if(day_off.includes("1")){
              $('.fc-day.fc-mon').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-mon').css('backgroundColor', '#829460');
      }

      if(day_off.includes("2")){
              $('.fc-day.fc-tue').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-tue').css('backgroundColor', '#829460');
      }

      if(day_off.includes("3")){
              $('.fc-day.fc-wed').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-wed').css('backgroundColor', '#829460');
      }

      if(day_off.includes("4")){
              $('.fc-day.fc-thu').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-thu').css('backgroundColor', '#829460');
      }

      if(day_off.includes("5")){
              $('.fc-day.fc-fri').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-fri').css('backgroundColor', '#829460');
      }

      if(day_off.includes("6")){
              $('.fc-day.fc-sat').css('backgroundColor', '#cc6666');
      }else{
        $('.fc-day.fc-sat').css('backgroundColor', '#829460');
      }

      $('.fc-day.fc-today').css('backgroundColor', 'white');
    },



    dayRender: function (date, cell) {

    var currentDate = moment();

    if (date.isSame(currentDate, 'day')) {
      cell.addClass('fc-state-disabled');
    }
  },
    
    select:function(start, end, allDay)
            {
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



           if(formattedDate == start){
            // $('#message-error').text("Sorry you cannot book this date");
            //                 $(".error").show();
            //                 setTimeout(function() {
            //                     $(".error").fadeOut(500);
            //                 }, 3000);

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
                        success:function(response)
                        {   
                            $('#date').val("");
                            $('#available-time').empty()
                            $('#available-time').append('<option value="0" disabled selected></option>')
                            if(response.status == "405"){
                            //     $('#message-error').text(response.message);
                            // $(".error").show();
                            // setTimeout(function() {
                            //     $(".error").fadeOut(500);
                            // }, 3000);

                            // Swal.fire({
                            //       title: 'error!',
                            //       text: response.message,
                            //       icon: 'error',
                            //       confirmButtonText: 'OK',
                            //       confirmButtonColor: '#829460',
                            //       confirmButtonBorder: '#829460',
                            //   });
                        
                            $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text(response.message);
                            
                            
                            }else{
                            
                                $('#date').val(response.date);
                                $.each(response.available_time, function(index, val){ 
                                    $("#available-time").append("<option value='"+val+"'>"+val+"</option>");
                                } )
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

        function getdiscount(){
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                        url:"/discount",
                        datatype: "json",
                        success:function(response){
                            $('#discount').empty();
                            $('#discount').append('<option value="none" >--select--</option>');
                            $.each(response.discount, function(index, val){
                                    $("#discount").append("<option value='"+val.discountcode+"'>"+val.discountname+"</option>");
                                } );
                        }
                    });
        }
 
        $('#services').on('change', function(){
            var id = $(this).val();
            $('#servicename').val("");
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
                    $.ajax({
                        url:"/getservice/"+id,
                        datatype: "json",
                        data:{
                        },
                        success:function(response){
                            $('#servicename').val("");
                            $('#servicename').val(response.service.servicename );
                        }
                    });
                 
        })

        $('.appointment-confirm').on('click', function(){
            var date = $('.date').val();
            var time = $("#available-time").val();
            var services = $('#services').val();
            if($('#agree').is(":checked")){
                  if(date.length === 0 ){
                    // $(".error").hide();
                    // $('#message-error').text("Please select date in calendar");
                    // $(".error").show();
                    // setTimeout(function() {
                    //         $(".error").fadeOut(500);
                    // }, 3000);   
                    // Swal.fire({
                    //               title: 'Error!',
                    //               text: 'Please select date in calendar.' ,
                    //               icon: 'error',
                    //               confirmButtonText: 'OK',
                    //               confirmButtonColor: '#829460',
                    //               confirmButtonBorder: '#829460',
                    //           });

                    $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text('Please select date in calendar.');
                            
                            
                    
                  }else if(time == null){
                    // $(".error").hide();
                    // $('#message-error').text("Please select available time");
                    // $(".error").show();
                    // setTimeout(function() {
                    //         $(".error").fadeOut(500);
                    // }, 3000); 
                    // Swal.fire({
                    //               title: 'Error!',
                    //               text: 'Please select available time.' ,
                    //               icon: 'error',
                    //               confirmButtonText: 'OK',
                    //               confirmButtonColor: '#829460',
                    //               confirmButtonBorder: '#829460',
                    //           });

                    
                    $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text('Please select available time.');
                    
                  }else{
                    $('#form-dateselected, #form-timeselected').val("");
                    $('#form-dateselected').val($('#date').val());
                    $('#form-timeselected').val($('#available-time').val());
                    $('#appointment-confirmation').modal('show');
                  }
            }
            else{
                // $(".error").hide();
                // $('#message-error').text("Please read and accept the terms and condition to proceed.");
                // $(".error").show();
                // Swal.fire({
                //                   title: 'Error!',
                //                   text: 'Please read and accept the terms and condition to proceed.' ,
                //                   icon: 'error',
                //                   confirmButtonText: 'OK',
                //                   confirmButtonColor: '#829460',
                //                   confirmButtonBorder: '#829460',
                //               });
                // setTimeout(function() {
                //         $(".error").fadeOut(500);
                // }, 3000);      
                  
                $('#errormodal').modal('show');
                            $('#errormessage').text(" ");
                            $('#errormessage').text('Please read and accept the terms and condition to proceed.');
                            
                            
            }

        });
    
    });
      
    </script>

@endsection