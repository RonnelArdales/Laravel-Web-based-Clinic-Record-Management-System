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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title',)</title>
    <link rel="icon"  href="{!! asset('logo/icon.ico') !!}"/>
</head>
<style>

.swal2-popup {

height: auto;
background-color: #EDDBC0;
}

.container1{
    width:77%;height: auto;
    
    align-self: center;margin-bottom: 5%;

  }
  .divngpamagat1{
    margin-top:2.5%;padding:0;
    margin-bottom: 3%;
  }
  .pamagat{
   margin: 0 0 1% 0%;
   font-size: 32px;
   padding:0;
   line-height:0%;
   font-weight: 800;
  }
  .linya{
    border: 1px solid rgba(0, 0, 0, 0.3);width:100%;align-self:center;margin:1% 0 1% 0;
  }
  .divngpamagat2{
   position: absolute;
   visibility: hidden;
   text-align: center;
   align-self: center;
    line-height:0%;
    margin: 0;
    padding: 0;
    background-color: #EDDBC0;
    top: 4%;
  }
  .form-label{
    margin: 4.5% 0 0 0 ;padding:0;font-size: 14px;
  }
    @media (max-width: 578px) {
  
  .divngpamagat1{
    visibility: hidden;
  }
  .divngpamagat2{
    visibility: visible;
  }
  .pamagat2{
    font-size: 25px;
    margin:0;
    line-height:0%;
   font-weight: 800;
  }
  .linya{
    margin:15px 0 2% 0;
  }
  .form-label{
    margin: 1% 0% 0% 0%;
  }

}

  

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

    .fc-day {
      background-color: #829460;
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



  /* ---------------------HOMEPAGE CSSS------------------------------------- */
  .bgpic{
        height:50vw;
        width:100%;
        background-image:url('https://res.cloudinary.com/uhno-dos-tres/image/upload/v1683471986/asdasdasada_beggm7.png');
        background-repeat: no-repeat;
        background-size:cover;
        background-position:center;
        background-attachment:scroll;
    }
    .btnregister{
      font-size: 1.5vw;
      text-decoration:none; font-weight:900; font-family:Poppins; background-color: #829460; text-align:center; color:white;   line-height: 1vw; border-radius: 2vw 0vw;margin-left: 5%; padding:0.5vw 1vw 0.5vw 1vw;
    }
    .btnlogin{
        font-size: 1.5vw;
        text-decoration:none; font-family:Poppins; font-weight:900; text-align:center; color:#829460; border: 0.2vw solid; line-height: 1vw;  border-radius: 2vw 0vw; margin-left: 0.5%; padding:0.4vw 2vw 0.4vw 2vw;
    }
    .title{
  font-size: 1.75rem;
 }
    .textpage1{
        margin-left:3%;margin-top:5%; margin-right:3%;
    }
    .speak{
    font-size: 6vw; margin-left:3%; margin-top:2.5rem; font-family:Song Myung; color:black;
    }
    .werehere{
        font-size:2.8vw; margin-left:8.5%; margin-top: -2%; font-family:Song Myung; color:black;
    }
    .speakforyou{
        margin-left:1.25rem; margin-right:1.25rem ;  margin-bottom: 3%;
    }
    .btnloginregister{
        margin-top: 25px;
    }
    .whatwe{
        color: white; font-size: 2vw;font-weight:700;
    }
    .servicescontainer{
        width: 100%; height: 55vw; background-color:#829460; text-align:center; font-family:Poppins;color:white;
    }
    .servicescontainer2{
        display: flex;flex-direction:row; justify-content: center;
    }
    .servicestitle{
        padding-top: 3vw; font-size:1.2vw;color:#EDDBC0;font-weight:700;
    }
    .brownshape{
        margin-left:1% ;margin-right:1%;background-color: #AA8B56;  border-radius:500px 500px 0 0; height:25vw ; width:15vw;padding:2%; padding-top:0%;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.25);
    }
    .whiteline{
        margin:auto; height: 0.5%; width:35%; border: 0; background: white;
    }
    .servicesimg{
        height:5vw; width:5vw; margin-bottom:5%;
    }
    .txtbrown124{
        text-align: left;font-size:1vw;
    }
    .txtbrown3{
        text-align:center; font-size:1.5vw; 
    }
    .undertxt{
        margin-top:3%;font-size:1.3vw;
    } 
    .colcontainer{
        display: flex;flex-direction:row; justify-content: center;margin-top:5%; 
    }
    .colcontainer2{
        display: flex; justify-content: center;margin-top:5%; 
    }
    .gettoknow{
        padding-top: 3vw; font-size:1.2vw;color:#395144;font-weight:700;
    }
    .aboutimg{
        height: 19vw; width:20vw; margin-bottom:5%;
    }
    .abouttxtcontainer{
        font-family:'Song Myung';font-weight: 400;  margin-bottom:20px;
    }
    .abouttxt{
        font-size: 1.3vw; margin-bottom:1%;text-align:justify;
    }
    .blackline{
        margin:auto;  width:35%; border: 0;border: 2px solid #000000;
    }
    .aboutreadmore{
        font-size: 1.5vw; text-decoration:none;color:black;font-weight: 900; text-align:center;
    }
    .aboutus{
        color: black ; font-size: 2vw;font-weight:700;
    }
    .docimg{
        height: 35vw; width:31vw;border-radius: 10% 0px;vertical-align: middle;
    }
    .doccontainer1{
        display: flex;flex-direction:row; justify-content:right;align-items:center;
         flex-wrap: wrap;
    }
    .doccontainer2{
        display: flex;flex-direction:row; justify-content:left;align-items:center;
         flex-wrap: wrap; 
         
    }
    .doctxt{
       text-align: justify; margin-bottom: 3%; color:white; font-family:'Song Myung';font-weight: 400;
    }
    .whyspeakimg{
        height: 28vw; width:38vw;
    }
    .whycontent{
         font-weight: 400; ;margin-top:8%; margin-bottom:5%;
    }
    .imgwhycontainer{
        align-self:auto
    }
    .whytitle{
        font-family: 'Poppins'; font-style: normal; font-weight: 700; color:black; font-size:2.5vw;margin-bottom:0%; text-align:center;
    }
    @media(max-width: 1269px) {
        .bgpic {
            background-size:contain;
            height: auto;
        }
        .textpage1{
        background-color:#eddbc0bb;
        }
        .btnlogin{
        line-height: 30px;
        font-size: 20px; 
    }
    .btnregister{
        line-height: 30px;
        font-size: 20px;
    }
    .btnloginregister{
        margin-bottom: 5%;
    }
    .servicescontainer{
        height: auto;

    }
    .whiteline{
        border: 1px solid #FFFFFF;
    }
    .brownshape{
        margin-top:5%;
    }
    .undertxt{
        font-size: 15px;
        padding-bottom: 5%;
    }
    .docimg{
        width: 391px;
        height: 456px;
    }
  
    .doccontainer1{
        justify-content:center;
     }
     .whyspeakimg{
        height: 386px;
        width: 586px;
     }
  
}   

    @media(max-width: 769px ) {
        .speak{
            font-size: 80px;
        }
        .werehere{
            font-size: 45px;
        }
        .servicestitle{
            font-size: 15px;
            line-height: 0 ;
        }
        .servicescontainer{
            padding-top: 35px;
        }
         .brownshape{
            height: 315px ; width:224px;
        }
        .servicesimg{
            height: 71px;width: 77px;
        }
        .txtbrown124{
            font-size: 15px;
        }
        .txtbrown3{
            font-size: 24px;
        } 
        .whatwe{
            font-size: 25px;
            line-height: 20px;
        }
        .aboutimg{
            width: 291px;
            height: 235px;
        }
        .abouttxt{
            font-size: 15px;
            padding: 0 3% 0 3%;
        }
        .aboutreadmore{
            font-size: 15px;
            line-height: 60px;
        }
        .aboutus{
            font-size: 25px;
            line-height: 20px;
        }
        .gettoknow{
            font-size: 10px;
            line-height: 0;
        }
        .docimg{
        width: 291px;
        height: 356px;
    }
    .whyspeakimg{
        width: 455px;
        height: 265px;

    }
    .imgwhycontainer{
        text-align: center;
    }
    .whytitle{
        font-size: 25px;
    }
     }
     @media(max-width: 481px ) {
        .speak{
            font-size: 70px;
        }
        .werehere{
            font-size: 30px;
        }
        }
        @media (max-width:451px){
            .brownshape{
            height: 315px ; width:154px;
        }
        .servicesimg{
            height: 51px;width: 57px;
        }
        .txtbrown124{
            font-size: 13px;
        }
        .txtbrown3{
            font-size: 24px;
        }
        .undertxt{
          font-size: 13px;
          padding:0 2% 10% 2%;
        }
        .whatwe{
            font-size: 20px;
        }
        }
        @media(max-width: 327px) {
            .speakforyou{
            margin: 0;
            font-size: 15px;
        }
        .speak{
            font-size: 50px;
        }
        .werehere{
            font-size: 25px;
        }
        .brownshape{
            height: 400px ; width:134px;
        }
        .servicesimg{
            height: 51px;width: 57px;
        }
        .txtbrown124{
            font-size: 15px;
        }
        .txtbrown3{
            font-size: 24px;
        }  
        .docimg{
            width: 191px;
            height: 256px;
    } 
      
    }
        @media(max-width:288px) {
            .speakforyou{
                display: none;
            }
            .docimg{
        width: 141px;
        height: 206px;
    }

        }

        @media(max-width:400px) {
            .whyspeakimg{
                width: 300px;
                height: 250px;
            }
        }
    /* -------------------HOMEPAGE CSS END------------------------------------------- */
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
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3" style="text-align:center; color:white">
        <h6 class="text-uppercase mb-4 font-weight-bold">
          ADDRESS
        </h6>
        {{-- <p>
          2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Philippines
        </p> --}}
        {!! $address->content !!}
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
        <a href="https://www.instagram.com/jgmarquezpsych/?igshid=YmMyMTA2M2Y%3D&fbclid=IwAR2e7HVw8Gctwx_ctM0Tkhue3PqgGg-UJuEY8e7ssLyEbtip0Y3YSeqIgWA"> <img style="height: 5vw;width:5vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676299299/JG%20marquez/image_4_dicjnk.png" alt=""> </a>
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






      @yield('scripts')

</body>


</html>