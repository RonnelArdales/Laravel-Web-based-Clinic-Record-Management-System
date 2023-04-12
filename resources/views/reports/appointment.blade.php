@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>Appointment Report  </h1>
    </div>

    {{-- <img src="{{ asset('gcash.png') }}" alt=""> --}}
 <div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >

	<div class="me-auto">
	{{-- <i class="fa fa-search"></i>
	  <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
	</div>
  <select name="usertype" style="font-family:Poppins;font-size:0.9vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:200px; margin-right:20px ;padding-bottom:5px; padding-top:2px" class="usertypetable" id="usertypetable">
    <option value="">Select Filter</option>
    <option value="patient">patient</option>
    <option value="secretary">secretary</option>
    <option value="admin">admin</option>
  </select>
  <form action="/admin/reports/print_appointment" method="GET">
    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:0.9vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
Generate Report
    </button>
  </form>
    </div>
  

<div id="success"></div>
<div class="card table-div"  style="background:#EDDBC0;border:none; ">
    <div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
        <table class="table table-data table-bordered table-striped" style="background-color: white" >
          <thead>
            <tr>
              <th>id</th>
              <th>Patient Id</th>
              <th>Fullname</th>
              <th>Date</th>
              <th>Time</th>
              <th>Service</th>
              <th>Price</th>
              <th>Status</th>
        
           
          </tr>
        </thead>
        <tbody >
          @if (count($appointments)> 0 )
          @foreach ($appointments as $appointment)
          <tr class="overflow-auto">
            <td>{{$appointment->id}}</td>
              <td>{{$appointment->user_id}}</td>
              <td>{{$appointment->fullname}}</td>
               <td>{{$appointment->date}}</td>
               <td>{{$appointment->time}}</td>
               <td>{{$appointment->service}}</td>
               <td>{{$appointment->price}}</td>
               <td>{{$appointment->status}}</td>
   
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="8" style="text-align: center;">No appointment Found</td>
      
          </tr>
          @endif
           
        </tbody>
        </table>
    </div>
</div>

</div>       
 
@endsection