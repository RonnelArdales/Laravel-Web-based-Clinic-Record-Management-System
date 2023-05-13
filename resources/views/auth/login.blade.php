@extends('layouts.login_register')
@section('title', 'Login')
@section('content')


<div class="container-fluid main" >
  <div style="background: #EDDBC0; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);width: 358px;
 margin-right:18%; ;margin-left:15%; margin-top:5%; padding: 3% 4% 3% 4%">
    
    <div style="display:flex; flex-direction:row;">
        <div style="background-color:#829460;width:4px; height: 70px; border-radius:5px; margin-right:2px "></div>
        <p style="black;font-family: 'Song Myung'; font-style: normal; font-weight: 450; font-size: 44px; line-height: 70px;">welcome.</p>
      </div>

      @if(Session::has('success'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <span class="block sm:inline">{{Session::get('success')}}</span>
        </div>
      @endif 


      <!-- Sign In Form -->
<form action="/login/process" method="POST">
        @csrf
  
          <input style="font-family:Poppins; margin-bottom:5%; border:none; border-bottom: 2px solid rgba(0, 0, 0, 0.5);;background-color:#EDDBC0; width:100%"  placeholder="E-mail" name="email" value="{{ old('email') }}" >  
          <input style="font-family:Poppins; margin-bottom:5%;border:none; border-bottom: 2px solid rgba(0, 0, 0, 0.5);;background-color:#EDDBC0; width:100% " placeholder="Password" type="password" autocomplete="off" value="{{old('password')}}" id="floatingPassword" name="password" >  
          @foreach ($errors->all() as $message) 
          <span  role="alert" class="block  text-danger">{{ $message }}</span>
          @endforeach
          @if(Session::has('error'))
          <span  role="alert" class="block  text-danger">{{Session::get('error')}}</span>
          @endif

   <div style="text-align: center; margin-top: 2%">
  <button type="submit"    style="text-align:center; background: #829460; border-radius: 20px; width:85%; border:none; color:white; font-family: Poppins;font-weight:700; font-size:15px;" >Log In</button>
 
  <p style="margin-top: 10px"> --------- or ---------</p>

  <a href="/register" style="text-decoration:none; font-family:Poppins; text-align:center; color:#829460; line-height: 1vw;border-radius: 20px; width: px; border: 2px solid #829460; padding:0 68px 0 68px;font-weight:700;font-size:15px " >Sign Up</a> 
  
    <div  style="margin-top: 5%; display:flex; flex-direction:row;font-size: 13px;justify-content:center;">
      <p style="font-family: 'Poppins';
      font-style: normal;
      font-weight: 400;">Forgot Password?</p>
      <a style="font-family: 'Poppins';
      font-style: normal;
      font-weight: 400;margin-left:3px;color:#829460;" href="/identify">Click Here</a>
    </div>
 </div>
</form> 
 </div>

</div>

{{-- Eto yung shape na paoblong yung may logo --}}
<style>
@media (max-width: 767px) {
.hidelogo {
  display: none;
}
}
</style>

<div class="hidelogo" style="position: absolute; width: 17%;height: 88%;
top:0px;
margin-top:2%;
left:60%;
background: #829460;
border-radius: 200px;
text-align:center; padding-top:10%;
">

<img  style=" height: 13vw; width: 13vw; margin-left:auto; margin-right: auto; border-radius: 9999px;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="logo">
<p style="font-family: 'Noto Serif Gujarati';
font-style: normal;
font-weight: 600;
font-size: 20px;
line-height: 16px;
text-align: center;
text-transform: uppercase;
margin-top:6%;
color: #FFFFFF;"> JGMarquez, RPsy</p>

</div>        
    
{{-- 
<div>   

            <div style="background: #EDDBC0; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);width: 358px;
            height: 415px; margin-left:15%; margin-top:5%; padding: 3% 4% 3% 4%">
              
              <div style="display:flex; flex-direction:row;">
                  <div style="background-color:#829460;width:4px; height: 70px; border-radius:5px; margin-right:2px "></div>
                  <p style="black;font-family: 'Song Myung'; font-style: normal; font-weight: 450; font-size: 44px; line-height: 70px;">welcome.</p>
                </div>

                @if(Session::has('success'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{Session::get('success')}}</span>
                  </div>
                @endif 
 
                <!-- Sign In Form -->
        <form action="/login/process" method="POST">
                  @csrf
            
                    <input style="font-family:Poppins; margin-bottom:5%; border:none; border-bottom: 2px solid rgba(0, 0, 0, 0.5);;background-color:#EDDBC0; width:100%"  placeholder="E-mail" name="email" value="{{old('email')}}" >  
                    <input style="font-family:Poppins; margin-bottom:5%;border:none; border-bottom: 2px solid rgba(0, 0, 0, 0.5);;background-color:#EDDBC0; width:100% " placeholder="Password" type="password" autocomplete="off"  id="floatingPassword" name="password" >  
                
                  @if(Session::has('error'))
                  <span  role="alert">{{Session::get('error')}}</span>
              @endif

             <div style="text-align: center; margin-top: 2%">
            <button type="submit"    style="text-align:center; background: #829460; border-radius: 20px; width:85%; border:none; color:white; font-family: Poppins;font-weight:700; font-size:15px;" >Log In</button>
           
            <p style="margin-top: 10px"> --------- or ---------</p>

            <a href="/register" style="text-decoration:none; font-family:Poppins; text-align:center; color:#829460; line-height: 1vw;border-radius: 20px; width: px; border: 2px solid #829460; padding:0 68px 0 68px;font-weight:700;font-size:15px " >Sign Up</a> 
            
              <div  style="margin-top: 5%; display:flex; flex-direction:row;font-size: 15px;">
                <p style="font-family: 'Poppins';
                font-style: normal;
                font-weight: 400;">Forgot Password?</p>
                <a style="font-family: 'Poppins';
                font-style: normal;
                font-weight: 400;margin-left:2px;" href="/identify"> Click Here</a>
              </div>
           </div>
           </div>
        </form> 
       </div>

       <div style="position: absolute; width: 17%;height: 88%;
       top:0px;
       margin-top:2%;
       left:60%;
       background: #829460;
       border-radius: 200px;
       text-align:center; padding-top:10%;">
  
        <img  style=" height: 13vw; width: 13vw; margin-left:auto; margin-right: auto; border-radius: 9999px;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="logo">
        <p style="font-family: 'Noto Serif Gujarati';
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 16px;
        text-align: center;
        text-transform: uppercase;
        margin-top:6%;
        color: #FFFFFF;"> JGMarquez, RPsy</p>

      </div>         --}}






@endsection