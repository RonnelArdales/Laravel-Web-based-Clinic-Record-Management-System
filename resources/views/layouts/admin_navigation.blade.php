<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">
     <script src="https://code.highcharts.com/highcharts.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
     <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
     <script src="https://code.highcharts.com/modules/export-data.js"></script>
     <script src="https://code.highcharts.com/modules/accessibility.js"></script>
     <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Gujarati:wght@700&family=Poppins:wght@400;700&family=Song+Myung&display=swap" rel="stylesheet">

    <title>@yield('title',)</title>
    <link rel="icon"  href="{!! asset('logo/icon.ico') !!}"/>
     <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>



<body >                                    {{--d-flex--}}
     <div class="side-navbar active-nav justify-content-between flex-wrap flex-column" style="z-index:9" id="sidebar">
          <div class="p-2.5 mt-1 d-flex  justify-content-center" style="padding-bottom: 20px;  border-bottom: 2px solid gray ">
               <img style="border-radius: 100%; height:100px; width: 100px;   " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
          </div>
        
          <div class="overflow-auto" style="height: 70vh; border-bottom: 2px solid gray "> 
               @if (Auth::user()->usertype == 'admin')

                    @include('partials.admin_sidebar')

               @else

                    @include('partials.secretary_sidebar')

               @endif

          </div>

          <div class="btn-group dropup" style="width: 100%; margin-top:10px; margin-left:1px">
               <button type="button" style="text-align: start ;  display: flex; border:none; align-items: center;" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->profile_pic == null ) 
                         <img class=" dropdown" src="{{url('profilepic/defaultprofile.png')}}" width="35" height="35" style="border-radius: 100%"  alt="">
                    @else
                         <img class=" dropdown" src="{{url('profilepic/' . Auth::user()->profile_pic )}} " width="35" height="35"  alt="" style="border-radius: 100%">
                    @endif
                         <label style="margin-left:10px; color:white" for="">    {{Auth::user()->username}}</label>
                         <img style="margin-left:80px" src="{{url('logo/dropup.png')}}" width="10" height="10" alt="" >
               </button>
               <ul class="dropdown-menu"  style="width: 100%; background-color:#7a875c">
                    <form class="" action="/logout" method="POST" >
                         @csrf
                         <li class="my-1 mx-3">
                              <button type="submit" class="dropdown-btn">Logout </button>
                         </li>
                    </form>

                    @if (Auth::user()->usertype == "admin")
                         <li class="my-1 mx-3">
                              <a href="/admin/myprofile">My Profile</a>
                         </li>
                         <li class="my-1 mx-3">
                              <a href="/admin/myprofile/changepassword">Change password</a>
                         </li>
                    @else
                         <li class="my-1 mx-3">
                              <a href="/secretary/myprofile">My Profile</a>
                         </li>
                         <li class="my-1 mx-3">
                              <a href="/secretary/myprofile/changepassword">Change password</a>
                         </li>
                    @endif
               </ul>
          </div>
     </div>  

     <div class=" my-container active-cont">
          <div class="p-1 main overflow-auto ">
               {{-- <a style="background-color: #829460; padding:10px"  id="menu-btn">
                    <img width="30" height="30" src="{{url('/logo/menu.png')}}" alt="">
               </a> --}}
                         
               @yield('content')       
          </div>
     </div>

     <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     

     @yield('scripts')

     {{-- <script>
     var menu_btn = document.querySelector("#menu-btn");
     var sidebar = document.querySelector("#sidebar");
     var container = document.querySelector(".my-container");
     var main = document.querySelector(".main");
     menu_btn.addEventListener("click", () => {
     sidebar.classList.toggle("active-nav") + main.classList.toggle("add-left") ;
     container.classList.toggle("active-cont") ;
     });
     </script> --}}
</body>
</html>







