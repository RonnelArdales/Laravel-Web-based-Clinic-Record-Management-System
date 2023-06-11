@extends('layouts.admin_navigation')
@section('title', 'Appointment')
@section('content')
<div class="row m-4">

    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px" id="message-success">hello</p> 
    </div>

    <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
        <div class="me-auto col-md-8 col-md-offset-5">
            <h1> <b>APPOINTMENT</b> </h1>
        </div>

        <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 show-create" >
        Create
        </button>
    </div>

    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" style="color: black" id="home-tab" data-bs-toggle="tab" data-bs-target="#pending-appointment" type="button" role="tab" aria-controls="home" aria-selected="true">Pending Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab"  style="color: black" data-bs-toggle="tab" data-bs-target="#complete-appointment" type="button" role="tab" aria-controls="profile" aria-selected="false">Complete Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab"  style="color: black" data-bs-toggle="tab" data-bs-target="#cancelled-appointment" type="button" role="tab" aria-controls="profile" aria-selected="false">Cancelled Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab"  style="color: black" data-bs-toggle="tab" data-bs-target="#transaction-appointment" type="button" role="tab" aria-controls="profile" aria-selected="false">Transaction</button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        {{-- Tab panel for pending appointments --}}
        <div class="tab-pane fade show active" id="pending-appointment" role="tabpanel" aria-labelledby="home-tab">
            <div class="card"  style="background:#EDDBC0;border:none; " >
                <div class="table-appointment" style="padding: 0%" >
                    <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                        <table class="table table-bordered table-striped  "  id="pendings" style="background-color: white; width:100%; " >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th style="width:30px">Patient Id</th>
                                    <th>Fullname</th>
                                    <th style="width: 100px" >Contact no.</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th >Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="error">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab panel for complete appointments --}}
        <div class="tab-pane fade " id="complete-appointment" role="tabpanel" aria-labelledby="home-tab">
            <div class="card"  style="background:#EDDBC0;border:none; " >
                <div class="table-appointment" style="padding: 0%" >
                    <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                        <table class="table table-bordered table-striped  "  id="complete" style="background-color: white; width:100%" >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Patient Id</th>
                                    <th>Fullname</th>
                                    <th>Contact no.</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th style="min-width: 60px" >Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="error">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
      {{-- Tab panel for complete appointments --}}
        <div class="tab-pane fade" id="cancelled-appointment" role="tabpanel" aria-labelledby="home-tab">
            <div class="card"  style="background:#EDDBC0;border:none; " >
                <div class="table-appointment" style="padding: 0%" >
                    <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                        <table class="table table-bordered table-striped  "  id="cancel" style="background-color: white; width:100%" >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Patient Id</th>
                                    <th>Fullname</th>
                                    <th>Contact no.</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th style="min-width: 60px" >Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="error">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab panel for appointment transactions --}}
        <div class="tab-pane fade" id="transaction-appointment" role="tabpanel" aria-labelledby="home-tab">
            <div class="card"  style="background:#EDDBC0;border:none; " >
                <div class="table-appointment" style="padding: 0%" >
                    <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                        <table class="table table-bordered table-striped  "  id="transaction" style="background-color: white; width:100%" >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th >Patient Id</th>
                                    <th style="min-width: 120px">Fullname</th>
                                    <th>Date</th>
                                    <th style="min-width: 60px" >Time</th>
                                    <th style="min-width: 110px">Appointment method</th>
                                    <th style="min-width: 80px">Mode of payment</th>
                                    <th>Status</th>
                                    <th style="min-width: 55px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="error">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    {{-- create --}}
    <div class="modal fade create-form" id="create-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-family: Poppins;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Create Appointment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body">
                    <div class="mb-5 pt-6  ">
                        <div class=" columns-1 sm:columns-2 create-refresh" >
                            <input class="userid  refresh" id="userid"  type="text" hidden> 
                            <input class="contactno  refresh" id="contactno"  type="text"  hidden> 
                            <input class="email  refresh" id="email"  type="text" hidden > 
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Name</label><br>
                            <input class=" fullname   refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="fullname" style="width:390px" readonly type="text"> 
                            <button class="patients btn btn-outline-success" style="border: 1px solid #829460;"><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 20px ;
                                width: 20px ;" alt="" ></button>
                            <br>

                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_user"></span>
                            </div>

                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Date</label><br>
                            <input class="date  refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="date" style="width:390px" type="text" readonly> 
                            <button class="calendar btn btn-outline-secondary"><img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" style="height: 20px ;
                                width: 20px ;" alt=""></button>
                            <br>

                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_date"></span>
                            </div>
                    
                            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Available time:</label><br>
                            <select class=" available-time   refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="available-time" style="width:435px">
                            <option value="">-- select time --</option>
                            <option value="">No available time</option>
                            </select>
                            <br>

                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_time"></span>
                            </div>
                    
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Reservation fee</label><br>
                            <input readonly class="reservationfee  rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="reservationfee"  type="text" value="{{$fee->reservationfee}}" > 
                            <br>
                            <div class="mt-0 mb-2">
                            </div>

                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mode of payment</label><br>
                            <select name="mode_payment" id="mode_payment" class="  refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="width: 210px">
                            <option value="">--select--</option>
                            <option value="Cash">Cash</option>
                            @foreach ($mops as $mop)
                            <option value="{{$mop->modeofpayment}}">{{$mop->modeofpayment}}</option>
                            @endforeach
                            </select><br>

                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_modepayment"></span>
                            </div>

                            <div id="cash" style="display: none; margin-top: 10px">
                                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Payment</label><br>
                                <div class="currency-wrap-payment">
                                <span class="currency-code-payment">₱</span>
                                <input type="number" class=" refresh text-currency-payment" id="payment_cash" placeholder="0.00" class="payment_cash" name="payment_cash" value=""/>
                                </div>
                                <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_payment"></span>
                                </div>
                        
                                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Change</label><br>
                                <div class="currency-wrap-payment">
                                    <span class="currency-code-payment">₱</span>
                                    <input type="text" class=" refresh text-currency-payment" placeholder="0.00" readonly id="change" name="change" />
                                </div>
                            </div>

                            <div id="gcash" style="display:none; margin-top: 10px">
                                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" for="">Reference no:</label><br>
                                <input type="text" class="refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="reference_no" name="reference_no"><br>

                                <div class="mt-0 mb-2">
                                    <span  role="alert" class="block mt-5   text-danger" id="error_reference_no"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                        <button type="button" class=" " style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                        <button class=" store_appointment" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- accept confirmation --}}
    <div class="modal fade" id="complete-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
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
                            <input type="text" hidden id="appointmentcode">
                            <h5 style="font-size:19px">Are you sure you want to confirm this appointment?</h5>
                        </div>
                    </div>
                
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class="  "style="margin-right:15px ; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
                        <button class=" update_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- cancel confirmation --}}
    <div class="modal fade" id="cancel-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" hidden id="cancel_id">
                            <h4 style="font-size:19px"  >Are you sure you want to cancel this appointment?</h4>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close btn btn-secondary"  style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
                        <button class=" cancel_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Yes</button>
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
      <div class="modal-body " >
        <div class="patient patient-remove overflow-auto container-fluid" style="height:420px" >
          <table class="table table-bordered users table-striped" id="users"  style="background-color: white; width:100%" >

            <thead>
              <tr>
                  <th>Id</th>
                  <th>fullname</th>
                  <th>Gender</th>
                  <th>Age</th> 
                  <th >Action</th>
              </tr>
          </thead>
          <tbody class="nofound" >
          
          </tbody>

          </table>
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
          <div  style="height: 30px;margin-left:30%  ;width:30px; background-color: #cc6666;  text-align: center;" >

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

{{-------------- Reschedule appointment------------------}}
<div class="modal fade" id="reschedcalendar">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content" style="height: 650px; background:#EDDBC0;">

      <!-- Modal Header -->
      <div class="modal-header" style="border-bottom-color: gray">
        <h4 class="modal-title"  style="font-weight: 700;">Reschedule</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body ">
        <div class="mb-5 pt-6  ">

          <div class="container ">
            <div class="row"  >

                <div   style="padding:0px; width:800px" >
                  <p style="margin-bottom:5px">Click your preffered Date to view availability</p>
                    <div class="" style=" background-color: #EDDBC0; margin-left:15px; margin-right:15px" id="calendar_res"></div>
           
                </div>    
                <div class="col-sm" style="margin-left: 20px"  >
                    <div >
                        {{-- justify-content-center  --}}
                        <h3>Legends:</h3>
                        <hr class="line">
        
                        <div class="row  d-flex  align-items-center" style="margin-left:12px">
                            <div style="background-color: #cc6666; height:35px; width:35px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Not Available.
                        </div>
                        <div class="row  d-flex  align-items-center" style="margin-left:12px; margin-top:10px">
                            <div style="background-color: #829460 ;  height:35px; width:35px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Available day.
                        </div>
                        <div class="row  d-flex  align-items-center" style="margin-left:12px; margin-top:10px">
                            <div style="background-color: white ;  height:35px; width:35px; margin-right:5px  "  class="border border-dark">
                            </div>
                            Date Today.
                        </div>

                        <div class="row  d-flex  align-items-center" style="margin-left:12px; margin-top:25px">
                            <label style="padding-left: 0px" for="">Date selected:</label>
                            <input type="text" class="date refresh rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:250px" readonly id="resched_date">
                            <div class="mt-0 mb-1">
                              <span  role="alert" class="block   text-danger" id="error_resched_date"></span>
                          </div>
                            <br>
                            <label style="padding-left: 0px; margin-top:10px" for="">Time selected:</label>
                            <select name="" id="reschedtime" class="rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:250px" >
                              <option value="">--select--</option>
                          </select>

                          <div class="mt-0 mb-1">
                            <span  role="alert" class="block mt-5   text-danger" id="error_resched_tim"></span>
                        </div>

                          <input hidden type="text" class="refresh" id="reschedid">
                      </div>
                     

                      <div style="margin-top: 65px" class="row  d-flex  justify-content-center">

                        <button type="button" class=" " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; margin-right:10px" data-bs-dismiss="modal" data-bs-dismiss="modal">Close</button>

                        <button type="button" class="resched_button" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Reschedule</button>

                      </div>
                

                    </div>
                 
                
                </div>
            
            </div>
        </div>
         
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

        var day_off = {!! json_encode($day_array) !!} ;
        var date_off = {!! json_encode($date_array) !!} ;
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#available-time').empty()
        $('#available-time').append('<option value="0" disabled selected></option>');
        $('#reschedtime').empty()
        $('#reschedtime').append('<option value="0" disabled selected></option>');

        setTimeout(function() {
                                    $(".success").fadeOut(500);
                                }, 3000);
	
        var pendings = $('#pendings').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/appointment",
            dom: 'frtp',
            pageLength: 10,
            responsive: true,
            columns: [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false},
                {data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false},
                {data: 'email', name: 'email' , orderable: false, searchable: false},
                {data: 'date', name: 'date' , orderable: false, searchable: false},
                {data: 'time', name: 'time' , orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        var complete = $('#complete').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/complete-appointment",
            dom: 'frtp',
            pageLength: 10,
            responsive: true,
            columns: [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false},
                {data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false},
                {data: 'email', name: 'email' , orderable: false, searchable: false},
                {data: 'date', name: 'date' , orderable: false, searchable: false},
                {data: 'time', name: 'time' , orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
        });

        var cancel = $('#cancel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/cancelled-appointment",
            dom: 'frtp',
            pageLength: 10,
            responsive: true,
            columns: [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false},
                {data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false},
                {data: 'email', name: 'email' , orderable: false, searchable: false},
                {data: 'date', name: 'date' , orderable: false, searchable: false},
                {data: 'time', name: 'time' , orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
        });

        var transaction = $('#transaction').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/transaction-appointment",
            dom: 'frtp',
            pageLength: 10,
            responsive: true,
            columns: [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false},
                {data: 'date', name: 'date' , orderable: false, searchable: false},
                {data: 'time', name: 'time' , orderable: false, searchable: false},
                {data: 'appointment_method', name: 'appointment_method' , orderable: false, searchable: false},
                {data: 'mode_of_payment', name: 'mode_of_payment' , orderable: false, searchable: false},
                {data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        var usertable = null;
  
        $('.viewpatients').on('shown.bs.modal', function() {
            if (!usertable) {
                    usertable =  $('#users').DataTable({
                        "ajax": "/admin/appointment/show_user",
                        processing: true,
                        serverSide: true,
                        dom: 'frtp',
                        pageLength: 6,
                        responsive: true,
                        "columns": [
                            {data: 'id', name: 'id' , orderable: false, searchable: false},
                            {data: 'fullname', name: 'fullname' , orderable: false},
                            {data: 'gender', name: 'gender' , orderable: false},
                            {data: 'age', name: 'age' , orderable: false},
                            { width: "10%",data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });
            }else{
                usertable.ajax.reload();
            }
          });

        $('.viewpatients').on('hidden.bs.modal', function() {
            if (usertable) {
            usertable.destroy();
            usertable = null;
            }
        });

        $('#pendings').on('click', '.complete', function(e) {
            e.preventDefault();
            var appointcode = $(this).data('id');
            $('#appointmentcode').val(appointcode);
            $('#complete-confirmation').modal('show');
        });

        $('#pendings').on('click', '.resched', function(e) {
	        e.preventDefault();
            var appointid = $(this).data('id');
            $('#reschedid').val("");
            $('#reschedid').val(appointid);
            $('#reschedcalendar').modal('show');
        });

	   $('#pendings').on('click', '.cancel', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#cancel_id').val(id);
            $('#cancel-confirmation').modal('show');
        });

        $('#users').on('click', '.select', function(e){
            e.preventDefault();
            var id = $(this).data('id');
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
                    $('#contactno').val(response.users[0].mobileno);
			        $('#email').val(response.users[0].email);
                    $('#viewpatients').modal('hide');
                }
            });
        });

        $('.show-create').on('click', function(e){
                e.preventDefault();
                $('.create-form').modal('show')
                $('#available-time').empty()
                $('#available-time').append('<option value="0" disabled selected></option>');
        })

        $(".create-form").on("hidden.bs.modal", function(e){
            e.preventDefault();
            $('.create-form').find('.refresh').val("");
            $('#cash, #gcash').hide();
            $('#error_user, #error_date, #error_time, #error_modepayment, #error_payment, #error_reference_no ' ).html("");
        });

        $("#reschedcalendar").on("hidden.bs.modal", function(e){
            e.preventDefault();
            $('#reschedcalendar').find('.refresh').val("");
            $('#reschedtime').empty()
            $('#reschedtime').append('<option value="0" disabled selected></option>');
            $(' #error_resched_date, #error_resched_tim' ).html("");
        });

        $(document).on('click', '.patients', function(e){
            $('#viewpatients').modal('show');
            $('#modal-status').val('show')
        })
        
        $(document).on('click', '.calendar', function(e){
            $('#viewcalendar').modal('show');
        })

        //---------------store appointment--------------------------//
        $(document).on('click', '.store_appointment', function(e){
            e.preventDefault();
            payment = $('#payment').val();
            reservation_fee = $('#reservation_fee').val();
            var data ={
                    'userid' : $('#userid').val(),
                    'fullname': $('#fullname').val(),
                    'contactno' : $('#contactno').val(),
                    'email' : $('#email').val(),
                    'date': $('#date').val(),
                    'time': $('#available-time').val(),
                    'reservation_fee' : $('#reservationfee').val(),  
                    'modepayment': $('#mode_payment').val(),
                        'payment': $('#payment_cash').val(),
                    'change': $('#change').val(),
                    'reference_no': $('#reference_no').val(),
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
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){ 
                    if(response.status == 400){
                        $('#error_user, #error_date, #error_time, #error_modepayment, #error_payment, #error_reference_no ' ).html("");
                            $.each(response.errors.userid, function (key, err_values){
                            $('#error_user').append('<span>'+err_values+'</span>');
                            })
                            $.each(response.errors.date, function (key, err_values){
                                $('#error_date').append('<span>'+err_values+'</span>');
                            })
                            $.each(response.errors.time, function (key, err_values){
                                $('#error_time').append('<span>'+err_values+'</span>');
                            })
                            $.each(response.errors.modepayment, function (key, err_values){
                                $('#error_modepayment').append('<span>'+err_values+'</span>');
                            })
                        $.each(response.errors.payment, function (key, err_values){
                                $('#error_payment').append('<span>'+err_values+'</span>');
                            })
                        $.each(response.errors.reference_no, function (key, err_values){
                                $('#error_reference_no').append('<span>'+err_values+'</span>');
                            })
                    }else{
                            $('#message-success').text('Created successfully');
                            $(".success").show();
                            setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);
                            $('#create-form').modal('hide');
                            $('#create-form').find('.refresh').val("");
                                    pendings.draw();
                    }
                }
            });
        })

            //update data from database
            $('.update_appointment').on('click', function(e){
            e.preventDefault();
            var appointcode = $('#appointmentcode').val();
            var status = "Success";
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
              
                    $(".main-spinner").show();
                },
                complete: function(){
				            $('#complete-confirmation').modal('hide');
                    $(".main-spinner").hide();
                },
                success: function(response){ 
                  console.log(response);
                  $('#success').html();
                    $('#success').text('Updated successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
               
             pendings.draw();
             complete.draw();
        }
    });
        });

        $('.cancel_appointment').on('click', function(e){
            e.preventDefault();
            var status = "Cancel"
            var appointcode = $('#cancel_id').val();
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
              
              $(".main-spinner").show();
          },
          complete: function(){
            $('#cancel-confirmation').modal('hide');
              $(".main-spinner").hide();
          },
                success: function(response){ 
				console.log(response);
                  $('#success').html();
                    $('#success').text('Cancel successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                   pendings.draw();
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

        

  

        //-------------------- View Calendar --------------------//

        var calendar = $('#calendar').fullCalendar({
            height:470,
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month'
            },
            // events:'/admin/appointment',
            selectable:true,
           
            color: 'red',
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

      $('.fc-day.fc-today').css('backgroundColor', 'white');

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
                    var selected_date = new Date(start);
                    let formattedDate = `${year}-${month}-${day}`;

                  if(formattedDate == start){
                      return false;
                    }else{

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
                            $(".main-spinner").show();
                        },
                        complete: function(){
                            $(".main-spinner").hide();
                        },
                        success:function(response)
                        {   
                              $('#date').val("");
                              $('#available-time').empty();
                              
                              if(date_off.includes(start)){
                                $('#available-time').append('<option value="0" disabled selected></option>');
                                $('#message-error').text("Sorry this day is off");
                                $(".error-calendar").show();
                                setTimeout(function() {
                                    $(".error-calendar").fadeOut(500);
                            }, 3000);
                    }else{

                      if (selected_date < currentDate) {
                        $('#available-time').append('<option value="0" disabled selected></option>');
                      $('#message-error').text("This day is not available");
                                $(".error-calendar").show();
                                setTimeout(function() {
                                    $(".error-calendar").fadeOut(500);
                            }, 3000);
                        } else {
                          if(response.status == "405"){
                             $('#available-time').append('<option value="0" disabled selected></option>');
                                    $('#message-error').text('This day is full');
                                $(".error-calendar").show();
                                setTimeout(function() {
                                    $(".error-calendar").fadeOut(500);
                                }, 3000);
                                
                            }else{
                           
                              $('#date').val(start);
                                  $('#viewcalendar').modal('hide');
                                    $('#date').val(response.date);
                                    $('#form-dateselected').val(response.date);
                                    $("#available-time").append("<option value=''>-- select --</option>");
                                $.each(response.available_time, function(index, val){ 
                                    $("#available-time").append("<option value='"+val+"'>"+val+"</option>");
                                } )
                            }
                        }
            
                    }
                     
                        }
                    })
              

           }
                    

             
            },
            editable:true,
        });


        var calendar_res = $('#calendar_res').fullCalendar({
            height:470,
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month'
            },
            // events:'/admin/appointment',
            selectable:true,
           
            color: 'red',
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
                    var selected_date = new Date(start);
                    let formattedDate = `${year}-${month}-${day}`;

                    // if(formattedDate == start){

                    //     return false;
                    //   }else{

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
                        $('#complete-confirmation').modal('hide');
                            $(".main-spinner").show();
                        },
                        complete: function(){
                            $(".main-spinner").hide();
                        },
                        success:function(response)
                        {   
                         
                          $('#resched_date').val("");
                          $('#reschedtime').empty();
                         
                          if(date_off.includes(start)){
                            $('#reschedtime').append('<option value="0" disabled selected></option>');
                      $('#message-error').text("Sorry this day is off");
                                $(".error-calendar").show();
                                setTimeout(function() {
                                    $(".error-calendar").fadeOut(500);
                            }, 3000);
                    }else{

                      if (selected_date < currentDate) {
                        $('#reschedtime').append('<option value="0" disabled selected></option>');
                      $('#message-error').text("Sorry this day is off");
                                $(".error-calendar").show();
                                setTimeout(function() {
                                    $(".error-calendar").fadeOut(500);
                            }, 3000);
                        } else {
                          if(response.status == "405"){
                        $('#reschedtime').append('<option value="0" disabled selected></option>');
                                $('#message-error').text(response.message);
                            $(".error-calendar").show();
                            setTimeout(function() {
                                $(".error-calendar").fadeOut(500);
                            }, 3000);
                            
                            }else{
                           
                          $('#resched_date').val(start);
                                $("#reschedtime").append("<option value=''>-- select --</option>");
                                $.each(response.available_time, function(index, val){ 
                                    $("#reschedtime").append("<option value='"+val+"'>"+val+"</option>");
                                } )
                            }
                        }
                    }
                        }
                    })



            //   }
                },
                editable:true,
            });


        $('.resched_button').on('click', function(e){
          $('#reschedid').val();
          $('#resched_date').val();
          $('#reschedtime').val();

          data = {
            "id": $('#reschedid').val(),
            "date": $('#resched_date').val(),
            "time": $('#reschedtime').val(),
          }
          
          $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type: "PUT",
                url: "/admin/appointment/resched",
                datatype: "json",
                data: data,
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){
				 
                    $(".main-spinner").hide();
                },
                success: function(response){ 

                  if(response.status == 400){
                    $('#error_resched_date, #error_resched_tim' ).html("");
                        $.each(response.errors.date, function (key, err_values){
                            $('#error_resched_date').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.time, function (key, err_values){
                            $('#error_resched_tim').append('<span>'+err_values+'</span>');
                        })
           
                  }else{
                    
                    $('#reschedcalendar').modal('hide');
                  $('#success').html();
                    $('#success').text('Reschedule successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                          pendings.draw();
                          complete.draw();
                  }
             
        }
    });
        });
	   
        $('#mode_payment').on('change', function(e){
            var payment = $(this).val();
          $('#payment_cash, #change, #reference_no').val(" ");

            if(payment == "Cash"){
                $('#cash').show();
                $('#gcash').hide();
            }else{
                $('#cash').hide();
                $('#gcash').show();
            }
        });

        $('#payment_cash').on('keyup', function(e){
          e.preventDefault();
          let total = $('#reservationfee').val();
          let payment = $(this).val();

          let change =  parseInt(payment) - parseInt(total);
          // let change_replace =Number(parseFloat(change).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});

   
     
          if(parseFloat(payment) < parseFloat(total)){
            // console.log('werwe');
            console.log('payment is lower than total');
                $('#change').val('');
            }else if(payment == ""){
                console.log('null inputs')
                $('#change').val('');
            }else{
                // alert('higher');
                  console.log('payment is greater than total');
                            $('#change').val(change);
            }
        });

    });
</script>

@endsection
