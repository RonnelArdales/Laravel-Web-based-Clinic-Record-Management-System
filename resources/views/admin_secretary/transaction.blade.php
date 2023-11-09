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
        padding-left:20px;
    }
</style>

<div class="row m-3">
    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	
    
    <div class="me-auto col-md-8 col-md-offset-5">
        <h1> <b>TRANSACTION</b> </h1>
    </div>

    <div class="alert success alert-success" role="alert" style="width:300px; right:25px; display:none;  position:fixed; z-index:9999; text-align:center">
        <p  style="font-size:20px" id="message-success"></p> 
    </div>

    <div class="alert error alert-danger" role="alert" style="width:300px; right:25px; display:none;  position:fixed; z-index:9999; text-align:center">
        <p  style="font-size:20px" id="message-error"></p> 
    </div>

    <div class="row" >
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
                <button type="button" class="store_addtocart"  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; margin-bottom:2%; " >Add Service</button>
            </div>
        </div>
    </div>

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
    let usertype = '{{ Auth::user()->usertype }}';
</script>
@vite( 'resources/js/admin_secretary/transaction.js')
@endsection
