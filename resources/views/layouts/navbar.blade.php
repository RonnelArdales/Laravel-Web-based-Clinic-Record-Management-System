<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Gujarati:wght@700&family=Poppins:wght@400;700&family=Song+Myung&display=swap" rel="stylesheet">


</head>
<style>
    body{
        margin: 0%;
        padding: 0%;
        background-color: #EDDBC0;
    }
    .logoutbutton{
      background-color: #EDDBC0;
    }

    #calendar {
    max-width: 900px;
    
    margin: 0 auto;
    background-color: white;
  }
  .info{
    margin-right: 20px;
    width: 100px;
  }
    
</style>
<body>
    <nav class="navbar navbar-expand-lg " style="background-color: #EDDBC0; margin-left:2%;">
        <div class="container-fluid">
          <a class="navbar-brand" style="font-family: Noto Serif Gujarati; font-size: 1.8vw;" href="#">JGMarquez, RPsy</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div style="font-family: Poppins; font-weight: 400;" class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/homepage">HOME</a>
                  </li> 
                  @else
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">HOME</a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link active" href="#">ABOUT US</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">CONTACT US</a>
              </li>
      
                  
              @if (Auth::check()) 
        <form action="/logout" method="POST">
            @csrf
            <li class="nav-item">
                <button type="submit" class="logoutbutton nav-link border border-none">LOGOUT</button>
            </li>
            </form>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/profile/">PROFILE/a>
                  </li>      
                  
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/appointment/">Appointment</a>
                  </li>   
                  <li class="nav-item">
                    <a class="nav-link mr-20" href="#">welcome {{Auth::user()->fname}}</a>
                  </li>
        @else
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login">LOGIN</a>
          </li>  

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/register">REGISTER</a>
          </li>       
                
    @endif
              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> --}}
            </ul>
          </div>
        </div>
      </nav>
      <main>
        @yield('content')
      </main>
</body>

</html>