<div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
    <table class="table table-data table-bordered table-striped" style="background-color: white">
        <thead>
            <tr>
                <th>User_id</th>
                <th>Username</th>
                <th>Activity</th> 
                <th>usertype</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="tbody" >
            @if (count($audits) > 0)
                @foreach ($audits as $user)
                <tr class="overflow-auto" id="nouser">
                    <td>{{$user->user_id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->activity}}</td>
                    <td>{{$user->usertype}}</td>
                    <td>{{date('m-d-Y h:i:s A', strtotime($user->created_at))}}</td>
                </tr>
                @endforeach
            @else
                <tr id="nouser">
                    <td colspan="7" style="text-align: center;">No user Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div>
  {{ $audits->links() }}
</div>