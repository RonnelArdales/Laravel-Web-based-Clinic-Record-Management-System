@extends('layouts.navbar')
@section('content')

<style>
    input, select{
        padding-left:12px;
    }
</style>

<div class="container" style="margin-bottom:5%">
    <div class="card w-40 " style="padding:3%; box-sizing: border-box;font-family:Inter; background:#EDDBC0;padding-top:1%; margin-bottom:4%;padding-bottom:1%;margin-top:2%;box-shadow: 0px 4px 4px rgba   (0, 0, 0, 0.25);border-radius:0;">
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
                            <br>

                            <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{Auth::user()->lname}}" type="text" 
                            name="lname">
                            @error('lname')
                                <span  role="alert" class="block  text-danger">{{$message}}</span>
                            @enderror
                        
                            <br>
                            <div class="row">
                                <div class="col-sm">
                                    <label class="form-label">Birthday:</label> <br>
                                    <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;"  type="date" value="{{Auth::user()->birthday}}" id="birthday" name="birthday">
                                    @error('birthday')
                                        <span  role="alert" class="block  text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                    
                                <div class="col-sm">
                                    <label class="form-label">Age:</label> <br>
                                    <input readonly type="text" style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" name="age" value="{{Auth::user()->age}}" id="age">
                    
                                </div>
                            </div>

                            <label class="form-label">Gender:</label> <br>
                            <select name="gender" style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;">
                                <option value="Male" {{Auth::user()->gender == "Male" ? 'selected' : ''}}>Male</option>
                                <option value="Female" {{Auth::user()->gender == "Female" ? 'selected' : ''}}>Female</option>
                            </select>
                            @error('gender')
                                <span  role="alert" class="block   text-danger">{{$message}}</span>
                            @enderror
                            

                            <div class="input-group">
                                <label class="form-label">Address:</label>
                                <textarea class="form-control" aria-label="With textarea" style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;height: 85px;"  type="text" value=""  name="address">{{Auth::user()->address}}</textarea>

                                @error('address')
                                    <span  role="alert" class="block text-danger">{{$message}}</span>
                                @enderror
                                <br>
                            </div>

                        </div>
                        
                        <div class="col-sm-1"></div>
                        
                        <div class="col-sm">

                            <label class="form-label" >Mobile Number:</label> <br>
                            <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{Auth::user()->mobileno}}"  type="text" name="mobileno">
                            
                            @error('mobileno')
                                <span  role="alert" class="block  text-danger">{{$message}}</span>
                            @enderror

                            <br>

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
                            {{-- <input style="background: #EDDBC0; border: 1px solid #829460;height: 29px;width: 100%;" value="{{old('old_password')}}" type="password" name="old_password"> --}}

                            <div class="input-box">
                                <input  type="password" name="old_password" id="oldpassword" value="{{ old('password') }}" >
                                <i class="oldpass_show fa-regular fa-eye-slash"></i>
                                <i class="oldpass_hide fa fa-eye" style="display: none;" ></i>
                            </div>

                            @if(session('error'))
                                <span  role="alert" style="font-size: 15px" class="block text-danger">{{ session('error') }}</span>
                            @endif
                        
                            <div>
                                <label class="form-label" for="password">New Password:</label> <br>
                                <div class="input-box">
                                    <input  type="password" name="password" id="password" value="{{ old('password') }}" >
                                    <i class="newpass_show fa-regular fa-eye-slash"></i>
                                    <i class="newpass_hide fa fa-eye" style="display: none;" ></i>
                                </div>

                                @error('password')
                                    <span  role="alert" class="block  text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                        
                            
                            <label class="form-label" for="password_confirmation" >Confirm Password:</label><br>

                            <div class="input-box">
                                <input  type="password" name="password_confirmation" id="confirm_password" value="{{ old('password_confirmation') }}">
                                <i class="confirmpass_show fa-regular fa-eye-slash"></i>
                                <i class="confirmpass_hide fa fa-eye" style="display: none;" ></i>
                            </div>
                            

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

@section('scripts')

<script >

    $(document).ready(function(){

        $(document).on('change', '#birthday', function(){
                        const birthday = $(this).val();
                        const currentDate = new Date();
                        const dateObject = new Date(birthday);
                        const birthYear = dateObject.getFullYear();
                        const currentYear = currentDate.getFullYear();
                        const birthMonth = dateObject.getMonth();
                        const currentMonth = currentDate.getMonth();
                        const birthDay = dateObject.getDate();
                        const currentDay = currentDate.getDate();
                        let age = currentYear - birthYear;

                        if (currentMonth < birthMonth || (currentMonth === birthMonth && currentDay < birthDay)) {
                              age--; // Adjust age if current month and day are earlier
                        }

                        $('#age').html("");
                        $('#age').val(age);
                  })  

        $(document).on('click','.oldpass_show', function(){
            $('.oldpass_show').hide();
            $('#oldpassword').attr('type', 'text');
            $('.oldpass_hide').show();
        });

        $(document).on('click','.oldpass_hide', function(){
            $('.oldpass_show').show();
            $('#oldpassword').attr('type', 'password');
            $('.oldpass_hide').hide();
        });

        $(document).on('click','.newpass_show', function(){
            $('.newpass_show').hide();
            $('#password').attr('type', 'text');
            $('.newpass_hide').show();
        });

        $(document).on('click','.newpass_hide', function(){
            $('.newpass_show').show();
            $('#password').attr('type', 'password');
            $('.newpass_hide').hide();
        });

        $(document).on('click','.confirmpass_show', function(){
            $('.confirmpass_show').hide();
            $('#confirm_password').attr('type', 'text');
            $('.confirmpass_hide').show();
        });

        $(document).on('click','.confirmpass_hide', function(){
            $('.confirmpass_show').show();
            $('#confirm_password').attr('type', 'password');
            $('.confirmpass_hide').hide();
        });

    });

</script>
    
@endsection