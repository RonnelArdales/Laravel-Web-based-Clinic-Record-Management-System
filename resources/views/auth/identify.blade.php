@extends('layouts.verify')
@section('content')

       
<div class="container" style="font-family: Poppins; ">
    <div class="row" >
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="login d-flex align-items-center py-4" style="background: #EDDBC0;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                @if(Session::has('success'))
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <span class="block sm:inline">{{Session::get('success')}}</span>
                                    </div>
                                @endif
                                <h3 class="login-heading mb-4" style="font-weight:700;" >Find your account</h3>
                                <hr>
                                <!-- Sign In Form -->
                                <form action="/forgot_password/find_email/process" method="GET">
                                    @csrf
                                    <h6 style="text-align: center;">Please enter your email for your account.</h6>
                                    <div class="form-floating mb-1">  
                                        <input  class="form-control"   name="email" value="" style="background: #D0B894;">
                                        <label for="floatingInput"  >Email Address</label>
                                    </div>
                                    @if(Session::has('error'))
                                        <span  role="alert"  class="block  text-danger">{{Session::get('error')}}</span>
                                    @endif
                                    @error('email')
                                        <span  role="alert"  class="block  text-danger">{{$message}}</span>
                                    @enderror
                                        <hr style="margin-top:10px">
                                    <div class="d-grid" style="justify-content:right;">
                                        <button style="background: #829460;
                                        border-radius: 15px; color:white; border:#829460;width: 110px;height: 37px; " type="submit">Find email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="
    width: 7vw;
    height: 20vw;
    left: 0;
    bottom:0;
    position: absolute;
    background: #829460;
    /* box-shadow: 20px 30px 10px rgba(0, 0, 0, 0.25); */
    border-radius: 0 200px 0 0 ;">
    </div>
</div>
@endsection






