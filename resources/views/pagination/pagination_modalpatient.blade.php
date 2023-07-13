<table class="table table-bordered table-striped" >
  <thead>
      <tr>
          <th>id</th>
          <th>First name</th>
          <th>Middle name</th>
          <th>Last name</th> 
          <th>Address</th>
          <th>Gender</th>
          <th>Mobile no.</th>
          <th>Email</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody class="nofound" >
        @if (count($patients) > 0)
            @foreach ($patients as $user)
                <tr class="overflow-auto">
                    <td>{{$user->id}}</td>
                    <td>{{$user->fname}}</td>
                    <td>{{$user->mname}}</td>
                    <td>{{$user->lname}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->mobileno}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    <button type="button" value="{{$user->id}}" style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " class="select btn2 btn btn-primary ">Select</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
            <div>
                <td colspan="9" style="text-align: center;">no user Found</td>
            </div>
            </tr>
        @endif
  </tbody>
</table>
<div style="">
{!! $patients->links() !!}
</div>

