<div class="card-body " style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
    <table class="table table-data table-bordered table-striped" style="background-color: white" >
      <thead>
        <tr>
        
          <th>Patient Id</th>
          <th>Fullname</th>
          <th>Date</th>
          <th>Time</th>
          <th>Mode of Payment</th>
          <th>Status</th>
    
       
      </tr>
    </thead>
    <tbody >
      @if (count($appointments)> 0 )
      @foreach ($appointments as $appointment)
      <tr class="overflow-auto">
          <td>{{$appointment->user_id}}</td>
          <td>{{$appointment->fullname}}</td>
           <td>{{$appointment->date}}</td>
           <td>{{$appointment->time}}</td>
           <td>{{$appointment->mode_of_payment}}</td>
           <td>{{$appointment->status}}</td>

      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="8" style="text-align: center;">No appointment Found</td>
  
      </tr>
      @endif
       
    </tbody>
    </table>
</div>
<div>
  {{ $appointments->appends(request()->query())->links() }}
</div>