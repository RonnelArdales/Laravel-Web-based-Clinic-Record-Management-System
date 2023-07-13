@extends('layouts.admin_navigation')
@section('title', 'Patient Record')
@section('content')
<style>
    label{
        font-family: 'Poppins';
    }
    .addtocart_input, .service_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        text-align: center; 
    }

</style>

<div class="row m-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"  >

                <div class="card-header" style="text-align: center; ">
                    <h3 class="card-title">Patient Record</h3>
                </div>

                <div class="card-body mt-3">
                    <div class="" style="background:#EDDBC0; padding: 20px 30px ;border-left:12px solid white; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
                        Patient name: <label style="font-size: 23px" for=""><b> {{$userinfo->fname}} {{$userinfo->lname}}</b></label>
                    </div>

                    <div class="row mt-3" style="padding-left:15px " >
                        <div class="rounded    row col-md" style="height:420px; margin:0px;padding-top:10px ; margin-right:18px ;background: #EDDBC0;
                        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">  
                            <div class="col-sm " >
                                <label style="font-size:  20px" for=""><b>Basic Information:</b> </label>
                                <hr style="margin-top:10px">
                                
                                <label style="font-size: 13px;" for="">Address:</label><br>
                                <label style="font-family: 'Poppins';font-style: normal; font-size:18px"  for="">{{$userinfo->address}} </label><br>

                                <label style="font-size: 13px; margin-top:8px" for="">Age:</label><br>
                                <label style="font-size: 18px" for="">{{$userinfo->age}} </label><br>

                                <label style="font-size: 13px;  margin-top:8px" for="">Gender:</label><br>
                                <label style="font-size: 18px" for="">{{$userinfo->gender}} </label><br>

                                <label style="font-size: 13px;  margin-top:8px" for="">Contact no:</label><br>
                                <label style="font-size: 18px" for="">{{$userinfo->mobileno}} </label><br>
                                    
                                <label style="font-size: 13px; margin-top:8px" for="">Email:</label><br>
                                <label style="font-size: 18px" for="">{{$userinfo->email}}</label><br>

                                <label style="font-size: 13px; margin-top:8px" for="">Last appointment:</label><br>
                                <label style="font-size: 18px" for="">{{ date('M d, Y ', strtotime($last->date))}}</label><br>
                                <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px"></div>
                            </div>
            
                    
                        </div>
                        <div class="col-md-8" style="margin-right:15px;border-radius: 5px; padding:0px; box-shadow: 1px 4px 4px rgba(0, 0, 0, 0.25); background: #EDDBC0">
                            <div style="margin-top:5px; margin-left:10px">
                                <a href="/admin/consultation"><img height="20" width="20" src="{{url('logo/arrow.png')}}" alt=""></a>
                                <hr style="margin-top: 5px;">
                            </div>

                            <div class="d-flex justify-content-center row" style="text-align: center; margin-top:15px">
                                <label style="font-size:  20px" for=""><b> Appointment History</b></label>
                            </div>

                            <div>
                                <table class="table table-bordered table-striped"  id="consultation" style="background-color: white; width:100%; " >
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Service</th>
                                            <th>Date</th>
                                            <th style="min-width: 55px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="error">
                                        @foreach ($consultations as $consult)
                                        <tr class="overflow-auto">
                                            <td>{{$consult->id}}</td>
                                            <td>{{$consult->service}}</td>
                                            <td>{{$consult->date}}</td>
                                            <td>{{$consult->time}}</td>
                                            <td style="text-align: center">
                                                <a href="/admin/consultation/viewconsultation/{{$consult->id}}/{{$consult->user_id}}" class=" btn btn-sm btn-primary">View</a>
                                                <a href="/admin/consultation/edit/{{$consult->id}}/{{$consult->user_id}}" class=" btn btn-sm btn-info" style="color: white" >Edit</a>
                                                <button value="{{$consult->id}}" class=" delete btn btn-sm btn-danger" > Delete</button>
                                            </td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div>
                                    {!! $consultations->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  ">
            <div class="modal-content" style="background: #EDDBC0; margin-top:30%;">
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                            <input type="text" hidden id="consultationid">
                            <h5>Do you want to delete this data?</h5>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close btn btn-secondary" style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">Close</button>
                        <button class="delete_user" id="deleteconsultation"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection   

@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete', function (e){
            e.preventDefault();
            id =  $(this).val();
            $('#consultationid').val(" ")
            $('#consultationid').val(id)
            $('#delete').modal('show');
        })
    })
</script>
@endsection



  
