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
        <div style="background-color:#DDDDDD ; width:100%; height:150px" class="d-flex justify-content-center">
            <h3>no image</h3>
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
                            <div style="background-color: #DDDDDD; height:50px; width:50px; margin-right:5px  "  class="border border-dark">
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

    <div class="container" style=" margin-bottom:20px; margin-top:10px">
        <div class="row">
            <p style="margin-bottom:5px">Please, complete the appointment details below to continue.</p>
            <div class="rounded  border border-dark col-sm-9 row" style=" padding:30px; margin:0px ">  
                <div class="col-sm " >
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
    
                      <div class="form-group" style="margin-top:15px">
                        <label for="exampleInputEmail1">Available services:</label><br>
                        <select name="" id="services" class="rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:20vw" >
                            <option value=""></option>
                            @foreach ($services as $service)
                            <option value="{{$service->servicecode}}">{{$service->servicename}}</option>
                            @endforeach
                        </select>
                      </div>
    
                      <div class="form-group" style="margin-top:15px">
                        <label for=""> price:</label><br>
                        <div class="currency-wrap">
                            <span class="currency-code">₱</span>
                            <input readonly type="number" class="text-currency rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" placeholder="0.00"  style="background: #D0B894;"  id="price" name="doctorfee"/>
                        </div>
                        {{-- <input type="text" class="rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="price"  readonly> --}}
                      </div>
                </div>

                <div class="col-sm" >
                    <div class="form-group" >
                        <label for="">Mode of payment:</label><br>
                        <select name="" id="mode-of-payment"  class="rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:20vw" >
                            <option value="">--select--</option>
                            <option value="gcash">gcash</option>
                            <option value="cash">cash</option>
                        </select>
    
                      <div class="form-group" style="margin-top:15px">
                        <label for="">Discount:</label><br>
                  
                            <select name="" id="discount" class="rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:20vw" >
                                <option value="">--select--</option>
                                @foreach ($discounts as $discount)
                                <option value="{{$discount->discountcode}}">{{$discount->discountname}}</option>
                                @endforeach
                            </select>
                   
                      </div>
    
                      <div class="form-group" style="margin-top:15px">
                        <label for="">Total Price</label><br>
                        <div class="currency-wrap">
                            <span class="currency-code">₱</span>
                            <input readonly type="number" style="background: #D0B894;" class="text-currency rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" placeholder="0.00" style="background: #D0B894;" id="total-price" />
                        </div>
                        {{-- <input type="text" class="rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="total-price"  readonly> --}}
                      </div>

                      <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px">
                        <button  class="appointment-confirm" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px; height: 37px; ">Submit</button>
                    
                            <p>    <input type="checkbox" style="margin-right: 10px"  name="" id="agree">I agree to the<button type="button" data-bs-toggle="modal" data-bs-target="#privacy"class="logoutbutton" style="outline: none" ><strong>Terms Condition & Privacy Policy </strong> of the clinic</button></p>
                            <x-privacyact/>
                      
                      </div>
              
                </div>
           

            </div>
            
      
        </div>
        <div class="col-sm  border border-dark" style=" padding:0px">

        </div>
    </div>

  
</div>

<div class="modal fade" id="appointment-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalCenter">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">HOLD ON!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="hidden" id="discountcode">
                <h6>Are you sure you want to continue?</h6>
         
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="/patient/billing/payment" method="get">
            @csrf
            <input type="text" name="date" hidden id="form-dateselected">
            <input type="text" name="time" hidden id="form-timeselected">
            <input type="text" name="service_code" hidden  id="form-servicecode">
            <input type="text" name="service" hidden  id="form-services">
            <input type="text" name="price" hidden id="form-price">
            <input type="text" name="mode_of_payment" hidden id="form-modepayment">
            <input type="text" name="discount" hidden id="form-discount">
            <input type="text" name="total_price" hidden id="form-totalprice">
          <button type="submit" class=" p-2 w-30 bg-[#829460]  mt-7 rounded">Yes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>

    $(document).ready(function () {
    
        setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);

        var day_off = {!! json_encode($day_array) !!} ;
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

    // eventRender: function(event, element) {
    //     // if (event.start.format('w') ==  1 ) { // check if it's your specific date
    //     //     // element.css('backgroundColor', 'black'); // change the background color
    //     //     //       $('.fc-day.fc-sat').css('backgroundColor', 'red');
    //     // alert();
    //     // }
    // },
    
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
                            $('#available-time').empty()
                            $('#available-time').append('<option value="0" disabled selected></option>')
                            if(response.status == "405"){
                                $('#message-error').text(response.message);
                            $(".error").show();
                            setTimeout(function() {
                                $(".error").fadeOut(500);
                            }, 3000);
                            
                            }else{
                                $('#date').val(response.date);
                                $('#form-dateselected').val(response.date);
                                $.each(response.available_time, function(index, val){ 
                                    $("#available-time").append("<option value='"+val+"'>"+val+"</option>");
                                } )
                            }
                        }
                    })
            },
        });

        $('#available-time').on('change', function(){
            var time = $(this).val();
            $('#form-timeselected').val(time);
        });

        $('#mode-of-payment').on('change', function(){
            var mode = $(this).val();
            $('#form-modepayment').val(mode);
        });

        $('#services').on('change', function(){
            var id = $(this).val();
            
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
                             $('#price').val(response.service.price + '.00' );
                             $('#total-price').val(response.service.price + '.00');

                             //----form----//
                             $('#form-servicecode').val(id);
                             $('#form-services').val(response.service.servicename );
                             $('#form-price').val(response.service.price);

                        }
                    });
                    $.ajax({
                        url:"/discount",
                        datatype: "json",
                        success:function(response){
                            $('#discount').empty();
                            $('#discount').append('<option value="" >--select--</option>');
                            $.each(response.discount, function(index, val){
                                    $("#discount").append("<option value='"+val.discountcode+"'>"+val.discountname+"</option>");
                                } );
                        }
                    });
        })

        $('#discount').on('change', function(){

            var id = $(this).val();
            let price = parseInt($('#price').val(), 10);

            if(id.length === 0 ){
           
                $('#total-price').val(price);
                //-----form--------//
                $('#form-totalprice').val(price);
            }else{
                $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
                });

                $.ajax({
                        url:"/getdiscount/"+id,
                        datatype: "json",
                        data:{
                        },
                        success:function(response)
                        {   
                          
                            var percentage = response.discount.percentage;
                            let discount = (percentage/100);
                            let sub_total = price - (price * discount)
                            $('#total-price').val(sub_total + '.00');

                            //-----form--------//

                            $('#form-discount').val(response.discount.discountname);
                            $('#form-totalprice').val(sub_total);
                            
                        }
                    })
            }
     
            
             
        });

        $('.appointment-confirm').on('click', function(){
            var date = $('.date').val();
            var time = $("#available-time").val();
            var services = $('#services').val();
            var mop = $('#mode-of-payment').val();
            if($('#agree').is(":checked")){
                  if(date.length === 0 ){
                    $(".error").hide();
                    $('#message-error').text("Please select date in calendar");
                    $(".error").show();
                    setTimeout(function() {
                            $(".error").fadeOut(500);
                    }, 3000);   
                  }else if(time == null){
                    $(".error").hide();
                    $('#message-error').text("Please select available time");
                    $(".error").show();
                    setTimeout(function() {
                            $(".error").fadeOut(500);
                    }, 3000); 
                  }else if(services.length === 0){
                    $(".error").hide();
                    $('#message-error').text("Please select services");
                    $(".error").show();
                    setTimeout(function() {
                            $(".error").fadeOut(500);
                    }, 3000); 
                  }else if(mop.length === 0){
                    $(".error").hide();
                    $('#message-error').text("Please select mode of payment");
                    $(".error").show();
                    setTimeout(function() {
                            $(".error").fadeOut(500);
                    }, 3000); 
                  }
                  else{
                    $('#appointment-confirmation').modal('show');
                  }
            }
            else{
                $(".error").hide();
                $('#message-error').text("check the fucking checkbox");
                $(".error").show();
                setTimeout(function() {
                        $(".error").fadeOut(500);
                }, 3000);        
            }

        });
    
    });
      
    </script>

@endsection