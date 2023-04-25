
@extends('layouts.login_register')
@section('title', 'Register')
@section('content')

{{-- <div class="container card" style="font-family:Poppins; background:#EDDBC0;padding-top:1%; margin-bottom:1%;padding-bottom:1%;">
  <p style="font-family: Poppins;text-align:center;" > To sign up, please complete all needed information below. <strong>Do not leave an fields blank.</strong> </p>
  <form class="row  "  action="/store" method="POST">
    @csrf

     <h4>NAME</h4>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">First Name:</label>
      <input  type="text" class="form-control" name="first_name" >
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">Middle Name:</label>
      <input  type="text" class="form-control" name="mname" >
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">Last Name:</label>
      <input type="text" class="form-control" name="last_name" >
      @error('last_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-12">
      <h4>Address</h4>
      <input type="text" class="form-control" name="address" >
      @error('address')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <h4>BIRTHDATE</h4>
      <input style="text-align:center" type="date" class="form-control"   name="birthday" >
      @error('birthday')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
     <h4>GENDER</h4>
      <select name="gender" class="form-control">
        <option style="text-align:center" value="">--select--</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      @error('gender')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <h4>CONTACTS</h4>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">Mobile Number:</label>
      <input type="text" class="form-control" name="mobile_number"  >
      @error('mobile_number')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Email Address:</label>
      <input type="text" class="form-control" name="email" >
      @error('email')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <h4>CREATE ACCOUNT</h4>
        <div class="col-6">
      <label for="inputAddress" class="form-label">Username:</label>
      <input type="text" class="form-control" name="username" >
      @error('username')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
 
    <div class="col-6">
      <label for="inputAddress" class="form-label">Password:</label>
      <input type="password" class="form-control" name="password" >
      @error('password')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Confirm Password:</label>
      <input type="text" class="form-control" name="password_confirmation"  >
    </div>
    
    <div>
      <h4 style="text-align: center;">UPLOAD VALID ID</h4>
      <button class="btn btn-primary mb-3 mt-2">Upload Photo</button>
    </div>

    <p>By clicking <strong>Sign Up</strong> , you agree to our <button type="button" data-bs-toggle="modal" data-bs-target="#create" class="logoutbutton" style="outline: none" ><strong>Terms and Privacy Policy.</strong></button> You may receive Email Notifications from us for the verification code to successfully sign in.</p>

    <div class="col-12 text-right">
      <button class="hober" style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 200px;border:#829460; 
      height: 47px; " type="submit" >Sign Up</button>
    </div>
    
  </form> 

</div> --}}


<div class="container card " style="font-family:Poppins; background:#EDDBC0;padding-top:1%; margin-bottom:1%;padding-bottom:1%;">
  <style>
   
    label{
      font-weight: 400;
    }
    div{
      text-align: center;
    }
    h4{
      font-weight: 700;
      text-align: left;
    }
    @media (max-width: 400px) {
          label{ 
            text-align: left;
          }
        }
        /* di ko alam bat ayaw gumana yung hover kung dahil ba sa bootstrap o sa code ko pero parang okay namna yung code */
    .hober:hover{
      color:black;
      background: white;
    }
  </style>
  <form class="row  "  action="/store" method="POST">
    @csrf

    <p style="font-family: Poppins;text-align:center;" > To sign up, please complete all needed information below. <strong>Do not leave an fields blank.</strong> </p> 
    <h4>NAME</h4>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">First Name:</label>
      <input  type="text" class="form-control" value="{{old('first_name')}}" name="first_name" >
      @error('first_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">Middle Name:</label>
      <input  type="text" value="{{old('mname')}}"  class="form-control" name="mname" >
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">Last Name:</label>
      <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" >
      @error('last_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-12">
      <h4>Address</h4>
      <input type="text" class="form-control" value="{{old('address')}}"  name="address" >
      @error('address')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <h4>BIRTHDATE</h4>
      <input style="text-align:center" value="{{old('birthday')}}" type="date" class="form-control"   name="birthday" >
      @error('birthday')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
     <h4>Age</h4>
     <input type="number" style="text-align:center" value="{{old('age')}}" type="age" class="form-control"   name="age" >
      @error('age')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <h4>GENDER</h4>
       <select name="gender" class="form-control">
         <option style="text-align:center" value="">--select--</option>
         <option value="Male" {{old('gender') == "Male" ? 'selected' : ''}}>Male</option>
         <option value="Female" {{old('gender') == "Female" ? 'selected' : ''}}>Female</option>
       </select>
       @error('gender')
       <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
       @enderror
     </div>
    <h4>CONTACTS</h4>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">Mobile Number:</label>
      <input type="number" value="{{old('mobile_number')}}"  class="form-control" name="mobile_number"  >
      @error('mobile_number')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Email Address:</label>
      <input type="text" value="{{old('email')}}"  class="form-control" name="email" >
      @error('email')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <h4>CREATE ACCOUNT</h4>
        <div class="col-6">
      <label for="inputAddress" class="form-label">Username:</label>
      <input type="text" value="{{old('username')}}"  class="form-control" name="username" >
      @error('username')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
 
    <div class="col-6">
      <label for="inputAddress" class="form-label">Password:</label>
      <input type="password" class="form-control" name="password" >
      @error('password')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Confirm Password:</label>
      <input type="password" class="form-control" name="password_confirmation"  >
    </div>
    
    <div class=" mb-3 mt-2">
      {{-- <h4 style="text-align: center;">UPLOAD VALID ID</h4>
      <button class="btn btn-primary mb-3 mt-2">Upload Photo</button> --}}
    </div>

    <p>By clicking <strong>Sign Up</strong> , you agree to our <button type="button" data-bs-toggle="modal" data-bs-target="#privacy" class="logoutbutton" style="outline: none" ><strong>Terms and Privacy Policy.</strong></button> You may receive Email Notifications from us for the verification code to successfully sign in.</p>

    <div class="col-12 text-right">
      <button class="hober" style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 200px;border:#829460; 
      height: 47px; " type="submit" >Sign Up</button>
    </div>
  </form> 

<x-privacyact/>

</div> 





@endsection

 {{-- Eto yung galing sa yt pero di gumana yung media --}}
{{-- <style>
  .buo{
    display: flex;
    flex-direction: row;

  }
  .firstcol{
    flex: 1;
    height: 1000px;
    background: white;
  }
  .secondcol{
    flex: 1;
    height: 1000px;
    background: #829460;
  }
  @media (max-width: 400px) {
          .buo{ 
            flex-direction: column;
            height: 500px;;
          }
        }
</style>

<div class="buo">
      <div class="firstcol"></div>

      <div class="secondcol" ></div>
</div> --}}


{{-- ETO YUNG UNA KONG SAMPLEE --}}
{{-- <div style="margin:2%">

  <style>
    h4{
      font-weight: 700;
      /* font-size: 1.5vw; */
    }
    label{
      font-weight: 400;
      /* font-size: 1vw; */
    }
   
  </style>
<p style="font-family: Poppins;text-align:center;" > To sign up, please complete all needed information below. Do not leave an fields blank.</p> 

<div class="samplelang" style="font-family: Poppins; display: flex; flex-direction: row; justify-content: center;">

  <div style="flex:1;background:white">
    <h4>NAME</h4>
    <div>
      <label for=""> First Name: </label> 
      <input type="text" class="form-control" name="first_name" >
      @error('first_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
      <br><label for=""> Middle Name: </label>
      <br><label for=""> Last Name: </label>
    </div>
    
    <h4>BIRTH DATE</h4>
    
    <h4>GENDER</h4>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
      <label class="form-check-label" for="inlineRadio1">Female</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
      <label class="form-check-label" for="inlineRadio2">Male</label>
    </div>
    <h4>ADDRRESS</h4>
    <h4>CONTACTS</h4>
    <label for="">Mobile Number:</label>
    <br><label for="">E-mail Address:</label>

  </div>

  <div style="flex:1; background:#829460">
    <div>
      <h4>CREATE ACCOUNT</h4>
      <label for="">Username:</label>
      <br><label for="">Password:</label>
      <br><label for="">Confirm Password:</label>
  
    </div>
    
  
      <h4>UPLOAD VALID ID</h4>

   
    <p>By clicking Sign Up, you agree to our Terms and Privacy <br> Policy. You may receive Email Notifications from us for <br> the verification code to successfully sign in.</p>
    <button type="submit"  style="background: #829460;
    border-radius: 20px;font-family: 'Poppins';font-style: normal;font-weight: 700;color:white; border:none;">Register</button>
  </div> 

</div> --}}
{{-- border-0 shadow
rounded-3
border
border-dark --}}
{{-- </div> --}}

