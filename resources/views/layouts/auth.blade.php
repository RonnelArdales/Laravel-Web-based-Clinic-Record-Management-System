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

    .navbar{
        background-color: #a8ba86;
    }

    
</style>
<body>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
       
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
   
                <div class="btn-group  mr-5">
                    <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      {{Auth::user()->fname}}
                    </button>
                    
                    <ul class="dropdown-menu">
                      <form action="/logout" method="POST">
                        @csrf
                        <li class="nav-item">
                            <button type="submit" class="logoutbutton nav-link border border-none">LOGOUT</button>
                        </li>
                        </form>
                    </ul>
                  </div>
          
       
          </div>
        </div>
      </nav>

      <main>
        @yield('content')
      </main> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>