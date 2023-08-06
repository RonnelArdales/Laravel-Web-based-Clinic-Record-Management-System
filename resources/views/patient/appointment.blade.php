@extends('layouts.patient_navbar')
@section('content')
<div >
    <div class="alert error alert-danger" role="alert" style="width:250px; right:25px; display:none;  position:fixed">
        <p id="message-error"></p> 
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
        <div style="background-color:#DDDDDD ;  height:150px; width:100%" class="d-flex justify-content-center">
        {{-- <img style="width:90%;" src="{{url('guestpage/appointment.jpg')}}" alt=""> --}}
            <img style="width:100%; height:150px" src="{{url('guestpage/appointment_header.png')}}" alt="">
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
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                                <input type="hidden" id="discountcode">
                                <h4>Are you sure you want to continue?</h4>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close " style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">No</button>
                        <form action="{{route('appointment.create')}}" method="GET">
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
       var day_off = {!! json_encode($day_array) !!} ;
        var date_off = {!! json_encode($date_array) !!} ;
        var walkin = {!! json_encode($walkin_array) !!} ;
</script>

@vite('resources/js/user/appointment.js')

@endsection