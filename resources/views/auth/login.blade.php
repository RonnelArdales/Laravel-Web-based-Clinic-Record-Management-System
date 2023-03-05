@extends('layouts.navbar')
@section('content')
    

   

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

      </div>        



{{-- <div class=" h-screen bg-[#EDDBC0]">
    <form action="/login/process" method="POST">


        @csrf
        <div class="mb-5 pt-6 rounded columns-1 sm:columns-2 bg-[#EDDBC0]">
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >email</label>
            <input class="bg-white rounded  text-gray-700 focus:outline-none border-b-4 
            border-gray-400 mg-5" type="email" name="email" value="{{old('email')}}"> --}}
            {{-- error message if email is not valid --}}
            {{-- <span >@error('email'){{$message}}@enderror</span>
            <br>
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" for="password" >Password</label>
            <input class="bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="password" name="password" >
            @error('password'){{$message}}@enderror
            <br>
        </div>
            <button class="p-2 w-30 bg-[#829460] mt-7 rounded" type="submit">Submit</button>
            </form>
            <h1>admin</h1>
<br>
<p>email: admin@gmail.com</p><br>
<p>password: admin</p>
<br>
<h1>patient</h1>
<br>
<p>email: patient@gmail.com</p><br>
<p>password: patient</p>
<br>
<h1>secretary</h1>
<br>
<p>email: secretary@gmail.com</p><br>
<p>password: secretary</p>
</div> --}}


@endsection