@extends('layouts.auth')
@section('content')

<style>
      .form-check:hover {
          background-color: #f5f5f5;
          cursor: pointer;
      }
  </style>
  
<div class="container my-5" style="font-family: Poppins; ">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="login d-flex align-items-center pt-5 pb-3" style="background: #EDDBC0;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
          <div class="container">
            <div class="row">
              <div class="">
        
                @if(Session::has('success'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{Session::get('success')}}</span>
                  </div>
                @endif
                  <form action="/select/sendcode" method="POST">
                        @csrf

                  <div class="row">
                  <div class="col-sm">
                        <p>How do you want to get the code to reset your password?</p> 

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="email" value="email" id="email">
                            <label class="form-check-label" for="email">Email</label>
                        </div>
                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mobileno" value="mobileno" id="mobileno">
                            <label class="form-check-label" for="mobileno">Mobile Number</label>
                        </div>
                  </div>
                  <div class="col-sm text-center d-flex flex-column justify-content-center align-items-center">
              
                        @if (Auth::user()->profile_pic == null ) 
                        <img src="{{ url('profilepic/defaultprofile.png') }}" width="50" height="50" style="border-radius: 100%" alt="">
                    @else
                        <img  src="{{ url('profilepic/' . Auth::user()->profile_pic) }}" width="50" height="50" alt="" style="border-radius: 100%">
                    @endif
                         <label for="" style="width:200px; height:auto; font-size:14px">{{Auth::user()->username}}</label> 

                  </div>


              </div>
              <div class="text-end mt-4 " >
                  <button style="background: #829460; border-radius: 15px; color:white; border:#829460;width: 110px;height: 37px;"  type="submit">Send code</button>
              </div>

                        
                  </form>
    
            
               

                {{-- <form action="">
                    <div class="row">
                        <div class="col-md-6">
                            <label style="font-size: 15px; margin-top:15px" for="">First name</label><br>
                        <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->fname}}</label>
                      </div>
                      <div class="col-md-6">
                            <label style="font-size: 15px; margin-top:15px" for="">Middle name</label><br>
                            <label style="font-size: 18px; text-align: justify; text-justify: inter-word; "  for="">{{Auth::user()->mname}}</label>
                      </div>
                    </div>
                </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      $(document).ready(function() {

      $('#email').prop('checked', true);

    $('.form-check').click(function() {
        var checkbox = $(this).find('input[type="checkbox"]');
        checkbox.prop('checked', !checkbox.prop('checked'));

        $('.form-check-input').not(checkbox).prop('checked', false);
    });
});
</script>
@endsection