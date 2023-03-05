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