@extends('layouts.navbar')
@section('content')


<div class="h-screen bg-[#EDDBC0]" style="font-family:Poppins; display:flex;flex-wrap:wrap flex-direction:column;justify-content:center; " >
    <form action="/patient/profile/update/{{Auth::user()->id}}" method="POST">
        @csrf
        @method('PUT')
     <div style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);margin:35px;width:auto;padding: 0% 5% 3% 5%;">
      <div>
      <h1 class="text-center text-[30px]" style="font-weight: 700">Change Profile</h1>

      <hr>
       
      <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >First Name</label>
      <input class="bg-white rounded  focus:outline-none " value="{{Auth::user()->fname}}" type="text" name="fname"> 
      @error('fname'){{$message}}@enderror
      <br>

   

    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" >Middle Name</label>
    <input class="bg-white rounded  focus:outline-none "style="max-width: 50%" value="{{Auth::user()->mname}}" type="text" name="mname">
    @error('mname'){{$message}}@enderror
    <br>

    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Last Name</label>
    <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->lname}}" type="text" 
    name="lname">
    @error('lname'){{$message}}@enderror
    
    <br>
    
    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Birthday</label>
    <input class="bg-white rounded  focus:outline-none" type="date" value="{{Auth::user()->birthday}}" name="birthday">
    @error('birthday'){{$message}}@enderror
    <br>
    
    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Address</label>
    <input class="bg-white rounded  focus:outline-none" type="text" value="{{Auth::user()->address}}"  name="address">
    @error('address'){{$message}}@enderror
    <br>

    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Gender</label>
    <select name="gender">
        <option value="" {{Auth::user()->gender == "" ? 'selected' : ''}}></option>
        <option value="Male" {{Auth::user()->gender == "Male" ? 'selected' : ''}}>Male</option>
        <option value="Female" {{Auth::user()->gender == "Female" ? 'selected' : ''}}>Female</option>
      </select>
      @error('gender'){{$message}}@enderror
    <br>
    
    <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mobile No.</label>
    <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->mobileno}}"  type="text" name="mobileno">
    @error('mobileno'){{$message}}@enderror
    <br>

    <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Email</label>
    <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->email}}" type="email" name="email">
    @error('email'){{$message}}@enderror
    <br>

    <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Username</label>
    <input class="bg-white rounded  focus:outline-none" type="text" value="{{Auth::user()->username}}" name="username">
    @error('username'){{$message}}@enderror
    <br>

    <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Old Password</label>
    <input class="bg-white rounded  focus:outline-none" type="text" name="old_password">
    @error('username'){{$message}}@enderror
    <br>

    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" for="password">New Password</label>
    <input class="bg-white rounded  focus:outline-none" type="password" name="password" >
    @error('password'){{$message}}@enderror
    <br>
      
    <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" for="password_confirmation" >Confirm Password</label>
    <input class="bg-white rounded  focus:outline-none" type="password" name="password_confirmation">
    @error('password_confirmation'){{$message}}@enderror
    
  </div>

 
<div style="text-align: right;">
   <button class="p-2 w-30 bg-[#829460]  mt-7 rounded" style="background: #829460;
      border-radius: 20px;color: #FFFFFF;border:#829460;" type="submit">Update</button>
</div>
   

      
      </form>
  
         
     

        @if(Session::has('error'))
        <span  role="alert" class="block  text-danger">{{Session::get('error')}}</span>
    @endif
    
  
         
          </form>
  
        </div>
</div>



@endsection