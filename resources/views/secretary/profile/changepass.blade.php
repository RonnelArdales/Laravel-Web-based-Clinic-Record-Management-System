@extends('layouts.admin_navigation')
@section('content')


<div style="height:80vh;font-family:Inter;display:flex;flex-direction:column;justify-content:center;align-items:center;">

  @if (session()->has('success'))
  <div class="alert alert-success success"   id="success" >{{ session('success') }}</div> 
  @endif
  

<div class="container" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 447px;
height: 458px;padding:1% 2% 1% 2%;background: #EDDBC0;">
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


  <form action="/secretary/myprofile/changepassword/update" method="POST">
    @csrf

    <div style="padding:0 8% 0 8%">
      <label class="labelang" for="exampleFormControlInput1">Old password:</label>
                <input style="border: 1px solid #829460;border-radius:0;height: 29px;background: #EDDBC0;" type="password" class="form-control" name="oldpassword" id="exampleFormControlInput1">
                @if (session('oldpassword'))
                      <span  role="alert" class="block mt-5 pb-4 text-danger">{{ session('oldpassword') }} </span><br>
            @endif

            <label class="labelang" for="exampleFormControlInput1">New password:</label>
                <input style="border: 1px solid #829460;border-radius:0;height: 29px;background: #EDDBC0;" type="password" class="form-control" name="password" id="exampleFormControlInput1" >
                @error('password')
                <span style="margin-bottom: 10px"  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span><br>
                @enderror

                <label class="labelang" for="exampleFormControlInput1">Confirm-password:</label>
                <input style="border: 1px solid #829460;border-radius:0;height: 29px;background: #EDDBC0;" type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1" >
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
      });
</script>

@endsection