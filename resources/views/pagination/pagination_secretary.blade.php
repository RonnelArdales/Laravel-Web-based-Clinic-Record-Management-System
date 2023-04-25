<div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
  <table class="table  table-bordered table-striped "  style="background-color: white">

      <thead>
          <tr>
              <th>id</th>
              <th>First name</th>
              <th>Middle name</th>
              <th>Last name</th> 
              <th>Birthday</th>
              <th>Age</th>
              <th>Address</th>
              <th>Gender</th>
              <th>Mobile no.</th>

              <th>Action</th>

          </tr>
      </thead>
      <tbody >
        @if (count($secretaries) > 0)
        @foreach ($secretaries as $user)
        <tr class="overflow-auto">
            <td>{{$user->id}}</td>
            <td>{{$user->fname}}</td>
            <td>{{$user->mname}}</td>
            <td>{{$user->lname}}</td>
            <td>{{$user->birthday}}</td>
            <td>{{$user->age}}</td>
            <td>{{$user->address}}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->mobileno}}</td>
      
            
            <td style="text-align: center">
              <button type="button" value="{{$user->id}}" class="view btn btn-sm btn-primary ">view</button>
              <button type="button" value="{{$user->id}}" class="edit  btn btn-sm btn-primary ">Edit</button>
              <button type="button" value="{{$user->id}}" class="delete btn-sm btn  btn-danger">delete</button></td>
        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="4" style="text-align: center;">no user Found</td>

        </tr>
        @endif
         
      </tbody>
  </table>
</div>
<div style="">
  {!! $secretaries->links() !!}
</div>