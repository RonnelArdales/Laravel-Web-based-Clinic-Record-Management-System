@extends('layouts.admin_navigation')
@section('content')
<style>
      label{
            font-family: 'Poppins';
      }
      .addtocart_input, .service_input{
            background: #D0B894;
            border-radius: 10px;
            border:none;
            margin-bottom: 1%;
            text-align: center; 
      }
</style>
<div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">
      <div class="col-md-8 col-md-offset-5 d-flex justify-content-center " style="width: 100%">
          <h1>Edit profile </h1>
      </div>
  
      <div class="d-flex justify-content-center">
            <div class="card w-100">
                  <div class="card-body   " style="background:#EDDBC0; padding: 20px 30px ; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
                        <form class="row  "  action="/admin/myprofile/update" method="POST">
                              @csrf
            
                              <div class="col-md-4">
                                    <label for="inputEmail4" class="form-label">First Name:</label>
                                    <input  type="text" class="form-control" value="{{Auth::user()->lname}}" name="first_name" >
                                    @error('first_name')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4">
                                    <label for="inputPassword4" class="form-label">Middle Name:</label>
                                    <input  type="text" value="{{Auth::user()->mname}}"  class="form-control" name="mname" >
                              </div>
                              <div class="col-md-4">
                                    <label for="inputPassword4" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->lname}}" name="last_name" >
                                    @error('last_name')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-12"  style="margin-top:10px" >
                                    <label for="inputPassword4" class="form-label">Address:</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->address}}"  name="address" >
                                    @error('address')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4"  style="margin-top:10px" >
                                    <label for="inputPassword4" class="form-label">Birthday:</label>
                                    <input style="text-align:center" value="{{Auth::user()->birthday}}" type="date" class="form-control"   name="birthday" >
                                    @error('birthday')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4"  style="margin-top:10px" >
                                    <label for="inputPassword4" class="form-label">Age:</label>
                                    <input type="number" style="text-align:center" value="{{Auth::user()->age}}" type="age" class="form-control"   name="age" >
                                    @error('age')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4" style="margin-top:10px">
                                    <label for="inputPassword4" class="form-label">Sex:</label>
                                    <select name="gender" class="form-control">
                                    <option style="text-align:center" value="">--select--</option>
                                    <option value="Male" {{Auth::user()->gender == "Male" ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{Auth::user()->gender == "Female" ? 'selected' : ''}}>Female</option>
                                    </select>
                                    @error('gender')
                                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                        


                              <div class="col-md-4"  style="margin-top:10px" >
                                    <label for="inputPassword4" class="form-label">Mobile no:</label>
                                    <input style="text-align:center" value="{{Auth::user()->mobileno}}" type="text" class="form-control"   name="mobileno" >
                                    @error('mobileno')
                                          <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4"  style="margin-top:10px" >
                                    <label for="inputPassword4" class="form-label">Email:</label>
                                    <input type="text" style="text-align:center" value="{{Auth::user()->email}}" type="age" class="form-control"   name="email" >
                                    @error('email')
                                          <span role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                                    @enderror
                              </div>
                              <div class="col-md-4" style="margin-top:10px">
                                    <label for="inputPassword4" class="form-label">Username:</label>
                                    <input type="text" style="text-align:center" value="{{Auth::user()->username}}" readonly type="age" class="form-control"   name="username" >
                              </div>
                              <div class="col-12 d-flex justify-content-end mt-3 " >
                                    <button  style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 200px;border:#829460; 
                                    height: 47px; " type="submit" >Update</button>
                              </div>
                        </form> 
                  </div>
            </div>
      </div>
</div>
@endsection