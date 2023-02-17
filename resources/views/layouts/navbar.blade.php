<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

    
</style>
<body>
    <nav class="navbar navbar-expand-lg " style="background-color: #EDDBC0">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">JG MARQUEZ</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/homepage">Home</a>
                  </li> 
                  @else
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link active" href="#">About US</a>
              </li>
      
                  
              @if (Auth::check()) 
        <form action="/logout" method="POST">
            @csrf
            <li class="nav-item">
                <button type="submit" class="logoutbutton nav-link border border-none">LOGOUT</button>
            </li>
            </form>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/profile/">Profile</a>
                  </li>      

                  <li class="nav-item">
                    <a class="nav-link mr-20" href="#">welcome {{Auth::user()->fname}}</a>
                  </li>
        @else
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login">Login</a>
          </li>  

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/register">Register</a>
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