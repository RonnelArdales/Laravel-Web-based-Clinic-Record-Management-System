@section('title', 'Register')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">


    







</head>

<style>
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

  body{
 background-color: #829460;
 padding: 0;
 margin: 0;

 font-family: 'Inter';
 font-size: 14px;
  }
  input{
    font-size: 14px;
    font-family: 'Inter';
  }
  .sample{
    background-image:url('https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682778291/JG_MARQUEZ_RPSY_register_jkl47v.png');
    background-size:cover;
    background-repeat: no-repeat;
    background-position:center;
    height:100vh
  }
  @media (max-width: 580px) {
  .sample{
    height: 45vh;
    width:100%;
  }
  h2{
    margin-top:25px; 
  }


  }
</style>

<body>


      <div>

             <div class="container-fluid " style="width:100%; color:white">

              <div class="row">                    
                        <div class="col-sm"  >
                          <div class="sample" >
                           <a href="/" style="text-decoration: none;color:white"><h4  style="font-weight: 800;padding-left:15px;" >JG MARQUEZ, RPSY</h4></a> 
                          </div>
                         
                        </div>
<!--------------- RIGHT SIDE  CONTENTS ----------------->
                 <div class="col-sm" style="display: flex;flex-direction:column; justify-content:center;">
                        <div style="padding-left:2%">
                          <h2 style="font-weight: 800;">WELCOME.</h2>
                            <p style="padding: 0; margin:0;">To sign up, please complete all needed information below. <b> Do not leave any fields blank. </b> </p>
                            <div style="display: flex;flex-direction:row;padding: 0; margin:0;">
                            <p style="padding: 0; margin:0;">Already have an account? <a href="/login " style="text-decoration: none;color:white;"> <b> Log in here.</b> </a></p>
                         
                            </div>
                          
                        </div>
                                 
                         <!----FILL UP FORM FOR REGISTER / TEXTBOXES----------->

                          <div style="padding:4%; width:75%;height: auto;align-self:center;"> 
                          <form class="row  "  action="/store" method="POST">
                           @csrf
                           <div class="container">
                              <div class="row" style="color: white">


                                    <div class="col-sm" >
                                        <label for="inputEmail4" class="form-label">First Name</label>
                                        <input  style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;" type="text" class="form-control" value="{{old('first_name')}}" name="first_name" >
                                        @error('first_name')
                                        <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                      <div class="col-sm" >
                                        <label for="inputPassword4" class="form-label">Middle Name</label>
                                        <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;" type="text" value="{{old('mname')}}"  class="form-control" name="mname" >                    
                                      </div>

                                      <div class="col-sm">
                                          <label for="inputPassword4" class="form-label">Last Name</label>
                                          <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;" type="text" class="form-control" value="{{old('last_name')}}" name="last_name" >
                                            @error('last_name')
                                          <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                            @enderror
                                      </div>

                                    <div class="row" style="margin-top:2%;padding-right:0;">
                                            <div class="col">
                                               <label for="inputPassword4" class="form-label">Birth Date</label>
                                                <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;" style="text-align:center" value="{{old('birthday')}}" type="date" class="form-control"   name="birthday" >
                                                @error('birthday')
                                                <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="col">
                                                <label for="">Age</label>
                                                <input type="number" style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0;margin-top:8px; color: white;font-size: 14px;"  style="text-align:center" value="{{old('age')}}" type="age" class="form-control"   name="age" >
                                                  @error('age')
                                                  <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                                  @enderror
                                            </div>

                                            <div class="col-sm" style="padding-right: 0;">
                                               <label  for="">Gender</label>
                                               <select style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0;margin-top:8px; color: white;font-size: 14px;padding:0;" name="gender" class="form-control">
                                                <option style="text-align:center;line-height:0;font-size:2px" value="">--select--</option>
                                                <option value="Male" {{old('gender') == "Male" ? 'selected' : ''}}>Male</option>
                                                <option value="Female" {{old('gender') == "Female" ? 'selected' : ''}}>Female</option>
                                              </select>
                                              @error('gender')
                                              <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                              @enderror
                                            </div>
                                          
                                    </div>





                              </div>
                            </div>

                            <div style="margin-top:2%">
                                   <label for="inputPassword4" class="form-label">Address</label>
                                    <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="text" class="form-control" value="{{old('address')}}"  name="address" >
                                    @error('address')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                            </div>

                            <div class="container">
                              <div class="row" style="margin-top:2%">
                                  <div class="col-sm" style="">
                                  <label for="inputEmail4" class="form-label">Mobile Number:</label>
                                  <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="number" value="{{old('mobile_number')}}"  class="form-control" name="mobile_number"  >
                                    @error('mobile_number')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror

                                  </div>
                                  <div class="col-7">
                                  <label for="inputAddress" class="form-label">Email Address:</label>
                                  <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="text" value="{{old('email')}}"  class="form-control" name="email" >
                                  @error('email')
                                  <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                  @enderror

                                  </div>
                              </div>
                            </div>
                            
                            <div class="container" >
                            
                              <div class="row" style="margin-top:2%">                                       
                                        <div class="col-7">
                                              <label for="inputAddress" class="form-label">Username:</label>
                                              <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="text" value="{{old('username')}}"  class="form-control" name="username" >
                                              @error('username')
                                              <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                              @enderror
                                        </div>

                                        <div class="col" style="padding-left: 0;">
                                              <label for="inputAddress" class="form-label">Password:</label>
                                              <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="password" class="form-control" name="password" >
                                              @error('password')
                                              <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                              @enderror
                                        </div>
                                      </div>
                            </div>

                                      <div class="container">
                                        <div class="row" style="margin-top:2%;padding-right:0;">
                                          <div class="">
                                          <label for="inputAddress" class="form-label">Confirm Password:</label>
                                          <input style="background:#829460;border: 1px solid #EDDBC0;height: 24px;border-radius:0; color: white;font-size: 14px;"  type="password" class="form-control" name="password_confirmation"  >
                                          </div>
                                       
                                    </div>

                                      </div>
                                       
                              
                                

                           

                         </div>
              <div style="padding-left:3%">

              <button style="font-weight: 700;background-color:#EDDBC0;border-radius: 5px;border:none;width: 89px;height: 34px; ;color: #829460; margin: 5px 0 8px 0"> Sign Up</button>
        


                <p>By clicking <b> Sign Up</b>, you agree to the <button type="button" data-bs-toggle="modal" data-bs-target="#privacy" class="logoutbutton" 
                style="outline: none;
                  text-decoration: none;
                  background:none;
                  border:none;
                  margin:0;
                  font-family: 'Inter';
                  font-weight:900;
                  padding:0;
                  cursor: pointer;
                  color:white;" ><b> Terms and Privacy Policy </b> </button> .</a>  You may receive an email notification for the email verification.</p>
              </div>

                  </div>
                        
            </div>
   
      </div>
    </form> 
    <x-privacyact/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>

   
  








