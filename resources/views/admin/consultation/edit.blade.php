@extends('layouts.admin_navigation')
@section('title', 'Edit Consultation')
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
                                    {{-- {{$last->date->format('M d, Y')}} --}}
                                          <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px">
                                          
                                        
                                          </div>
                                    </div>
                    
                    
                                
                          
                            </div>
                            <div class="col-md-8" style="margin-right:15px;border-radius: 5px; padding:0px; box-shadow: 1px 4px 4px rgba(0, 0, 0, 0.25); background: #EDDBC0; padding-left:15px; padding-right:15px; padding-bottom:50px">
                                <div style="margin-top:5px; " class="d-flex justify-content-between" >
                                    <a href="/admin/consultation/viewrecords/{{$userinfo->id}} " class="btn "><img height="20" width="20" src="{{url('logo/arrow.png')}}" alt=""></a>
                                </div>
                                <hr style="margin-top: 5px;">
                                <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px; margin-bottom:10px">
                                          <label style="font-size:  24px" for=""><b> Edit consultation</b></label>
                                </div>
                           <form action="/admin/consultation/update/{{$consultations->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input hidden name="user_id" value="{{$userinfo->id}}" type="text">
                                    <label for="">Appointment Date:</label>
                                    <label for="">{{ date('M d, Y ', strtotime($consultations->date))}} </label><br>
                                    <label for="">Service:</label>
                                    <label for="">{{$consultations->service}}</label><br>

                                    <label style="font-size: 15px; margin-top:25px" for="">Primary diagnosis</label><br>
                                    <div style="padding-left: 20px; padding-right:20px" >
                                        <input type="text" style="width: 400px; " class="addtocart_input" value="{{$consultations->primary_diag}}" id="findings" name="primary_diag"><br>
                                    </div>
                              
                      
                                    <label style="font-size: 15px; margin-top:25px" for="">Behavioral observation</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                        <textarea class="addtocart_input" style="width: 100%;text-align:justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap;" name="observation" id="" s rows="10">{{$consultations->behavioral_observation}}</textarea>
                                    </div>
                               

                                    <label style="font-size: 15px; margin-top:15px" for="">Brief Summary Encounter</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                        <textarea class="addtocart_input" style="width: 100%;text-align:justify;padding:10px; text-justify: inter-word;  white-space: pre-wrap;" name="summary" id=""  rows="10">{{ $consultations->brief_summary_encounter }}</textarea>
                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Clinical Impression</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                        <textarea class="addtocart_input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap;" name="impression" id=""  rows="10">{{$consultations->clinical_impression}}</textarea>
                       
                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Treatment Given</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">

                                        <textarea class="addtocart_input" style="width: 100%;text-align: justify;padding:10px; text-justify: inter-word;  white-space: pre-wrap;" name="treatment" id=""  rows="10">{{$consultations->treatment_given}}</textarea>

                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Recommendation</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                        
                                        <textarea class="addtocart_input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap;"name="recommendation" id=""  rows="10">{{$consultations->recommendation}}</textarea>
                               
                                    </div>
                              
            <div class="row">
          
                <div id="subtotal" class="subtotal d-flex justify-content-end col " style="; margin-right:20px; justify-content:center">
     
      
                 <button type="submit"  class="saveaddtocart" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 180px;height: 40px; margin-left:1%; " >Update</button>
                 </div>
           </div>
                                </form>
                                </div>
                            
                            </div>
                        </div>
                    
                        </div>
                   
                </div>                    
        </div>

  
    </div>
                   

    @section('scripts')
    <script>
        $(document).ready(function() {
    
        })
    </script>
    @endsection



  

@endsection