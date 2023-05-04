@extends('layouts.admin_navigation')
@section('title', 'Pending user')
@section('content')

<div class="row m-4">

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


      <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
            <div class="me-auto col-md-8 col-md-offset-5">
                  <h1> <b>PENDING USER</b> </h1>
            </div>
      </div>

      <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px;" id="message-success"></p> 
      </div>

      <div class="card"  style="background:#EDDBC0;border:none; " >
            <div class="table-user" style="padding: 0%" >
              <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                  <table class="table table-bordered table-striped  "  id="users" style="background-color: white; width:100%" >
                      <thead>
                          <tr>
                   
                              <th>Patient Id</th>
                              <th>Fullname</th>
                              <th>Gender</th>
                              <th>Age</th>
                              <th >Date Created</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="error">
            
                      </tbody>
                  </table>
              </div>
            </div>
          </div>

          {{---- Verify modal---}}
<div class="modal fade" id="verify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="background: #EDDBC0; margin-top:30%;">
        <div class="modal-header" style="border-bottom-color: gray" >
          <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:700;">Hold on!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" hidden id="userid">
                <h5>Do you want to verify this user?</h5>

        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button type="button" class=" btn btn-secondary" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">No</button>
          <button class="verify_user" id="verify_user"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Yes</button>
        </div>
      </div>
    </div>
  </div>
  </div>


          


      
</div>

@endsection


@section('scripts')
<script>
      $(document).ready(function () {

            
    var user = $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/pendinguser",
	   dom: 'frtp',
	   pageLength: 10,
	   responsive: true,
        columns: [
		{data: 'id', name: 'id' , orderable: false, searchable: false},
		{data: 'fullname', name: 'fullname' , orderable: false},
		{data: 'gender', name: 'gender' , orderable: false, searchable: false},
		{data: 'age', name: 'age' , orderable: false, searchable: false},
        {data: 'created_at', name: 'created_at' , orderable: false, searchable: false},
		{data: 'status', name: 'status', orderable: false, searchable: false},
		{ data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $('#users').on('click', '.verify', function(e) {
	e.preventDefault();
    var id = $(this).data('id');
    $('#userid').val(" ");
    $('#userid').val(id);
    $('#verify').modal('show');
     
        });

    $(document).on('click', '.verify_user', function(e) {
     id = $('#userid').val();
        
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "POST",   
                url: "/admin/pendinguser/status/" + id, 
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){
                    $(".main-spinner").hide();
                    $('#verify').modal('hide');
                },
                success: function(response){ 
        
                    $('#userid').val(" ");
                    $('#userid').val(id);
                   user.draw();
                   $('#message-success').text("Updated Successfully");
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                 
                }
            });

    })


      });
</script>
@endsection

