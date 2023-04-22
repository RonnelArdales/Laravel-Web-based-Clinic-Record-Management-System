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
    <div>
        <a class="btn btn-info" href="/admin/billing"> Back </a>
    </div>
    <hr>
    <form class="row" >
                
        <div class="col-md-6">

            <label for="">User ID:</label>
            <input type="text" style="width: 480px;" class="addtocart_input" id="userid"  value="{{$infos->user_id}}" name="userid" readonly>
              <br>
            <label style="margin-top: 10px" for="">Fullname:</label>
            <input type="text" style="width: 470px" class="addtocart_input" id="fullname" value="{{$infos->fullname}}" name="fullname" readonly>
         
        </div>

        <div class="col-md-6">
            <label for="">Billing no:</label>
            <input type="text" style="width: 460px;" class="addtocart_input" name="billingno" value="{{$infos->billing_no}}"  id="getbillingno" readonly>
            <label style="margin-top: 10px"  for="">Billing date:</label>
            <input type="text" style="width: 460px;" class="addtocart_input" name="billingno" value="{{$infos->created_at}}"  id="billingdate" readonly>
        </div>
        </form>
        <div style="margin-top:10px">
            <h4>Services</h4>
        </div>

        <table>
            <thead>
                <tr style="text-align: center;">
              
                    <th>Service code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="patient-error" >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr class="overflow-auto">
                    <td> {{$service->servicecode}}</td>
                    <td>{{$service->service}}</td>
                    <td>{{$service->price}}</td>
               
                    <td style="text-align: center;">
                        <button class="btn btn-danger" >remove</button>
                   </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                  </tr>
                @endif
            </tbody>
        </table>



</div>
@endsection