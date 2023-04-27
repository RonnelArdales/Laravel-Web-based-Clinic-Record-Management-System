@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>User Report  </h1>
    </div>

 <div style="margin-top: 15px; align-items:center;margin-bottom:1%;" >


  @if (Auth::user()->usertype == 'admin')

  <form action="/admin/reports/print_user" method="post">
    @csrf
     <div class=" row">
     <div class="col search_fullname" style="display: none;">
          <i class="fa fa-search"></i>
          <input type="text" name="fullname" id="fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" class="fullname" > 
     </div>
     <div class="col search_usertype" style="display: none;">
          <select name="usertype" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px; height:100%"class="usertype" id="usertype">
               <option value="">Select usertype</option>
               <option value="active">Active</option>
               <option value="inactive">Inactive</option>
               <option value="not verified">Not verified</option>
             </select>
     </div>
     <div class="col search_status " style="display: none; ">
         <select name="status" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; height:100%; background:#EDDBC0; width:180px; margin-right:10px" class="status" id="status">
          <option value="" >Select usertype</option>
          <option value="admin">Admin</option>
          <option value="patient">Patient</option>
          <option value="secretary">Secretary</option>
        </select>
     </div>
      
<div class="col  d-flex justify-content-end" style="width: 600px">
    <select name="filters" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:160px; margin-right:10px; " class="filters" id="filters">
      <option value="">Select Filter</option>
      <option value="fullname">Fullname</option>
      <option value="usertype">Usertype</option>
      <option value="status">Status</option>
    </select>
    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
      Generate Report
    </button>
</div>
</div>
  </form>
      
  @else

  <form action="/secretary/reports/print_user" method="post">
    @csrf
     <div class=" row">
     <div class="col search_fullname" style="display: none;">
          <i class="fa fa-search"></i>
          <input type="text" name="fullname" id="fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" class="fullname" > 
     </div>
     <div class="col search_usertype" style="display: none;">
          <select name="usertype" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px; height:100%"class="usertype" id="usertype">
               <option value="">Select usertype</option>
               <option value="active">Active</option>
               <option value="inactive">Inactive</option>
               <option value="not verified">Not verified</option>
             </select>
     </div>
     <div class="col search_status " style="display: none; ">
         <select name="status" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; height:100%; background:#EDDBC0; width:180px; margin-right:10px" class="status" id="status">
          <option value="" >Select usertype</option>
          <option value="admin">Admin</option>
          <option value="patient">Patient</option>
          <option value="secretary">Secretary</option>
        </select>
     </div>
      
<div class="col  d-flex justify-content-end" style="width: 600px">
    <select name="filters" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:160px; margin-right:10px; " class="filters" id="filters">
      <option value="">Select Filter</option>
      <option value="fullname">Fullname</option>
      <option value="usertype">Usertype</option>
      <option value="status">Status</option>
    </select>
    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
      Generate Report
    </button>
</div>
</div>
  </form>
      
  @endif

    </div>

    <div class="card " style="background:#EDDBC0;border:none; ">
     <div class="users" style="padding:0%; ">
   <div class="card-body " style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
       <table class="table table-bordered table-striped"  style="background-color: white">
 
           <thead>
               <tr>
                   <th>id</th>
                   <th>First name</th>
                   <th>Middle name</th>
                   <th>Last name</th> 
                   <th>Gender</th>
                   <th>Age</th>
                   <th>Status</th>
                   <th>Usertype</th>
                
 
               </tr>
           </thead>
           <tbody >
             @if (count($users) > 0)
             @foreach ($users as $user)
             <tr class="overflow-auto">
                 <td>{{$user->id}}</td>
                 <td>{{$user->fname}}</td>
                 <td>{{$user->mname}}</td>
                 <td>{{$user->lname}}</td>
                 <td>{{$user->gender}}</td>
                 <td>{{$user->age}}</td>
                 <td>{{$user->status}}</td>
                 <td>{{$user->usertype}}</td>
             </tr>
             @endforeach
             @else
             <tr>
               <td colspan="8" style="text-align: center;">no user Found</td>
   
             </tr>
             @endif
              
           </tbody>
       </table>
   </div>
   <div>
     {!! $users->links() !!}
   </div>
 </div>
 </div>
</div>       
 
@endsection

@section('scripts')
    
<script>
      $(document).ready(function (){

        function get_status(){
                            $('#status').empty();
                            $('#status').append('<option value="" >Select status</option>\
                                    <option value="active">Active</option>\
                                    <option value="inactive">Inactive</option>\
                                    <option value="not verified">Not verified</option>\
                            ');
        }

        function get_usertypes(){
                $('#usertype').empty();
                $('#usertype').append('<option value="" >Select usertype</option>\
                                    <option value="admin">Admin</option>\
                                    <option value="patient">Patient</option>\
                                    <option value="secretary">Secretary</option>\
                                    ')
        }

        $('#fullname').on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname').val();
          console.log(search);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/report/user_fullname',
            method:'GET',
            data: {search:search,},
            success:function(response){
           
              $('.users').html(response);
              if(response.message == 'Nofound'){       
                $('.users').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                                             <thead>\
                                                                  <tr>\
                                                                      <th>id</th>\
                                                                      <th>First name</th>\
                                                                      <th>Middle name</th>\
                                                                      <th>Last name</th> \
                                                                      <th>Gender</th>\
                                                                      <th>Age</th>\
                                                                      <th>Status</th>\
                                                                      <th>Usertype</th>\
                                                                  </tr>\
                                                              </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="10" style="text-align: center;">no user Found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
        })

        
        $(document).on('change', '#filters', function(e){
                e.preventDefault();
                var filters = $(this).val();
               if(filters == 'fullname'){
                    $('#fullname').val('');
                    $('.search_fullname').show();
                    $('.search_usertype').hide();
                    $('.search_status').hide();
                    $('.users').load(location.href+' .users');
                    get_status();
                    get_usertypes();
               }else if(filters == 'usertype'){
                    $('.search_fullname').hide();
                    $('.search_usertype').show();
              
                    $('.search_status').hide();
                    $('.fullname').val('');
                    $('.users').load(location.href+' .users');
                    get_status();
                    get_usertypes();
               }else if(filters == 'status'){
                    $('.search_fullname').hide();
                    $('.search_usertype').hide();
                    $('.search_status').show();
                    $('.fullname').val('');
                    $('.users').load(location.href+' .users');
                    get_status();
                    get_usertypes();
               }else{
                    $('.search_fullname').hide();
                    $('.search_usertype').hide();
                    $('.search_status').hide();
                    $('.fullname').val('');
                    $('.users').load(location.href+' .users');
                    get_status();
                    get_usertypes();
               }
            })

            $(document).on('change', '#status', function(e){
              e.preventDefault();
          let  status = $(this).val();
          
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(status.length > 0){
              $.ajax({
            url: '/report/user_status',
            method:'GET',
            data: {status:status,},
            success:function(response){
        
              $('.users').html(response);
              if(response.message == 'Nofound'){       
                $('.users').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                                            <thead>\
                                                                  <tr>\
                                                                      <th>id</th>\
                                                                      <th>First name</th>\
                                                                      <th>Middle name</th>\
                                                                      <th>Last name</th> \
                                                                      <th>Gender</th>\
                                                                      <th>Age</th>\
                                                                      <th>Status</th>\
                                                                      <th>Usertype</th>\
                                                                  </tr>\
                                                              </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">no user Found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
            }else{
              $('.users').load(location.href+' .users');
            }
         
        })

        $(document).on('change', '#usertype', function(e){
              e.preventDefault();
          let  usertype = $(this).val();
          console.log(usertype);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(usertype.length > 0){
              $.ajax({
            url: '/report/user_usertype',
            method:'GET',
            data: {usertype:usertype,},
            success:function(response){
        console.log(response);
              $('.users').html(response);
              if(response.message == 'Nofound'){       
                $('.users').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                                           <thead>\
                                                                  <tr>\
                                                                      <th>id</th>\
                                                                      <th>First name</th>\
                                                                      <th>Middle name</th>\
                                                                      <th>Last name</th> \
                                                                      <th>Gender</th>\
                                                                      <th>Age</th>\
                                                                      <th>Status</th>\
                                                                      <th>Usertype</th>\
                                                                  </tr>\
                                                              </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">no user Found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
            }else{
              $('.users').load(location.href+' .users');
            }
         
        })

        // $(document).on('click',  '.pagination a', function(e){
        //     e.preventDefault();
        //    let name = $('#fullname').val();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //     });
        //     if(name){
        //         var url = $(this).attr('href');
        //         console.log('filter');
        //         $.ajax({
        //             url: url,
        //             type: 'GET',
        //             success: function(response) {
        //             $('.appointments').html(response);
        //             },
        //             error: function(xhr) {
        //                 alert('Error: ' + xhr.statusText);
        //             }
        //         });
        //     }else{
        //         let page = $(this).attr('href').split('appointments=')[1]
        //       appointment(page);
        //     }
   
              
        // });


            $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
   
              let fullname = $('#fullname').val();
              let usertype = $('#usertype').val();
              let status = $('status').val();
   

              if(fullname || usertype || status){
                var url = $(this).attr('href');
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                    $('.users').html(response);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.statusText);
                    }
                });
              }else{
           let page = $(this).attr('href').split('users=')[1]
              user(page);
              }
       
              
        });


        function user(page){
          console.log(page);
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
              $.ajax({
                type: "GET",  
                url: "/report/users/pagination/paginate-data?users="+page ,
                datatype: "json",
                success: function(response){
                $('.users').html(response);
                  }
              }) ;
        }

        

      })
</script>
@endsection


