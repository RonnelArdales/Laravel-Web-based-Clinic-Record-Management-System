@extends('layouts.admin_navigation')
@section('title', 'View Patient Consultation')
@section('content')
<style>
    label{
        font-family: 'Poppins';
    }
    .addtocart_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        text-align: center;
        width: 100%; 
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
                  
                    <x-patientname :userinfo="$userinfo" />

                        <div class="row mt-3" style="padding-left:15px " >
                            
                            <x-patientbasicinfo :userinfo="$userinfo" :last="$last" />

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

                    <div class="modal-footer" style="border-top-color: gray">
                        <a  href="/admin/consultation/print/{{$consultations->id}}"> <button class="cancel_appointment "style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; "  >No</button></a>
                        <button class=" " id="set-encrypt" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Yes</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Set Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/consultation/print/{{$consultations->id}}">
                        <div class="mb-5 pt-6  ">
                            <div class=" columns-1 sm:columns-2">
                                <input type="text" id="type" name="type" hidden value="encrypt">
                                
                                <div>
                                    <label style="margin-top:10px" for="">User Password</label><br>
                                    <input type="text" id="userpass" name="userpass" style="width: 100%" class="addtocart_input" value="">
                                    @error('userpass')
                                        
                                    @enderror
                                </div>
                                
                                <div>
                                    <label style="margin-top:10px" for="">Admin Password</label><br>
                                    <input type="text" name="adminpass"  id="adminpass"  style="width: 100%" class="addtocart_input">
                                    @error('adminpass')
                                        
                                    @enderror
                                </div>
                                
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

@vite( 'resources/js/admin/consultation/view.js')

@endsection

 

  

