@extends('layouts.admin_navigation')
@section('content')


<style>
    .label-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;

    }

    .label-container label {
        margin-right: 10px;
        margin-bottom: 10px;

    }
</style>

<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
        <h1><B>BUSINESS HOURS</B></h1>
    </div>   

    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px" id="message-success"></p> 
    </div>

    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	


    <div class="row">
        <div class="col-md">
            <div class="card table-appointment" style="background:#EDDBC0;border:none; padding-top:15px; padding-left:7px; padding-right:7px "  >
                <div style="align-items:center; display:flex;   margin-bottom:1%;" >
                    <div class="me-auto">
                        <div class="days" id="days">
                            <label for=""><b>Day</b> </label>
                            <select name="businessdays" id="businessdays" style="width:220px;height:30px ;font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; ">
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                    </div>

                    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 show-create" data-bs-toggle="modal" data-bs-target="#create" >
                    Create
                    </button>
                </div>

                <h2 style="margin: 0px; margin-bottom:10px"> <b>Available Hours</b></h2>
                <p>Select the preferred day and click "<b>Day Off</b>" to set the <b>day in a whole month</b> as day off.</p>
                <div class="card-body" style="width:100%; min-height:50vh; display: flex; overflow-x: auto;padding:0px ; font-size: 15px; ">
                    <div  style="width:100%; " class="businessHours" >
                        <div id="" style="height:300px; padding:10px; background-color:aliceblue; border-radius:10px; " >
                            <div class="label-container">
                                @foreach ($hours as $hour)
                                    <label style="margin-bottom: 10px; display: flex; align-items: ">
                                        <input type="checkbox" class="day_id" name="day_id[]" id="day_id" value="{{$hour->id}}" id="time-checkbox">
                                        <div style="margin-left: 10px" class="btn btn-primary ml-20">{{$hour->from}}</div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                
                        @foreach ($days as $day)
                            <div class="refresh_off" style="margin-top:10px">
                                <button class="delete btn btn-danger ml-20 delete" id="delete">Delete</button>
                                <button style="padding-left:30px; padding-right:30px" class=" btn btn-primary ml-0 off_day" value="{{$day->day}}" id="off_day"><label for=""><input onclick="this.checked=!this.checked;" type="checkbox" {{ $day->off == 1  ? 'checked' : '' }} class="checked_off" name="checked_off" id="checked_off"  > </label> <label for="">Day Off</label></button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card " style="background:#EDDBC0;border:none; padding-top:15px; padding-left:7px; padding-right:7px; "  >
                <div style="align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
                    <div class="me-auto">
                        <div class="days" id="days">
                            <label for=""><b>Date</b> </label>
                            <input type="date" class="date" style="width:220px;height:30px ;font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; " >
                        </div>
                    </div>
                    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 add_date"   >
                    Add
                    </button>
                </div>
            
                <h2 style="margin: 0px; margin-bottom:10px"><b>Date off dates</b></h2>
                <p style="margin-top:7px">Select a specific "<b>date</b>" for Day Off.</p>
                <div class="card-body" style="width:100%; min-height:50vh; display: flex; overflow-x: auto;padding:0px ; font-size: 15px;margin-top:14px">
                    <div  style="width:100%; " class="dayoff_dates" >
                        <div id="" style="height:300px; padding:10px; background-color:aliceblue; border-radius:10px" >
                            <div class="label-container">
                                @foreach ($offdates as $offdate)
                                    <label style="margin-bottom: 10px; display: flex; align-items: ">
                                        <input type="checkbox" class="date_id" name="date_id[]" id="date_id" value="{{$offdate->id}}">
                                        <div style="margin-left: 10px" class="btn btn-primary ml-20">{{date('m-d-Y', strtotime($offdate->date))}}</div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                
                        <div style="margin-top:10px">
                            <button class="delete_date btn btn-danger ml-20 " id="delete_date">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- create business modal --}}
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Business Hours</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-5 pt-6  ">
                        <div class=" columns-1 sm:columns-2 modal-asd">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Day</label>
                            <select name="businessdays" id="create_businessday" style="width:200px" class="create_businessday bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5">
                                <option value="">select</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_day"></span>
                            </div>
                            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Time</label>
                            <input class="create_businesstime bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="time">
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_time"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                        <button type="button" class=" close " style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                        <button class=" add_businesshours" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Create</button>
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
    </script>

    <script src="{{mix('js/system_settings/businessHours.js')}}"></script>

@endsection
