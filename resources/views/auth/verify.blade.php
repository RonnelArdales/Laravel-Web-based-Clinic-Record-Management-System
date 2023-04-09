{{-- @extends('layouts.auth')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification code has been sent to your email address.') }}
                        </div>
                        
                        <form action="/verifyconfirm" method="POST">
                            @csrf
                            <h6>Please enter the code that we sent to email.</h6>
                            <div class="form-floating ">
                                
                              <input  class="form-control"   name="code" value="" >
                              <label for="floatingInput">code</label>
                            </div>
                            @error('code')  <span  role="alert" class="block  text-danger">{{$message}}</span> @enderror
                            @if(Session::has('error'))
                            <span  role="alert" class="block mt-0 text-danger">{{Session::get('error')}}</span>
                        @endif
        
                            <div class="d-grid">
                              <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mt-3 mb-2" type="submit">Send Code</button>
                          </form>

             
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.auth')
@section('content')


  
<div class="container my-5" style="font-family: Poppins; ">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="login d-flex align-items-center py-5 " style="background: #EDDBC0;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
        
                @if(Session::has('success'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{Session::get('success')}}</span>
                  </div>
                @endif

  
                <!-- Sign In Form -->
                <form action="/verifyconfirm" method="POST">
                    @method('PUT')
                    @csrf
                  <h6>Please enter the code that we sent to email.</h6>
                  <div class="form-floating ">
                      
                    <input   class="form-control"   name="code" value="" style="background: #D0B894;">
                    <label for="floatingInput">Code</label>
                  </div>
                  @error('code')  <span  role="alert" class="block  text-danger">{{$message}}</span> @enderror
                  @if(Session::has('error'))
                  <span  role="alert" class="block mt-0 text-danger">{{Session::get('error')}}</span>
              @endif
                  <hr style="margin-bottom: 0px; margin-top:10px" >
                  <a href="/resendCode" style="text-decoration: none">Resend Code</a>
                  <div class="d-grid" style="margin-top: 2%;justify-content:right;">
                    <button style="background: #829460; border-radius: 15px; color:white; border:#829460;width: 110px;height: 37px;" type="submit">Verify</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
