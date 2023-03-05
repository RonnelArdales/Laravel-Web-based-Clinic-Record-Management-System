<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Users</h1>

<div class="card">
    <div class="card-body">

        
        <table class="table table-bordered table-striped">
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
          @if (count($userss) > 0)
          @foreach ($userss as $user)
          <tr class="overflow-auto" style="font-size: 10px">
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
</div>
   
</body>
</html>