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
    <div  class="d-flex justify-content-between " style="height: 43px">
        <div style="margin-bottom: 1%;">
            <a  class="btn" href="/secretary/billing"><img height="23" width="23" src="{{url('logo/arrow.png')}}" alt=""></a>
        </div>
    
        <div class=" ">
            <a href="/secretary/billing/printinvoice/{{$infos->transno}}" class="btn"><img height="28" width="28" src="{{url('logo/printer.png')}}" alt=""></a>
        </div>
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
                <label for="">Transaction No.:</label>
                <input type="text"  style="width: 50px" class="view1 rounded " id="fullname" value="{{$infos->transno}}" name="fullname" readonly>
               <br> <label for="">Trans Date:</label>
               <input type="text"  class="view1 rounded " id="fullname" value="{{ date('M d, Y H:i A', strtotime($infos->created_at))}}" name="fullname" readonly>
              </div>
        </div>
        </form> 


        <div style="margin-top:20px">
            <h3><b>Services</b> </h3>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr style="text-align: center;">
              
                    <th>Description</th>
                    <th>Price</th>
              
                </tr>
            </thead>

            <tbody class="patient-error" >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr class="overflow-auto">
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

        <form class="row" >
                
            <div class="col-sm-8 ">
        
        
             
            </div>
        
            <div class="col-sm " >
                <div >
                    @if ($infos->status == 'Pending')
            
                    @else
                    <label for="">Discount:</label>
                    <input type="text" style="width:150px" class="view1 rounded " id="fullname" value="{{$infos->discount_price}}" name="fullname" readonly><br>
                    @endif
                     <label for="">Total:</label>
                    <input type="text"  class="view1 rounded " id="fullname" value=" ₱ {{number_format("$infos->total",2)}}" name="fullname" readonly>
                    @if ($infos->status == 'Pending')
                    <br> <label for="">Status:</label>
                    <label for="">{{$infos->status}}</label>
                    @else
                    <br> <label for="">Mode of payment:</label>
                    <input type="text"  style="width:100px"  class="view1 rounded " id="fullname" value="{{$infos->mode_of_payment}}" name="fullname" readonly>
                    @if ($infos->mode_of_payment == "Cash")
                    <br> <label for="">Payment:</label>
                    <input type="text"  class="view1 rounded  "  style="width:150px"  id="fullname" value=" ₱ {{number_format("$infos->payment",2)}}" name="fullname" readonly>
                    <br> <label for="">Change:</label>
                    <input type="text"  class="view1 rounded "  style="width:150px"  id="fullname"  value=" ₱ {{number_format("$infos->change",2)}}"name="fullname" readonly>
                    @else
                    <br> <label for="">Reference no.:</label>
                    <input type="text"  class="view1 rounded "  id="fullname" value="{{$infos->reference_no}}" name="fullname" readonly>
                    @endif
                    @endif
                  </div>
        
                  
            </div>
            </form> 


</div>
@endsection