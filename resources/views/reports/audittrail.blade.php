@extends('layouts.admin_navigation')
@section('title', 'Audit Trail')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>Audit trail  </h1>
    </div>



  
  
 <div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >

	<div class="me-auto">
	{{-- <i class="fa fa-search"></i>
	  <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
	</div>
  <select name="usertype" style="font-family:Poppins;font-size:1vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:200px; margin-right:20px ;padding-bottom:5px; padding-top:2px" class="usertypetable" id="usertypetable">
    <option value="">Select Filter</option>
    <option value="patient">patient</option>
    <option value="secretary">secretary</option>
    <option value="admin">admin</option>
  </select>
  <form action="/admin/reports/print_audit_trail" method="get">
    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
Generate Report
    </button>
  </form>
    </div>

<div class="card table-div" style="background:#EDDBC0;border:none; ">
    <div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
        <table class="table table-data table-bordered table-striped" style="background-color: white">
          <thead>
            <tr>
       
                <th>User_id</th>
                <th>Username</th>
                <th>Activity</th> 
                <th>usertype</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="tbody" >
          @if (count($audits) > 0)
          @foreach ($audits as $user)
          <tr class="overflow-auto" id="nouser">
              <td>{{$user->user_id}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->activity}}</td>
              <td>{{$user->usertype}}</td>
              <td>{{date('m-d-Y h:i:s A', strtotime($user->created_at))}}</td>
          </tr>
          @endforeach
          @else
          <tr id="nouser">
            <td colspan="7" style="text-align: center;">No user Found</td>
      
          </tr>
          @endif
           
        </tbody>
        </table>
    </div>
</div>

</div>       
 
@endsection

@section('scripts')
    
<script>
      $(document).ready(function (){

        $(document).on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname').val();
          // console.log(search);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/admin/profile/search-name',
            method:'GET',
            data: {search:search,},
            success:function(response){
              $('#usertype').val('');
              console.log(response);
              var users = response.data;
              var html = '';
              if(users.length > 0){
                  for(let i = 0; i<users.length; i++){
                    html += '<tr >\
                        <td>'+users[i]['id']+'</td>\
                        <td>'+users[i]['fname']+'</td>\
                        <td>'+users[i]['mname']+'</td>\
                        <td>'+users[i]['lname']+'</td>\
                        <td>'+users[i]['birthday']+'</td>\
                        <td>'+users[i]['address']+'</td>\
                        <td>'+users[i]['gender']+'</td>\
                        <td>'+users[i]['mobileno']+'</td>\
                        <td>'+users[i]['email']+'</td>\
                    </tr>';
                  }
              }else{
                html += '<tr>\
                        <td>No usasd Found</td>\
                    </tr>';
              }
                $('#tbody').html(html);
            }
          });
        })

        
        $('#usertype').on('change', function(e){
                e.preventDefault();
                var usertype = $(this).val();
                console.log(usertype);
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/admin/profile/search',
            method:'GET',
            data: {usertype:usertype},
            success:function(response){
              $('#fullname').val('');
              var users = response.usertype;
              var html = '';
              console.log(response);
              if(users.length > 0){
                  for(let i = 0; i<users.length; i++){
                    html += '<tr>\
                        <td>'+users[i]['id']+'</td>\
                        <td>'+users[i]['fname']+'</td>\
                        <td>'+users[i]['mname']+'</td>\
                        <td>'+users[i]['lname']+'</td>\
                        <td>'+users[i]['birthday']+'</td>\
                        <td>'+users[i]['address']+'</td>\
                        <td>'+users[i]['gender']+'</td>\
                        <td>'+users[i]['mobileno']+'</td>\
                        <td>'+users[i]['email']+'</td>\
                    </tr>';
                  }
              }else{
                html += '<tr>\
                        <td>No users Found</td>\
                    </tr>';
              }
                $('#tbody').html(html);
            }
          });
            })
      })
</script>
@endsection