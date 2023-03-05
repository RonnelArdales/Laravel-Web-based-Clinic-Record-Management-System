@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
    
        <h1>Profile  <button type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
           create
         </button></h1>
       </div>
       <div>
        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Usertype</label>
        <select name="usertype" class="usertypetable" id="usertypetable">
          <option value="patient">patient</option>
          <option value="secretary">secretary</option>
          <option value="admin">admin</option>
        </select>

          <input type="search" name="search" id="search" placeholder="search"> 
  
        
       </div>
 
       <div id="success"></div>
<div class="card " style="height: 400px" id="patient">
    <div class="card-body">
      <div class="d-flex justify-content-center">
        <h4>Profile</h4>
      </div>
        <table class="table patient table-bordered table-striped" >

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
                    <th>Action</th>

                </tr>
            </thead>
            <tbody >
              @if (count($users) > 0)
              @foreach ($users->where('usertype', 'patient') as $user)
              <tr class="overflow-auto">
                  <td>{{$user->id}}</td>
                  <td>{{$user->fname}}</td>
                  <td>{{$user->mname}}</td>
                  <td>{{$user->lname}}</td>
                  <td>{{$user->birthday}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->gender}}</td>
                  <td>{{$user->mobileno}}</td>
                  <td>{{$user->email}}</td>
                  
                  <td>
                  <button type="button" value="{{$user->id}}" class="view btn2 btn btn-primary ">view</button>
                  <button type="button" value="{{$user->id}}" class="edit btn2 btn btn-primary ">Edit</button>
                  <button type="button" value="{{$user->id}}" class="delete btn2 btn  btn-danger">delete</button></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align: center;">no user Found</td>
    
              </tr>
              @endif
               
            </tbody>
        </table>
    </div>
</div>

{{-- secretary --}}
<div class="card" style="height: 400px"  id="secretary" hidden>
  <div class="card-body">
    <div class="d-flex justify-content-center">
      <h4>Secretary</h4>
    </div>
      <table class="table secretary table-bordered table-striped" >

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
                  <th>Action</th>

              </tr>
          </thead>
          <tbody >
            @if (count($users) > 0)
            @foreach ($users->where('usertype', 'secretary') as $user)
            <tr class="overflow-auto">
                <td>{{$user->id}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->mname}}</td>
                <td>{{$user->lname}}</td>
                <td>{{$user->birthday}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->mobileno}}</td>
                <td>{{$user->email}}</td>
                
                <td>
                <button type="button" value="{{$user->id}}" class="view btn2 btn btn-primary ">view</button>
                <button type="button" value="{{$user->id}}" class="edit btn2 btn btn-primary ">Edit</button>
                <button type="button" value="{{$user->id}}" class="delete btn2 btn  btn-danger">delete</button></td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" style="text-align: center;">no user Found</td>
  
            </tr>
            @endif
             
          </tbody>
      </table>
  </div>
</div>

{{-- admin --}}

<div class="card" style="height: 400px"  id="admin" hidden>
  <div class="card-body">
    <div class="d-flex justify-content-center">
      <h4>Admin</h4>
    </div>
      <table class="table  admin table-bordered table-striped" >

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
                  <th>Action</th>

              </tr>
          </thead>
          <tbody >
            @if (count($users) > 0)
            @foreach ($users->where('usertype', 'admin') as $user)
            <tr class="overflow-auto">
                <td>{{$user->id}}</td>
                <td>{{$user->fname}}</td>
                <td>{{$user->mname}}</td>
                <td>{{$user->lname}}</td>
                <td>{{$user->birthday}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->mobileno}}</td>
                <td>{{$user->email}}</td>
                
                <td>
                <button type="button" value="{{$user->id}}" class="view btn2 btn btn-primary ">view</button>
                <button type="button" value="{{$user->id}}" class="edit btn2 btn btn-primary ">Edit</button>
                <button type="button" value="{{$user->id}}" class="delete btn2 btn  btn-danger">delete</button></td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" style="text-align: center;">no user Found</td>
  
            </tr>
            @endif
             
          </tbody>
      </table>
  </div>
</div>


{{-- modal --}}
{{-- create --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >First name</label>
                <input class=" fname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text">
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="fname"></span>
                </div>
           
                
                <label class=" rounded bg-[#EDDBC0] ml-3">Middle name</label>
                <input class="mname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="text">
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="mname"></span>
                </div>
             

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last name</label>
                <input class=" lname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="lname"></span>
                </div>
          

                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
                <input class=" birthday bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="date"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="birthday"></span>
                </div>
                
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
                <input class=" address bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="address"></span>
                </div>
        
                
                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Gender</label>
                <select name="gender" class="gender" >
                  <option value="">--select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="gender"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile no.</label>
                <input class=" mobileno bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="mobileno"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Email</label>
                <input class=" email bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="email"></span>
                </div>
          
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Username</label>
                <input class=" username bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="username"></span>
                </div>
            
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Usertype</label>
                <select name="usertype" class="usertype" >
                  <option value="">--select--</option>
                  <option value="patient">Patient</option>
                  <option value="secretary">Secretary</option>
                  <option value="admin">Admin</option>
                </select>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="usertype"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Password</label>
                <input autocomplete="off" class=" password bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" name="password" type="password"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="password"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Confirm Password</label>
                <input autocomplete="off" class="password_confirmation bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  type="password"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="confirmpassword"></span>
                </div>


        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" add_user p-2 w-30 bg-[#829460]  mt-7 rounded" >Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- edit --}}

  {{-- edit modal --}}
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-5 pt-6  ">
            <div class=" columns-1 sm:columns-2">
              <input type="hidden" id="usercode">
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >First name</label>
            <input class=" fname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_fname" type="text"> 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_fname"></span>
            </div>
            
            <label class=" rounded bg-[#EDDBC0] ml-3">Middle name</label>
            <input class="mname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" id="edit_mname"  type="text">
            <br>

            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last name</label>
            <input class=" lname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_lname"  type="text"> 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_lname"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
            <input class=" birthday bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_birthday"  type="text"> 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_birthday"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
            <input class=" address bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_address"  type="text" id="edit_address" > 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_address"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Gender</label>
            <select name="gender" class="gender" id="edit_gender" >
              <option value="" {{$user->gender == "" ? 'selected' : ''}}></option>
              <option value="Male" {{$user->gender == "Male" ? 'selected' : ''}}>Male</option>
              <option value="Female" {{$user->gender == "Female" ? 'selected' : ''}}>Female</option>
            </select>
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_gender"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile no.</label>
            <input class=" mobileno bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_mobileno"  type="text"> 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_mobileno"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Email</label>
            <input class=" email bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" id="edit_email" > 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_email"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Usertype</label>
            <select name="usertype" class="usertype" id="edit_usertype" >
              <option value="" {{$user->usertype == "" ? 'selected' : ''}}></option>
              <option value="patient" {{$user->usertype == "patient" ? 'selected' : ''}}>Patient</option>
              <option value="secretary" {{$user->usertype == "secretary" ? 'selected' : ''}}>Secretary</option>
              <option value="admin" {{$user->usertype == "admin" ? 'selected' : ''}}>Admin</option>
            </select>
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_usertype"></span>
            </div>

            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Password</label>
            <input class=" password bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_password"  name="password" type="password"> 
            <div class="mt-0 mb-2">
              <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_pass"></span>
            </div>
            
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Confirm Password</label>
            <input class="password_confirmation bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  type="password" id="edit_confirmpassword" > 


    </div>
    </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_user p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- view modal --}}

<div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-5 pt-6  ">
          <div class=" columns-1 sm:columns-2">
            <input type="hidden" id="usercode">
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >First name:</label>  
          <input class="view1 mname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="view_fname" readonly  type="text">
          <br>
          <label class=" rounded bg-[#EDDBC0] ml-3 fw-bold">Middle name:</label>
          <input class=" view1 mname bg-white rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" id="view_mname"  readonly type="text">
         <br>
          <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Last name:</label>
          <input class="view1 lname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_lname" readonly  type="text"> 
      
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Birthday:</label>
          <input class="view1 lname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_birthday" readonly  type="text"> 
     
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Address:</label>
          <input class="view1 address bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_address" readonly  type="text"  > 
     
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] ml-3 fw-bold" >Gender: </label>
          <select name="gender" readonly class=" view1 gender" id="view_gender" >
            <option value="" {{$user->gender == "" ? 'selected' : ''}}></option>
            <option value="Male" {{$user->gender == "Male" ? 'selected' : ''}}>Male</option>
            <option value="Female" {{$user->gender == "Female" ? 'selected' : ''}}>Female</option>
          </select>
      
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Mobile no.: </label>
          <input class="view1 mobileno bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_mobileno" readonly  type="text"> 
   
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Email: </label>
          <input class="view1 email bg-white rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" readonly id="view_email" > 
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >username: </label>
          <input class="view1 email bg-white rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" readonly id="view_username" > 

     
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Usertype: </label>
          <select name="usertype" class=" view1 usertype" readonly id="view_usertype" >
            <option value="" {{$user->usertype == "" ? 'selected' : ''}}></option>
            <option value="patient" {{$user->usertype == "patient" ? 'selected' : ''}}>Patient</option>
            <option value="secretary" {{$user->usertype == "secretary" ? 'selected' : ''}}>Secretary</option>
            <option value="admin" {{$user->usertype == "admin" ? 'selected' : ''}}>Admin</option>
          </select>

  </div>
  </div>
      <div class="modal-footer">
        <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
    
    {{-- //delete modal --}}

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal edit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="hidden" id="servicecode">
                <h6>Do you want to delete this data?</h6>
         
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" delete_user p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
    <br>
@endsection


@section('scripts')
<script>
    $(document).ready(function (){

      refresh_table();
      deleteall();
        
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
  
      function refresh_table(){
        var usertype = $('#usertypetable').val()
        if( usertype == 'secretary' ){
                $('.secretary').load(location.href+' .secretary');
               } else if (usertype == 'patient') {
                $('.patient').load(location.href+' .patient');
               } else {
                $('.admin').load(location.href+' .admin');
               }
      }



        $(".modal").on("hidden.bs.modal", function(){
            $('#create, #edit, #delete').find('input').val("");

            $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #fname, #mname, #lname, #birthday, #address, #mobileno, #email, #username, #confirmpassword, #password ').html("");
        });

        //show and hide table

        $('#usertypetable').on('change', function(e){
                e.preventDefault();
                var usertype = $(this).val();
               if( usertype == 'secretary' ){
                    $('#patient').attr("hidden",true);
                    $('#admin').attr("hidden",true);
                    $("#secretary").attr("hidden",false);
                    refresh_table();
                      //  alert(usertype);
               } else if (usertype == 'patient') {
                $('#patient').attr("hidden",false);
                    $('#admin').attr("hidden",true);
                    $("#secretary").attr("hidden",true);
                    refresh_table();
               } else {
                $('#patient').attr("hidden",true);
                    $('#admin').attr("hidden",false);
                    $("#secretary").attr("hidden",true);
                    refresh_table();
               }
            
            })


            $('#search').on('keyup', function(e){
              var search = $(this).val();
              alert(search);
            })

        //store data
        $(document).on('click', '.add_user', function(e){
            e.preventDefault();
            // console.log('hello');
            var data ={
                'first_name' : $('.fname').val(),
                'mname': $('.mname').val(), 
                'last_name': $('.lname').val(),
                'birthday': $('.birthday').val(),
                'address': $('.address').val(),
                'gender': $('.gender').val(),
                'mobile_number': $('.mobileno').val(), 
                'email': $('.email').val(),
                'username': $('.username').val(),
                'address': $('.address').val(),
                'password': $('.password').val(),
                'password_confirmation': $('.password_confirmation').val(),
                'usertype': $('.usertype').val(),
            }
            // console.log(data);
            //always add csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/admin/profile/createuser/store",
                data: data,
                datatype: "json",
                success: function(response){
                    console.log(response);

                    if(response.status == 400){
                      $('#fname, #mname, #lname,#gender, #usertype, #birthday, #address, #mobileno, #email, #username, #confirmpassword, #password'  ).html("");
                        $.each(response.errors.first_name, function (key, err_values){
                        $('#fname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.last_name, function (key, err_values){
                        $('#lname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.birthday, function (key, err_values){
                        $('#birthday').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.address, function (key, err_values){
                        $('#address').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.mobile_number, function (key, err_values){
                        $('#mobileno').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.email, function (key, err_values){
                        $('#email').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.username, function (key, err_values){
                        $('#username').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.password, function (key, err_values){
                        $('#password').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.confirm_password, function (key, err_values){
                        $('#confirmpassword').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.gender, function (key, err_values){
                        $('#gender').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.usertype, function (key, err_values){
                        $('#usertype').append('<span>'+err_values+'</span>');
                        })
                        

                    }else{
                    
                      $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('success');
                        $('#create').modal('hide');
                        $('#create').find('option').val("");
                        refresh_table();
                        hidetables();
                    
            
                    }
                }
            });

        });

        //view form
        
        $(document).on('click', '.view', function(e){
            e.preventDefault();
            var id = $(this).val();
           $('#view').modal('show');
           $.ajax({
                type: "GET",   
                url: "/admin/profile/edit/"+ id, 
                datatype: "json",
                success: function(response){ 
                  // console.log(response)
                    if(response.status == 400){
                      $('#update_errform' ).html("");
                        $('#update_errform' ).addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values){
                        $('#update_errform').append('<li>'+err_values+'</li>');
                        })
                    }else{
               $('#view_fname').val(response.user[0].fname);
               $('#view_mname').val(response.user[0].mname);
               $('#view_lname').val(response.user[0].lname);
               $('#view_birthday').val(response.user[0].birthday);
               $('#view_address').val(response.user[0].address);
               $('#view_gender').val(response.user[0].gender); 
               $('#view_mobileno').val(response.user[0].mobileno);
               $('#view_email').val(response.user[0].email);  
               $('#view_usertype').val(response.user[0].usertype);
               $('#view_username').val(response.user[0].username);  
               $('#usercode').val(id);
                    }
        }
    });
        });


            //show data in edit form
             $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var id = $(this).val();
           $('#edit').modal('show');
           $.ajax({
                type: "GET",   
                url: "/admin/profile/edit/"+ id,
                datatype: "json",
                success: function(response){ 
              
                    if(response.status == 400){
                      $('#update_errform' ).html("");
                        $('#update_errform' ).addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values){
                        $('#update_errform').append('<li>'+err_values+'</li>');
                        })
                    }else{
               $('#edit_fname').val(response.user[0].fname);
               $('#edit_mname').val(response.user[0].mname);
               $('#edit_lname').val(response.user[0].lname);
               $('#edit_birthday').val(response.user[0].birthday);
               $('#edit_address').val(response.user[0].address);
               $('#edit_gender').val(response.user[0].gender); 
               $('#edit_mobileno').val(response.user[0].mobileno);
               $('#edit_email').val(response.user[0].email);  
               $('#edit_usertype').val(response.user[0].usertype); 
               $('#usercode').val(id);
                    }
        }
    });
        });

            //update data from database
            $(document).on('click', '.update_user', function(e){
            e.preventDefault();
            var id = $('#usercode').val();
            var data ={
                _method: 'PUT',
                'first_name' : $('#edit_fname').val(),
                'mname': $('#edit_mname').val(), 
                'last_name': $('#edit_lname').val(),
                'birthday': $('#edit_birthday').val(),
                'address': $('#edit_address').val(),
                'gender': $('#edit_gender').val(),
                'mobile_number': $('#edit_mobileno').val(), 
                'email': $('#edit_email').val(),
                'password': $('#edit_password').val(),
                'password_confirmation': $('#edit_confirmpassword').val(),
                'usertype': $('#edit_usertype').val(),
            }
   
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           
           $.ajax({
                type: 'POST', 
                url: "/admin/profile/update/"+ id,
                data: data,
                datatype: "json",
                success: function(response){ 
                    console.log(response);
                    if(response.status == 400){
                      $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password'  ).html("");
                        $.each(response.errors.first_name, function (key, err_values){
                        $('#error_fname' ).append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.last_name, function (key, err_values){
                        $('#error_lname' ).append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.birthday, function (key, err_values){
                        $('#error_birthday').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.address, function (key, err_values){
                        $('#error_address').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.mobile_number, function (key, err_values){
                        $('#error_mobileno').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.email, function (key, err_values){
                        $('#error_email').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.password, function (key, err_values){
                        $('#error_pass').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.gender, function (key, err_values){
                        $('#error_gender').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.usertype, function (key, err_values){
                        $('#error_usertype').append('<span>'+err_values+'</span>');
                        })

                    }else{                  
                        $('#update_errform' ).html("");
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('update successfully');
                        $('#edit').modal('hide');
                        $('#edit').find('input').val("");
                    
                    }
        }
    });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).val();
            $('#delete').modal('show');
            $('#usercode').val(id);   
        });

        $(document).on('click', '.delete_user', function(e){
            e.preventDefault();
            var id = $('#usercode').val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/profile/delete/"+ id,
                datatype: "json",
                success: function(response){ 
                             console.log( response);
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('deleted successfully');
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                       refresh_table();
        }
    });
        });


});
</script>

@endsection