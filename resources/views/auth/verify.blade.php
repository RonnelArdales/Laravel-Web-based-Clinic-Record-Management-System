@extends('layouts.auth')
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
                    {{-- <form class="d-inline" method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
