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
            <table class="table table-data table-bordered table-striped" style="background-color: white">
                <thead>
                  <tr>
             
                      <th>Billing no</th>
                      <th>Fullname</th>
                      <th>Service</th> 
                      <th>Total</th>
                      <th>Mode of payment</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody id="tbody" >
                @if (count($billings) > 0)
                @foreach ($billings as $billing)
                <tr class="overflow-auto" id="nouser">
                    <td>{{$billing->billing_no}}</td>
                    <td>{{$billing->fullname}}</td>
                    <td>{{$billing->service}}</td>
                    <td>{{$billing->total}}</td>
                    <td>{{$billing->mode_of_payment}}</td>
                    <td>{{$billing->status}}</td>
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
    
    </div>
   
</body>
</html>