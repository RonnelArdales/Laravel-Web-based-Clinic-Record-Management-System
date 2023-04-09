@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#addtocart" type="button" role="tab" aria-controls="home" aria-selected="true">Add to cart</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab" aria-controls="profile" aria-selected="false">BIlling</button>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">

            {{--Show Add to cart tab--}}
            <div class="tab-pane fade show active" id="addtocart" role="tabpanel" aria-labelledby="home-tab">
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
                        
                            <div hidden>
                                <label for="" style="text-align:right">billing no.</label><br><input type="text" style="background-color:transparent; text-align:center; width: 100px; " readonly id="getid">
                            </div>
                            <form method="post" class="row" id="store_addtocart">
                        
                            <input class="col-6" type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="billingno" readonly id="getbillingno">

                            <input type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="appointment" readonly id="appointmentno">

                
                            <div class="col-md-6">
                                <label for="">User ID:</label>
                                <input type="text" style="width: 400px; " id="userid" name="userid">
                                <button type="button" style="width: 50px" class="patient" id="patient">....</button>
                            
                                <label for="">Fullname:</label>
                                <input type="text" style="width: 400px" id="fullname" name="fullname">
                                
                                <label for="">Consultation Date:</label>
                                <input type="text" style="width: 400px" id="consultation" name="consultation">
                                </div>

                            <div class="col-md-6">
                            <label for="">service code</label> 
                            <input type="text" style="width: 400px" id="servicecode" name="servicecode">
                            <button type="button" style="width: 50px"  class="service" id="users">...</button>

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
                        <div>
                            {!! $addtocarts->links() !!}
                        </div>
                        </div>
                    
                    </div>
                    
                        <div id="subtotal" class="subtotal d-flex justify-content-end" style="margin-bottom:20px">
                            <label for="">Sub-total</label>
                            <input type="text" id="subtotal_value" readonly value="₱ {{number_format("$sum",2)}}" >
                            <button type="button" style="width: 200px; margin-left:10px"  class="proceedpayment" >Proceed to payment</button>
                    </div>
                
                </div>
            </div>
            <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="profile-tab">...</div>
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

                {{--------------- View service ---------------------}}

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

                                <input type="text" style="background-color:transparent; text-align:center; " hidden name="billingno" readonly id="getbillingno">

                                <input type="text" style="background-color:transparent; text-align:center; width: 100px; " hidden name="appointment" readonly id="appointmentno">

                                <label for=""><b>Userid: </b></label>
                                <input type="text" class="view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400"  id="payment_userid"  name="userid"><br>

                                <label for=""><b>Fullname:</b></label>
                                <input type="text" style="width: px" class="view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="payment_fullname" name="fullname"><br>

                                <label for=""><b>Consultation date: </b></label>
                                <input type="text" style="width: px" class="view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="payment_consultation" name="consultation"><br>

                                <label for=""><b>Service total: </b></label>
                                <input type="text" style="width: px" class="view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="payment_servicesubtotal" name="servicesubtotal"><br>

                                <label for=""><b>Doctor's fee: </b> </label>
                                <div class="currency-wrap">
                                    <span class="currency-code">₱</span>
                                    <input readonly type="number" class="text-currency view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" value="{{number_format("600",2)}}" id="doctorfee" name="doctorfee"/>
                                </div>

                                <label for=""><b>sub-total: </b></label>
                                <input type="text" style="width: px" class="view1 bg-white rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" id="payment_subtotal" name="subtotal"><br>
                                
                                <div class="d-flex bd-highlight">
                                    <label for=""> <b>Discount: </b> </label>
                                    <input type="text" id="discount_name" hidden>
                                    <select name="discount" id="payment_discount" class="payment_discount" style="height:30px">
                                        <option value="">--select--</option>
                                        @foreach ($discounts as $discount)
                                        <option value="{{$discount->discountcode}}">{{$discount->discountname}}</option>
                                        @endforeach
                                    </select> 
                                   
                                </div>

                                <label for=""><b>Total: </b> </label>
                           
                                <input type="text" readonly id="total_price" name="total_price"><br> 
                                <input type="text" id="totalprice_nosymbol" name="totalprice_nosymbol" hidden>                               
                                
                                <label for=""><b>Mode of payment:</b> </label>
                                <select name="mode_payment" id="mode_payment">
                                    <option value="">--select--</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Gcash">Gcash</option>
                                </select><br>
                                <div id="cash">
                                    <label for=""><b>payment:</b></label>
                                         <div class="currency-wrap">
                                            <span class="currency-code">₱</span>
                                            <input type="number" class="text-currency" id="payment_cash" placeholder="0.00" class="payment_cash" name="payment_cash" value=""/>
                                        </div>
                                  
                                    <label for=""><b>change:</b></label>

                                    <div class="currency-wrap">
                                        <span class="currency-code">₱</span>
                                        <input type="text" class="text-currency" placeholder="0.00" readonly id="change" name="change" />
                                    </div>
                                   
                                </div>
                              <div id="gcash" style="display:none">
                                <label for=""><b>Reference no:</b></label>
                                <input type="text" style="width:  px" id="reference_no" name="reference_no"><br>
                              </div>

                        </div>
                        <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%" >
                            <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="add_payment p-2 w-30 bg-[#829460]  mt-7 rounded" >Pay</button>
                        </form>
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
 
    $("#payment_cash").on('change', function(e){
        e.preventDefault();
            this.value = parseFloat(this.value).toFixed(2);
    });

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

        //---------------------Show payment modal---------------------//
        $(document).on('click', '.proceedpayment', function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/billing/addtocart/getdata/",
                datatype: "json",
                success: function(response){ 
                
                if(response.status == 400){
                    $('#message-error').html('');
                $('#message-error').text(response.message);
                            $(".error").show();
                            setTimeout(function() {
                                $(".error").fadeOut(500);
                            }, 2000);
                }else{
                            let userid = $('#userid').val();
                            let fullname = $('#fullname').val();
                            let consultation_date = $('#consultation').val();
                            let service_subtotal = $('#subtotal_value').val();
                            let doctor_fee = $('#doctorfee').val();
                            // let replace_doctor_fee = doctor_fee.replaceAll("₱" , " ")
                            let replace_service_subtotal = service_subtotal.replace(/[^a-z0-9. ]/gi, '');
                            let subtotal = parseInt(replace_service_subtotal, 10) + parseInt(doctor_fee);
                            let number = Number(parseFloat(subtotal).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});
                           
                            console.log(subtotal);
                           
                           
                                $('#totalprice_nosymbol').val(subtotal);
                                $('#payment_userid').val(userid);
                                $('#payment_fullname').val(fullname);
                                $('#payment_consultation').val(consultation_date);
                                $('#payment_servicesubtotal').val(service_subtotal);
                                $('#payment_subtotal').val('₱ '+subtotal.toFixed(2));
                                $('#total_price').val('₱ '+ number);
                                $('#payment').modal('show');
                }
                }
            });        
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
                    $('#servicecode').val(response.service.servicecode);
                  $('#servicename').val(response.service.servicename);
                  $('#price').val(response.service.price);
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
        $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('addtocart=')[1]
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
                url: "/admin/billing/pagination/paginate-data?addtocart="+page , 
                datatype: "json",
                success: function(response){ 
                $('.data-table').html(response);
        }
    });
        }

        $('#mode_payment').on('change', function(e){
            var payment = $(this).val();

            if(payment == "Gcash"){
                $('#cash').hide();
                $('#gcash').show();
            }else{
                $('#cash').show();
                $('#gcash').hide();
            }
        });

        $('#payment_discount').on('change', function(e){
            e.preventDefault();
            var discount = $(this).val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET", 
                url: "/admin/billing/getdiscount/"+discount , 
                datatype: "json",
                success: function(response){ 
                    if(discount == ""){
                       var subtotal = $('#payment_subtotal').val();
                        
                        $('#total_price').html("");
                        $('#total_price').val(subtotal);
                //   $('#total_price').val('₱ '+ number_total);
                    }else{
                        let total_price = $('#totalprice_nosymbol').val();
                  var divide = response.discount.percentage;
                  let discount = (divide/100);
                  let total = total_price - (total_price * discount)
                  let number_total = Number(parseFloat(total).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});
                  const cars = [total_price, discount, total];
                  $('#change').val("");
                  $('#payment_cash').val("");
                  $('#total_price').html("");
                  $('#total_price').val('₱ '+ number_total);

                $('#discount_name').val(response.discount.discountname);
                    }
             
                
        }
    }); 
        });

        $('#payment_cash').on('keyup', function(e){
          e.preventDefault();
          let total = $('#total_price').val();
          let payment = $('#payment_cash').val();
          let replace_total = total.replace(/[^a-z0-9. ]/gi, '');
          let change =  parseInt(payment) - parseInt(replace_total, 10);
          let change_replace =Number(parseFloat(change).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});

   
          console.log(payment);
          if(parseFloat(payment) < parseFloat(replace_total)){
            // console.log('werwe');
            console.log('payment is lower than total');
                $('#change').val('');
            }else if(payment == ""){
                console.log('null inputs')
                $('#change').val('');
            }else{
                // alert('higher');
                  console.log('payment is greater than total');
                            $('#change').val(change_replace);
            }

        
        });
});
</script>

@endsection
