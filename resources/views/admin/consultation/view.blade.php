@extends('layouts.admin_navigation')

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
                            
                                    <button class="btn printer" id="printer" type="button"><img height="23" width="25" src="{{url('logo/printer.png')}}" alt=""></button>
                                </div>
                                <hr style="margin-top: 5px;">
                                <div class="d-flex justify-content-center row" style="text-align: center; margin-top:20px; margin-bottom:10px">
                                          <label style="font-size:  24px" for=""><b> View Consultation</b></label>
                                </div>
                           
                                    <label for="">Appointment Date:</label>

                                    <label for="">{{ date('M d, Y ', strtotime($consultations->date))}} </label><br>
                                    <label for="">Service:</label>
                                    <label for="">{{$consultations->service}}</label><br>

                                    <label style="font-size: 15px; margin-top:25px" for="">Behavioral observation</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                        <label style="font-size: 18px; text-align: justify; text-justify: inter-word; " for="">{{$consultations->behavioral_observation}}</label>
                                    </div>
                                    

                                    <label style="font-size: 15px; margin-top:15px" for="">Brief Summary Encounter</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                    <label  style="font-size: 18px; text-align: justify; text-justify: inter-word; " for="">{{$consultations->brief_summary_encounter}}</label>
                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Clinical Impression</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{$consultations->clinical_impression}}</label>
                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Treatment Given</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{$consultations->treatment_given}}</label>
                                    </div>

                                    <label style="font-size: 15px; margin-top:15px" for="">Recommendation</label><br>
                                    <div style="padding-left: 20px; padding-right:20px">
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{$consultations->recommendation}}</label>
                                    </div>
                               
                                  
                                </div>
                            
                            </div>
                        </div>
                    
                        </div>
                   
                </div>                    
        </div>


          {{------- encrypt confirmation ------------}}
  <div class="modal fade" id="encrypt-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                   
                <h5>Do you want to encrypt this file?</h5>

        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          {{-- <button type="button" class=" close btn btn-secondary"  style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button> --}}
          {{-- <button class=" cancel_appointment p-2 w-30 bg-[#829460]  mt-7 rounded" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; "  >Cancel</button> --}}
          <button class=" " id="set-encrypt" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Yes</button>

          <a  href="/admin/consultation/print/{{$consultations->id}}"> <button class=" cancel_appointment "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >No</button></a>
     
        </div>
      </div>
    </div>
  </div>
</div>

{{------------------------Insert password in encrypt file------------------------------------}}
<div class="modal fade" id="insert-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel"> </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/consultation/print/{{$consultations->id}}">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <label style="font-size: 20px"  for="">Set password in the file</label> <br>
                    <input type="text" id="type" name="type" hidden value="encrypt">
                   <label style="margin-top:10px" for="">User Password</label><br>
                    <input type="text" id="userpass" name="userpass" class="addtocart_input" value=""><br>

                    <label style="margin-top:10px" for="">Admin Password</label><br>
                    <input type="text" name="adminpass"  id="adminpass" class="addtocart_input">
                </div>
            </div>
        <div class="modal-footer" style="border-top-color: gray">
         
          <button type="submit" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Print</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

  
    </div>

    @endsection
                   

    @section('scripts')
    <script>
        $(document).ready(function() {

$('#printer').on('click', function(e) {
    e.preventDefault();
    $('#encrypt-confirmation').modal('show');
})

$('#set-encrypt').on('click', function(e) {
    e.preventDefault();
    $('#adminpass, #userpass, #type ' ).html("");
    $('#type').val('encrypt');
    $('#encrypt-confirmation').modal('hide');
    $('#insert-password').modal('show');
})

$("#insert-password").on("hidden.bs.modal", function(e){
        e.preventDefault();
	   $('#adminpass, #userpass, #type  ' ).html("");

        });


    window.addEventListener('beforeunload', function () {
  // Close any open modal windows
  $('#adminpass, #userpass, #type  ' ).html("");
  $('#insert-password').modal('hide');
  $('#encrypt-confirmation').modal('hide');
});
    
        })
    </script>
    @endsection



  

