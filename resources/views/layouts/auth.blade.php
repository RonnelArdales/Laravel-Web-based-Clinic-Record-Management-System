<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Gujarati:wght@700&family=Poppins:wght@400;700&family=Song+Myung&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
</head>
<style>
    body{
        margin: 0%;
        padding: 0%;
        background-color: #EDDBC0;
    }

    footer{
        color:white;
        border-radius: 55px 55px 0px 0px;
        background-color: #829460;
        padding: 0% 2% 0% 2%;
    }

    .main{
        min-height:85vh 
    }

    .dropdown-menu {
        right: -90px;
    }

    .logoutbutton{
        background-color: #EDDBC0;
        border: 0;
        background: none;
        outline: none;
        color: black;
    }

    .input-box{
        background: #D0B894; 
        border-radius: 10px;
        padding-left: 12px;
        padding-right: 12px;
        padding-top: 6px;
        padding-bottom: 6px;
        border:none;
        height: 
    }

    .input-box input{
        width:90%;
        outline:none;
        background: #D0B894; 
        border: none
    }

</style>
<body>
        @if (Auth::check())
            <nav class="navbar navbar-expand-md flex" style="background-color: rgba(130, 148, 96, 1); ">
                <div class="container-fluid d-flex justify-content-between" >
                    <div class="d-flex justify-content-center" style="margin-left:2%;">
                        <a href="/"><img width="50" style="margin-right: 5px" height="50" src="{{url('/logo/icon.ico')}}" alt=""></a> 
                        <a class="navbar-brand" style="font-family: Noto Serif Gujarati; font-size:28px; color:white;  "href="/">JGMarquez, RPsy</a>
                    </div>

                    <div class="" id="navbarSupportedContent" >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                        <div class="btn-group mr-5" style="margin-right:20px">
                            <button type="button" style="color:white" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->username}}</button>
                            <div class="dropdown-menu dropdown-menu-end " style="position: absolute">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <li class="nav-item" style="outline: none; padding-left:10px; ">
                                        <button type="submit" class="logoutbutton nav-link ">LOGOUT</button>
                                    </li>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @else
          <nav class="navbar navbar-expand-md flex" style="background-color: #EDDBC0; margin-left:2%;">
            <div class="container-fluid">
                <div class="d-flex justify-content-center" >
                    <a href="/"><img width="50" style="margin-right: 5px" height="50" src="{{url('/logo/icon.ico')}}" alt=""></a> 
                    <a class="navbar-brand" style="font-family: Noto Serif Gujarati; font-size:28px  "href="/">JGMarquez, RPsy</a>
                </div>
            </div>
          </nav>
        @endif
        
      <main class="main">
            @yield('content')
      </main> 

        <footer class="text-center text-lg-start text-white">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Links -->
                <section class="">
                    <!--Grid row-->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" style="text-align:center; color:white">
                            <h6 class="text-uppercase mb-4 font-weight-bold"> ADDRESS </h6>
                            {{-- <p>
                            2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Philippines
                            </p> --}}
                            {!! $address_clinic->content !!}
                        </div>
                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />
    
                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3" style="text-align:center">
                            <h6 class="text-uppercase mb-4 font-weight-bold">CONTACT US</h6>
                            {!! $contact_us->content !!}
                        </div>
    
                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />
    
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3" style="text-align:center">
                            <h6 class="text-uppercase mb-4 font-weight-bold"> EMAIL US </h6>
                            {!! $email_us->content !!}
                        </div>

                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mb-md-2 mx-auto mt-3 mb-2" style="text-align:center">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                            <a href="https://www.facebook.com/jgmarquezpsych"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_6_et05wg.png" alt=""> </a>
                            <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
                        </div>
                
                    </div>
                </section>
            </div>
        </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

      @yield('scripts')
      
</body>
</html>