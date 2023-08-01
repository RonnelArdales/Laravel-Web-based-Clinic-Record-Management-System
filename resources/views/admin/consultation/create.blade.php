@extends('layouts.admin_navigation')
@section('title', 'Create Consultation')
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
    <div class="main-spinner" style="position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
	     <div class="spinner">
               <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                    <span class="visually-hidden">Loading...</span>
               </div>
	    </div>
     </div>	

    @foreach ($errors->all() as $message) 
    <div class="alert alert-danger error" id="error">{{ $message }}</div>
    @endforeach

     {{--Show Add to cart tab--}}
     <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
          <div class="me-auto col-md-8 col-md-offset-5">
               <h1>Create Consultation</h1>
          </div>
     </div>

     <form action="{{route('consultation.store')}}"  method="POST">
          @csrf
          <div class="row" >
               <div class="col-md-6">
                    <label for="">Appointment Id:</label>
                    <input type="text" style="min-width:360px;" class="addtocart_input" name="appoint_id"  id="appoint_id" readonly>

                    <label hidden for="">User ID:</label>
                    <input type="text" hidden style="width: 430px;" class="addtocart_input" id="userid" name="userid" readonly>
                    <button class="getappointment btn btn-outline-success" type="button" style="border: 1px solid #829460;"><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 15px ;
                    width: 15px ;" id="appointment" alt="" ></button>
                    <br>
                    <label style="margin-top: 5px" for="">Fullname:</label>
                    <input type="text" style="width: 460px" class="addtocart_input" id="fullname" name="fullname" readonly>
               
                    <label style="margin-top: 5px" for="">Date:</label>
                    <input type="text" style="width: 498px" class="addtocart_input" id="date" name="date" readonly>

                    <label style="margin-top: 5px" for="">Time:</label>
                    <input type="text" style="width: 498px" class="addtocart_input" id="time" name="time" readonly>
                    <input type="text" style="width: 498px" class="addtocart_input" hidden id="gender" name="gender" readonly>
                    <input type="text" style="width: 498px" class="addtocart_input" hidden id="age" name="age" readonly>
               </div>
               <div style="margin-top: 1px" class="col-md-6">
                    <label for="">Services: </label>
                    <input type="text" hidden style="width: 400px" class="addtocart_input servicename" id="servicename" name="servicename" >
                    <select style="width:470px; height:30px" class="service_input getservice"  name="service"  id="getservice">
                         <option value="">-- select --</option>
                         @foreach ($services as $service)
                         <option value="{{$service->services}}">{{$service->services }}</option>
                         @endforeach
                    </select>

                    <br>
                    <label style="margin-top: 5px" for="">Primary diagnosis:</label>
                    <input type="text" style="width: 400px" class="addtocart_input" value="" id="findings" name="primary_diag">
               </div>
          </div>
          
          <div style="margin-top:5px" >
               <label for="">Behavioral observation</label><br>
               <textarea class="addtocart_input" style="width: 100%;text-align: left;padding:10px;" name="observation" id="" cols="30" rows="10"></textarea><br>
               <label for="">Brief summary encounter</label><br>
               <textarea  class="addtocart_input" style="width: 100%;text-align: left;padding:5px;" name="summary" id="" cols="30" rows="10"></textarea><br>
               <label for="">Clinical impression</label><br>
               <textarea  class="addtocart_input" style="width: 100%; text-align: left;padding:5px;" name="impression" id="" cols="30" rows="10"></textarea><br>
               <label for="">Treatment given</label><br>
               <textarea  class="addtocart_input" style="width: 100%; text-align: left;padding:5px;" name="treatment" id="" cols="30" rows="10"></textarea><br>
               <label for="">Recommendation</label><br>
               <textarea name="recommendation"  class="addtocart_input" style="width: 100%; text-align: left; padding:5px;" id="" cols="30" rows="10"></textarea><br>
          </div>

          <div class="row">
               <div id="subtotal" class="subtotal d-flex justify-content-end col " style="margin-bottom:15px; margin-right:20px; justify-content:center">
                    <button type="submit"  class="saveaddtocart" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 180px;height: 40px; margin-left:1%; " >Save</button>
               </div>
          </div>
     </form>


     <div class="modal fade viewappointments " id="viewappointments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl ">
               <div class="modal-content viewbody" style="background: #EDDBC0;">
        
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom-color: gray">
                              <h4 class="modal-title">Appointments</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
        
                    <!-- Modal body -->
                    <div class="modal-body " >
                         <div class="patient patient-remove overflow-auto container-fluid" style="height:420px" >
                              <table class="table table-bordered appointments table-striped"  style="background-color: white; width:100%" >
                                   <thead>
                                        <tr>
                                             <th>id</th>
                                             <th>fullname</th>
                                             <th>date</th>
                                             <th>time</th> 
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
</div>                   
@endsection

@section('scripts')

<script src="{{mix('js/admin/consultation/create.js')}}"></script>

@endsection