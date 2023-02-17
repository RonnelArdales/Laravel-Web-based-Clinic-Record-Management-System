@extends('layouts.navbar')
@section('content')
    

   
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
             
        
                @if(Session::has('success'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{Session::get('success')}}</span>
                  </div>
                @endif
                <h3 class="login-heading mb-4">Sign in</h3>
  
                <!-- Sign In Form -->
                <form action="/login/process" method="POST">
                  @csrf
                  <div class="form-floating mb-3">
                    <input  class="form-control"   name="email" value="{{old('email')}}" >
                    <label for="floatingInput">Email address</label>
                  </div>
                  <div class="form-floating mb-1">
                    <input type="password" class="form-control" autocomplete="off"  id="floatingPassword" name="password" >
                    <label for="floatingPassword">Password</label>
                  </div>
                  @if(Session::has('error'))
                  <span  role="alert" class="block  text-danger">{{Session::get('error')}}</span>
              @endif
          
             
  
                  <div class="d-grid">
                    <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mt-2 mb-2" type="submit">Sign in</button>
                 
                    <div class="text-center">
                      <a class="small" href="/identify">Forgot password?</a>
                    </div>
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