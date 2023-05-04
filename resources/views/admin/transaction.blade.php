@extends('layouts.admin_navigation')
@section('title', 'Transaction')
@section('content')
<style>
  label{
      font-family: 'Poppins';
  }
      .addtocart_input, .service_input{
      background: #D0B894;
      border-radius: 10px;
      border:none;
      margin-bottom: 1%;
      text-align: left; 
      padding-left:30px;
  }

</style>
  <div class="row m-3">
          {{--Show Add to cart tab--}}

          <div class="me-auto col-md-8 col-md-offset-5">

            <h1> <b>TRANSACTION</b> </h1>
            </div>
                      <div class="alert success alert-success" role="alert" style="width:250px; right:25px; display:none;  position:fixed; z-index:9999">
                          <p id="message-success"></p> 
                      </div>
                      <div class="alert error alert-danger" role="alert" style="width:250px; right:25px; display:none;  position:fixed; z-index:9999">
                          <p id="message-error"></p> 
                      </div>
                      <div class="loading" style="width:250px; right:25px; display:none; position:fixed">
                          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>
                          <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div>
                      </div>
                      
                          <form class="row" >
                            <div hidden>
                                <label for="" style="text-align:right">billing no.</label><br>
                                <input type="text" class="text-center" style="background-color:transparent; text-align:center; width: 100px; " readonly id="getid">
                            </div>
                          <div class="col-md-6">
                            <div  >
                                <label style="width:90px" for="">Trans no:</label>
                                <input type="text" style="width: 470px;" class="addtocart_input" name="billingno"  id="getbillingno" readonly>
                            </div>

                            <div style="margin-bottom: 3px; margin-top: 3px">
                                <label  style="width:90px"  for="">User ID:</label>
                                <input type="text" style="width: 425px;" class="addtocart_input" id="userid" name="userid" readonly>
                                <button class="getpatient btn btn-outline-success" type="button" style="border: 1px solid #829460;  "><img src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" style="height: 15px ;
                                    width: 15px ;" id="appointment" alt="" ></button>
                                  <br>
                            </div>

                            <div>
                                <label  style="width:90px"  style="margin-top: 5px" for="">Fullname:</label>
                                <input type="text" style="width: 470px;" class="addtocart_input" id="fullname" name="fullname" readonly>
                            </div>

                              <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_fullname"></span>
                            </div>
                        
                          </div>

                          <div  class="col-md-6">

                        <div>
                            <label style="width:80px" for="">Service: </label>
                            <input type="text" hidden class="addtocart_input servicename" id="servicename" name="servicename" >
                            <select style="width:470px; height:28px" class="service_input getservice"  name="service"  id="getservice">
                                <option style="text-align:center" value="">-- select --</option>
                                @foreach ($services as $service)
                                <option value="{{$service->servicecode}}">{{$service->services }}</option>
                                @endforeach
                            </select>
                            <br>
                            <div class="">
                              <span  role="alert" class="block mt-5   text-danger" id="error_service"></span>
                          </div>
                        </div>
                  
                        <div style="margin-top: 3px ">
                            <label style="width:80px" for="">Price: </label>
                            <input type="number" readonly style="width: 470px" class="addtocart_input price" id="price" name="price" >
                            <div class="mt-0 mb-2" >
                              <span  role="alert" class="block mt-5   text-danger" id="error_price"></span>
                          </div>
                        </div>
                  
                          <div class="float-end text-right d-flex justify-content-end" style="margin-bottom: 2%; margin-top:20px">
                              <button type="button" class="store_addtocart"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; margin-bottom:2%; " >Add to Cart</button>
                          </div>

                          </div>
                          </form>

                          <div class="card " style="background:#EDDBC0;border:none;" id="patient">
                              <div class="data-table" style="padding:0% ">
                                <div class="card-body" style="width:100%; min-height:50vh; display: flex; overflow-x: auto;  font-size: 15px; " >
                                  <table class="table  table-bordered table-striped "  style="background-color: white">
                                      <thead>
                                          <tr>
                                              <th>Patient ID</th>
                                              <th>Full Name</th>
                                              <th>Service code</th>
                                              <th>Service</th>
                                              <th>Price</th>
                                              <th>Action</th> 
                                          </tr>
                                      </thead>
                                        <tbody class="patient-error" >
                                              @if (count($addtocarts)> 0 )
                                              @foreach ($addtocarts as $addtocart)
                                              <tr class="overflow-auto">
                                                  <td> {{$addtocart->user_id}}</td>
                                                  <td>{{$addtocart->fullname}}</td>
                                                  <td>{{$addtocart->servicecode}}</td>
                                                  <td>{{$addtocart->service}}</td>
                                                  <td>{{$addtocart->price}}</td>
                                                  <td style="text-align: center;">
                                                  <button type="button" value="{{$addtocart->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
                                              </tr>
                                              @endforeach
                                              @else
                                              <tr>
                                                  <td colspan="9" style="text-align: center">No Service Found</td>
                                                </tr>
                                              @endif
                                          </tbody>
                                    </table>
                                  </div>
                                  <div class="row">
                                      <div style="margin-left:20px" class="col">
                                          {!! $addtocarts->links() !!}
                                       </div>
                                       <div id="subtotal" class="subtotal d-flex justify-content-end col " style="margin-bottom:15px; margin-right:20px; justify-content:center">
                                        <label for="" style="font-weight: 700;Padding-top:2%; font-size:15px;margin-right:10px; justify-content:center">Sub-Total:</label>
                                        {{-- <input type="text" id="subtotal_value" style="text-align: right;" readonly value="₱ {{number_format("$sum",2)}}" > --}}
                                        <div class="currency-wrap">
                                          <span class="currency-code">₱</span>
                                          <input readonly type="text" class="text-currency rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 " placeholder="0.00"  style="background: #D0B894; height:38px" value="{{number_format("$sum",2)}}" />
                                      </div>
                                        <button type="button"  class="saveaddtocart" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 180px;height: 40px; margin-left:1%; " >Save</button>
                                        </div>
                                  </div>
                                </div>
                             </div> 

            {{--------------- View patients ---------------------}}

            <div class="modal fade viewpatients " id="viewpatients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                  <div class="modal-content viewbody" style="background: #EDDBC0;">
              
                    <!-- Modal Header -->
                    <div class="modal-header" style="border-bottom-color: gray">
                      <h4 class="modal-title">Patients</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body " >
                      <div class="patient patient-remove overflow-auto container-fluid" style="height:420px" >
                        <table class="table table-bordered users table-striped" id="users"  style="background-color: white; width:100%" >
              
                          <thead>
                            <tr>
                                <th>Id</th>
                                <th>fullname</th>
                                <th>Gender</th>
                                <th>Age</th> 
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
                

  </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function (){

      get_maxid();

      function message_success(){
        setTimeout(function() {
                            $(".success").show();
                        }, 500);
      }


      var usertable = null;
  
  $('.viewpatients').on('shown.bs.modal', function() {
    if (!usertable) {
              usertable =  $('#users').DataTable({
                "ajax": "/admin/appointment/show_user",
                processing: true,
                serverSide: true,
                dom: 'frtp',
                pageLength: 6,
                responsive: true,
                "columns": [
                  {data: 'id', name: 'id' , orderable: false, searchable: false},
                          {data: 'fullname', name: 'fullname' , orderable: false},
                          {data: 'gender', name: 'gender' , orderable: false},
                          {data: 'age', name: 'age' , orderable: false},
                          { width: "10%",data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
          }else{
          
      usertable.ajax.reload();
 
          }
          });

          $('.viewpatients').on('hidden.bs.modal', function() {
    if (usertable) {
      usertable.destroy();
      usertable = null;
    }
  });

        // ------ get max biling no --------------//
        function get_maxid(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/transaction/getid",
                datatype: "json",
                success: function(response){ 
                    console.log(response);
                $('#getid, #getbillingno').val(response.id);
                }
            });
        }
       //------------------ show patient modal -------------------//
        $(document).on('click', '.getpatient', function(e){
            e.preventDefault();
            $('#modal-status').val('show');
          $('#viewpatients').modal('show');
        })

        //------------------ Select patient info -------------------//
        $('#users').on('click', '.select', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "GET",   
                url: "/admin/appointment/getuser/"+ id, 
                    datatype: "json",
                    success: function(response){ //return galing sa function sa controller
                    $(' #userid, #fullname').html("");
                    $('#userid').val(response.users[0].id);
                    $('#fullname').val(response.fullname[0].fullname);
                    $('#viewpatients').modal('hide');
                }
            });
        });

        $(document).on('change', '.getservice', function(e){
            e.preventDefault();
            var id = $(this).val();

                    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(id.length > 0){
                $.ajax({
                type: "GET",   
                url: "/admin/appointment/get_appointment_service/"+id ,
                datatype: "json",
                success: function(response){ 
                    $('.price, .servicename').val("");
                    $('.servicename').val(response.service.services);
                    $('.price').val(response.service.price);
                }
            });
            }else{
                $('.price, .servicename').val("");
            }


        });

        
        //------------------ store to add to cart -------------------//
        $(document).on('click','.store_addtocart' ,function(e){
            e.preventDefault();
            var data ={
                'transno' : $('#getid').val(),
                'userid': $('#userid').val(),
                'fullname': $('#fullname').val(),
                'servicecode': $('#getservice').val(),
                'service': $('#servicename').val(),
                'price': $('#price').val(),
            }
            console.log(data);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "POST",   
                url: "/admin/transaction/addtocart/store", 
                data: data,
                datatype: "json",
                beforeSend: function(){
                    $(".loading").show();
                },
                complete: function(){
                    $(".loading").hide();
                },
                success: function(response){ 
                    $('#error_fullname, #error_service, #error_price' ).html("");
                        if(response.status == 200){     
                            $('#sub-total').val(response.subtotal);
                            $('#message').text(response.message);
                            $('.subtotal').load(location.href+' .subtotal');
                            $('.data-table').load(location.href+' .data-table');
                            $('#servicename').val("");
                            $('#getservice').val("");
                            $('#price').val("");
                            $(".success").show();
                            $('#message-success').text('Added Successfully');
                            setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 2000);
                        }else if(response.status == 401){
                    
                        $.each(response.errors.fullname, function (key, err_values){
                          $('#error_fullname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.servicecode, function (key, err_values){
                            $('#error_service').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.price, function (key, err_values){
                            $('#error_price').append('<span>'+err_values+'</span>');
                        })

                        }else{
                            $('#message-error').text(response.message);
                            $(".error").show();
                            setTimeout(function() {
                                $(".error").fadeOut(500);
                            }, 2000);
                        }
                        
                    }
                });
        });

        // ------------------- save to transaction table ----------------//
        $(document).on('click', '.saveaddtocart', function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",   
                url: "/admin/transaction/addtocart/billing_store", 
                    datatype: "json",
                    data: {transno : $('#getid').val() },
                    success: function(response){ 
                        if(response.status == "400"){

                            $('#message-error').text("");
                            $('#message-error').text("Please add service");
                            $(".error").show();
                            setTimeout(function() {
                                $(".error").fadeOut(500);
                            }, 2000);
                            
                        }else{

                            get_maxid();
                        $('.subtotal').load(location.href+' .subtotal');
                            $('.data-table').load(location.href+' .data-table');
                            $('#userid').val("");
                            $('#fullname').val("");
                            $('#servicename').val("");
                            $('#getservice').val("");
                            $('#price').val("");
                            $(".success").show();
                            $('#message-success').text('Saved Successfully');
                            setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 2000);
                        }
                 
                }
            });
          });




        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            id =  $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",   
                url: "/admin/transaction/delete/" + id, 
                    datatype: "json",
                    success: function(response){ //return galing sa function sa controller
                        $(".success").show();
                            $('#message-success').text(response.message);
                            setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 2000);
                        $('.subtotal').load(location.href+' .subtotal');
                        $('.data-table').load(location.href+' .data-table');
                        
                 
                }
            });

        })
        
});
</script>

@endsection
