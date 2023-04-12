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
  <header  style="width:100%; text-align: center;" >
    <img class="border border-dark" style="height: 90px; width:530px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('logo/report-logo.png'))) }}">
  <hr style="width:100%; border:solid; margin-top:10px;margin-bottom:10px ;padding:0px" >
  </header>
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
                <th>Username</th>
                <th>Status</th>

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
              <td>{{$user->username}}</td>
              <td>{{$user->status}}</td>

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

    {{-- <img src="{{ public_path("logo/".report.png) }}" alt="" style="width: 150px; height: 150px;"> --}}
</div>
   
</body>
</html>