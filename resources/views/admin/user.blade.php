@extends('layouts.admin_navigation')
@section('title', 'User')
@section('content')

<style>
    .input-box{
        background-color: #D0B894;
        border-radius: 6px;
        padding-left: 5px;
        border-bottom: solid gray 2px;
        border-right:solid gray 2px;
        border-top:solid black 2px;
        border-left: solid black 2px;
    }

    .input-box input{
        background-color: #D0B894;
        border: none;
        outline: none;
        width: 90%;
    }
    .custom-select{
        height: 30px;
        padding-left: 5px;
        border-bottom: solid gray 2px;
        border-right:solid gray 2px;
        border-top:solid black 2px;
        border-left: solid black 2px;
    } 
</style>
<div class="row m-4">

    <div class="col-md-8 col-md-offset-5">
        <h1> <b>USER</b>  </h1>
    </div>

    <div id="success" class="error alert alert-success" style="display: none;"></div>

    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279);  z-index:9999; display:none; "> 
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

        <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">Create
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
                            <th>Sex</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="patient-error" >
                        @if(count($patients) > 0)
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
                            <th>Sex</th>
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
                <table class="table table-bordered table-striped"  style="background-color: white">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th> 
                            <th>Age</th>
                            <th>Sex</th>
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
                            </td>
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
        <div class="modal-dialog modal-dialog-centered modal-lg " >
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: black" >
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Create User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 pt-6  ">
                        <div class="container">
                            <div class="row">
                                    <div class="col-sm-4  ">
                                        <label class="rounded bg-[#EDDBC0] ml-3" >First Name</label>
                                        <input class=" fname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" style="background: #D0B894;">
                                        
                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="fname"></span>
                                        </div>
                                    </div>
                        
                                    <div class="col-sm-4  "  >
                                        <label class=" rounded bg-[#EDDBC0] ml-3">Middle Name (Optional)</label>
                                        <input class="mname  w-100 rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" type="text">
                                        
                                        <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="mname"></span>
                                        </div>                   
                                    </div>
                        
                                    <div class="col-sm-4  " >
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last Name</label>
                                        <input class=" lname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" type="text"> 
                                        
                                        <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="lname"></span>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top:1%;padding-right:0;">

                                        <div class="col">
                                                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
                                                <input class=" birthday rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;text-decoration:aliceblue;" type="date" id="birthday"> 

                                                <div class="mt-0 mb-2">
                                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="create_error_birthday"></span>
                                                </div>
                                        </div>

                                        <div class="col">
                                                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Age</label>
                                                <input class=" age rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;text-decoration:aliceblue;" readonly type="number" id="age"> 

                                                <div class="mt-0 mb-2">
                                                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="create_error_age"></span>
                                                </div>
                                        </div>

                                        <div class="col-sm" style="padding-right: 0;">
                                                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Sex:</label>
                                                <select name="gender" class="gender custom-select rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;"  style="height:200px" >
                                                <option value="">--select--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                </select>
                                                <div class="mt-0 mb-2">
                                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="gender"></span>
                                                </div>
                                        </div>
                                        
                                    </div>
                            </div>

                            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
                            <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" type="text"> 
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="address"></span>
                            </div>

                            <div class="row" style="margin-top:1%">
                                    <div class="col-sm" style="">
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile No.</label>
                                        <input class=" mobileno  rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="number"> 
                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="mobileno"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-7">
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Email</label>
                                        <input class=" email rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;"type="text"> 
                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="email"></span>
                                        </div>
                                    </div>
                            </div>

                            <div class="row" style="margin-top:1%">
                                    <div class="col-sm-4" style="">
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Username</label>
                                        <input class=" username rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  style="background: #D0B894;" type="text"> 
                                        <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="username"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Status:</label>
                                        <select name="status" class="status rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"style="background: #D0B894;" >
                                        <option value="">--select--</option>
                                        <option value="pending">Pending</option>
                                        <option value="verified">Verified</option>
                                        </select>
                                        <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="status"></span>
                                        </div>
                                    </div>
                            </div>

                            <div class="row" style="margin-top:1%">
                                    <div class="col-sm-6">
                                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Password</label>
                                        <div class="input-box">
                                                <input type="password" class="create_password">
                                                <i class="create_show_password fa-regular fa-eye-slash"></i>
                                                <i class="create_hidden_password fa fa-eye" style="display: none;" ></i>
                                        </div>

                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="password"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Confirm Password</label>
                                        <div class="input-box">
                                            <input type="password" class="create_password_confirmation">
                                            <i class="create_show_confirm_password fa-regular fa-eye-slash"></i>
                                            <i class="create_hidden_confirm_password fa fa-eye" style="display: none;" ></i>
                                        </div> 

                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="confirmpassword"></span>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: black"> 
                        <button type="button" data-bs-dismiss="modal" class="close_button">Close</button>
                        <button  class="add_user create-button ">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  {{-- edit modal --}}

  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg " >
      <div class="modal-content" style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: black" >
          <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3 pt-6  ">
                  <div class="container">
                        <div class="row">
                              <div class="col-sm-4  ">
                                    <input type="text" hidden id="usercode">
                                    <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >First Name</label>
                                    <input class=" fname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" id="edit_fname" style="background: #D0B894;">

                                    <div class="mt-0 mb-2">
                                      <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_fname"></span>
                                    </div>
                              </div>
                  
                              <div class="col-sm-4  "  >
                                    <label class=" rounded bg-[#EDDBC0] ml-3">Middle Name (Optional)</label>
                                    <input class="mname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" id="edit_mname" type="text">

                              </div>
                  
                              <div class="col-sm-4  " >
                                    <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Last Name</label>
                                    <input class=" lname rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="edit_lname" type="text"> 

                                    <div class="mt-0 mb-2">
                                          <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_lname"></span>
                                    </div>
                              </div>
      
                              <div class="row" style="margin-top:1%;padding-right:0;">
      
                                    <div class="col">
                                          <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Birthday</label>
                                          <input class=" birthday rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_birthday" style="background: #D0B894;text-decoration:aliceblue;" type="date"> 
                                          
                                          <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_birthday"></span>
                                          </div>
                                    </div>
      
                                    <div class="col">
                                          <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Age</label>
                                          <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_age" style="background: #D0B894;" type="text"> 

                                          <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_age"></span>
                                          </div>
                                    </div>
      
                                    <div class="col-sm" style="padding-right: 0;">
                                          <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Sex:</label>
                                          <select name="gender" class="gender rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_gender"  style="background: #D0B894;"  >
                                                <option value="" {{$user->gender == "" ? 'selected' : ''}}></option>
                                                <option value="Male" {{$user->gender == "Male" ? 'selected' : ''}}>Male</option>
                                                <option value="Female" {{$user->gender == "Female" ? 'selected' : ''}}>Female</option>
                                          </select>

                                          <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_gender"></span>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Address</label>
                        <input class=" address rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_address" style="background: #D0B894;" type="text">

                        <div class="mt-0 mb-2">
                            <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_address"></span>
                        </div>
      
                        <div class="row" style="margin-top:1%">
                              <div class="col-sm" style="">
                                    <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Mobile No.</label>
                                    <input class=" mobileno  rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_mobileno" style="background: #D0B894;" type="text"> 

                                    <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_mobileno"></span>
                                    </div>
                              </div>
      
                              <div class="col-sm-7">
                                    <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Email</label>
                                    <input class=" email rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_email" style="background: #D0B894;"type="text"> 

                                    <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_email"></span>
                                    </div>
                              </div>
                        </div>
      
                        <div class="row" style="margin-top:1%">
                              <div class="col-sm-4" style="">
                                    <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Username</label>

                                    <input readonly class=" username rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_username" style="background: #D0B894;" type="text"> 
                                    <div class="mt-0 mb-2">
                                      <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_username"></span>
                                    </div>
                              </div>
      
                              <div class="col-sm-4">
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
                              </div>
      
                              <div class="col-sm-4">
                                    <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Status:</label>
                                    <select class=" rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background: #D0B894;" id="edit_status" >
                                    <option value="" {{$user->status == "" ? 'selected' : ''}}></option>
                                    <option value="verified" {{$user->status == "verified" ? 'selected' : ''}}>Verfied</option>
                                    <option value="inactive" {{$user->status == "inactive" ? 'selected' : ''}}>Inactive</option>
                                    </select>

                                      <div class="mt-0 mb-2">
                                        <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_status"></span>
                                      </div>
                              </div>
                        </div>
                        
                        <div class="row" style="margin-top:1%">
                            <div class="col-sm-6">
                                <label class="mb-0 rounded bg-[#EDDBC0]  ml-3" >Password</label>
                                <div class="input-box">
                                        <input type="password" class="edit_password" id="edit_password">
                                        <i class="edit_show_password fa-regular fa-eye-slash"></i>
                                        <i class="edit_hidden_password fa fa-eye" style="display: none;" ></i>
                                </div>

                                <div class="mt-0 mb-2">
                                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_password"></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Confirm Password</label>
                                <div class="input-box">
                                    <input type="password" class="edit_password_confirmation" id="edit_password_confirmation">
                                    <i class="edit_show_confirm_password fa-regular fa-eye-slash"></i>
                                    <i class="edit_hidden_confirm_password fa fa-eye" style="display: none;" ></i>
                                </div> 

                                <div class="mt-0 mb-2">
                                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="confirmpassword"></span>
                                </div>
                            </div>
                        </div>
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
    let usertype = "{{Auth::user()->usertype}}";
</script>

<script src="{{ mix('js/admin/user.js') }}"></script>

@endsection