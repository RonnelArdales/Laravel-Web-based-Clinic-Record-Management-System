<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
      @page {
         margin: 20px 0px; 
      }

      /** Define now the real margins of every page in the PDF **/
      body {
          margin-top: 3cm;
          margin-left: 2cm;
          margin-right: 2cm;
          margin-bottom: 2cm;
      }

      /** Define the header rules **/
      header {
          position: fixed;
          top: 0cm;
          left: 0cm;
          right: 0cm;
          height: 3cm;
      }

      /** Define the footer rules **/
      footer {
        position: fixed;
top: 19cm;
left: 0cm;
right: 0cm;
height: 2.5cm;
border-top: 1px solid gray;
text-align:right;
display: flex;
align-items: center;
padding-left: 20px;
padding-right: 30px;
padding-top: 18px;
      }

</style>

</head>
<body>
  <header  style="width:100%; text-align: center;" >
    <img class="border border-dark" style="height: 90px; width:530px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('logo/report-logo.png'))) }}">
  <hr style="width:100%; border:solid; margin-top:10px;margin-bottom:10px ;padding:0px" >
  </header>
  
  <footer>
    <label for=""><i>This is a computer-generated document. No signature is required</i></label>
     </footer>
  
  
  
  
  <div style="text-align: center">
    
    <h2>User</h2>
  </div>
  
  <div class="card"  >
    <div class="card-body" style="width:100%;  display: flex; overflow-x: auto;  font-size: 15px;">
      <div class="table-appointment" style="width:100%; " >
        <table class="table table-data table-bordered table-striped" style="background-color: white">
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
   
<script type="text/php">
  if ( isset($pdf) ) { 
      $pdf->page_script('
          if ($PAGE_COUNT > 0) {
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $size = 12;
              $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
              $y = 568;
              $x = 70;
              $pdf->text($x, $y, $pageText, $font, $size);
          } 
      ');
  }
  </script>
</body>
</html>