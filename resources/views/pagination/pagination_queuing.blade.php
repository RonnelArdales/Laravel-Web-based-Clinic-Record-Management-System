<div class="card-body" style="width:100%; height:68vh; display: flex; overflow-x: auto;  font-size: 15px;">
    <div  style="width:100%; " >
      <table class="table table-bordered table-striped "  >
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
                  <th style="width: 205px">Action</th>
               
              </tr>
          </thead>
          <tbody >
            @if (count($appointments)> 0 )
            @foreach ($appointments as $appointment)
            <tr class="overflow-auto">
              <td>{{$appointment->id}}</td>
                <td>{{$appointment->user_id}}</td>
                <td>{{$appointment->fullname}}</td>
                 <td>{{$appointment->date}}</td>
                 <td>{{$appointment->time}}</td>
                 <td>{{$appointment->service}}</td>
                 <td>{{$appointment->price}}</td>
                 <td>{{$appointment->status}}</td>
                <td>
                <button type="button" value="{{$appointment->id}}" class="edit btn btn-success btn-sm">Accept</button>
                <button type="button" value="{{$appointment->id}}" class="cancel btn btn-primary btn-sm">Cancel</button>
                <button type="button" value="{{$appointment->id}}" class="delete btn  btn-danger btn-sm">Delete</button></td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" style="text-align: center;">No appointment Found</td>
        
            </tr>
            @endif
             
          </tbody>
      </table>
    </div>
  </div>
  <div>
   {!! $appointments->links() !!}
 </div>