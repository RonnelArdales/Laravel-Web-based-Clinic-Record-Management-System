<div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; ">
    <div class="" style="width:100%; " >
        <table class="table table-bordered table-striped "  style="background-color: white" >
            <thead>
                <tr>
                    <th>id</th>
                    <th>Patient Id</th>
                    <th>Fullname</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="error">
                @if (count($appointments)> 0 )
                    @foreach ($appointments as $appointment)
                        <tr class="overflow-auto">
                            <td>{{$appointment->id}}</td>
                            <td>{{$appointment->user_id}}</td>
                            <td>{{$appointment->fullname}}</td>
                            <td>{{date('m/d/Y', strtotime($appointment->date))}}</td>
                            <td>{{date('h:i A', strtotime($appointment->time))}}</td>
                            <td>{{$appointment->service}}</td>
                            <td>{{$appointment->price}}</td>
                            <td>{{$appointment->status}}</td>
                            <td style="text-align: center">
                            <button type="button" value="{{$appointment->id}}" id="accept" class="accept btn btn-success btn-sm">Accept</button>
                            <button type="button" value="{{$appointment->id}}" id="cancel" class="cancel btn btn-primary btn-sm">Cancel</button>
                            <button type="button" value="{{$appointment->id}}" class="delete btn  btn-danger btn-sm">Delete</button></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center;">No appointment Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="">
    {!! $appointments->links() !!}
</div>