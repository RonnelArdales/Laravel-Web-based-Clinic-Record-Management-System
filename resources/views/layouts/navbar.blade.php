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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Gujarati:wght@700&family=Poppins:wght@400;700&family=Song+Myung&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title',)</title>
    <link rel="icon"  href="{!! asset('logo/icon.ico') !!}"/>
    <link rel="stylesheet" href="{{asset("css/user_app.css")}}">
    <link rel="stylesheet" href="{{asset("css/user/homepage.css")}}">
</head>
<style>

    
 
</style>
<body>
    <nav class="navbar navbar-expand-md flex" style="background-color: #EDDBC0; margin-left:2%;">
        <div class="container-fluid">
            <div class="d-flex justify-content-center" >
                <img width="45" class=" d-sm-block d-md-none" style="margin-right: 5px" height="45" src="{{url('/logo/icon.ico')}}" alt="">
                <a class="navbar-brand title" style="font-family: Noto Serif Gujarati;  "href="/patient">JGMarquez, RPsy</a>
            </div>
       
          <button style="" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"  aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

            <div style="font-family: Poppins; font-weight: 400;" class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/patient/homepage">HOME</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link active" href="/patient/about_us">ABOUT US</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/about_us">ABOUT US</a>
                        </li>
                    @endif
                    
                    @if (Auth::check())      
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/patient/profile/">PROFILE </a>
                        </li>      
                        
                        @if (Auth::user()->status == 'pending')
                            <li hidden class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/patient/appointment/">APPOINTMENT</a>
                            </li> 
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/patient/appointment/">APPOINTMENT</a>
                            </li> 
                        @endif
                        
                        
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/patient/billing/">BILLING</a>
                        </li>  

                        <form action="/logout" method="POST">
                            @csrf
                            <li class="nav-item" style="outline: none">
                                <button type="submit" class="logoutbutton nav-link ">LOGOUT</button>
                            </li>
                        </form>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/login">LOGIN</a>
                        </li>  

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/register">REGISTER</a>
                        </li>       
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>
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
                        <a href="https://www.facebook.com/jgmarquezpsych"> <img style="height: 5vw;width:5vw; margin-bottom:10px" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_6_et05wg.png" alt=""> </a>
                        <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 5vw;width:5vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
                    </div>
                </div>
            </section>
        </div>
    </footer>

    @yield('scripts')

</body>
</html>