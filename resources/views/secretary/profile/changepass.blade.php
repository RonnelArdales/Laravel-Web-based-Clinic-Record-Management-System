@extends('layouts.admin_navigation')
@section('content')
<div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">

    @if (session()->has('success'))
    <div class="alert alert-success success"  id="success" >{{ session('success') }}</div> 
 @endif

    <div class="col-md-8 col-md-offset-5 d-flex justify-content-center " style="width: 100%">
        <h1>Change password</h1>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card w-" style="width: 40%" >
          <div class="card-body  " style="background:#EDDBC0; padding: 20px 30px ; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
            <form action="/secretary/myprofile/changepassword/update" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Old password</label>
                    <input type="password" class="form-control" name="oldpassword" id="exampleFormControlInput1">
                    @if (session('oldpassword'))
                          <span  role="alert" class="block mt-5 pb-4 text-danger">{{ session('oldpassword') }} </span>
                @endif
                  </div>

                  <div class="form-group mt-3" >
                    <label for="exampleFormControlInput1">New password</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlInput1" >
                    @error('password')
                    <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
                    @enderror
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput1">Confirm-password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1" >
                  </div>
                  <div class="col-12 d-flex justify-content-end mt-3 " >
                    <button  style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 200px;border:#829460; 
                    height: 47px; " type="submit" >Change</button>
                  </div>
             
            </form>

            
          </div>
        </div>
    </div>



</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){
        setTimeout(function() {
            $(".success").fadeOut(800);
            }, 2000);
      });
</script>

@endsection