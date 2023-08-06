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
        <p id="message-error"></p> 
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
                                <p> <b>Legends:</b> </p>
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
    let usertype = "{{Auth::user()->usertype}}";
    let day_off = {!! json_encode($day_array) !!};
    let date_off = {!! json_encode($date_array) !!};
</script>

@vite( 'resources/js/admin_secretary/appointment.js')

@endsection
