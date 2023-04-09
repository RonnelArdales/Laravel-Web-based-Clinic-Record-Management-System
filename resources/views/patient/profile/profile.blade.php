@extends('layouts.navbar')
@section('content')
    
{{-- 
<h1 class="text-center text-[30px]">Profile</h1>


@if(Session::has('message'))
<span  role="alert" class="block  text-success">{{Session::get('message')}}</span>
@endif 

<label for="">profile picture</label>

<h6>first name: <label for="">{{Auth::user()->fname}}</label></h6> 



<h6>Middle name: <label for="">{{Auth::user()->mname}}</label> </h6> 



<h6>Last name: <label for="">{{Auth::user()->lname}}</label> </h6> 



<h6>birthday : <label for="">{{Auth::user()->birthday}}</label> </h6> 



<h6>address : <label for="">{{Auth::user()->address}}</label> </h6> 



<h6>gender : <label for="">{{Auth::user()->gender}}</label> </h6> 



<h6>Mobile No. : <label for="">{{Auth::user()->mobileno}}</label> </h6> 

 

<h6>email : <label for="">{{Auth::user()->email}}</label></h6> 



<h6>username: <label for="">{{Auth::user()->username}}</label> </h6>

<a href="/patient/profile/edit">change profile</a>

<div class="container-fluid">

<div>
    <h4>History</h4>
    <p>Here are the history of your finding during your consulation. Click to view</p>
</div>

<table class="table table-striped table-bordered border border-dark col-sm">
    <thead style="background-color: burlywood">
      <tr  style=" position: relative;">
            <th>Appointment Date</th>
            <th>file</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr onclick="document.location = '/patient/transaction/download/{{$transaction->id}}';">
            <td>{{$transaction->consultation_date}}</td>
            <td>{{$transaction->file}}</td>
          </tr>
        @endforeach
  
    </tbody>
  </table>

    <div>
        <h4>Appointments</h4>
        <p>Here are the history of your finding during your consulation. Click to view</p>
    </div>

    <table class="table table-striped table-bordered border border-dark col-sm">
        <thead style="background-color: burlywood">
          <tr  style=" position: relative;">
                <th>service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Mode of payment</th>
                <th>status</th>
                <th>action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)

            @if ($appointment->status == "Pending" || $appointment->status == "Booked")
            <tr>
                <td>{{$appointment->service}}</td>
                <td>{{$appointment->date}}</td>
                <td>{{$appointment->time}}</td>
                <td>{{$appointment->price}}</td>
                <td>{{$appointment->mode_of_payment}}</td>
                <td>{{$appointment->status}}</td>
                <td>
                    <button class="cancel-confirmation" type="button" value="{{$appointment->id}}" class="button button-danger">Cancel</button>
                </td>
              </tr>
            @else
            <tr>
                <td>{{$appointment->service}}</td>
                <td>{{$appointment->date}}</td>
                <td>{{$appointment->time}}</td>
                <td>{{$appointment->price}}</td>
                <td>{{$appointment->mode_of_payment}}</td>
                <td>{{$appointment->status}}</td>
              </tr>
            @endif
        
            @endforeach
      
        </tbody>
      </table> --}}

         {{----------delete modal--------------}}
    {{-- <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5 pt-6  ">
                    <div class=" columns-1 sm:columns-2">
                        <input type="text" id="appointment-id">
                    <h6>Do you want to cancel this appointment?</h6>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class=" cancel_appointment p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>

</div> --}}
<div class="container ">


<div class="card w-40" style="box-sizing: border-box;font-family:Poppins; background:#EDDBC0;padding-top:1%; margin-bottom:1%;padding-bottom:1%;margin-top:5%;box-shadow: 10px 10px 10px 5px rgba(0, 0, 0, 0.25);">
  
    <h1 class="text-center text-[30px]" style="font-weight: 700;">Profile</h1>
<div style=" display:flex; flex-direction:row;flex-wrap:wrap;  padding:5px;justify-content:center;">

    <div style="background:grey; border-radius:100%;height:300px; width:300px;box-shadow: -10px 0px 0px 5px  #829460;">

     </div>
    <div style="background: #EDDBC0;margin-left:30px;margin-top:30px;">
        <div style="display:flex;flex-direction:row;">
            <h3 style="font-weight: 700;"> <label for="">{{Auth::user()->fname}}</label></h3>
            <h3 style="margin-left: 5px;font-weight: 700;"> <label for="">{{Auth::user()->mname}}</label> </h3>
            <h3 style="margin-left: 5px;font-weight: 700;"><label for="">{{Auth::user()->lname}}</label> </h3> 
            <h3 style="margin-left: 5px;">/ <label for="">{{Auth::user()->username}}</label> </h3>
        </div>
       
        <h6> <label for="">{{Auth::user()->address}}</label> </h6> 
        <h6> <label for="">{{Auth::user()->email}}</label></h6> 
        <h6> <label for="">{{Auth::user()->mobileno}}</label> </h6> 
        <h6> <label for="">{{Auth::user()->birthday}}</label> </h6> 
        <h6><label for="">{{Auth::user()->gender}}</label> </h6> 
        
        <a href="/patient/profile/edit">change profile</a> 
    </div>
</div>
 
</div>

<div>
  <h4>History</h4>
  <p>Here are the history of your finding during your consulation. Click to view</p>
</div>

<table class="table table-striped table-bordered border border-dark col-sm">
  <thead style="background-color: burlywood">
    <tr  style=" position: relative;">
          <th>Appointment Date</th>
          <th>file</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($transactions as $transaction)
      <tr onclick="document.location = '/patient/transaction/download/{{$transaction->id}}';">
          <td>{{$transaction->consultation_date}}</td>
          <td>{{$transaction->file}}</td>
        </tr>
      @endforeach

  </tbody>
</table>

<div>
  <h4>Appointments</h4>
  <p>Here are the history of your finding during your consulation. Click to view</p>
</div>

<table class="table table-striped table-bordered border border-dark col-sm">
  <thead style="background-color: burlywood">
    <tr  style=" position: relative;">
          <th>service</th>
          <th>Date</th>
          <th>Time</th>
          <th>Price</th>
          <th>Mode of payment</th>
          <th>status</th>
          <th>action</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($appointments as $appointment)

      @if ($appointment->status == "Pending" || $appointment->status == "Booked")
      <tr>
          <td>{{$appointment->service}}</td>
          <td>{{$appointment->date}}</td>
          <td>{{$appointment->time}}</td>
          <td>{{$appointment->price}}</td>
          <td>{{$appointment->mode_of_payment}}</td>
          <td>{{$appointment->status}}</td>
          <td>
              <button class="cancel-confirmation" type="button" value="{{$appointment->id}}" class="button button-danger">Cancel</button>
          </td>
        </tr>
      @else
      <tr>
          <td>{{$appointment->service}}</td>
          <td>{{$appointment->date}}</td>
          <td>{{$appointment->time}}</td>
          <td>{{$appointment->price}}</td>
          <td>{{$appointment->mode_of_payment}}</td>
          <td>{{$appointment->status}}</td>
        </tr>
      @endif
  
      @endforeach

  </tbody>
</table> 
</div>
<script>
    $(document).ready(function(e){
     
        $(document).on('click', '.cancel-confirmation', function(e){
            e.preventDefault();
            var id = $(this).val();
            $('#appointment-id').val(id);
            $('#delete').modal('show');
        });

        $('.cancel_appointment').on('click', function(e){
            e.preventDefault();
            var id = $('#appointment-id').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'PUT', 
                url: "/patient/appointment/cancel/"+ id,
                datatype: "json",
                success: function(response){ 
                             console.log( response);
        }
    });
        });
    })
</script>
@endsection