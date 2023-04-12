<div class="card-body " style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
    <table class="table table-bordered table-striped"  style="background-color: white">

        <thead>
            <tr>
                <th>id</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th> 
                <th>Birthday</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Mobile no.</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody >
          @if (count($users) > 0)
          @foreach ($users as $user)
          <tr class="overflow-auto">
              <td>{{$user->id}}</td>
              <td>{{$user->fname}}</td>
              <td>{{$user->mname}}</td>
              <td>{{$user->lname}}</td>
              <td>{{$user->birthday}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->gender}}</td>
              <td>{{$user->mobileno}}</td>
              <td>{{$user->email}}</td>
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
<div>
  {!! $users->links() !!}
</div>