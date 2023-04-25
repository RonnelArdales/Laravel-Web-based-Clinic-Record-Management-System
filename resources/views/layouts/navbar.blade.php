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

    <title>@yield('title',)</title>
    <link rel="icon"  href="{!! asset('logo/icon.ico') !!}"/>
</head>
<style>

  /* .fc-widget-content{
    background-color: #829460;
  } */

  
  /* .billing-cancel{
    background: transparent;
    text-decoration:none;
    border-radius: 30px; 
    color:#829460; 
    border: 2px solid #829460;
    display:inline-block;
    text-align:center;
    vertical-align:top;
    width: 110px;
    height: 37px; 
    margin-right:20px

  } */

  /* Default font sizes */
/* body {
  font-size: 16px;
}

h1 {
  font-size: 32px;
} */

/* Media query for smaller screens */
/* @media only screen and (max-width: 767px) {
  body {
    font-size: 14px;
  }

  h1 {
    font-size: 28px;
  }
} */

/* Media query for larger screens */
/* @media only screen and (min-width: 1200px) {
  body {
    font-size: 18px;
  }

  h1 {
    font-size: 36px;
  }
} */
    body{
        margin: 0%;
        padding: 0%;
        background-color: #EDDBC0;
    }
    .logoutbutton{
      background-color: #EDDBC0;
      border: 0;
      background: none;
      outline: none;
      color: black;
    }
    .spinner {
    position: fixed;
    z-index: 1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 50px;
    height: 50px;
    margin: auto;
  }

  .currency-wrap{
      position:relative;
    }
    
    .currency-code{
      position:absolute;
      top:3px;
      padding-left: 10px
    }
    
    .text-currency{
      padding:2px 22px;
      border:solid 1px #ccc;
      border-radius:5px;
    }

    .fc-day.fc-today{
      background-color: aliceblue;
    }

    #calendar {
    max-width: 1200px;
    max-height: 800px;
    margin: 0 auto;
    background-color: white;
  }
  .info{
    margin-right: 20px;
    width: 100px;
  }

  .fc-body{
    border-color: #555;
  }

  .fc td {
    border-color: black;
}
  footer{
    color:white;
    border-radius: 55px 55px 0px 0px;
    background-color: #829460;
    padding: 0% 2% 0% 2%;
        }
        /* flex-direction:row; padding: 0% 2% 0% 2%;
            bottom:0; left: 0; right:0; font-family: Poppins; background-color: #829460; height:auto; width:100%; color:white;border-radius: 55px 55px 0px 0px; */
        .column1, .column2 , .column3, .column4 {
            width: 25%;
            height: auto;
        }

.modalCenter{
  top:50% !important ;
  transform: translateY(-50%) !important;
}

.view1{
    background: rgba(0, 0, 0, 0);
    border: none;
    pointer-events: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
  }

  @media (min-width: 1120px) {
  .collapse.dont-collapse-lg {
    display: block;
    height: auto !important;
    visibility: visible;
  }

  .speakforyou{
    max-width:640px;
  }
}

@media (min-width: 768px) {
    .button-size{
      font-size: 1.5vw;
    }
    .title{
  font-size: 1.75rem;
 }
  
}

@media (max-width: 768px) {
    .button-size{
      font-size: 10px;
    }
    .title{
     padding-top: 7px;
  font-size: 1.4rem;
 }
}

@media (max-width: 767px) {
    .button-size{
      font-size: 10px;
    }

}

@media (max-width: 992px) {
    .button-size{
      font-size: 10px;
    }
}

@media (min-width: 1120px) {
    .speakforyou{
      width: 100%
    }
}

@media screen and (min-width:0px) and (max-width:1180px){


}

::-webkit-scrollbar {
    width: 10px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f1f1; 
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #888; 
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #555; 
  }
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
                  <li class="nav-item">
                    <a class="nav-link active" href="/contactus">CONTACT US</a>
                  </li>
                  @else
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">HOME</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/about_us">ABOUT US</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/contactus">CONTACT US</a>
              </li>
              @endif
    
      
                  
              @if (Auth::check())      
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/profile/">PROFILE </a>
                  </li>      
                  
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/appointment/">BOOK NOW</a>
                  </li> 
                  
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/patient/billing/">BILLING</a>
                  </li>  

                  <form action="/logout" method="POST">
                    @csrf
                    <li class="nav-item" style="outline: none">
                        <button type="submit" class="logoutbutton nav-link ">LOGOUT</button>
                    </li>
                    </form>
                  {{-- <li class="nav-item">
                    <a class="nav-link mr-20" href="#">welcome {{Auth::user()->fname}}</a>
                  </li> --}}
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

      <footer
      class="text-center text-lg-start text-white"
      
      >
<!-- Grid container -->
<div class="container p-4 pb-0">
  <!-- Section: Links -->
  <section class="">
    <!--Grid row-->
    <div class="row">
      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" style="text-align:center">
        <h6 class="text-uppercase mb-4 font-weight-bold">
          ADDRESS
        </h6>
        <p>
          2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Philippines
        </p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none" />

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3" style="text-align:center">
        <h6 class="text-uppercase mb-4 font-weight-bold">CONTACT US</h6>
        <p>
         09171732844 - GLOBE
        </p>
        <p>
          090983992102 - SMART
        </p>
    
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none" />

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3" style="text-align:center">
        <h6 class="text-uppercase mb-4 font-weight-bold">
          EMAIL US
        </h6>
        <p>
          jgmarquez.psych@gmail.com
        </p>
      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none" />

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mb-md-2 mx-auto mt-3 mb-2" style="text-align:center">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <a href="https://www.facebook.com/jgmarquezpsych"> <img style="height: 5vw;width:5vw; margin-bottom:10px" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_6_et05wg.png" alt=""> </a>
        {{-- <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
        <a href=""> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_5_gjmers.png" alt=""> </a> --}}
      </div>
      <!-- Grid column -->
    </div>
    <!--Grid row-->
  </section>
  <!-- Section: Links -->
  
  <!-- Section: Copyright -->
</div>
<!-- Grid container -->
</footer>

      {{-- <footer style="padding:30px">
        <div class="container-fluid row" >
          
              <div class="col-sm" style="text-align:center;">
                <p style="font-weight: 700; font-size: 1.5vw;">ADDRESS</p>
                <p style="font-size: 1.1vw">2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Philippines</p>
              </div>
              <div class="col-sm " style="text-align:center;">
                <p style=" font-weight: 700;font-size: 1.5vw;">CONTACT US</p> 
                <p style="font-size: 1.1vw">09171732844 - GLOBE <br>
                  090983992102 - SMART
                </p>
              </div>
          
   
          <div class="col-sm " style="text-align:center;">
            <p style="font-weight: 700;font-size: 1.5vw;">EMAIL US</p>
            <p style="font-size: 1.1vw">jgmarquez.psych@gmail.com</p>
          </div>
          <div class="col-sm " style="text-align:center;">
            <p style="font-weight: 700;font-size: 1.5vw;">SOCIAL MEDIA</p>
            
            <div class="social" style="margin:0%; padding:0%;">
                <a href="https://www.facebook.com/jgmarquezpsych"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_6_et05wg.png" alt=""> </a>
                <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
                <a href=""> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_5_gjmers.png" alt=""> </a>
            </div>
          </div>
        </div>
      </footer> --}}



      {{-- <footer>
        
        <div class="column1" style="text-align:center; ">
            <p style="font-weight: 700; font-size: 1.5vw;">ADDRESS</p>
            <p style="font-size: 1.1vw">2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Philippines</p>
        </div>

        <div class="column2" style="text-align:center;">
            <p style=" font-weight: 700;font-size: 1.5vw;">CONTACT US</p> 
            <p style="font-size: 1.1vw">09171732844 - GLOBE <br>
               090983992102 - SMART
            </p>
        </div>

        <div class="column3" style="text-align:center;">
            <p style="font-weight: 700;font-size: 1.5vw;">EMAIL US</p>
            <p style="font-size: 1.1vw">jgmarquez.psych@gmail.com</p>
        </div>

        <div class="column4" style="text-align:center;">
            <p style="font-weight: 700;font-size: 1.5vw;">SOCIAL MEDIA</p>
            
            <div class="social" style="margin:0%; padding:0%;">
                <a href="https://www.facebook.com/jgmarquezpsych"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_6_et05wg.png" alt=""> </a>
                <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
                <a href=""> <img style="height: 4vw;width:4vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_5_gjmers.png" alt=""> </a>
            </div>
        </div>
      </footer> --}}
</body>


</html>