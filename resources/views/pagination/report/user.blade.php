<div class="card-body " style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; " >
    <table class="table table-bordered table-striped"  style="background-color: white">
        <thead>
            <tr>
                <th>id</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th> 
                <th>Gender</th>
                <th>Age</th>
                <th>Status</th>
                <th>Usertype</th>
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
                    <td>{{$user->gender}}</td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->usertype}}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" style="text-align: center;">no user Found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div>
    {{ $users->appends(request()->query())->links() }}
</div>