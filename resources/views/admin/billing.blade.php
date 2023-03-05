@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
        <h4>Billing</h4>
        <div class="alert success alert-success" role="alert" style="width:250px; right:25px; display:none;  position:fixed">
            <p id="message"></p> 
          </div>
          <div class="alert error alert-danger" role="alert" style="width:250px; right:25px; display:none;  position:fixed">
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
         
            <div>
                <label for="" style="text-align:right">billing no.</label><br><input type="text" style="background-color:transparent; text-align:center; width: 100px; " readonly id="getid">
            </div>
            <form method="post" class="row" id="store_addtocart">
         

                <input class="col-6" type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="billingno" readonly id="getbillingno">
                <input type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="appointment" readonly id="appointmentno">

                <div class="col-md-6">
            <label for="">userid</label>
            <input type="text" style="width: 400px; " id="userid" name="userid"><button type="button" style="width: 50px" class="patient" id="patient">....</button>
           
            <label for="">fullname</label>
            <input type="text" style="width: 400px" id="fullname" name="fullname">
            

            <label for="">consultation date</label>
            <input type="text" style="width: 400px" id="consultation" name="consultation">
            </div>
            <div class="col-md-6">
            <label for="">service code</label> 
            <input type="text" style="width: 400px" id="servicecode" name="servicecode"><button type="button" style="width: 50px"  class="service" id="users">...</button>

            <label for="">service</label>
            <input type="text" style="width: 400px" id="servicename" name="service"><br>

            <label for="">price</label>
            <input type="text" style="width: 400px" id="price" name="price">
            </div>

            <div class="float-end text-right d-flex justify-content-end">
                <button type="submit"  style="width: 200px" >Add to cart</button>
            </div>
            </form>
        <div class="card" style="height:420px">
    <div class="card-body" >
        <div class="data-table">
        <table class="table addtocart table-bordered table-striped">
            <thead>
                <tr>
                    <th>Appointment no.</th>
                    <th>User id</th>
                    <th>Fullname</th>
                    <th>consultation date</th>
                    <th>service code</th>
                    <th>service</th>
                    <th>price</th>
                    <th>action</th> 
                </tr>
            </thead>
            <tbody >
                @if (count($addtocarts)> 0 )
                @foreach ($addtocarts as $addtocart)
                <tr class="overflow-auto">
                    <td>{{$addtocart->appointment_no}}</td>
                    <td>{{$addtocart->user_id}}</td>
                    <td>{{$addtocart->fullname}}</td>
                    <td>{{$addtocart->consultation_date}}</td>
                    <td>{{$addtocart->servicecode}}</td>
                    <td>{{$addtocart->service}}</td>
                    <td>{{$addtocart->price}}</td>
                    <td>
                    <button type="button" value="{{$addtocart->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                  </tr>
                @endif
            </tbody>
        </table>
        <div style="">
            {!! $addtocarts->links() !!}
         </div>
        </div>
    
    </div>
       
      
      
        <div id="subtotal" class="subtotal d-flex justify-content-end" style="margin-bottom:20px">
            <label for="">Sub-total</label>
            <input type="text" readonly value="₱ {{number_format("$sum",2)}}" >
            <button type="button" style="width: 200px; margin-left:10px"  class="proceedpayment" >Proceed to payment</button>
    </div>
 
</div>

{{--------------- View patients ---------------------}}

                <div class="modal fade" id="viewpatients">
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
                                    <button class="selectpatient" id="selectpatient" value="{{$appointment->id}}">Select </button>
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

                {{--------------- View patients ---------------------}}

                <div class="modal fade" id="viewservice">
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
                                    <th>Fullname</th>
                                    <th>date</th>
                                    <th>Time</th>                                
                                </tr>
                            </thead>
                            <tbody >
                            @if (count($services) > 0)
                            @foreach ($services as $service)
                            <tr class="overflow-auto" >
                                <td>{{$service->servicecode}}</td>
                                <td>{{$service->servicename}}</td>
                                <td>{{$service->price}}</td>
                                <td>
                                    <button class="selectservice" id="selectservice" value="{{$service->servicecode}}">Select </button>
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

                       {{--------------- PAyment view ---------------------}}

                       <div class="modal fade" id="payment">
                        <div class="modal-dialog">
                        <div class="modal-content viewbody">
                    
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Proceed to Payment</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body ">
                            <div class="mb-5 pt-6  ">
                                <form method="post" id="store_addtocart">
                                    <input type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="billingno" readonly id="getbillingno">
                                    <input type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="appointment" readonly id="appointmentno">
                                <label for="">userid</label>
                                <input type="text" style="width: 400px; " id="userid" name="userid"><button type="button" style="width: 50px" class="patient" id="patient">....</button><br>
                                <label for="">fullname</label>
                                <input type="text" style="width: 400px" id="fullname" name="fullname"><br>
                                <label for="">consultation date</label>
                                <input type="text" style="width: 400px" id="consultation" name="consultation"><br>
                                <label for="">service code</label> 
                                <input type="text" style="width: 400px" id="servicecode" name="servicecode"><button type="button" style="width: 200px"  class="service" id="users">services</button><br>
                                <label for="">service</label>
                                <input type="text" style="width: 400px" id="servicename" name="service"><br>
                                <label for="">price</label>
                                <input type="text" style="width: 400px" id="price" name="price"><br>
                                <button type="submit"  style="width: 200px" >submit</button>
                                </form>
                    
                        </div>
                        <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%" >
                            <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        // deleteall();
        // message_show()
      function message_success(){
        setTimeout(function() {
                            $(".success").show();
                        }, 500);
      }

       
        
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

    function delete_table_addtocart(){
        
    }

        function get_maxid(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/billing/getid/",
                datatype: "json",
                success: function(response){ 
                $('#getid, #getbillingno ').val(response.id);
                }
            });
        }

        $(document).on('click', '.patient', function(e){
          $('#viewpatients').modal('show');
        })

        $(document).on('click', '.service', function(e){
          $('#viewservice').modal('show');
        })
        $(document).on('click', '.proceedpayment', function(e){
            console.log('hello');
          $('#payment').modal('show');
        })

        $(document).on('click', '.selectpatient', function(e){
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
                    $('#userid').val(response.users[0].user_id);
                    $('#fullname').val(response.users[0].fullname);
                    $('#appointmentno').val( response.users[0].id);
                    $('#consultation').val(datetime);
                    //   $('#fullname').val(response.fullname[0].fullname);
                    //   $('#email').val(response.users[0].email);
                    //   $('#mobile_number').val(response.users[0].mobileno);
                    $('#viewpatients').modal('hide');
                    console.log(datetime);
                }
            });
        });

        $(document).on('click', '.selectservice', function(e){
            e.preventDefault();
            var service = $(this).val();
        
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET",   
                url: "/admin/billing/getservice/"+ service, 
                datatype: "json",
                success: function(response){ 
                    $('#servicecode').val(response.service[0].servicecode);
                  $('#servicename').val(response.service[0].servicename);
                  $('#price').val(response.service[0].price);
                  $('#viewservice').modal('hide');
        }
    });
        });
        
        
        $('#store_addtocart').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "POST",   
                url: "/admin/billing/addtocart/store", 
                data: formData,
                datatype: "json",
                contentType:false,
                cache:false,
                processData: false,
                beforeSend: function(){
                    $(".loading").show();
                },
                complete: function(){
                    $(".loading").hide();
                },
                success: function(response){ 
                    
                        if(response.status == 200){     
                            console.log(response);
                          
                            $('#sub-total').val(response.subtotal);
                            $('#message').text(response.message);
                            $('.subtotal').load(location.href+' .subtotal');
                            $('.data-table').load(location.href+' .data-table');
                            $('#servicecode').val("");
                            $('#servicename').val("");
                            $('#price').val("");
                            message_success();
                            setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 2000);
                        }else if(response.status == 400){
                            $('#message-error').text(response.message);
                            $(".error").show();
                            setTimeout(function() {
                                $(".error").fadeOut(500);
                            }, 2000);
                        }
                        
                    }
                });
        });

        //pagination
        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            addtocart(page);
        });

        function addtocart(page){
            let data = page;
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET", 
                data: data,  
                url: "/admin/billing/pagination/paginate-data?page="+page , 
                datatype: "json",
                success: function(response){ 
                $('.data-table').html(response);
        }
    });
        }


});
</script>

@endsection
