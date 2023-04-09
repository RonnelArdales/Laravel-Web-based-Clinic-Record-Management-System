<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body >
<header  style="width:100%; text-align: center;" >
  <img class="border border-dark" style="height: 90px; width:530px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('logo/report-logo.png'))) }}">
<hr style="width:100%; border:solid; margin-top:10px;margin-bottom:10px ;padding:0px" >
</header>

<div style="text-align: center">
  <h2>Appointments</h2>
</div>

    <div class="card"  >
        <div class="card-body" style="width:100%;  display: flex; overflow-x: auto;  font-size: 15px;">
          <div class="table-appointment" style="width:100%; " >
            <table class="table table-bordered table-striped "  >
                <thead>
                    <tr style="text-align: center">
                        <th>Patient Id</th>
                        <th>Fullname</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody >
                  @if (count($appointments)> 0 )
                  @foreach ($appointments as $appointment)
                  <tr class="overflow-auto" style="text-align: center">
                      <td>{{$appointment->user_id}}</td>
                      <td>{{$appointment->fullname}}</td>
                       <td>{{$appointment->date}}</td>
                       <td>{{$appointment->time}}</td>
                       <td>{{$appointment->service}}</td>
                       <td>{{$appointment->price}}</td>
                       <td>{{$appointment->status}}</td>
           
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4" style="text-align: center;">No appointment Found</td>
              
                  </tr>
                  @endif
                   
                </tbody>
            </table>
          </div>
        </div>
    
    </div>
   
</body>
</html>