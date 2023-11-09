@extends('layouts.admin_navigation')
@section('title', 'Document')
@section('content')

<style>
    label{
        font-family: 'Poppins';
    }
    .input, .service_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        
    }
 </style>
<div class="row m-4" style="font-family: Poppins;">
    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px" id="message-success"></p> 
    </div>

    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	


    <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
        <div class="me-auto col-md-8 col-md-offset-5">
            <h1> <b>DOCUMENT</b>  </h1>
        </div>
        <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 show-create"  >
        Create
        </button>
    </div>
    
    <div class="card"  style="background:#EDDBC0;border:none; " >
        <div class="table-appointment" style="padding: 0%" >
            <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                <table class="table table-bordered table-striped  "  id="document" style="background-color: white; width:100%" >
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Appointment date</th>
                            <th>Fullname</th>
                            <th>Document Type</th>
                            <th style="min-width: 55px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="error">
            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--------------------------- Create modal -------------------------------------}}
    <div class="modal fade create " id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Create document</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 pt-6  ">
                            <form method="POST" id="store_data" enctype="multipart/form-data" class="row">
                                {{ csrf_field() }}
                              
                                    <div class="row" style="padding-right:0px">
                                        <div class="col-sm-6">
                                            <label for="">Appointment id</label><br>
                                            <div style="display:inline;">
                                                <input class=" fullname refresh rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894; width:87%" id="appointment_id" name="appointment_id" readonly type="text"> 
                                                <button class="getappointment btn btn-outline-success" type="button" style="border: 1px solid #829460;"><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 15px ;
                                                    width: 15px ;" id="appointment" alt="" ></button><br> 
                                            </div>
                                            <label style="margin-top:10px" for="">Fullname</label><br>
                                            <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" readonly  style="width: 100%" id="user_id" name="user_id" hidden>
                                            <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" readonly  style="width: 100%" id="fullname" name="fullname">
                                            <label style="margin-top:10px" for="">Appointment date</label><br>
                                            <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" id="date" name="date"><br>
                                            <div class="mt-0 mb-2">
                                                <span  role="alert" class="block mt-5   text-danger" id="error_userid"></span>
                                            </div>    
                                        </div>
        
                                        <div class="col-sm-6">
                                            <label style="margin-bottom: 5px;" for="">Description</label><br>
                                            <input class=" w-100 rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" name="doc_type" class="input" type="text">
                                            <br>
                                            <div class="mt-0 mb-2">
                                                    <span  role="alert" class="block mt-5   text-danger" id="error_doc_type"></span>
                                            </div>
                        
                                            <label style="margin-top:5px" for="">Upload pdf</label><br>
                                            <input type="file" class="rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  id="pdf" name="pdf"><br>
                                            <div class="mt-0 mb-2">
                                                <span  role="alert" class="block mt-5   text-danger" id="error_file"></span>
                                            </div>
                                        </div>
                                    </div>
 
                                
                                <div class="form-group" >
                                    <label for="message-text"  style="margin-top:5px" >Note</label>
                                    <textarea class="input" style="width: 100%; text-align: justify; padding: 10px; text-justify: inter-word; white-space: pre-wrap; min-height: 160px; overflow:hidden; resize:none" id="note"   name="note"></textarea>

                                </div>
                     
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                        <button type="button" style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                        <button class=" add_transaction p-2 w-30 bg-[#829460]  mt-7 " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </div>

    {{------------------------View Appointments------------------------------}}
    <div class="modal fade viewappointments " id="viewappointments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content viewbody" style="background: #EDDBC0;">
        
                <!-- Modal Header -->
                <div class="modal-header" style="border-bottom-color: gray">
                    <h4 class="modal-title">Appointments</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
        
            <!-- Modal body -->
                <div class="modal-body " >
                    <div class="patient patient-remove overflow-auto container-fluid" style="height:420px" >
                        <table class="table table-bordered appointment table-striped"  style="background-color: white; width:100%" >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>fullname</th>
                                    <th>date</th>
                                    <th>time</th> 
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody class="nofound" >
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97% ;border-top-color: gray" >
                        <button type="button" class="  " style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

              {{------------------------View document-------------------------------}}
    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="background: #EDDBC0;">
                    <div class="modal-header" style="border-bottom-color: gray">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">View document</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div class="mb-4 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <div  class="row">
                                <div class="col-md-6">

                                    <label for="">Appointment id</label><br>
                                    <input type="text"  class="input" id="view_appointemntid"  style="width: 100%" name="appointment_id" readonly><br>
                                    
                                    <label style="margin-top:10px" for="">Fullname</label><br>
                                    <input type="text" class="input" readonly  style="width: 100%" id="user_id" name="user_id" hidden>
                                    <input type="text" class="input" readonly   style="width: 100%" id="view_fullname" name="fullname">

                                    <label style="margin-top: 10px" for="">Appointment date</label><br>
                                    <input readonly type="text" readonly class="input"  style="width: 100%" id="view_date" name="date"><br>
                                
                                </div>
            
                                <div  class="col-md-6">
                                    <label style="margin-top: 0px" for="">Description</label><br>
                                    <input readonly type="text" class="input"  style="width: 100%" id="view_doc_type" name="date"><br>
                            
                                    <label style="margin-top:11px" for="">Uploaded pdf</label><br>
                                    <input readonly type="text"class="input" readonly   style="width: 100%" id="view_file" name="pdf"><br>
                                </div>

                                <div class="form-group" >
                                    <label for="message-text" style="margin-top:20px"  class="col-form-label">Note:</label>
                                    <textarea class="input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; min-height: 160px; resize:none" readonly id="view_note" name="note"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer" style="border-top-color: gray; padding-bottom:0px">
                            <button type="button" style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                            <div id="fileview"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--------------- edit modal --------------------}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Edit document</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <form method="POST" id="update_data" enctype="multipart/form-data" class="row">

                                <div class="row" style=" padding-right:0px">
                                    <div class="col-sm-6">
                                        <input type="text" hidden id="document_id" name="document_id">
                                        <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" readonly  style="width: 100%" id="edit_userid" name="user_id" hidden>
                                        <label for="">Appointment id</label><br>
                                        <div style="display:inline;">
                                        <input class=" fullname refresh rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894; width:87%" id="edit_appointmentid"   name="appointment_id" readonly type="text"> 
                               
                                        </div>
                                        <label style="margin-top:10px" for="">Fullname</label><br>
                                        <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" readonly  style="width: 100%" id="edit_fullname" name="fullname">
                                        <label style="margin-top:10px" for="">Appointment date</label><br>
                                        <input type="text" class="rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400"  style="width: 100%; background: #D0B894;" id="edit_date" name="date"><br>
                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5   text-danger" id="error_userid"></span>
                                        </div>    
                                    </div>
    
                                    <div class="col-sm-6">
                                        <label style="margin-bottom: 5px;" for="">Description</label><br>
                                        <input class=" w-100 rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" style="background: #D0B894;" id="edit_doc_type" name="doc_type" class="input" type="text">
                                        <br>
                                        <div class="mt-0 mb-2">
                                                <span  role="alert" class="block mt-5   text-danger" id="error_doc_type"></span>
                                        </div>
                    
                                        <label style="margin-top:5px" for="">Upload pdf</label><br>
                                        <input type="file" class="rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="pdf" name="pdf"><br>
                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5   text-danger" id="error_file"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="message-text" style="margin-top:5px"  class="col-form-label">Note:</label>
                                    <textarea class="input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; min-height: 100px; height:auto" id="edit_note" name="note"></textarea>
                                </div>
                        </div>
                    </div>


                    <div class="modal-footer" style="border-top-color: gray">
                        <button type="button" style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                        <button class="update p-2 w-30 bg-[#829460]  mt-7 " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{---- delete modal---}}
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content" style="background: #EDDBC0; margin-top:30%;">
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                            <input type="text" hidden id="documentid">
                            <h5>Do you want to delete this data?</h5>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close btn btn-secondary" style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">Close</button>
                        <button class="delete_user" id="deletefile"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@vite( 'resources/js/admin/document.js')

<script>
    // Select the textarea element
var textarea = $('#note');

// Attach an input event listener to the textarea
textarea.on('input', function() {
  // Reset the height to its default value to calculate the scrollHeight properly
  $(this).height('auto');
  
  // Set the new height to match the scrollHeight
  $(this).height(this.scrollHeight);
});
</script>
@endsection