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
                        <td>{{$addtocart->user_id}}</td>
                        <td>{{$addtocart->fullname}}</td>
                        <td>{{$addtocart->servicecode}}</td>
                        <td>{{$addtocart->service}}</td>
                        <td>{{$addtocart->price}}</td>
                        <td style="text-align: center">
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
    </div>
    <div class="row">
        <div style="margin-left:20px" class="col">
            {!! $addtocarts->links() !!}
         </div>
        <div id="subtotal" class="subtotal d-flex justify-content-end col " style="margin-bottom:15px; margin-right:20px">
            <label for="" style="font-weight: 700;Padding-top:0.8%; font-size:15px;padding-left:2%">Sub-Total:</label>
            <input type="text" id="subtotal_value" style="text-align: right;" readonly value="₱ {{number_format("$sum",2)}}" >
            <button type="button"  class="proceedpayment" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 200px;height: 40px; margin-left:1%; " >Proceed to payment</button>
        </div>
    </div>