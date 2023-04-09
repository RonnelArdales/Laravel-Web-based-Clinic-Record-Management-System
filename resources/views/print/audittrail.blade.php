<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <div style="text-align: center">
    <h2>JG Marquez Audit Trail</h2>
</div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>id</th>
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
</div>
   
</body>
</html>