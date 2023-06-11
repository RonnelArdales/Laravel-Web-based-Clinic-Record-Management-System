@extends('layouts.admin_navigation')
@section('content')

<style>
  .input-box{
    background: #EDDBC0; 
    border: 1px solid #829460;
    padding-left:12px;
    padding-right:12px;
    height:29px;
  }

  .input-box input{
    outline: none;
    border:none;
    background: #EDDBC0; 
    width: 92%;
  }
</style>

 <div style="height:80vh;font-family:Inter;display:flex;flex-direction:column;justify-content:center;align-items:center;">
  <div class="container" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 447px;
  min-height: 458px; height:auto; padding:1% 2% 1% 2%;background: #EDDBC0;">
    <div class="row">
      <div class="col-sm" style="text-align-left;">
          <img style="width: 100px;
          height: 100px;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1668999920/Psych/Ellipse_1-removebg-preview_exqd2u.png" alt="logo">
      </div>
      <div class="col-sm" style="text-align: right;padding-top:6%;align-items:center;">
        <h1 style="font-weight: 800;
        font-size: 32px;margin:2% 0 0 0;line-height: 0%;">CHANGE</h1> <br>
        <h1 style="font-weight: 800;
        font-size: 32px;margin:1% 0 0 0;line-height: 0%;">PASSWORD.</h1>
      </div>
    </div>
      <div style="margin-top:3%;">
        <p style="font-size: 14px;">The next time you log in, use the <b>new set of password</b>  you’ll create below.</p>
      </div>

      @if (session()->has('success'))
      <div class="alert alert-success success"   id="success" >{{ session('success') }}</div> 
      @endif
  
      <form action="/admin/myprofile/changepassword/update" method="POST">
        @csrf
  
        <div style="padding:0 8% 0 8%">
          <label class="labelang" for="exampleFormControlInput1">Old password:</label>
          <div class="input-box">
            <input type="password" name="oldpassword" id="oldpassword" value="{{ old('oldpassword') }}">
            <i class="oldpass_show fa-regular fa-eye-slash"></i>
            <i class="oldpass_hide fa fa-eye" style="display: none;" ></i>
          </div>
                   
                    @if (session('oldpassword'))
                          <span  role="alert" class="block mt-5 pb-4 text-danger">{{ session('oldpassword') }} </span><br>
                @endif
  
                <label class="labelang" for="exampleFormControlInput1">New password:</label>
                <div class="input-box">
                  <input  type="password" name="password" id="password" value="{{ old('password') }}" >
                  <i class="newpass_show fa-regular fa-eye-slash"></i>
                  <i class="newpass_hide fa fa-eye" style="display: none;" ></i>
                </div>
                 
                    @error('password')
                    <span style="margin-bottom: 10px"  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span><br>
                    @enderror
  
                    <label class="labelang" for="exampleFormControlInput1">Confirm-password:</label>
                    <input value="{{ old('password_confirmation') }}" style="border: 1px solid #829460;border-radius:0;height: 29px;background: #EDDBC0;" type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1" >
        </div>
        <div style="text-align:right;margin: 20px 5px 0 0 ">
          <button  style="color:white;font-weight: 700;width: 100px;
          height: 35px;
          font-size: 14px;background: #829460;
  border-radius: 20px;border:#829460;" type="submit" >Change</button>
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

            $(document).on('click','.oldpass_show', function(){
                  $('.oldpass_show').hide();
                  $('#oldpassword').attr('type', 'text');
                  $('.oldpass_hide').show();
            });

            $(document).on('click','.oldpass_hide', function(){
                  $('.oldpass_show').show();
                  $('#oldpassword').attr('type', 'password');
                  $('.oldpass_hide').hide();
            });

            $(document).on('click','.newpass_show', function(){
                  $('.newpass_show').hide();
                  $('#password').attr('type', 'text');
                  $('.newpass_hide').show();
            });

            $(document).on('click','.newpass_hide', function(){
                  $('.newpass_show').show();
                  $('#password').attr('type', 'password');
                  $('.newpass_hide').hide();
            });
      });
</script>

@endsection