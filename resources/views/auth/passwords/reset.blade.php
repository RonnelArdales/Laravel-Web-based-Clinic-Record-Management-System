
@extends('layouts.auth')
@section('content')

<div class="container" style="font-family: Poppins;">
  <div class="row" style="margin-top:5%;">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto" >
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="login d-flex align-items-center py-5" style="background: #EDDBC0;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); ">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
  
                @if(Session::has('success'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{Session::get('success')}}</span>
                  </div>
                @endif
                <h3 class="login-heading mb-4" style="font-weight:700;">Enter Password</h3>
                  <hr>
                <!-- Sign In Form -->
                <form action="/updatepassword" method="POST">
                        @method('PUT')
                        @csrf
      
                        <div class="col-md-12 mt-3">
                        <label for="inputEmail4" class="form-label">New Password</label>
                        <div class="input-box" >
                              <input type="password" autocomplete="off" id="password" name="password">
                              <i class="show_password fa-regular fa-eye-slash"></i>
                              <i class="hidden_password fa fa-eye" style="display: none;" ></i>
                        </div>
                        
                        </div>
                        @error('password')  <span  role="alert" class="block  text-danger">{{$message}}</span> @enderror
                        <div class="col-md-12 mt-3">
                        <label for="inputEmail4" class="form-label">Confirm Password</label>

                        <div class="input-box" >
                            <input type="password" autocomplete="off" id="password_confirmation" name="password_confirmation">
                            <i class="show_confirm_password fa-regular fa-eye-slash"></i>
                            <i class="hidden_confirm_password fa fa-eye" style="display: none;" ></i>
                        </div>

                        </div>

                        @if(Session::has('error'))
                            <span  role="alert" class="block  text-danger">{{Session::get('error')}}</span>
                        @endif
  
                        <div class="d-grid" style="margin-top:5%;justify-content:center;">
                            <button style="background: #829460; border-radius: 15px; color:white; border:#829460;width: 100%;height: 37px;" type="submit">Reset Password</button>
                        </div>
                </form>
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
    $(document).ready(function () {
        $(document).on('click','.show_password', function(){
                $('.show_password').hide();
                $('#password').attr('type', 'text');
                $('.hidden_password').show();
        });

        $(document).on('click','.hidden_password', function(){
                $('.show_password').show();
                $('#password').attr('type', 'password');
                $('.hidden_password').hide();
        });

        $(document).on('click','.show_confirm_password', function(){
                $('.show_confirm_password').hide();
                $('#password_confirmation').attr('type', 'text');
                $('.hidden_confirm_password').show();
        });

        $(document).on('click','.hidden_confirm_password', function(){
                $('.show_confirm_password').show();
                $('#password_confirmation').attr('type', 'password');
                $('.hidden_confirm_password').hide();
        });
    });
</script>
@endsection
