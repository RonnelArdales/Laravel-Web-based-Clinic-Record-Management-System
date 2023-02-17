@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
    
 <h1>discount page  <button type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
    create
  </button></h1>


</div>   
  

<div id="success"></div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>discount code</th>
                    <th>discount name</th>
                    <th>percent</th>
                    <th>Actions</th>
                 
                </tr>
            </thead>
            <tbody >
              @if (count($discounts)> 0 )
              @foreach ($discounts as $discount)
              <tr class="overflow-auto">
                  <td>{{$discount->discountcode}}</td>
                  <td>{{$discount->discountname}}</td>
                  <td>{{$discount->percentage}}</td>
                  <td>
                  <button type="button" value="{{$discount->discountcode}}" class="edit btn btn-primary btn-sm">Edit</button>
                  <button type="button" value="{{$discount->discountcode}}" class="delete btn  btn-danger btn-sm">delete</button></td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" style="text-align: center;">No Discount Found</td>
          
              </tr>
              @endif
               
            </tbody>
        </table>
    </div>
</div>
  

{{-- create user modal --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create discount</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Discount name</label>
                <input class=" discountname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="name"></span>
                </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Percentage</label>
                <input class="percentage bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="text">
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5 pb-4 text-danger" id="percent"></span>
              </div>
             
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" add_discount p-2 w-30 bg-[#829460]  mt-7 rounded" >Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

  {{-- edit modal --}}
  <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal edit</h1>
          <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <input type="hidden" id="discountcode">
                <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Discount name</label>
                <input class="discountname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_discountname" type="text"> 
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5   text-danger" id="error_discountname"></span>
              </div>
                <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Percentage</label>
                <input class="percentage bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" id="edit_percentage" type="text">
                <br>
                <div class="mt-0 mb-2">
                  <span  role="alert" class="block mt-5   text-danger" id="error_percent"></span>
              </div> 
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_discount p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button>
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
                    <input type="hidden" id="discountcode">
                <h6>Do you want to delete this data?</h6>
         
              {{-- </form> --}}
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" delete_discount p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
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

        $(".modal").on("hidden.bs.modal", function(){
            $('#create, #edit, #delete').find('input').val("");
            $('#name, #percent, #error_discountname, #error_percent').html("");
        });

        $(document).on('click', '.add_discount', function(e){
            e.preventDefault();
            // console.log('hello');
            var data ={
                'discountname' : $('.discountname').val(),
                'percentage': $('.percentage').val(), 
            }
            //always add csrf token
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            $.ajax({
                type: "POST",
                url: "/secretary/discount/creatediscount/store",
                data: data,
                datatype: "json",
                success: function(response){
                    console.log(response);
                    if(response.status == 400){
                        $('#percent, #name' ).html("");
                        $.each(response.errors.discountname, function (key, err_values){
                          $('#name').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.percentage, function (key, err_values){
                            $('#percent').append('<span>'+err_values+'</span>');
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
            var discode = $(this).val();
           $('#edit').modal('show');
           $.ajax({
                type: "GET", 
                url: "/secretary/discount/edit/"+ discode,  
                datatype: "json",
                success: function(response){ 
                    if(response.status == 400){
                    $('#percent, #name' ).html("");
                    $('#percent, #name' ).addClass('alert alert-danger');
                    $('#message' ).text(response.messages);
                    }else{
               $('#edit_discountname').val(response.discount[0].discountname);
               $('#edit_percentage').val(response.discount[0].percentage);
               $('#discountcode').val(discode);
                    }
        }
    });
        });
        $(document).on('click', '.update_discount', function(e){
            e.preventDefault();
            var discode = $('#discountcode').val();
            var data ={
                _method: 'PUT',
                'discountname' : $('#edit_discountname').val(),
                'percentage': $('#edit_percentage').val(), 
            }
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          
           $.ajax({
                type: 'POST', 
                url: "/secretary/discount/update/"+ discode,
                data: data,
                datatype: "json",
                success: function(response){ 
                    // console.log(data);
                    if(response.status == 400){
                      $('#error_discountname, #error_percent' ).html("");
                        // $('#update_errform' ).addClass('alert alert-danger');
                        $.each(response.errors.discountname, function (key, err_values){
                        $('#error_discountname').append('<span>'+err_values+'</span>');
                        });
                        $.each(response.errors.percentage, function (key, err_values){
                        $('#error_percent').append('<span>'+err_values+'</span>');
                        })

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

 //show delete modal
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var discode = $(this).val();
            $('#delete').modal('show');
            $('#discountcode').val(discode);
        });
        //delete discout
        $(document).on('click', '.delete_discount', function(e){
            e.preventDefault();
            var discode = $('#discountcode').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/secretary/discount/delete/"+ discode,
                data: discode,
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


