@extends('layouts.admin_navigation')
@section('content')
{{-- <div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">
    <div class="col-md-8 col-md-offset-5">
        <h1>Reservation fee </h1>
    </div>
<form action="/admin/reservationfee/update/{{$reservationfee->id}}" method="POST" >
    @method('PUT')
    @csrf
    <div class="d-flex justify-content-center " >
        <div class="form-group">
            <label for="">Current Reservation fee</label>
            <input type="text" value="{{$reservationfee->reservationfee}}" name="oldfee">
        </div>

<label for="">New reservation fee</label>
<input type="text" name="newfee">
<div class="col-12 d-flex justify-content-end mt-3 " >
<button type="submit" style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 200px;border:#829460; 
height: 47px; " >Update</button>
</div>
    </div>
</form>

</div> --}}

<div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">

    @if (session()->has('success'))
    <div class="alert alert-success success"  id="success" >{{ session('success') }}</div> 
 @endif

    <div class="col-md-8 col-md-offset-5 d-flex justify-content-center " style="width: 100%">
        <h1><b>RESERVATION FEE</b></h1>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card w-" style="width: 40%" >
          <div class="card-body  " style="background:#EDDBC0; padding: 20px 30px ; border-radius: 5px;box-shadow:  4px 4px 2px rgba(0, 0, 0, 0.25)">
            <form action="/secretary/reservationfee/update/{{$reservationfee->id}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Current Reservation fee</label>
                    <input type="text" readonly class="form-control" value="{{$reservationfee->reservationfee}}" name="oldfee" id="exampleFormControlInput1">
                  </div>

                  <div class="form-group mt-3" >
                    <label for="exampleFormControlInput1">New reservation fee</label>
                    <input type="text" class="form-control" name="newfee" id="exampleFormControlInput1" >
                  </div>

                  <div class="col-12 d-flex justify-content-end mt-3 " >
                    <button  style="  background: #829460; border-radius: 20px; color:white; font-size:15px;width: 170px;border:#829460; 
                    height: 40px; " type="submit" >Update</button>
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