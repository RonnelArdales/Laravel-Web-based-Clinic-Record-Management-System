@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
        <div class="col-md-8 col-md-offset-5">
            <h1>Transaction</h1>
           </div>
     
           <div id="success"></div>
     
        <div class="card">
            <div class="card-body" style="height:70vh ">
                <div class="d-flex bd-highlight ">
                    <div class="me-auto bd-highlight"><form action="/admin/reports/print_user" method="get" style="margin-bottom: 20px">
                        <label for="">full name</label>
                        <input type="text" value="" name="searchname" id="searchname">
                        <label style="margin-left: 30px" for="">from</label>
                        <input type="date" value="" name="from" id="from">
                        <label for="">to</label>
                        <input type="date" value="" name="to" id="to">
                       </form>
                    </div>
                    <div class="mb-2 bd-highlight"><button type="button" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
                        create
                      </button></div>
                  </div>
     
        <table  class=" table transaction table-bordered table-striped">
            <thead>
                <tr>
                    <th>Transaction no</th>
                    <th>Transaction date</th>
                    <th>userid</th>
                    <th>fullname</th>
                    <th>consultation date</th>
                    <th>file</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody >
                @if (count($transactions)> 0 )
                @foreach ($transactions as $transaction)
                <tr class="overflow-auto">
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->transaction_date}}</td>
                    <td>{{$transaction->user_id}}</td>
                    <td>{{$transaction->fullname}}</td>
                    <td>{{$transaction->consultation_date}}</td>
                    <td>{{$transaction->file}}</td>
                    <td>
                    <button type="button" value="{{$transaction->id}}" class="view btn btn-primary btn-sm">View</button>
                    <button type="button" value="{{$transaction->id}}" class="edit btn btn-primary btn-sm">Edit</button>
                    <button type="button" value="{{$transaction->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:300px ">No Transaction Found</td>
                  </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

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
                    <form method="POST" id="store_data" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <label for="">userid</label><br>
                    <input type="text" style="width: 310px" id="userid" name="userid">
                    <button style="width: 150px" class="patient" type="button" id="patient">show appointment</button><br>
                    <label for="">fullname</label><br>
                    <input type="text" style="width: 450px" id="fullname" name="fullname">
                    <label for="">Consultation date</label>
                    <input type="text" style="width: 450px" id="consultation" name="consultation">
                    <label for="">upload pdf</label><br>
                    <input type="file" style="width: 450px" id="pdf" name="pdf"><br>
                    <label for="">Password</label>
                    <input type="password" style="width: 450px" id="password" name="password">
                    <label for="">Confirm password</label>
                    <input type="password" style="width: 450px" id="password_confirmation" name="password_confirmation">
   
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" add_transaction p-2 w-30 bg-[#829460]  mt-7 rounded" >Submit</button>
        </form>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-5 pt-6  ">
                <div class=" columns-1 sm:columns-2">
                    <form method="POST" id="update_data" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <label for="">userid</label><br>
                    <input type="text" style="width: 310px" id="edit_transno" name="transno">
                    <input type="text" style="width: 450px" id="edit_transactiondate" name="transactiondate">
                    <input type="text" style="width: 310px" id="edit_userid" name="userid">
                    <button style="width: 150px" class="patient" type="button" id="patient">show appointment</button><br>
                    <label for="">fullname</label><br>
                    <input type="text" style="width: 450px" id="edit_fullname" name="fullname">
                    <label for="">Consultation date</label>
                    <input type="text" style="width: 450px" id="edit_consultation" name="consultation">
                    <label for="">upload pdf</label><br>
                    <input type="file" style="width: 450px" id="edit_pdf" name="pdf"><br>
                    <label for="">Password</label>
                    <input type="password" style="width: 450px" id="edit_password" name="password">
                    <label for="">Confirm password</label>
                    <input type="password" style="width: 450px" id="edit_password_confirmation" name="password_confirmation">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class=" update_transaction p-2 w-30 bg-[#829460]  mt-7 rounded" >Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
{{------------------------View transaction-------------------------------}}
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
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 fw-bold" >Transaction no.</label>  
            <input class="view1 mname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="view_transno" readonly  type="text">
            <br>
            <label class=" rounded bg-[#EDDBC0] ml-3 fw-bold">Transaction date:</label>
            <input class=" view1 mname bg-white rounded  text-gray-700 focus:outline-none border-b-4 border-gray-400" id="view_transactiondate"  readonly type="text">
           <br>
            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Fullname</label>
            <input class="view1 lname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_fullname" readonly  type="text"> 
            <br>
            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >Consultation date:</label>
            <input class="view1 lname bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_password" readonly  type="text"> 
    
            <br>
            <label class="mb-0 rounded bg-[#EDDBC0]  ml-3 fw-bold" >file:</label>
            <input class="view1 address bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="view_file" readonly  type="text"  > 
            <br>
            <div id="fileview">

            </div>
  
    </div>
    </div>
        <div class="modal-footer">
          <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>

{{--------------- View Appointments ---------------------}}

                <div class="modal fade" id="viewappointments">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content viewbody">
                
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Patients</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body ">
                        <div class="mb-5 pt-6  ">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Appointment id</th>
                                    <th>USer id</th>
                                    <th>Fullname</th>
                                    <th>date</th>
                                    <th>Time</th>                                
                                </tr>
                            </thead>
                            <tbody >
                            @if (count($appointments) > 0)
                            @foreach ($appointments as $appointment)
                            <tr class="overflow-auto" >
                                <td>{{$appointment->id}}</td>
                                <td>{{$appointment->user_id}}</td>
                                <td>{{$appointment->fullname}}</td>
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->time}}</td>
                                <td>
                                    <button class="selectappointment" id="selectappointment" value="{{$appointment->id}}">Select </button>
                                </td>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" style="text-align: center;">no user Found</td>
                    
                            </tr>
                            @endif
                            
                            </tbody>
                            </table>
                
                    </div>
                    <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%" >
                        <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                
                    </div>
                    </div>
                </div>
    </div>

    {{----------delete modal--------------}}
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
                        <input type="text" id="transactionid">
                    <h6>Do you want to delete this data?</h6>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class=" delete_transaction p-2 w-30 bg-[#829460]  mt-7 rounded" >delete</button>
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

      deleteall();
        
        function deleteall () {
            if(window.location.href) {
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
                  // alert('deleted successfully');
                }
            });
                
            }
        }

        $(document).on('click', '.patient', function(e){
          $('#viewappointments').modal('show');
        })

        $(document).on('click', '.service', function(e){
          $('#viewservice').modal('show');
        })

        //--------------- select appointment ------------------//

        $(document).on('click', '.selectappointment', function(e){
            e.preventDefault();
            var user = $(this).val();

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET",   
                url: "/admin/transaction/getuser/"+ user, 
                datatype: "json",
                success: function(response){ //return galing sa function sa controller
                    let datetime = ''.concat(response.users[0].date, ' ', response.users[0].time)
                    $('#consultation, #userid, #fullname, #appointment').html("");
                    $('#userid,#edit_userid ').val(response.users[0].user_id);
                    $('#fullname').val(response.users[0].fullname);
                    $('#consultation').val( datetime);
                    $('#viewappointments').modal('hide');
                }
            });
                });

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
                url: "/admin/transaction/store/", 
                data: formData,
                datatype: "json",
                contentType:false,
                cache:false,
                processData: false,
                success: function(response){ 
                    $('#consultation, #userid, #fullname, #appointment').html("");
                    $('#success' ).html("");
                $('#success' ).addClass('alert alert-success');
                $('#success').text(response.status);
                  $('#create').modal('hide');
                  $('.transaction').load(location.href+' .transaction');
                    console.log(response);
                }
            });
                });

            //---------show data in edit form------------------//

            $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var transid = $(this).val();
            $('#edit').modal('show');
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/transaction/edit/"+ transid,  
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
                    console.log(response);
                $('#edit_transno').val(transid);
                $('#edit_userid').val(response.transaction.user_id);
               $('#edit_fullname').val(response.transaction.fullname);
               $('#edit_transactiondate').val(response.transaction.transaction_date);
               $('#edit_consultation').val(response.transaction.consultation_date);
            
        }
    });
        });
        //---------------------view ----------------------------//
        $(document).on('click', '.view', function(e){
            e.preventDefault();
            var transno = $(this).val();
           $('#view').modal('show');
           $.ajax({
                type: "GET",   
                url: "/admin/transaction/edit/"+ transno, 
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
                  console.log(response)
                  $('#fileview').html("");
               $('#view_transno').val(response.transaction.id);
               $('#view_transactiondate').val(response.transaction.transaction_date);
               $('#view_fullname').val(response.transaction.fullname);
               $('#view_userid').val(response.transaction.user_id);
               $('#view_consultation').val(response.transaction.consultation_date);
               $('#view_file').val(response.transaction.file);
               $('#fileview').append('  <a href="/admin/transaction/download/'+response.transaction.id+'">download</a>\
               <a href="/admin/transaction/view/'+response.transaction.id+'">view</a>\
               ');
              
                    
        }
    });
        });

        //-------------------update-----------------------------//
        $('#update_data').on('submit', function(e){
            e.preventDefault();
            var transaction = $('#edit_transno').val();
            let formData = new FormData(this);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'POST', 
                url: "/admin/transaction/update/"+transaction,
                data: formData,
                datatype: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){ 
                    console.log(response);
                    // if(response.status == 400){
                    //     $('#error_servicename, #error_price' ).html("");
                    //     $.each(response.errors.servicename, function (key, err_values){
                    //     $('#error_servicename').append('<span>'+err_values+'</span>');
                    //     });
                    //     $.each(response.errors.price, function (key, err_values){
                    //     $('#error_price').append('<span>'+err_values+'</span>');
                    //     });

                    // }else{                  

                    //     $('#success' ).html("");
                    //     $('#success' ).addClass('alert alert-success');
                    //     $('#success').text('update successfully');
                        $('#edit').modal('hide');
                        $('#edit').find('input').val("");
                        $('.transaction').load(location.href+' .transaction');
                    // }
        }
    });
        });

        //-------------delete transaction----------------------//
        
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var transaction = $(this).val();
            $('#delete').modal('show');
            $('#transactionid').val(transaction);
        });

        $(document).on('click', '.delete_transaction', function(e){
            e.preventDefault();
            var transaction = $('#transactionid').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: 'DELETE', 
                url: "/admin/transaction/delete/"+ transaction,
                data: transaction,
                datatype: "json",
                success: function(response){ 
                       console.log(response);
                        $('#success' ).html("");
                        $('#success' ).addClass('alert alert-success');
                        $('#success').text('deleted successfully');
                        $('#delete').modal('hide');
                        $('#delete').find('input').val("");
                        $('.transaction').load(location.href+' .transaction');
        }
    });
        });


        
});
</script>

@endsection
