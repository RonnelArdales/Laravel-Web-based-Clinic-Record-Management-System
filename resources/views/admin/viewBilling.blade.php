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
<div class="row m-3" style="font-family: poppins;">
    <div style="margin-bottom: 1%;">
        <a  class="btn btn-outline-dark" href="/admin/billing"> Back </a>
    </div>
    <hr>
    <form class="row" >
                
        <div class="col-sm ">

            <label for="">User ID:</label>
            <input type="text"  class="view1 rounded " id="userid"  value="{{$infos->user_id}}" name="userid" readonly>
              <br>
            <label style="margin-top: 5px" for="">Fullname:</label>
            <input type="text" class="view1 rounded " id="fullname" value="{{$infos->fullname}}" name="fullname" readonly><br>
            <label style="margin-top: 5px" for="">Sex:</label>
            <input type="text" class="view1 rounded " id="fullname" value="{{$infos->user->gender}}" name="fullname" readonly><br>
            <label style="margin-top: 5px" for="">Address:</label>
            <input type="text" style="width:70%" class="view1 rounded " id="fullname" value="{{$infos->user->address}}" name="fullname" readonly><br>
            <label style="margin-top: 5px" for="">Contact Number:</label>
            <input type="text" style="width:70%" class="view1 rounded " id="fullname" value="{{$infos->user->mobileno}}" name="fullname" readonly><br>
            <label style="margin-top: 5px" for="">Email :</label>
            <input type="text" style="width:90%" class="view1 rounded " id="fullname" value="{{$infos->user->email}}" name="fullname" readonly><br>
         
        </div>

        <div class="col-sm d-flex justify-content-end" >
            <div style="">
                <label for="">Billing No.:</label>
                <input type="text"  class="view1 rounded " id="fullname" value="{{$infos->transno}}" name="fullname" readonly>
               <br> <label for="">Billing Date:</label>
               <input type="text"  class="view1 rounded " id="fullname" value="{{$infos->created_at}}" name="fullname" readonly>
              </div>
        </div>
        </form> 


        <div style="margin-top:10px">
            <h4>Services</h4>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr style="text-align: center;">
              
                    <th>Service code</th>
                    <th>Name</th>
                    <th>Price</th>
              
                </tr>
            </thead>

            <tbody class="patient-error" >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr class="overflow-auto">
                    <td style="text-align: center;"> {{$service->servicecode}}</td>
                    <td style="text-align: center;">{{$service->service}}</td>
                    <td style="text-align: center;">{{$service->price}}</td>
               
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                  </tr>
                @endif
            </tbody>
        </table>

<div class="row">
    <div class="col-sm ">
        <a href="/admin/billing/printinvoice/{{$infos->transno}}" class="btn btn-outline-dark">Print</a>
    </div>

    <div class="col-sm d-flex justify-content-end" >
        <div style="">
            <label for="">Discount:</label>
            <input type="text"  class="view1 rounded " id="fullname" value="{{$infos->discount}}" name="fullname" readonly>
           <br> <label for="">Total:</label>
           <input type="text"  class="view1 rounded " id="fullname" value=" ₱ {{number_format("$infos->total",2)}}" name="fullname" readonly>
           <br> <label for="">Mode of payment:</label>
           <input type="text"  class="view1 rounded " id="fullname" value="{{$infos->mode_of_payment}}" name="fullname" readonly>
           @if ($infos->mode_of_payment == "Cash")
           <br> <label for="">Payment:</label>
           <input type="text"  class="view1 rounded " id="fullname" value=" ₱ {{number_format("$infos->payment",2)}}" name="fullname" readonly>
           <br> <label for="">Change:</label>
           <input type="text"  class="view1 rounded " id="fullname"  value=" ₱ {{number_format("$infos->change",2)}}"name="fullname" readonly>
           @else
           <br> <label for="">Reference no.:</label>
           <input type="text"  class="view1 rounded " id="fullname" value="{{$infos->reference_no}}" name="fullname" readonly>
           @endif
     
          </div>
    </div>
</div>


</div>
@endsection