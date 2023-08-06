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
        <h1> <b>BILLING</b> </h1>
    </div>

    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px" id="message-success"></p> 
    </div>
    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
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
                            <input type="text" hidden id="discount_price">
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
    let usertype = '{{ Auth::user()->usertype }}';
</script>

@vite( 'resources/js/admin_secretary/billing.js')

@endsection
