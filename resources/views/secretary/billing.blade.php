@extends('layouts.admin_navigation')
@section('title', 'Billing')
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
                    <h1><b>BILLING</b></h1>
                </div>

                <div id="success" class="success alert alert-success" role="alert" style="display:none">
                    <p style="margin-bottom: 0px" id="message-success"></p> 
                  </div>

                  <div class="main-spinner" style="
                  position:fixed;
                      width:100%;
                      left:0;right:0;top:0;bottom:0;
                      background-color: rgba(255, 255, 255, 0.279);
                      z-index:9999;
                      display:none;"> 
                  <div class="spinner">
                      <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                      <span class="visually-hidden">Loading...</span>
                      </div>
                      </div>
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
                                    <th>Total</th>
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
                                    @foreach ($mops as $mop)
                                    <option value="{{$mop->modeofpayment}}">{{$mop->modeofpayment}}</option>
                                    @endforeach
                                </select><br>

                                <div class="mt-0 mb-2">
                                    <span  role="alert" class="block mt-5   text-danger" id="error_modeofpayment"></span>
                                     </div>

                                <div id="cash" style="display: none; margin-top: 10px">
                                    <label for=""><b>payment:</b></label>
                                         <div class="currency-wrap-payment">
                                            <span class="currency-code-payment">₱</span>
                                            <input type="number" class="text-currency-payment" id="payment_cash" placeholder="0.00" class="payment_cash" name="payment_cash" value=""/>
                                        </div>

                                        <div class="mt-0 mb-2">
                                            <span  role="alert" class="block mt-5   text-danger" id="error_payment"></span>
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
                                <div class="mt-0 mb-2">
                                    <span  role="alert" class="block mt-5   text-danger" id="error_reference_no"></span>
                                </div>
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

                                        {{---- delete modal---}}
                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="background: #EDDBC0;">
                                <div style="display: flex; justify-content: flex-end;">
                                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                                  </div>
                            <div class="modal-body">
                                <div class="mb-3 mt-4  ">
                                    <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                                        <input type="text" hidden id="delete_no">
                                    <h4>Do you want to delete this data?</h4>
                             
                                  {{-- </form> --}}
                            </div>
                            </div>
                            <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                              <button type="button" class=" close btn btn-secondary" style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px;  " data-bs-dismiss="modal">Close</button>
                              <button class="delete_user" id="deletefile"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Delete</button>
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
		  {data: 'total', name: 'total' , orderable: false, searchable: false},
		  {data: 'status', name: 'status' , orderable: false, searchable: false},
          {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
    });

 
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
                    beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){

                    $(".main-spinner").hide();
                },
                    success: function(response){
                        if(response.status == "400"){
                            $('#error_modeofpayment, #error_payment, #error_reference_no').html(" ");
                            $.each(response.errors.mode_of_payment, function (key, err_values){
                            $('#error_modeofpayment').append('<span>'+err_values+'</span>');
                                })
                            $.each(response.errors.payment, function (key, err_values){
                                    $('#error_payment').append('<span>'+err_values+'</span>');
                                })
                            $.each(response.errors.reference_no, function (key, err_values){
                                    $('#error_reference_no').append('<span>'+err_values+'</span>');
                                })
                        }else{
                            $('#message-success').text('Updated Successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
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
                        $('#payment_cash, #change, #reference_no').val(" ");
                        $('#cash').hide();
                        $('#gcash').hide();   
                        }
                    }

            });
            
        } )
      


        //------------ close patient modal --------------------------------//
        $(".viewpatients").on("hidden.bs.modal", function(e){
          e.preventDefault();
        $('.patient-remove').load(location.href+' .patient-remove');
        });
    
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
        



        $('#mode_payment').on('change', function(e){
            var payment = $(this).val();
            $('#payment_cash, #reference_no, #change').val(" ");
            $(' #error_payment, #error_reference_no').html(' ');
            if(payment == "Cash"){
                $('#cash').show();
                $('#gcash').hide();
            }else{
                $('#cash').hide();
                $('#gcash').show();
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


        $('#billingtable').on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#delete_no').val(id);
           $('#delete').modal('show');
        });

        $(document).on('click', '.delete_user', function(){
            id =   $('#delete_no').val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "DELETE", 
                url: "/secretary/billing/deleteBilling/"+ id , 
                datatype: "json",
                beforeSend: function(){
                    $(".main-spinner").show();
                },
                complete: function(){

                    $(".main-spinner").hide();
                },
                success: function(response){ 
                    console.log(response);
                    $('#delete_no').val("");
                    $('#delete_no').val(id);
                    $('#delete').modal('hide');
                    billing.draw();
                    
                    $('#message-success').text('Deleted Successfully');
                        $(".success").show();
                        setTimeout(function() {
                            $(".success").fadeOut(500);
                        }, 3000);
                }

            }); 

        })

        
        $('#payment').on('hidden.bs.modal', function() {

$('#payment_billingno').val("");
                $('#payment_userid').val("");
                $('#payment_fullname').val("");
                $('#compute_subtotal').val(""); //dito cocompute
                $('#payment_subtotal').val("");
                $('#total_price').val("");
                $('#totalprice_nosymbol').val("");
                $('#status').val("");
                $('#payment').modal('hide');
                $('#payment_cash, #change, #reference_no').val(" ");
                $('#cash').hide();
                $('#gcash').hide();   

});
        
});
</script>

@endsection
