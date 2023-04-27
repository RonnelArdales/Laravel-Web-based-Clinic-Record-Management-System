@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">


<div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
  <div class="me-auto">
  {{-- <i class="fa fa-search"></i>
    <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
    <div class="col-md-12 col-md-offset-12">
      <h1>Mode of payment</h1>
  </div>
  </div>
 

  <button type="button"  style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
    Create
  </button>

  </div>

  <div id="success" class="success alert alert-success" role="alert" style="display:none">
    <p style="margin-bottom: 0px" id="message-success"></p> 
  </div>

<div class="card" style="background:#EDDBC0;border:none; height:500px " >
    <div class="" style="padding:0% " >
    <div class="card-body" style="width:100%; min-height:63vh; display: flex; overflow-x: auto;  font-size: 15px; " >
        <table class="table table-bordered table-striped"  style="background-color: white; margin-bottom:0px" >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th >Actions</th>
                 
                </tr>
            </thead>
            <tbody >
              @if (count($mops)> 0 )
              @foreach ($mops as $mop)
              <tr class="overflow-auto">
                  <td>{{$mop->id}}</td>
                  <td>{{$mop->modeofpayment}}</td>
                  <td>{{$mop->image}}</td>
                  <td style="text-align: center">
                  <button type="button" value="{{$mop->id}}" class="edit btn btn-primary btn-sm">Edit</button>
                  <button type="button" value="{{$mop->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align: center;">No Mode of Payment Found</td>
          
              </tr>
              @endif
               
            </tbody>
        </table>
      </div>
      <div style="">
        {!! $mops->links() !!}
     </div>
    </div>
</div>
  

{{-- create user modal --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content"  style="background: #EDDBC0;">
        <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Discount</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
            <div class=" columns-1 sm:columns-2">
                <form method="POST" id="store_data" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mode of payment</label>
                <input name="mop" class=" mop_name bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="mop"></span>
                </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Image</label><br>
                <input id="image" name="image" class="image " type="file">
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="image"></span>
                  </div>
                <br>
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" add_discount " >Create</button>
        </form>
        </div>

  
      </div>
    </div>
  </div>
</div>

  {{-- edit modal --}}
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content"  style="background: #EDDBC0;">
          <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
            <div class=" columns-1 sm:columns-2">
                <form method="POST" id="update_data" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mode of payment</label>
                <input type="text" hidden id="mop_id">
                <input name="mop" class=" edit_mop_name bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_mop_name" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_mop"></span>
                </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Image</label><br>
                <input id="image" name="image" class="image " type="file">
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="error_image"></span>
                  </div>
                <br>
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" add_discount " >Create</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- //delete modal --}}

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content"  style="background: #EDDBC0;">
          <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hold on!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="text" hidden id="deletemopid">
                <h6>Do you want to delete this data?</h6>
         
              {{-- </form> --}}
        </div>
        </div>
        <div style="border-top-color: gray" class="modal-footer">
          <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; "  type="button" class=" btn" data-bs-dismiss="modal">Close</button>
          <button style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" delete_mop" >delete</button>
        </div>
      </div>
    </div>
  </div>
</div>
    
</div>
  <!-- Modal -->

  

@endsection

@section('scripts')
<script>
    $(document).ready(function (){

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

        $(".modal").on("hidden.bs.modal", function(){
            $('#create, #edit, #delete').find('input').val("");
            $('#name, #percent, #error_discountname, #error_percent').html("");
        });

 

        // $('.table').load(location.href+' .table');

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
                url: "/admin/modeofpayment/store", 
                data: formData,
                datatype: "json",
                contentType:false,
                cache:false,
                processData: false,
                success: function(response){ 
                  if(response.status == 400){
                        $('#mop, #image' ).html("");
                        $.each(response.errors.mop, function (key, err_values){
                          $('#mop').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.image, function (key, err_values){
                            $('#image').append('<span>'+err_values+'</span>');
                        })
                  }else{
                        $('#message-success').text('Created Successfully');
                        $('#create').modal('hide');
                       $('.table').load(location.href+' .table');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                  
                    
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
                url: "/admin/modeofpayment/edit/"+ id,  
                datatype: "json",
                success: function(response){ 
                    if(response.status == 400){
                    $('#price, #name' ).html("");
                    $('#price, #name' ).addClass('alert alert-danger');
                    $('#message' ).text(response.messages);
                    }else{
             $('#mop_id, #edit_mop_name').val("")
            $('#mop_id').val(response.mop.id);
               $('#edit_mop_name').val(response.mop.modeofpayment);
                    }
        }
    });
        });

        //-------------------update-----------------------------//
        $('#update_data').on('submit', function(e){
            e.preventDefault();
            var id = $('#mop_id').val();
            let formData = new FormData(this);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'POST', 
                url: "/admin/modeofpayment/update/"+ id,
                data: formData,
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
                    if(response.status == 400){
                        $('#error_mop, #error_image' ).html("");
                        $.each(response.errors.mop, function (key, err_values){
                          $('#error_mop').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.image, function (key, err_values){
                            $('#error_image').append('<span>'+err_values+'</span>');
                        })
                  }else{
                        $('#message-success').text('Updated Successfully');
                        $('#edit').modal('hide');
                       $('.table').load(location.href+' .table');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                  
                    
                  }
        }
    });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).val();
            $('#delete').modal('show');
            $('#deletemopid').val(id);
        });

        $(document).on('click', '.delete_mop', function(e){
            e.preventDefault();
            var id = $('#deletemopid').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/modeofpayment/delete/"+ id,
                datatype: "json",
                success: function(response){ 
                       
                    $('#message-success').text('Deleted successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#delete').modal('hide');
                        $('#deletemopid').find('input').val("");
                        $('.table').load(location.href+' .table');
        }
    });
        });


    });
</script>

@endsection

