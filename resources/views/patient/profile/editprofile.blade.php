@extends('layouts.navbar')
@section('content')



<style>


</style>


<div class="container" style="margin-bottom:5%">
  <div class="card w-40 " style="padding:3%; box-sizing: border-box;font-family:Inter; background:#EDDBC0;padding-top:1%; margin-bottom:4%;padding-bottom:1%;margin-top:2%;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border-radius:0;">
    


      <div class="divngpamagat1">
        <h1 class="pamagat" >EDIT</h1><br>
        <h1 class="pamagat" >PROFILE.</h1>
      </div>

      <div class="divngpamagat2" >
        <h1 class="pamagat2" >EDIT PROFILE.</h1>
      </div>
     

    <div class="linya"></div>
    
        <div style="margin-left:1%;">
            <p>Keep your profile <b> updated </b> to avoid misinformation and <b>change password regularly  </b> to avoid forgetting your password. </p>
        </div>

    <form action="/patient/profile/update/{{Auth::user()->id}}" method="POST">
          @csrf
          @method('PUT')
    <div style="display: flex;flex-direction:column; justify-content:center;">
    <div class="container1">
        <div class="row" style="width: 100%">
          
          
          <div class="col-sm">

          <label class="form-label"  >First Name:</label>
          <br><input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%" value="{{Auth::user()->fname}}" type="text" name="fname"> 
          @error('fname')
          <span  role="alert" class="block  text-danger">{{$message}}</span>
          @enderror
          
          <br>

          <label class="form-label" >Middle Name:</label>
          <br><input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%" value="{{Auth::user()->mname}}" type="text" name="mname">
          @error('mname')
          <span  role="alert" class="block  text-danger">{{$message}}</span>
          @enderror
          
          <br>

          <label class="form-label">Last Name:</label>
         <br> <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{Auth::user()->lname}}" type="text" 
          name="lname">
          @error('lname')
          <span  role="alert" class="block  text-danger">{{$message}}</span>
          @enderror
          
          <br>
            <div class="row">
              <div class="col-sm">
                <label class="form-label">Birthday:</label> <br>
                <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;"  type="date" value="{{Auth::user()->birthday}}" name="birthday">
                @error('birthday')
                <span  role="alert" class="block  text-danger">{{$message}}</span>
                @enderror
              </div>
  
              <div class="col-sm">
                <label class="form-label">Gender:</label> <br>
                <select name="gender" style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;">
                    <option value="" {{Auth::user()->gender == "" ? 'selected' : ''}}></option>
                    <option value="Male" {{Auth::user()->gender == "Male" ? 'selected' : ''}}>Male</option>
                    <option value="Female" {{Auth::user()->gender == "Female" ? 'selected' : ''}}>Female</option>
                  </select>
                  @error('gender')
                  <span  role="alert" class="block   text-danger">{{$message}}</span>
                  @enderror
               
              </div>
            </div>
            <div class="input-group">
              <label class="form-label">Address:</label>
              <textarea class="form-control" aria-label="With textarea" style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;height: 85px;"  type="text" value=""  name="address">{{Auth::user()->address}}</textarea>
              @error('address')
              <span  role="alert" class="block text-danger">{{$message}}</span>
              @enderror
              <br>
            </div>


              <label class="form-label" >Mobile Number:</label> <br>
              <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{Auth::user()->mobileno}}"  type="text" name="mobileno">
              @error('mobileno')
              <span  role="alert" class="block  text-danger">{{$message}}</span>
              @enderror
              <br>

         </div>
          
           <div class="col-sm-1"></div>


          <div class="col-sm">

            <label class="form-label" >Email:</label> <br>
            <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{Auth::user()->email}}" type="email" name="email">
            @error('email')
            <span  role="alert" class="block   text-danger">{{$message}}</span>
            @enderror
            <br>

            <label class="form-label" >Username:</label> <br>
            <input readonly style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" type="text" value="{{Auth::user()->username}}" name="username">
            @error('username')
            <span  role="alert" class="block   text-danger">{{$message}}</span>
            @enderror
            <br>
         
            <label class="form-label" style="width: 100%;">Set a <b>new password.</b>  </label> 
         
            <label class="form-label"  >Old Password:</label><br>
            <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{old('old_password')}}" type="password" name="old_password">
            @if(session('error'))
            <span  role="alert" class="block  text-danger">{{ session('error') }}</span>
            @endif
            <br>
          
            <label class="form-label" for="password">New Password:</label> <br>
            <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{old('password')}}" type="password" name="password" >
            @error('password')
            <span  role="alert" class="block  text-danger">{{$message}}</span>
            @enderror
            <br>
              
            <label class="form-label" for="password_confirmation" >Confirm Password:</label><br>
            <input  style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" type="password" name="password_confirmation">
            

            <div style="margin-top:10%;text-align:right;">
              <button style="background: #829460;
              border-radius: 20px;color: #FFFFFF;border:#829460;font-weight: 700;width: 100px;
            height: 35px;" type="submit">Update</button>
            </div>
          </div>
        </div>
    </div>
  </div>
  </form>
    </div>
  
  </div>





@endsection