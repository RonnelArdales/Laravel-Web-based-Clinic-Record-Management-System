@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
      <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
        <div class="me-auto col-md-8 col-md-offset-5">
      
        <h1>Queuing</h1>
        </div>
          </div>
    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" style="color: black" id="home-tab" data-bs-toggle="tab" data-bs-target="#today-appointment" type="button" role="tab" aria-controls="home" aria-selected="true">Today appointment</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab"  style="color: black" data-bs-toggle="tab" data-bs-target="#upcoming-appointment" type="button" role="tab" aria-controls="profile" aria-selected="false">Upcoming Appointments</button>
      </li>
    </ul>


    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="today-appointment" role="tabpanel" aria-labelledby="home-tab">

        <div class="card"  style="background:#EDDBC0;border:none; " >
          <div class="table-appointment" style="padding: 0%" >
            <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
            <table class="table table-bordered table-striped  "  id="today" style="background-color: white; width:100%" >
                <thead>
                <tr>
                <th>id</th>
                <th>Patient Id</th>
                <th>Fullname</th>
                <th>Contact no.</th>
                <th>Email</th>
                <th>Date</th>
                <th >Time</th>
                </tr>
                </thead>
                <tbody class="error">
          
                </tbody>
            </table>
            </div>
          </div>
            </div>
      </div>

      <div class="tab-pane fade " id="upcoming-appointment" role="tabpanel" aria-labelledby="home-tab">
        <div class="card"  style="background:#EDDBC0;border:none; " >
          <div class="table-appointment" style="padding: 0%" >
            <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
            <table class="table table-bordered table-striped  "  id="upcoming" style="background-color: white; width:100%" >
                <thead>
                <tr>
                <th>id</th>
                <th>Patient Id</th>
                <th>Fullname</th>
                <th>Contact no.</th>
                <th>Email</th>
                <th>Date</th>
                <th >Time</th>     
                </tr>
                </thead>
                <tbody class="error">
          
                </tbody>
            </table>
            </div>
          </div>
            </div>


      </div>
    </div>  



       
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){

      deleteall();


      var complete = $('#today').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/queuing",
	   dom: 'frtp',

	   pageLength: 10,
	   responsive: true,
        

        columns: [
		{data: 'id', name: 'id' , orderable: false, searchable: false},
            {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
		  {data: 'fullname', name: 'fullname' , orderable: false},
		  {data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false},
		  {data: 'email', name: 'email' , orderable: false, searchable: false},
		  {data: 'date', name: 'date' , orderable: false, searchable: false},
		  {data: 'time', name: 'time' , orderable: false, searchable: false},
        ],
        initComplete: function() {
                var api = this.api();
                var dataCount = api.data().length;
                if (dataCount < 10) {
                    $('#today_paginate').hide(); // Hide pagination element
                }
            }
            
    });

    var upcoming = $('#upcoming').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/queuing/upcoming",
	   dom: 'frtp',
	   pageLength: 10,
	   responsive: true,
        columns: [
		  {data: 'id', name: 'id' , orderable: false, searchable: false},
      {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
		  {data: 'fullname', name: 'fullname' , orderable: false},
		  {data: 'contact_no', name: 'contact_no' , orderable: false, searchable: false},
		  {data: 'email', name: 'email' , orderable: false, searchable: false},
		  {data: 'date', name: 'date' , orderable: false, searchable: false},
		  {data: 'time', name: 'time' , orderable: false, searchable: false},
        ], 
        initComplete: function() {
                var api = this.api();
                var dataCount = api.data().length;
                if (dataCount < 10) {
                    $('#upcoming_paginate').hide(); // Hide pagination element
                }
            }
    });
    
        function deleteall () {
            if (window.location.href) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/billing/addtocart/deleteall",
                datatype: "json",
                success: function(response){ 
                }
            });
                
            }
        }


    });
</script>

@endsection