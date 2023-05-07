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
        text-align: center; 
    }
  
  </style>
    <div class="row m-4" style="font-family: Poppins;">

      <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px" id="message-success"></p> 
      </div>

      <div class="main-spinner" style="
	  position:fixed;
		width:100%;
		left:0;right:0;top:0;bottom:0;
		background-color: rgba(255, 255, 255, 0.279);
		z-index:9999;
		display:none;"> 
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
            <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" type="button" class="btn btn-primary ml-6 show-create" data-bs-toggle="modal" data-bs-target="#create"  >
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
                <div class=" columns-1 sm:columns-2">
                    <form method="POST" id="store_data" enctype="multipart/form-data" class="row">
                        {{ csrf_field() }}
                        <div class="col-md-6">

                            <label for="">Appointment id</label><br>
                            <input type="text"  class="input" id="appointment_id"  style="width: 300px" name="appointment_id" readonly>
                            <button class="getappointment btn btn-outline-success" type="button" style="border: 1px solid #829460;"><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 15px ;
                                width: 15px ;" id="appointment" alt="" ></button><br>
                            <label style="margin-top:10px" for="">Fullname</label><br>
                            <input type="text" class="input" readonly  style="width: 300px" id="user_id" name="user_id" hidden>
                            <input type="text" class="input" readonly  style="width: 300px" id="fullname" name="fullname">
                            <label style="margin-top:10px" for="">Appointment date</label><br>
                            <input type="text" class="input"  style="width: 300px" id="date" name="date"><br>
                            <div class="mt-0 mb-2">
                              <span  role="alert" class="block mt-5   text-danger" id="error_userid"></span>
                        </div>
                        </div>
    
                        <div class="col-md-6">

                          <label style="margin-bottom: 5px;" for="">Description</label><br>
                          <input style="width:300px" name="doc_type" class="input" type="text">
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
                        

                        <div class="form-group" >
                            <label for="message-text"    class="col-form-label">Note:</label>
                            <textarea class="input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; min-height: 100px; height:auto" id="note" name="note"></textarea>
                          </div>
              
   
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

              {{------------------------View transaction-------------------------------}}
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
                          <input type="text"  class="input" id="view_appointemntid"  style="width: 300px" name="appointment_id" readonly><br>
                        
                          <label style="margin-top:10px" for="">Fullname</label><br>
                          <input type="text" class="input" readonly  style="width: 300px" id="user_id" name="user_id" hidden>
                          <input type="text" class="input" readonly   style="width: 300px" id="view_fullname" name="fullname">

                          <label style="margin-top: 10px" for="">Appointment date</label><br>
                          <input readonly type="text" readonly class="input"  style="width: 300px" id="view_date" name="date"><br>
                       
                      </div>
  
                      <div  class="col-md-6">
                        
                        <label style="margin-top: 0px" for="">Description</label><br>
                        <input readonly type="text" class="input"  style="width: 300px" id="view_doc_type" name="date"><br>
                
                      <label style="margin-top:13px" for="">Uploaded pdf</label><br>
                      <input readonly type="text"class="input" readonly   style="width: 300px" id="view_file" name="pdf"><br>
                      </div>

                      <div class="form-group" >
                          <label for="message-text" style="margin-top:20px"  class="col-form-label">Note:</label>
                          <textarea class="input" style="width: 100%;text-align: justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; min-height: 100px; height:auto" id="view_note" name="note"></textarea>
                        </div>
            
 
              </div>
              </div>


                  <div class="modal-footer" style="border-top-color: gray; padding-bottom:0px">
                  <button type="button" style=" border-radius: 30px; border: 2px solid #829460;width: 110px;height: 37px; color:#829460;; background:transparent;" data-bs-dismiss="modal">Close</button>
                  <div id="fileview">

                  </div>
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
                
                      <div class="col-md-6">

                          <label for="">Appointment id</label><br>
                          <input type="text" hidden id="document_id" name="document_id">
                          <input  type="text"  class="input" id="edit_appointmentid"  style="width: 300px" name="appointment_id" readonly>
                          <br>

                          <label style="margin-top:10px" for="">fullname</label><br>
                          <input type="text" class="input" readonly  style="width: 300px" id="edit_userid" name="user_id" hidden>
                          <input type="text" class="input" readonly  style="width: 300px" id="edit_fullname" name="fullname">
                       
                            <label style="margin-top:10px" for="">Appointment date</label><br>
                          <input readonly type="text" class="input"  style="width: 300px" id="edit_date" name="date"><br>
                      </div>
            
                      <div  class="col-md-6">

                        <label style="margin-bottom: 5px;" for="">Description</label><br>
                        <input style="width:300px" name="doc_type" id="edit_doc_type" class="input" type="text">
                        <br>
                        <div class="mt-0 mb-2">
                              <span  role="alert" class="block mt-5   text-danger" id="error_edit_doc_type"></span>
                        </div>
  
     
                      <label style="margin-top:5px" for="">Upload pdf</label><br>
                      <input type="file" class="rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5"  id="pdf" name="pdf"><br>

                      <div class="mt-0 mb-2">
                        <span  role="alert" class="block mt-5   text-danger" id="error_edit_file"></span>
                  </div>
                      </div>

                      <div class="form-group" >
                          <label for="message-text" style="margin-top:20px"  class="col-form-label">Note:</label>
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
          <div class="modal-header" style="border-bottom-color: gray" >
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Delete Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-5 pt-6  ">
                  <div class=" columns-1 sm:columns-2">
                      <input type="text" hidden id="documentid">
                  <h5>Do you want to delete this data?</h5>
           
                {{-- </form> --}}
          </div>
          </div>
          <div class="modal-footer" style="border-top-color: gray">
            <button type="button" class=" close btn btn-secondary" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">Close</button>
            <button class="delete_user" id="deletefile"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
          </div>
        </div>
      </div>
    </div>
    </div>

    </div>
@endsection

@section('scripts')
<script>

$(document).ready(function(){



    setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);

window.addEventListener('beforeunload', function () {
  $('#view').modal('hide');
});
	
	var document = $('#document').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/document",
	   dom: 'frtp',
	   pageLength: 10,
	   responsive: true,
        columns: [
		    {data: 'id', name: 'id' , orderable: false, searchable: false},
        {data: 'appointment_date', name: 'appointment_date' , orderable: false, searchable: false},
        {data: 'fullname', name: 'fullname' , orderable: false, searchable: false},
        {data: 'documenttype', name: 'documenttype' , orderable: false, searchable: false},
        {data: 'action', name: 'Action', orderable: false, searchable: false},
        ]
    });

    $('#viewappointments').on('shown.bs.modal', function() {
                $('.appointment').DataTable({
                "ajax": "/admin/consultation/show_appointment",
                processing: true,
                serverSide: true,
                dom: 'frtp',
                pageLength: 6,
                responsive: true,
                "columns": [
                  {data: 'id', name: 'id' , orderable: false, searchable: false},
                          {data: 'fullname', name: 'fullname' , orderable: false},
                          {data: 'date', name: 'date' , orderable: false, searchable: false},
                          {data: 'time', name: 'time' , orderable: false, searchable: false},
                          { width: "10%",data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
          });

          $('#viewappointments').on('hidden.bs.modal', function() {
            $('.appointment').DataTable().destroy();
        });



        $(".create").on("hidden.bs.modal", function(e){
          e.preventDefault();
          $('#create').find('input, select').val("");
        });



                    $('.getappointment').on('click', function(e){
                      e.preventDefault();
                    $('#viewappointments').modal('show');
                  })     

        



        //---------------store data ------------------//

        $('#store_data').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "POST",   
                url: "/admin/document/store", 
                data: formData,
                datatype: "json",
                contentType:false,
                cache:false,
                processData: false,
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){

                    $(".main-spinner").hide();
                },
                success: function(response){ 
                  if(response.status == 400){
                        $('#error_userid, #error_file, #error_doc_type' ).html("");
                        $.each(response.errors.fullname, function (key, err_values){
                          $('#error_userid').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.pdf, function (key, err_values){
                            $('#error_file').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.doc_type, function (key, err_values){
                            $('#error_doc_type').append('<span>'+err_values+'</span>');
                        })
                  }else{
                        $('#message-success').text('Created Successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#create').modal('hide');
                        document.draw();
                    
                  }
            
                 
                }
            });
                });

        //-----------------------Get User-----------------------------//
        
        $('.appointment').on('click', '.select', function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                            console.log(id);
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/admin/consultation/getappointment/" +id,
                            datatype: "json",
                            beforeSend: function(){
                                $(".main-spinner").show();
                            },
                            complete: function(){

                                $(".main-spinner").hide();
                            },
                            success: function(response){ 
                                   $('#appointment_id,#user_id,#fullname,#date,#time ').val("");

                                    $('#appointment_id').val(response.appointment.id);
                                    $('#user_id').val(response.appointment.user_id);
                                    $('#fullname').val(response.appointment.fullname);
                                    $('#date').val(response.appointment.date);
                                
                           
                                    $('#viewappointments').modal('hide');
                                }
                            });
            
                        });

            $('#document').on('click', '.view', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
           $('#view').modal('show');
           $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
           $.ajax({
                type: "GET",   
                url: "/admin/document/edit/"+ id, 
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
              $('#fileview').html("");
              $('#view').find('input, textarea').html("");
               $('#view_appointemntid').val(response.document.appointment_id);
               $('#view_fullname').val(response.document.fullname);
               $('#view_doc_type').val(response.document.documenttype);
               $('#view_date').val(response.document.appointment_date);
               $('#view_file').val(response.document.filename);
               $('#view_note').val(response.document.note);
               $('#fileview').append('  <a href="/admin/document/download/' + response.document.id+'" class=" p-2 w-30 bg-[#829460]  mt-7 " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; text-decoration:none; " >Download</a>\
               ');
        }
    });
        });

        $('#document').on('click', '.edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
           $('#edit').modal('show');
           $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
           $.ajax({
                type: "GET",   
                url: "/admin/document/edit/"+ id, 
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
                  console.log(response)
              $('#fileview').html("");
              $('#edit').find('input, textarea').val("");
               $('#document_id').val(response.document.id);
               $('#edit_appointmentid').val(response.document.appointment_id);
               $('#edit_userid').val(response.document.user_id);
               
               $('#edit_fullname').val(response.document.fullname);
               $('#edit_doc_type').val(response.document.documenttype);
               $('#edit_date').val(response.document.appointment_date);
               $('#edit_note').val(response.document.note);

        }
    });
        });

        //-------------------update-----------------------------//
              $('#update_data').on('submit', function(e){
            e.preventDefault();
            var id = $('#document_id').val();
            let formData = new FormData(this);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'POST', 
                url: "/admin/document/update/"+ id,
                data: formData,
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){

                    $(".main-spinner").hide();
                },
                success: function(response){ 
                  console.log(response);
                    if(response.status == 400){
                      $('#error_userid, #error_file, #error_doc_type' ).html("");
                        $.each(response.errors.pdf, function (key, err_values){
                            $('#error_edit_file').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.doc_type, function (key, err_values){
                            $('#error_edit_doc_type').append('<span>'+err_values+'</span>');
                        })
                    }else{                  
                        $('#message-success').text('Updated Successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#edit').modal('hide');
                        $('#edit').find('input, textarea').val("");
                        document.draw();
           
                    }
        }
    });
        });

        
        $('#document').on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#documentid').val(id);
           $('#delete').modal('show');
        });

        $('#deletefile').on('click',  function(e) {
            e.preventDefault();
            id =  $('#documentid').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: 'DELETE', 
                url: "/admin/document/delete/"+ id,
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){

                    $(".main-spinner").hide();
                },
                success: function(response){ 
                        $('#documentid' ).html("");
                        $('#message-success').text('Deleted Successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        document.draw();
                  }
            });


           $('#delete').modal('hide');
        });


});


</script>
@endsection