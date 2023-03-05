@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>Users Report  </h1>
    </div>

 <form action="/admin/reports/print_user" method="get">
  <label for="">full name</label>
  <input type="text" value="" name="fullname" id="fullname">
  <label for="">usertype</label>
  <select name="usertype" class="usertype" id="usertype">
    <option value="">--select--</option>
    <option value="patient">patient</option>
    <option value="secretary">secretary</option>
    <option value="admin">admin</option>
  </select>
<button type="submit">print</button>
 </form>
  
  

<div id="success"></div>
<div class="card table-div">
    <div class="card-body">
        <table class="table table-data table-bordered table-striped">
          <thead>
            <tr>
                <th>id</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th> 
                <th>Birthday</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Mobile no.</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="tbody" >
          @if (count($users) > 0)
          @foreach ($users as $user)
          <tr class="overflow-auto" id="nouser">
              <td>{{$user->id}}</td>
              <td>{{$user->fname}}</td>
              <td>{{$user->mname}}</td>
              <td>{{$user->lname}}</td>
              <td>{{$user->birthday}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->gender}}</td>
              <td>{{$user->mobileno}}</td>
              <td>{{$user->email}}</td>
              
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


