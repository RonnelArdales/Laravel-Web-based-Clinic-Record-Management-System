@extends('layouts.admin_navigation')
@section('title', 'User')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
        <h1> <b>USER</b>  </h1>
    </div>

    <div id="success" class="error alert alert-success" style="display: none;">
    </div>

    <div class="main-spinner" style="
            position:fixed;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255, 255, 255, 0.279);
        z-index:9999;
        display:none;
        "> 
      <div class="spinner">
        <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
          </div>
    </div>	

    <div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;">
      <div class="me-auto">
        <i class="fa fa-search"></i>
        <input type="search" name="search-fullname" id="search-fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;"> 

        <label style="margin-left:33px; font-size:1.3vw; margin-right:5px" for=""> Usertype</label>
        <select name="usertype" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;  width:200px; padding-bottom:5px; padding-top:2px" class="usertypetable" id="usertypetable">
            <option value="patient">patient</option>
            <option value="secretary">secretary</option>
            <option value="admin">admin</option>
          </select>

      </div>

      <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
            Create
      </button>
     </div>



      
       <div class="card " style="background:#EDDBC0;border:none;" id="patient">
        <div class="patient" style="padding:0% ">
          <div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
            <table class="table  table-bordered table-striped "  style="background-color: white">
      
                <thead>
                    <tr>
                        <th>id</th>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Last name</th> 
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
      
                    </tr>
                </thead>
                  <tbody class="patient-error" >
                    @if (count($patients) > 0)
                    @foreach ($patients as $user)
                    <tr class="overflow-auto">
                        <td>{{$user->id}}</td>
                        <td>{{$user->fname}}</td>
                        <td>{{$user->mname}}</td>
                        <td>{{$user->lname}}</td>
                        <td>{{$user->age}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->status}}</td>
                
                        
                        <td style="text-align: center">
                        <button type="button" value="{{$user->id}}" class="view btn btn-sm btn-primary ">View</button>
                    <button type="button" style="color:white" value="{{$user->id}}" class="edit  btn btn-sm btn-info ">Edit</button>
                        {{-- <button type="button" value="{{$user->id}}" class="delete btn-sm btn  btn-danger">delete</button></td> --}}
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
            <div style="">
              {!! $patients->links() !!}
           </div>
          </div>
       </div>
      
          {{-- secretary --}}
          <div class="card " style="background:#EDDBC0;border:none; " id="secretary" hidden>
          <div class="secretary" style="padding:0%; ">
        <div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
            <table class="table  table-bordered table-striped "  style="background-color: white">
      
                <thead>
                    <tr>
                        <th>id</th>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Last name</th> 
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
      
                    </tr>
                </thead>
                <tbody >
                  @if (count($secretaries) > 0)
                  @foreach ($secretaries as $user)
                  <tr class="overflow-auto">
                      <td>{{$user->id}}</td>
                      <td>{{$user->fname}}</td>
                      <td>{{$user->mname}}</td>
                      <td>{{$user->lname}}</td>
                      <td>{{$user->age}}</td>
                      <td>{{$user->gender}}</td>
                      <td>{{$user->status}}</td>
                
                      
                      <td style="text-align: center">
                        <button type="button" value="{{$user->id}}" class="view btn btn-sm btn-primary ">View</button>
                        <button type="button" style="color:white" value="{{$user->id}}" class="edit  btn btn-sm btn-info ">Edit</button>
                        {{-- <button type="button" value="{{$user->id}}" class="delete btn-sm btn  btn-danger">delete</button></td> --}}
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
          <div style="">
            {!! $secretaries->links() !!}
         </div>
        </div>
      </div>

        {{-- admin --}}
        <div class="card " style="background:#EDDBC0;border:none; " id="admin" hidden>
          <div class="admin" style="padding:0%; ">
        <div class="card-body " style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
          {{-- <div class="d-flex justify-content-center">
            <h4>Admin</h4>
          </div> --}}
         
            <table class="table table-bordered table-striped"  style="background-color: white">
      
                <thead>
                    <tr>
                        <th>id</th>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Last name</th> 
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
      
                    </tr>
                </thead>
                <tbody >
                  @if (count($admins) > 0)
                  @foreach ($admins as $user)
                  <tr class="overflow-auto">
                      <td>{{$user->id}}</td>
                      <td>{{$user->fname}}</td>
                      <td>{{$user->mname}}</td>
                      <td>{{$user->lname}}</td>
                      <td>{{$user->age}}</td>
                      <td>{{$user->gender}}</td>
                      <td>{{$user->status}}</td>
               
                      
                      <td style="text-align: center">
                        <button type="button" value="{{$user->id}}" class="view btn btn-sm btn-primary ">View</button>
                        <button type="button" style="color:white" value="{{$user->id}}" class="edit  btn btn-sm btn-info ">Edit</button>
                    {{-- <button type="button" value="{{$user->id}}" class="delete btn-sm btn  btn-danger">delete</button></td> --}}
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
          {!! $admins->links() !!}
        </div>
      </div>

      </div>


{{--create--}}

<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content" style="background: #EDDBC0;">
      <div class="modal-header" style="border-bottom-color: black" >
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Create User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-5 pt-6  ">
              <div class=" columns-1 sm:columns-2 modal-create">
              <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >First Name</label>
              <input class=" fname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" style="background: #D0B894;">
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="fname"></span>
              </div>
         
              
              <label class=" rounded bg-[#EDDBC0] ml-3">Middle Name</label>
              <input class="mname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" type="text">
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="mname"></span>
              </div>
           

              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last Name</label>
              <input class=" lname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" type="text"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="lname"></span>
              </div>
        

              <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
              <input class=" birthday rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;text-decoration:aliceblue;" type="date" id="birthday"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="birthday"></span>
              </div>

              
              <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Age</label>
              <input class=" age rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;text-decoration:aliceblue;" readonly type="number" id="age"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="age"></span>
              </div>
              
              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
              <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" type="text"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="address"></span>
              </div>
      
              
              <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Gender:</label>
              <select name="gender" class="gender rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;"  >
                <option value="">--select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="gender"></span>
              </div>

              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile No.</label>
              <input class=" mobileno  rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="text"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="mobileno"></span>
              </div>

              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Email</label>
              <input class=" email rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;"type="text"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="email"></span>
              </div>
        
              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Username</label>
              <input class=" username rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="text"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="username"></span>
              </div>
          
              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Usertype:</label>
              <select name="usertype" class="usertype rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"style="background: #D0B894;" >
                <option value="">--select--</option>
                <option value="patient">Patient</option>
                <option value="secretary">Secretary</option>
                <option value="admin">Admin</option>
              </select>
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="usertype"></span>
              </div>

              {{-- <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Status:</label>
              <select name="status" class="status rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"style="background: #D0B894;" >
                <option value="">--select--</option>
                <option value="pending">Pending</option>
                <option value="verified">Verified</option>
              </select>
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="status"></span>
              </div> --}}

              <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Password</label>
              <input autocomplete="off" class=" password rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" name="password" type="password"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="password"></span>
              </div>

              <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Confirm Password</label>
              <input autocomplete="off" class="password_confirmation rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="password"> 
              <div class="mt-0 mb-2">
                <span  role="alert" class="block mt-5 pb-4 text-danger" id="confirmpassword"></span>
              </div>


      </div>
      </div>
      <div class="modal-footer" style="border-top-color: black"> 
        <button type="button" data-bs-dismiss="modal" style="background: #829460;
        border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Close</button>
        <button  class=" add_user " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Create</button>
      </div>
    </div>
  </div>
</div>
</div>

  {{-- edit modal --}}

  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: black" >
          <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2 modal-update">
                  <input type="text" hidden id="usercode">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >First Name</label>
                <input class=" fname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" id="edit_fname" style="background: #D0B894;">
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_fname"></span>
                </div>
                
                <label class=" rounded bg-[#EDDBC0] ml-3">Middle Name</label>
                <input class="mname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" id="edit_mname" type="text">
             
  
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last Name</label>
                <input class=" lname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="edit_lname" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_lname"></span>
                </div>
          
  
                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
                <input class=" birthday rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_birthday" style="background: #D0B894;text-decoration:aliceblue;" type="date"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_birthday"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Age</label>
                <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_age" style="background: #D0B894;" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_age"></span>
                </div>
                
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
                <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_address" style="background: #D0B894;" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_address"></span>
                </div>
        
                
                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Gender:</label>
                <select name="gender" class="gender rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_gender"  style="background: #D0B894;"  >
                  <option value="" {{$user->gender == "" ? 'selected' : ''}}></option>
                  <option value="Male" {{$user->gender == "Male" ? 'selected' : ''}}>Male</option>
                  <option value="Female" {{$user->gender == "Female" ? 'selected' : ''}}>Female</option>
                </select>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_gender"></span>
                </div>
  
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile No.</label>
                <input class=" mobileno  rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_mobileno" style="background: #D0B894;" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_mobileno"></span>
                </div>
  
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Email</label>
                <input class=" email rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_email" style="background: #D0B894;"type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_email"></span>
                </div>
          
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Username</label>
                <input readonly class=" username rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_username" style="background: #D0B894;" type="text"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_username"></span>
                </div>
            
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Usertype:</label>
                <select name="usertype" class="usertype rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="edit_usertype" >
                  <option value="" {{$user->usertype == "" ? 'selected' : ''}}></option>
                  <option value="patient" {{$user->usertype == "patient" ? 'selected' : ''}}>Patient</option>
                  <option value="secretary" {{$user->usertype == "secretary" ? 'selected' : ''}}>Secretary</option>
                  <option value="admin" {{$user->usertype == "admin" ? 'selected' : ''}}>Admin</option>
                </select>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_usertype"></span>
                </div>

                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Status:</label>
                <select name="usertype" class="usertype rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="edit_status" >
                  <option value="" {{$user->status == "" ? 'selected' : ''}}></option>
                  <option value="verified" {{$user->status == "verified" ? 'selected' : ''}}>verfied</option>
                  <option value="inactive" {{$user->status == "inactive" ? 'selected' : ''}}>Inactive</option>
                </select>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_status"></span>
                </div>
  
                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Password</label>
                <input autocomplete="off" class=" password rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" name="password" type="password" id="edit_password"> 
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_password"></span>
                </div>
  
                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Confirm Password</label>
                <input autocomplete="off" class="password_confirmation rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="password" id="edit_confirmpassword">  
  
  
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: black"> 
          <button type="button" data-bs-dismiss="modal" style="background: #829460;
          border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Close</button>
          <button  class=" update_user " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Update</button>
        </div>
      </div>
    </div>
  </div>
  </div>

{{-- view modal --}}

<div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content"style="background: #EDDBC0;">
      <div class="modal-header" style="border-bottom-color: gray">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">View User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-5 pt-6  ">
          <div class=" columns-1 sm:columns-2">
            <input type="hidden" id="usercode">
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Name:</label>  
          <input class="view1 mname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="view_fname" readonly  type="text">
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Birthday:</label>
          <input class="view1 lname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_birthday" readonly  type="text"> 
     
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Age:</label>
          <input class="view1 lname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_age" readonly  type="text"> 
     
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Address:</label>
          <input style="width: 80%; height:auto;" class="view1 lname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_address" readonly  type="text"> 
     
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Gender: </label>
          <select name="gender" readonly class=" view1 gender" id="view_gender" >
            <option value="" {{$user->gender == "" ? 'selected' : ''}}></option>
            <option value="Male" {{$user->gender == "Male" ? 'selected' : ''}}>Male</option>
            <option value="Female" {{$user->gender == "Female" ? 'selected' : ''}}>Female</option>
          </select>
      
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2  ml-3 fw-bold" >Mobile No.: </label>
          <input class="view1 mobileno bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_mobileno" readonly  type="text"> 
   
          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Email: </label>
          <input style="width:80%; height:auto;" class="view1 email bg-[#EDDBC0] rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" readonly id="view_email" > 
          <br>

          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Username:</label>
          <input class="view1 email bg-[#EDDBC0] rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" readonly id="view_username" > 

          <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Usertype: </label>
          <select name="usertype" class=" view1 usertype" readonly id="view_usertype" >
            <option value="" {{$user->usertype == "" ? 'selected' : ''}}></option>
            <option value="patient" {{$user->usertype == "patient" ? 'selected' : ''}}>Patient</option>
            <option value="secretary" {{$user->usertype == "secretary" ? 'selected' : ''}}>Secretary</option>
            <option value="admin" {{$user->usertype == "admin" ? 'selected' : ''}}>Admin</option>
          </select>
            <br>
          <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Status:</label>
          <input class="view1 email bg-[#EDDBC0] rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" readonly id="view_status" > 

  </div>
  </div>
      <div class="modal-footer" style="border-top-color: gray">
        <button type="button" class="  " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
    
    {{-- //delete modal --}}

{{-- //delete modal --}}

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #EDDBC0; margin-top:30%;">
      <div class="modal-header" style="border-bottom-color: gray" >
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Delete Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-5 pt-6  ">
              <div class=" columns-1 sm:columns-2">
                  <input type="text" hidden id="servicecode">
              <h5>Do you want to delete this data?</h5>
       
            {{-- </form> --}}
      </div>
      </div>
      <div class="modal-footer" style="border-top-color: gray">
        <button type="button" class=" close btn btn-secondary" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">Close</button>
        <button class=" delete_user " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
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

      refresh_table();
      // deleteall();
        
      //   function deleteall () {
      //       if (window.location.href) {
      //           $.ajaxSetup({
      //           headers: {
      //               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //           }
      //       });
      //       $.ajax({
      //           type: "post",
      //           url: "/admin/billing/addtocart/deleteall",
      //           datatype: "json",
      //           success: function(response){ 
      //           }
      //       });
                
      //       }
      //   }

      $('#birthday').on('change', function(){
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
               $('#age').val(" ");
               $('#age').val(age);
            }) 
  
      function refresh_table(){
        var usertype = $('#usertypetable').val()
        if( usertype == 'secretary' ){
                 $('#fullname').val("");
                $('.secretary').load(location.href+' .secretary');
               } else if (usertype == 'patient') {
                $('#fullname').val("");
                $('.patient').load(location.href+' .patient');
               } else if(usertype == 'admin') {
                $('#fullname').val("");
                $('.admin').load(location.href+' .admin');
               }
      }

        $(".modal").on("hidden.bs.modal", function(){ 
            $('#create, #edit, #delete').find('input, select').val("");
            $('#fname, #mname, #lname,#gender, #usertype, #birthday, #address, #mobileno, #email, #username, #confirmpassword, #password, #status, #age '  ).html("");
            $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #error_status'  ).html("");
            // $('.modal-create').load(location.href+' .modal-create');
            // $('.modal-update').load(location.href+' .modal-update');
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
                'age': $('.age').val(),
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
                beforeSend: function(){
                  $('#accept-confirmation').modal('hide');
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){
                    if(response.status == 400){
                      $('#fname, #mname, #lname,#gender, #usertype, #birthday, #address, #mobileno, #email, #username, #confirmpassword, #password, #status, #age '  ).html("");
                        $.each(response.errors.first_name, function (key, err_values){
                        $('#fname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.last_name, function (key, err_values){
                        $('#lname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.birthday, function (key, err_values){
                        $('#birthday').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.age, function (key, err_values){
                        $('#age').append('<span>'+err_values+'</span>');
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
                        $('#password').append('<span>'+err_values+' </span>');
                        })
                        $.each(response.errors.confirm_password, function (key, err_values){
                        $('#confirmpassword').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.gender, function (key, err_values){
                        $('#gender').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.status, function (key, err_values){
                        $('#status').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.usertype, function (key, err_values){
                        $('#usertype').append('<span>'+err_values+'</span>');
                        })
                    }else{
                      $('#success').html();
                    $('#success').text('Created successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                        $('#create').modal('hide');
                        $('.modal-create').load(location.href+' .modal-create');
                        refresh_table();
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
                      const fullname = response.user[0].fname ;
               $('#view_fname').val(fullname.concat(" ", response.user[0].lname  )  );
               $('#view_mname').val(response.user[0].mname);
               $('#view_lname').val(response.user[0].lname);
               $('#view_birthday').val(response.user[0].birthday);
               $('#view_age').val(response.user[0].age);
               $('#view_address').val(response.user[0].address);
               $('#view_gender').val(response.user[0].gender); 
               $('#view_mobileno').val(response.user[0].mobileno);
               $('#view_email').val(response.user[0].email);  
               $('#view_usertype').val(response.user[0].usertype);
               $('#view_username').val(response.user[0].username);  
               $('#view_status').val(response.user[0].status);  
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
               $('#edit_age').val(response.user[0].age);
               $('#edit_address').val(response.user[0].address);
               $('#edit_gender').val(response.user[0].gender); 
               $('#edit_username').val(response.user[0].username);
               $('#edit_mobileno').val(response.user[0].mobileno);
               $('#edit_email').val(response.user[0].email);  
               $('#edit_usertype').val(response.user[0].usertype); 
               $('#edit_status').val(response.user[0].status); 
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
                'age': $('#edit_age').val(),
                'address': $('#edit_address').val(),
                'gender': $('#edit_gender').val(),
                'mobile_number': $('#edit_mobileno').val(), 
                'email': $('#edit_email').val(),
                'password': $('#edit_password').val(),
                'password_confirmation': $('#edit_confirmpassword').val(),
                'usertype': $('#edit_usertype').val(),
                'status': $('#edit_status').val(),
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
                beforeSend: function(){
                  $('#accept-confirmation').modal('hide');
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){ 
                    console.log(response);
                    if(response.status == 400){
                      $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #error_status'  ).html("");
                        $.each(response.errors.first_name, function (key, err_values){
                        $('#error_fname' ).append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.last_name, function (key, err_values){
                        $('#error_lname' ).append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.birthday, function (key, err_values){
                        $('#error_birthday').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.age, function (key, err_values){
                        $('#error_age').append('<span>'+err_values+'</span>');
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
                        $.each(response.errors.status, function (key, err_values){
                        $('#error_status').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.password, function (key, err_values){
                        $('#error_password').append('<span>'+err_values+'</span>');
                        })

                    }else{                  
                        $('#update_errform' ).html("");
                        $('#success').html();
                    $('#success').text('Updated successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                        $('#edit').modal('hide');
            $('.modal-update').load(location.href+' .modal-update');
                        refresh_table();
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
                beforeSend: function(){
                  $('#accept-confirmation').modal('hide');
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                },
                success: function(response){ 
                  $('#success').html();
                    $('#success').text('Deleted successfully');
                      $('#success').show();
                      setTimeout(function() {
                                $("#success").fadeOut(500);
                            }, 2000);
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                       refresh_table();
        }
    });
        });


                //pagination
                $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
            let usertype = $('#usertypetable').val();

            if (usertype == "patient") {
              let page = $(this).attr('href').split('patient=')[1]
              profile(page, usertype);
              
            } else if(usertype == "secretary"){
              let page = $(this).attr('href').split('secretary=')[1]
              profile(page, usertype);
            }else{
              let page = $(this).attr('href').split('admin=')[1]
              profile(page, usertype);
              
            }
        });

        

        function profile(page, usertype){
            let data = page;
            let usertypetable = usertype;
            console.log(page, usertype);
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            if (usertypetable == "patient") {
              $.ajax({
                type: "GET", 
                data: {usertypetable :usertypetable},  
                url: "/admin/profile/pagination/paginate-data?patient="+page , 
                datatype: "json",
                success: function(response){
                  console.log('from paginate' + usertype); 
                  console.log(response);
                $('.patient').html(response);
                  }
              });
              
            } else if(usertypetable == "secretary"){
              $.ajax({
                type: "GET", 
                data: {usertypetable :usertypetable},  
                url: "/admin/profile/pagination/paginate-data?secretary="+page , 
                datatype: "json",
                success: function(response){ 
                  console.log('from paginate' + usertype);
                  console.log(response);
                $('.secretary').html(response);
                  }
              });
            }else{
              $.ajax({
                type: "GET", 
                data:{usertypetable :usertypetable},  
                url: "/admin/profile/pagination/paginate-data?admin="+page , 
                datatype: "json",
                success: function(response){
                  console.log('from paginate' + usertype);
                  console.log(response); 
                $('.admin').html(response);
                  }
              });
            }
        }

        $('#search-fullname').on('keyup', function(e){
          e.preventDefault();
          let usertype = $('#usertypetable').val();
          let search = $('#search-fullname').val();
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/profile/search-name',
            method:'GET',
            data: {search:search,
                  usertype:usertype,
                                    },
            success:function(response){
             
              if(usertype == 'patient'){
                // console.log(response.message);
                $('.patient').html("");
                $('.patient').html(response);
               if(response.message == 'Nofound'){
                $('.patient').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                      <thead>\
                                                <tr>\
                                                    <th>id</th>\
                                                    <th>First name</th>\
                                                    <th>Middle name</th>\
                                                    <th>Last name</th> \
                                                    <th>Birthday</th>\
                                                    <th>Address</th>\
                                                    <th>Gender</th>\
                                                    <th>Mobile no.</th>\
                                                    <th>Email</th>\
                                                    <th>Action</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody >\
                                              <tr>\
                                                <td colspan="10" style="text-align: center;">no user Found</td>\
                                              </tr>\
                                            </tbody>\
                                        </table>');
               }
              }else if(usertype == 'secretary'){
                console.log(response);
              $('.secretary').html("");
              $('.secretary').html(response);

              if(response.message == 'Nofound'){
                $('.secretary').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                      <thead>\
                                                <tr>\
                                                    <th>id</th>\
                                                    <th>First name</th>\
                                                    <th>Middle name</th>\
                                                    <th>Last name</th> \
                                                    <th>Birthday</th>\
                                                    <th>Address</th>\
                                                    <th>Gender</th>\
                                                    <th>Mobile no.</th>\
                                                    <th>Email</th>\
                                                    <th>Action</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody >\
                                              <tr>\
                                                <td colspan="10" style="text-align: center;">No Secretary Found</td>\
                                              </tr>\
                                            </tbody>\
                                        </table>');
               }
              
              }else{
                console.log(response);
              $('.admin').html("");
              $('.admin').html(response);

              if(response.message == 'Nofound'){
                $('.admin').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                      <thead>\
                                                <tr>\
                                                    <th>id</th>\
                                                    <th>First name</th>\
                                                    <th>Middle name</th>\
                                                    <th>Last name</th> \
                                                    <th>Birthday</th>\
                                                    <th>Address</th>\
                                                    <th>Gender</th>\
                                                    <th>Mobile no.</th>\
                                                    <th>Email</th>\
                                                    <th>Action</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody >\
                                              <tr>\
                                                <td colspan="10" style="text-align: center;">No Admin Found</td>\
                                              </tr>\
                                            </tbody>\
                                        </table>');
               }

              }
            }
          });
        })
});
</script>

@endsection