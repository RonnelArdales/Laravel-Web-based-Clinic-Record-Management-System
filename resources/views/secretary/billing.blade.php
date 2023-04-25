@extends('layouts.admin_navigation')
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
        text-align: center; 
    }
</style>
    <div class="row m-3">

      

{{----------- Billing tab ---------------}}

                <div class="col-md-8 col-md-offset-5">
                    <h2>Billing</h2>
                </div>


                        <div class="card"  style="background:#EDDBC0;border:none; " >
                            <div class="table-appointment" style="padding: 0%" >
                              <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                        <table class="table  table-bordered table-striped " id="billingtable" style="background-color: white; width:100%">
                  
                            <thead>
                                <tr>
                                    <th>Trans no.</th>
                                    <th >User ID</th>
                                    <th>Fullname</th>
                                    <th>Sub-total</th>
                                    <th>Status</th>
                                    <th style="width: 230px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="patient-error" >
                     
                            </tbody>
                          </table>
                        </div>

             
                      </div>
                   </div>
     


                       {{-- ------------- PAyment view ---------------------}}

                       <div class="modal fade" id="payment">
                        <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content viewbody " style="background: #EDDBC0;">
                    
                            <!-- Modal Header -->
                            <div class="modal-header" style="border-bottom-color: gray">
                            <h4 class="modal-title fs-5" style="font-weight:700;">Proceed to Payment</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body ">
                            <div class="mb-5 pt-6  ">
                      

                                <input type="text" style="background-color:transparent; text-align:center; " name="billingno" hidden readonly id="getbillingno">
                                <label for=""><b>Billing no: </b></label>
                                <input type="text" class="view1 rounded "  id="payment_billingno"  name="userid"><br>

                                <label style="margin-top: 10px" for=""><b>Userid: </b></label>
                                <input type="text" class="view1 rounded"  id="payment_userid"  name="userid"><br>

                                <label style="margin-top: 10px" for=""><b>Fullname:</b></label>
                                <input type="text" style="width: px" class="view1 rounded" id="payment_fullname" name="fullname"><br>


                                <label style="margin-top: 10px" for=""><b>sub-total: </b></label>
                                <input type="text" style="width: px" class="view1 rounded" id="payment_subtotal" name="subtotal"><br>
                                <input hidden type="text" id="compute_subtotal">
                                 
                                <div class="d-flex bd-highlight" style="margin-top: 10px">
                                    <label for=""> <b>Discount: </b> </label>
                                    <input type="text" id="discount_name" hidden>
                                    <input type="text" id="discount_price" hidden>
                                    <select name="discount" id="payment_discount" class="payment_discount rounded" style="height:30px; width:100px">
                                        <option value="">--select--</option>
                                        <option value="None">none</option>  
                                        @foreach ($discounts as $discount)
                                        <option value="{{$discount->discountcode}}">{{$discount->discountname}}</option>
                                        @endforeach
                                    </select> 
                                </div>

                                <label style="margin-top: 10px" for=""><b>Total: </b> </label>
                           
                                <input type="text" readonly id="total_price" name="total_price"><br> 
                                <input hidden type="text" id="totalprice_nosymbol" name="totalprice_nosymbol" >
                                {{-- <label style="margin-top: 10px" for=""><b>Status: </b> </label>
                                <input type="text" class="view1 rounded" id="status"><br>                                --}}
                                 
                                <label style="margin-top: 10px" for=""><b>Mode of payment:</b> </label>
                                <select name="mode_payment" id="mode_payment">
                                    <option value="">--select--</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Gcash">Gcash</option>
                                </select><br>
                                <div id="cash" style="display: none; margin-top: 10px">
                                    <label for=""><b>payment:</b></label>
                                         <div class="currency-wrap-payment">
                                            <span class="currency-code-payment">₱</span>
                                            <input type="number" class="text-currency-payment" id="payment_cash" placeholder="0.00" class="payment_cash" name="payment_cash" value=""/>
                                        </div>
                                  
                                    <label for=""><b>change:</b></label>

                                    <div class="currency-wrap-payment">
                                        <span class="currency-code-payment">₱</span>
                                        <input type="text" class="text-currency-payment" placeholder="0.00" readonly id="change" name="change" />
                                    </div>
                                   
                                </div>
                              <div  id="gcash" style="display:none; margin-top: 10px">
                                <label for=""><b>Reference no:</b></label>
                                <input type="text" style="width:  px" id="reference_no" name="reference_no"><br>
                              </div>

                        </div>
                        <div class="modal-footer w-5" style="position:absolute; bottom:1%; width:97%; border-top-color: gray  "  >
                            <button type="button" class="  "style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">Close</button>
                            <button class="pay_billing "style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Pay</button>
            
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

        var billing = $('#billingtable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/secretary/billing",
	   dom: 'frtp',
	   pageLength: 10,
	   responsive: true,
        columns: [
		{data: 'transno', name: 'transno' , orderable: false, searchable: false},
            {data: 'user_id', name: 'user_id' , orderable: false, searchable: false},
		  {data: 'fullname', name: 'fullname' , orderable: false},
		  {data: 'sub_total', name: 'sub_total' , orderable: false, searchable: false},
		  {data: 'status', name: 'status' , orderable: false, searchable: false},
          {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });

    // <th>Trans no.</th>
    //                                 <th >User ID</th>
    //                                 <th>Fullname</th>
    //                                 <th>Sub-total</th>
    //                                 <th>Status</th>
    //                                 <th style="width: 230px">Action</th>
 
    $("#payment_cash").on('change', function(e){
        e.preventDefault();
            this.value = parseFloat(this.value).toFixed(2);
    });

    
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
                url: "/secretary/billing/addtocart/deleteall",
                datatype: "json",
                success: function(response){ 
                }
            });
                
            }
        }


        // -------- show patient modal -------------- //

        $(document).on('click', '.getpatient', function(e){
            e.preventDefault();
            $('#modal-status').val('show')
          $('#viewpatients').modal('show');
        })

        // $(document).on('click', '.service', function(e){
        //   $('#viewservice').modal('show');
        // })

        // //---------------------Show payment modal---------------------//
        // $(document).on('click', '.proceedpayment', function(e){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: "GET",
        //         url: "/admin/billing/addtocart/getdata/",
        //         datatype: "json",
        //         success: function(response){ 
                
        //         if(response.status == 400){
        //             $('#message-error').html('');
        //         $('#message-error').text(response.message);
        //                     $(".error").show();
        //                     setTimeout(function() {
        //                         $(".error").fadeOut(500);
        //                     }, 2000);
        //         }else{
        //                     let userid = $('#userid').val();
        //                     let fullname = $('#fullname').val();
        //                     let consultation_date = $('#consultation').val();
        //                     let service_subtotal = $('#subtotal_value').val();
        //                     let doctor_fee = $('#doctorfee').val();
        //                     // let replace_doctor_fee = doctor_fee.replaceAll("₱" , " ")
        //                     let replace_service_subtotal = service_subtotal.replace(/[^a-z0-9. ]/gi, '');
        //                     let subtotal = parseInt(replace_service_subtotal, 10) + parseInt(doctor_fee);
        //                     let number = Number(parseFloat(subtotal).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});
                           
        //                     console.log(subtotal);
                           
                           
        //                         $('#totalprice_nosymbol').val(subtotal);
        //                         $('#payment_userid').val(userid);
        //                         $('#payment_fullname').val(fullname);
        //                         $('#payment_consultation').val(consultation_date);
        //                         $('#payment_servicesubtotal').val(service_subtotal);
        //                         $('#payment_subtotal').val('₱ '+subtotal.toFixed(2));
        //                         $('#total_price').val('₱ '+ number);
        //                         $('#payment').modal('show');
        //         }
        //         }
        //     });        
        // })


             // //---------------------Show payment modal---------------------//
        $(document).on('click', '.payment', function(e){
       
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/secretary/billing/getdata/"+id,
                datatype: "json",
                success: function(response){ 
                   
                                $('#payment_billingno').val(response.data.transno);
                                $('#payment_userid').val(response.data.user_id);
                                $('#payment_fullname').val(response.data.fullname);
                                $('#compute_subtotal').val(response.data.sub_total); //dito cocompute
                                $('#payment_subtotal').val( "₱" + response.data.sub_total + ".00");
                                $('#total_price').val("₱" + response.data.sub_total + ".00");
                                $('#totalprice_nosymbol').val(response.data.sub_total);
                                $('#payment_discount').val("");
                                $('#mode_payment').val("");
                                $('#change').val("")
                                $('#reference_no').val("")
                                $('#payment').modal('show');      
                }
                
            });        
        })


        $('.pay_billing').on('click', function(){
            var billing_no = $('#payment_billingno').val();
            var data = {
                'user_id' : $('#payment_userid').val(),
                'fullname' : $('#payment_fullname').val(),
                'subtotal' : $('#compute_subtotal').val(),
                'discountcode' : $('#payment_discount').val(),
                'discountname' : $('#discount_name').val(),
                'discountprice' : $('#discount_price').val(),
                'total' : $('#totalprice_nosymbol').val(),
                'mode_of_payment' : $('#mode_payment').val(),
                'payment' : $('#payment_cash').val(),
                'change' : $('#change').val(),
                'reference_no' : $('#reference_no').val(),
            }
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "PUT",   
                url: "/secretary/billing/update/payment/" + billing_no, 
                    datatype: "json",
                    data: data ,
                    success: function(response){
                        $('#payment_billingno').val("");
                        $('#payment_userid').val("");
                        $('#payment_fullname').val("");
                        $('#compute_subtotal').val(""); //dito cocompute
                        $('#payment_subtotal').val("");
                        $('#total_price').val("");
                        $('#totalprice_nosymbol').val("");
                        $('#status').val("");
     billing.draw();
                    $('#payment').modal('hide');     
                    }

            });
            
        } )
      
        $(document).on('click', '.saveaddtocart', function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",   
                url: "/secretary/billing/addtocart/billing_store", 
                    datatype: "json",
                    data: {billingno : $('#getid').val() },
                    success: function(response){ //return galing sa function sa controller
                        get_maxid();
                        $('.subtotal').load(location.href+' .subtotal');
                            $('.data-table').load(location.href+' .data-table');
                            $('#userid').val("");
                            $('#fullname').val("");
                            $('#servicename').val("");
                            $('#getservice').val("");
                            $('#price').val("");
                            $('.billing').load(location.href+' .billing');
                 
                }
            });
        });


        // -------- select patient in modal ------------// 
        $(document).on('click', '.select', function(e){
            e.preventDefault();
            var id = $(this).val();
console.log(id);
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "GET",   
                url: "/secretary/appointment/getuser/"+ id, 
                    datatype: "json",
                    success: function(response){ //return galing sa function sa controller
                    $(' #userid, #fullname').html("");
                    $('#userid').val(response.users[0].id);
                    $('#fullname').val(response.fullname[0].fullname);
                    $('#viewpatients').modal('hide');
                }
            });
        });

        //------------ close patient modal --------------------------------//
        $(".viewpatients").on("hidden.bs.modal", function(e){
          e.preventDefault();
        $('.patient-remove').load(location.href+' .patient-remove');
        });

    //     $(document).on('click', '.selectservice', function(e){
    //         e.preventDefault();
    //         var service = $(this).val();
        
    //        $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //         });
    //        $.ajax({
    //             type: "GET",   
    //             url: "/admin/billing/getservice/"+ service, 
    //             datatype: "json",
    //             success: function(response){ 
    //                 $('#servicecode').val(response.service.servicecode);
    //               $('#servicename').val(response.service.servicename);
    //               $('#price').val(response.service.price);
    //               $('#viewservice').modal('hide');
    //     }
    // });
    //     });

    $('')

    
        $(document).on('change', '.getservice', function(e){
            e.preventDefault();
            var id = $(this).val();

                    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           $.ajax({
                type: "GET",   
                url: "/secretary/appointment/get_appointment_service/"+id ,
                datatype: "json",
                success: function(response){ 
                    $('.servicename').val(response.service.servicename);
                    $('.price').val(response.service.price);
                }
            });

        });
        
        $(document).on('click','.store_addtocart' ,function(e){
            e.preventDefault();
            var data ={
                'billingno' : $('#getid').val(),
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
                url: "/secretary/billing/addtocart/store", 
                data: data,
                datatype: "json",
                beforeSend: function(){
                    $(".loading").show();
                },
                complete: function(){
                    $(".loading").hide();
                },
                success: function(response){ 
                        if(response.status == 200){     
                            $('#sub-total').val(response.subtotal);
                            $('#message').text(response.message);
                            $('.subtotal').load(location.href+' .subtotal');
                            $('.data-table').load(location.href+' .data-table');
                            $('.billing').load(location.href+' .billing');
                            $('#servicename').val("");
                            $('#getservice').val("");
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



        $('#mode_payment').on('change', function(e){
            var payment = $(this).val();

            if(payment == "Gcash"){
                $('#cash').hide();
                $('#gcash').show();
            }else if (payment == "Cash"){
                $('#cash').show();
                $('#gcash').hide();
            }else{
                $('#cash').hide();
                $('#gcash').hide();
            }
        });

        $('#payment_discount').on('change' , function(e){
            e.preventDefault();
            var discount = $(this).val();
          
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(discount.length == 0 || discount == "None"){
                let total_price = $('#compute_subtotal').val();
                var subtotal = $('#payment_subtotal').val();
                      $('#total_price').html("");
                        $('#total_price').val(subtotal);
                        $('#totalprice_nosymbol').val(total_price);
                        $('#discount_price').val("");
            }else{
    
                        $.ajax({
                type: "GET", 
                url: "/secretary/billing/getdiscount/"+discount , 
                datatype: "json",
                success: function(response){ 
                
                    let total_price = $('#compute_subtotal').val();
                  var divide = response.discount.percentage;
                  let discount = (divide/100);
                  let discountprice = total_price * discount;
                  let total = total_price - discountprice;
                  let number_total = Number(parseFloat(total).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});
                  const cars = [total_price, discount, total];
                  $('#change').val("");
                  $('#payment_cash').val("");
                  $('#total_price').html("");
                  $('#total_price').val('₱ '+ number_total);
                  $('#totalprice_nosymbol').val(total);
                $('#discount_name').val(response.discount.discountname);
                $('#discount_price').val(discountprice);
                }

            }); 
                    };
  
        });

        $('#payment_cash').on('keyup', function(e){
          e.preventDefault();
          let total = $('#total_price').val();
          let payment = $('#payment_cash').val();
          let replace_total = total.replace(/[^a-z0-9. ]/gi, '');
          let change =  parseInt(payment) - parseInt(replace_total, 10);
          let change_replace =Number(parseFloat(change).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});

   
     
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


        $('#fullname_patient').on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname_patient').val();
          // console.log(search);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/modal_profile/search-name',
            method:'GET',
            data: {search:search,},
            success:function(response){
              console.log(response);
             
              $('.patient').html(response);
              if(response.message == 'Nofound'){       
                $('.patient').append('<table class="table table-bordered table-striped" >\
                                                            <thead>\
                                                                <tr>\
                                                                    <th>id</th>\
                                                                    <th>First name</th>\
                                                                    <th>Middle name</th>\
                                                                    <th>Last name</th> \
                                                                    <th>Birthday</th>\
                                                                    <th>Address</th>\
                                                                    <th>Gender</th>\
                                                                    <th>Mobile no.</th>\
                                                                    <th>Email</th>\
                                                                    <th>Action</th>\
                                                                </tr>\
                                                            </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="10" style="text-align: center;">no user Found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>');
               }
            }
          });
        })

    //     $(document).on('click',  '.pagination a', function(e){
    //         e.preventDefault();
    //         let status = $('#modal-status').val()

    //         if( status == "show" ){
    //           let page = $(this).attr('href').split('patient=')[1]
    //           patient(page);
    //         }else{
    //             let page = $(this).attr('href').split('addtocart=')[1]
    //         addtocart(page);
    //         }
    //     });

    //     function patient(page){
    //       let data = page;
    //        $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //         });
    //           $.ajax({
    //             type: "GET",  
    //             url: "/admin/modal_patient/pagination/paginate-data?patient="+page ,
    //             data: {data: data}, 
    //             datatype: "json",
    //             success: function(response){
    //               console.log(response);
    //             $('.patient').html(response);
    //               }
    //           });
    //     }

    //     function addtocart(page){
    //         let data = page;
    //         console.log(data);
    //        $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //         });
    //        $.ajax({
    //             type: "GET", 
    //             data: {data:data},  
    //             url: "/admin/billing/addtocart/pagination/paginate-data?addtocart="+ page , 
    //             datatype: "json",
    //             success: function(response){ 
                
    //             $('.data-table').html(response);
    //     }
    // });
    //     }
});
</script>

@endsection
