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
<div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">
      @if (session()->has('success'))
            <div class="alert alert-success success"  id="success" >{{ session('success') }}</div> 
      @endif

      <div class="col-md-8 col-md-offset-5 d-flex justify-content-center " style="width: 100%">
            <h1>My Profile </h1>
      </div>

      <div class="d-flex justify-content-center">
            <div class="card w-100">
                  <div class="card-body  text-center  " style="background:#EDDBC0; padding: 20px 30px ; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
                        @if (Auth::user()->profile_pic == null)
                              <img style="border-radius:100%;height:150px; width:150px;box-shadow: -10px 0px 0px 5px  #829460;" src="{{url('profilepic/defaultprofile.png')}}" alt="">
                        @else
                              <img style=" border-radius:100%;height:150px; width:150px;box-shadow: -10px 0px 0px 5px  #829460;"  src="{{url('profilepic/' . Auth::user()->profile_pic )}}" alt="">
                        @endif
                        <form style="margin-top:15px" action="/secretary/myprofile/picture/update/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="file" name="profilepic"  style="width:180px ; "  >  
                              <button style="border-radius:3px; padding-left:7px;padding-right:7px ; padding-bottom:3px; padding-top:3px;background-color: #829460; border:none; color:white" type="submit">Change</button>
                        </form> 
                  </div>
            </div>
      </div>

      <div class="d-flex justify-content-center mt-4" style="margin-bottom: 20px">
            <div class="card w-100">
                  <div class="card-body " style="background:#EDDBC0; padding: 20px 30px ; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
                        <div class="d-flex justify-content-between">
                              <h3>Basic information</h3>
                              <a style="border-radius:3px; padding-left:10px;padding-right:10px ; padding-top:10px;background-color: #829460; border:none; color:white; text-decoration:none" href="/secretary/myprofile/edit">Edit</a>
                        </div>
            

                        <div class="row">
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">First name</label><br>
                              <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->fname}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Middle name</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->mname}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Last name</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->lname}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Sex</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->gender}}</label>
                              </div>
                        </div>

                        <div class="row" style="margin-top: 5px">
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Username</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->username}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for=""> Birthday</label><br>     
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word;"  for="">{{ date('M d, Y ', strtotime(Auth::user()->birthday))}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Age</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->age}}</label>
                              </div>
                              <div class="col-md-3">
                                    <label style="font-size: 15px; margin-top:15px" for="">Contact no.</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->mobileno}}</label>
                              </div>
                        </div>

                        <div class="row" style="margin-top: 5px">
                              <div class="col-md-4">
                                    <label style="font-size: 15px; margin-top:15px" for="">Email</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->email}}</label>
                              
                              </div>
                              <div class="col-md-4">
                                    <label style="font-size: 15px; margin-top:15px" for="">Status</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->status}}</label>
                              
                              </div>
                              <div class="col-md-4">
                                    <label style="font-size: 15px; margin-top:15px" for="">Usertype</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->usertype}}</label>
                              </div>
                        </div>

                        <div class="row" style="margin-top: 5px">
                              <div class="col-md-8">
                                    <label style="font-size: 15px; margin-top:15px" for="">Address</label><br>
                                    <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->address}}</label>
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
            setTimeout(function() {
                  $(".success").fadeOut(800);
            }, 2000);
      });
</script>
@endsection