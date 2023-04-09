<table class="table table-bordered table-striped" >
  
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
          <th>Action</th>

      </tr>
  </thead>
  <tbody class="patient-error" >
    @if (count($patients) > 0)
    @foreach ($patients as $user)
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
        
        <td>
          <button type="button" value="{{$user->id}}" class="select btn2 btn btn-primary ">Select</button>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="4" style="text-align: center;">no user Found</td>

    </tr>
    @endif
     
  </tbody>
</table>
<div style="">
{!! $patients->links() !!}
</div>

