@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
    
        <h1>Services  <button type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
           create
         </button></h1>
       </div>
       <div>
        
       </div>
 
       <div id="success"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>service code</th>
                    <th>service name</th>
                    <th>price</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr class="overflow-auto">
                    <td>{{$service->servicecode}}</td>
                    <td>{{$service->servicename}}</td>
                    <td>{{$service->price}}</td>
                    <td>
                    <button type="button" value="{{$service->servicecode}}" class="edit btn btn-primary btn-sm">Edit</button>
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
 
</div>

{{-- modal --}}
{{-- create --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >service name</label>
                <input class=" servicename bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5 pb-4 text-danger" id="name"></span>
                </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Price</label>
                <input class="price bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="text">
                <span  role="alert" class="block mt-5   text-danger" id="price"></span>
                <br>
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5   text-danger" id="price"></span>
                </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" add_service p-2 w-30 bg-[#829460]  mt-7 rounded" >Submit</button>
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
                <input class="price bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" id="edit_price" type="text">
                <br>           
                <div class="mt-0 mb-2">
                    <span  role="alert" class="block mt-5   text-danger" id="error_price"></span>
                </div>
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_service p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
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
          <button class=" delete_service p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
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
                        $('#price, #name' ).html("");
                        // $('#price, #name' ).addClass('alert alert-danger');
                        $.each(response.errors.servicename, function (key, err_values){
                            $('#name').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.price, function (key, err_values){
                            $('#price').append('<span>'+err_values+'</span>');
                        })
                    }else{
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('success');
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
               $('#edit_servicename').val(response.service[0].servicename);
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

                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('update successfully');
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
                       
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('deleted successfully');
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                        $('.table').load(location.href+' .table');
        }
    });
        });


});
</script>

@endsection