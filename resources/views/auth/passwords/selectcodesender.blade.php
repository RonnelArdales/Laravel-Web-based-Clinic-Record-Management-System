@extends('layouts.auth')
@section('content')

<style>
    .divvtitle1{
        text-align: left;
    }
    .resetpassword1{
        font-weight: 800;
        font-size: 32px;
        margin: 2% 0 0 0;
        padding: 0;
        line-height: 0%;
    }
    .carddd{
            width: 549px;
            height: auto;
            font-family:Inter; background:#EDDBC0; 
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius:0;
            box-sizing: border-box;
            padding: 2% 1% 2% 1%;
    }
    .llinee{
        border: 1px solid rgba(0, 0, 0, 0.3);
        margin:7% 0% 3% 0%;
        width: auto;
    }
    .form-check{
        margin: 0% 1% 0 1%;
        font-size: 14px;
    }
    .form-check:hover {
        background-color: #d0b894c7;
        cursor: pointer;
    }

    .form-check-input{
        background-color: #829460;
    }
    @media (max-width: 578px) {
        .carddd{
            width: auto;
            margin: 2%;
            padding: 0;
        }
    }
</style>

<div style="height:100vh; width:100vw; display:flex;flex-direction:column;justify-content:center; align-items:center;" >
    <div class="carddd" >
        <div class="divvtitle1">
            <h1 class="resetpassword1" >RESET</h1><br>
            <h1 class="resetpassword1" >PASSWORD.</h1>
        </div>
        
        <div class="llinee"></div>
        @if(Session::has('success'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{Session::get('success')}}</span>
            </div>
        @endif
            <form action="/forgot_password/select/sendcode" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-sm"> 
                            <p style="font-size: 14px;line-height: 17px;">How do you want <b>to get the code</b> to reset your password?</p>

                            <div style="padding:3% 0 3% 6%;margin:30px 0 30px 0;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="email" value="email" id="email">
                                    <label class="form-check-label"  for="email">Send code via <b>email</b> .</label>
                                </div>
                            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="mobileno" value="mobileno" id="mobileno">
                                    <label class="form-check-label" for="mobileno">Send code via <b>SMS</b>.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm text-center d-flex flex-column justify-content-right align-items-center">
                            @if (Auth::user()->profile_pic == null ) 
                                <img src="{{ url('profilepic/defaultprofile.png') }}" width="100" height="100" style="border-radius: 100%" alt="">
                            @else
                                <img  src="{{ url('profilepic/' . Auth::user()->profile_pic) }}" width="100" height="100" alt="" style="border-radius: 100%">
                            @endif
                                <label for="" style="width:200px; height:auto; font-size:14px">{{Auth::user()->username}}</label> 
                        </div>
                    </div> 
                </div>
            <div class="llinee"></div>
                <div class="text-end mt-4 " >
                    <button style="background: #829460; border-radius: 20px; color:white; border:#829460;width: 110px;height: 37px;"  type="submit">Send Code</button>
                </div>        
            </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
  
        $('#email').prop('checked', true);
    // $('.form-check').click(function(e) {
    //     var checkbox = $(this).find('input[type="checkbox"]');
    //     checkbox.prop('checked', !checkbox.prop('checked'));
    
    //     $('.form-check-input').not(checkbox).prop('checked', false);
    // });

        $('.form-check').click(function() {
            var checkbox = $(this).find('input[type="checkbox"]');
            if (!checkbox.prop('checked')) {
                checkbox.prop('checked', true);
                $('.form-check-input').not(checkbox).prop('checked', false);
            }
        });
    });
</script>
@endsection
