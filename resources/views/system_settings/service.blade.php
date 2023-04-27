@extends('layouts.admin_navigation')
@section('content')
<div class="row " style="margin-bottom: 0px; margin-top:24px; margin-left:24px; margin-right:24px">


    <div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
        <div class="me-auto">
        {{-- <i class="fa fa-search"></i>
          <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
          <div class="col-md-8 col-md-offset-5">
            <h1>Services </h1>
        </div>
        </div>
       

        <button type="button" style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" class="btn btn-primary ml-6" data-bs-toggle="modal" data-bs-target="#create">
            Create
          </button>

        </div>

        <div id="success" class="success alert alert-success" role="alert" style="display:none">
            <p style="margin-bottom: 0px;" id="message-success"></p> 
          </div>

<div class="card" style="background:#EDDBC0;border:none; height:500px " >
    <div class="" style="padding:0% " >
        <div class="card-body" style="width:100%; min-height:63vh; display: flex; overflow-x: auto;  font-size: 15px; " >
        <table class="table table-bordered table-striped"  style="background-color: white; margin-bottom:0px" >
            <thead>
                <tr>
                    <th style="text-align: center;" >Id</th>
                    <th style="text-align: center;" >Service name</th>
                    <th style="text-align: center;" >price</th>
                    <th  style="width: 205px; text-align: center;">Actions</th> 
                </tr>
            </thead>
            <tbody >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr>
                    <td style="text-align: center;" >{{$service->servicecode}}</td>
                    <td style="text-align: center;" >{{$service->services}}</td>
                    <td style="text-align: center;" >{{$service->price}}</td>
                    <td style="text-align: center">
                    <button type="button" value="{{$service->servicecode}}" class="edit btn btn-sm btn-primary">Edit</button>
                    <button type="button" value="{{$service->servicecode}}" class="delete btn  btn-danger btn-sm">delete</button></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" style="text-align: center;">No Service Found</td>
              
                  </tr>
                   
                @endif
              
            </tbody>
        </table>
        </div>
        <div style="">
            {!! $services->links() !!}
         </div>
    </div>

 
</div>

{{-- modal --}}
{{-- create --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"  style="background: #EDDBC0;">
          <div class="modal-header" style="border-bottom-color: gray">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Service name</label>
                <input class=" servicename bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="name"></span>
                </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Price</label>
                <input class="price bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="number">
                <span  role="alert" class="block mt-5   text-danger" id="price"></span>
                <br>
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5   text-danger" id="price"></span>
                </div>
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" btn " data-bs-dismiss="modal">Close</button>
          <button style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " type="button" class="add_service btn " >Create</button>
      
        </div>
      </div>
    </div>
  </div>
</div>

{{-- edit --}}

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
                    <input type="hidden" id="servicecode">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Service name</label>
                <input class="servicename bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_servicename" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5   text-danger" id="error_servicename"></span>
                </div>

                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Price</label>
                <input class="price bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" id="edit_price" type="number">
                <br>           
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5   text-danger" id="error_price"></span>
                </div>
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
            <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" btn " data-bs-dismiss="modal">Close</button>
          <button style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " type="button"  class=" update_service btn" >Update</button>
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
                    <input type="hidden" id="servicecode">
                <h6>Do you want to delete this data?</h6>
         
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer" style="border-top-color: gray">
          <button type="button" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px;" class="btn" data-bs-dismiss="modal">Close</button>
          <button class=" delete_service" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; "  >delete</button>
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
            $('#name, #price, #error_servicename, #error_price').html("");
        });

        //store data
        $(document).on('click', '.add_service', function(e){
            e.preventDefault();
            var data ={
                'servicename' : $('.servicename').val(),
                'price': $('.price').val(), 
            }
            //always add csrf token

            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/admin/service/createservice/store",
                data: data,
                datatype: "json",
                success: function(response){
                    console.log(response);
                    if(response.status == 400){
                        $('#name' ).html("");
                        // $('#price, #name' ).addClass('alert alert-danger');
                        $.each(response.errors.servicename, function (key, err_values){
                            $('#name').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.price, function (key, err_values){
                            $('#price').append('<span>'+err_values+'</span>');
                        })
                    }else{
                        $('#message-success').text('Created successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#create').modal('hide');
                        $('#create').find('input').val("");
                        $('.table').load(location.href+' .table');
                    }
                }
            });

        });


            //show data in edit form
             $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var sercode = $(this).val();
           $('#edit').modal('show');
           $.ajax({
                type: "GET",
                url: "/admin/service/edit/"+ sercode,  
                datatype: "json",
                success: function(response){ 
                    // console.log( response.discounts.percentage)
                    if(response.status == 400){
                    $('#price, #name' ).html("");
                    $('#price, #name' ).addClass('alert alert-danger');
                    $('#message' ).text(response.messages);
                    }else{
               $('#edit_servicename').val(response.service[0].services);
               $('#edit_price').val(response.service[0].price);
               $('#servicecode').val(sercode);
             
                    }
        }
    });
        });

            //update data from database
            $(document).on('click', '.update_service', function(e){
            e.preventDefault();
            var sercode = $('#servicecode').val();
            var data ={
                _method: 'PUT',
                'servicename' : $('#edit_servicename').val(),
                'price': $('#edit_price').val(), 
            }
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            console.log(data);
           $.ajax({
                type: 'POST', 
                url: "/admin/service/update/"+sercode,
                data: data,
                datatype: "json",
                success: function(response){ 
                    console.log(response);
                    if(response.status == 400){
                        $('#error_servicename, #error_price' ).html("");
                        $.each(response.errors.servicename, function (key, err_values){
                        $('#error_servicename').append('<span>'+err_values+'</span>');
                        });
                        $.each(response.errors.price, function (key, err_values){
                        $('#error_price').append('<span>'+err_values+'</span>');
                        });

                    }else{                  

                        $('#message-success').text('Updated successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#edit').modal('hide');
                        $('#edit').find('input').val("");
                        $('.table').load(location.href+' .table');
                    }
        }
    });
        });

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var sercode = $(this).val();
            $('#delete').modal('show');
            $('#servicecode').val(sercode);
        });

        $(document).on('click', '.delete_service', function(e){
            e.preventDefault();
            var sercode = $('#servicecode').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/service/delete/"+ sercode,
                data: sercode,
                datatype: "json",
                success: function(response){ 
                       
                    $('#message-success').text('Deleted successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                        $('.table').load(location.href+' .table');
        }
    });
        });


});
</script>

@endsection