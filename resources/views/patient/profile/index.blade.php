@extends('layouts.navbar')
@section('content')
 
<style>
    label{
        font-family: 'Poppins';
    }
    .input, .service_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        text-align: center; 
    }

    th, td{
        text-align: center; 
    }
</style>


<div class="alert success alert-success" role="alert" style="width:250px; right:25px; display:none;  position:fixed; z-index:9999 ">
    <p id="message-success"></p> 
</div>

<div class="container" style="margin-bottom:100px">
    
    @if (session()->has('success'))
        <div class="alert alert-success success"  id="success" >{{ session('success') }}</div> 
    @endif

    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279);z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	


    <div class="card w-40 " style="box-sizing: border-box;font-family:Poppins; background:#EDDBC0;padding-top:1%; margin-bottom:4%;padding-bottom:1%;margin-top:5%;box-shadow: 10px 10px 10px 5px rgba(0, 0, 0, 0.25);">
    
        <h1 class="text-center text-[30px]" style="font-weight: 700;">Profile</h1>
        <div style=" display:flex; flex-direction:row;flex-wrap:wrap;  padding:5px; margin-left:5%; ">

            @if (Auth::user()->profile_pic == null)
                <img style="border-radius:100%;height:280px; width:280px;box-shadow: -10px 0px 0px 5px  #829460;" src="{{url('profilepic/defaultprofile.png')}}" alt="">
            @else
                <img style=" border-radius:100%;height:280px; width:280px;box-shadow: -10px 0px 0px 5px  #829460;"  src="{{url('profilepic/' . Auth::user()->profile_pic )}}" alt="">
            @endif

            <div style="background: #EDDBC0;margin-left:30px;margin-top:30px;">
                <div style="display:flex;flex-direction:row;">
                    <h3 style="font-weight: 700;"> <label for="">{{Auth::user()->fname}}</label></h3>
                    <h3 style="margin-left: 5px;font-weight: 700;"> <label for="">{{Auth::user()->mname}}</label> </h3>
                    <h3 style="margin-left: 5px;font-weight: 700;"><label for="">{{Auth::user()->lname}}</label> </h3> 
                    <h3 style="margin-left: 5px;">/ <label for="">{{Auth::user()->username}}</label> </h3>
                </div>
            
                <h6> <label for="">{{Auth::user()->address}}</label> </h6> 
                <h6> <label for="">{{Auth::user()->email}}</label></h6> 
                <h6> <label for="">{{Auth::user()->mobileno}}</label> </h6> 
                <h6> <label for="">{{ date('M d, Y ', strtotime(Auth::user()->birthday))}}</label> </h6> 
                <h6><label for="">{{Auth::user()->gender}}</label> </h6>
                <form  action="/patient/profile/picture/update/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profilepic"  style="width:180px ; "  >  
                    <button style="border-radius:3px; padding-left:7px;padding-right:7px ; padding-bottom:3px; padding-top:3px;background-color: #829460; border:none; color:white" type="submit">Change</button>
                </form>

                @error('profilepic')
                    <span  role="alert" class="block mt-3 pb-5 text-danger">{{$message}}</span><br>
                @enderror
                <div style="margin-top:10px">
                    <a style="text-decoration:none;background-color: #829460;  padding-left:7px;padding-right:7px ; padding-bottom:3px; padding-top:3px;color:white" href="{{route('profile.edit', Auth::user()->id )}}">Edit profile</a> 
                </div>
            </div>
        </div>
    </div>

    <div>
        <h4>History</h4>
        <p>Here are the history of your finding during your consulation. Click to view</p>
    </div>


    <div class="card" style="background:#EDDBC0;border:none;">
        <div class="" style="padding:0%; ">
            <div class="card-body " style="width:100%;  display: flex; overflow-x: auto;  font-size: 15px; padding:0px " >
                <table class="table table-striped table-bordered border border-dark col-sm">
                    <thead style="background-color: burlywood">
                        <tr  style=" position: relative;">
                            <th style="text-align: center;" >Appointment Date</th>
                            <th style="text-align: center;">Description</th>
                            <th style="text-align: center;">File</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($documents) > 0)
                            @foreach ($documents as $document)
                                <tr>
                                    <td style="text-align: center">{{ date('M d, Y', strtotime($document->appointment_date))}} </td>
                                    <td style="text-align: center;" >{{$document->documenttype}}</td>
                                    <td style="text-align: center;" >{{$document->filename}}</td>
                                    <td style="text-align: center;">
                                        <button style="text-align: center;" value="{{$document->id}}" class="view btn btn-primary">View</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                            <td colspan="4" style="text-align: center;" >No Consultation file found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="margin-top:3%">
        <h4>Appointments</h4>
        <p>Here are the history of your finding during your consulation. Click to view</p>
    </div>

    <div class="appointment_table" >
        <div class="card" style="background:#EDDBC0;border:none;">
            <div class="appointment" style="padding:0%; ">
                <div class="card-body " style="width:100%;  display: flex; overflow-x: auto;  font-size: 15px; padding:0px " >
                    <table class="table table-striped table-bordered border border-dark col-sm">
                        <thead style="background-color: burlywood">
                            <tr  style=" position: relative;">
                                <th >Date</th>
                                <th>Time</th>
                                <th>Reservation fee</th>
                                <th>Mode of payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @if (count($appointments) > 0)
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ date('M d, Y', strtotime($appointment->date))}} </td>
                                    <td>{{ date('h:i A', strtotime($appointment->time))}}</td>
                                    <td>{{$appointment->reservation_fee}}</td>
                                    <td>{{$appointment->mode_of_payment}}</td>
                                    <td>{{$appointment->status}}</td>
                                    <td>
                                        @if ($appointment->status == "pending")
                                            <button class="cancel-confirmation btn btn-danger" type="button" value="{{$appointment->id}}" >Cancel</button>
                                            @if (now()->toDateString() >= date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d', strtotime($appointment->date))))))
                                            @else
                                                <button class="reschedule btn btn-primary" type="button" value="{{$appointment->id}}">Reschedule</button>
                                            @endif
                                            <a style="text-decoration: none" class="btn btn-secondary" href="/patient/appointment/print/{{$appointment->id}}">Print</a>
                                        @else
                                            <a style="text-decoration: none" class="btn btn-secondary" href="/patient/appointment/print/{{$appointment->id}}">Print</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center;" >No appointment found</td>
                            </tr>
                        @endif
                    </tbody>
            </table> 
                </div>
                <div style="">
                    {!! $appointments->links() !!}
                </div>
            </div>
        </div>
    </div>

    {{-------------------------- cancel Appointment --------------------------------------}}
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" id="appointment-id" hidden>
                            <h5>Do you want to cancel this appointnment?</h5>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close btn btn-secondary"  style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
                        <button class="cancel_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{------------------------------View Document-------------------------}}
    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">View Document</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <div  class="row">
                                <div class="col-md-6">

                                <label for="">Appointment id</label><br>
                                <input type="text"  class="input" id="view_appointemntid"  style="width: 300px" name="appointment_id" readonly><br>
                                
                                <label style="margin-top:10px" for="">Fullname</label><br>
                                <input type="text" class="input" readonly  style="width: 300px" id="user_id" name="user_id" hidden>
                                <input type="text" class="input" readonly   style="width: 300px" id="view_fullname" name="fullname">

                                <label style="margin-top: 10px" for="">Appointment date</label><br>
                                <input type="text" class="input"  style="width: 300px" id="view_date" name="date"><br>
                            
                                </div>

                                <div  class="col-md-6">
                                    <label style="margin-top: 0px" for="">Description</label><br>
                                    <input type="text" readonly class="input"  style="width: 300px" id="view_doc_file" name="date"><br>
                            
                                    <label style="margin-top:13px" for="">Uploaded pdf</label><br>
                                    <input type="text"class="input" readonly   style="width: 300px" id="view_file" name="pdf"><br>
                                </div>

                                <div class="form-group" >
                                    <label for="message-text" style="margin-top:20px"  class="col-form-label">Note:</label>
                                    <textarea class="input" readonly style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; min-height: 100px; height:auto" id="view_note" name="note"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer" style="border-top-color: gray; padding-bottom:0px">
                   
                            <div id="fileview">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <div class="modal fade" id="viewcalendar">
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
                                    <div class="" style=" background-color: #EDDBC0; margin-left:15px; margin-right:15px" id="calendar"></div>
                                    <label style="color: red; margin-top:15px; margin-left:20px"  for="">Please note: You can only reschedule appointment once.</label>
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
                                                <span  role="alert" class="block   text-danger" id="error_date"></span>
                                            </div>

                                            <br>
                                            <label style="padding-left: 0px; margin-top:10px" for="">Time selected:</label>
                                            <select name="" id="reschedtime" class="refresh rounded text-gray-700  focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894; width:250px" >
                                            <option value="">--select--</option>
                                            </select>

                                            <div class="mt-0 mb-1">
                                                <span  role="alert" class="block mt-5   text-danger" id="error_time"></span>
                                            </div>

                                            <input hidden type="text" id="reschedid">
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

    <div class="modal fade" id="errormodal" tabindex="-1" role="alert" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: #EDDBC0;"></div>
                <div class="modal-body">
                    <div class="mb-5 mt-5  ">
                        <div class=" columns-1 sm:columns-2">
                            <h3   id="errormessage"  style="text-align: center" ></h3>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                        <button  data-bs-dismiss="modal"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
        var day_off = {!! json_encode($day_array) !!} ;
        var date_off = {!! json_encode($date_array) !!} ;
</script>

@vite('resources/js/user/profilepage.js')

@endsection