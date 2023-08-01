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

</head>

<style>

     .fc-body{
          background-color: #829460;
     }

     .labelang{
          font-family: 'Inter';
          font-size: 14px;
          margin: 3% 0 0 0; 
     }

     .nav-pills > li > a.adopt-tab.active {
          background-color: #EF476F;
          color: white;
          border: none;
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
          /* display:none; */
     }

     .fc-day-header{
          background-color: #829460;
          color: white;
     }

     .fc-body{
          border-color: #555;
     }

     .fc td {
          border-color: black;
     }
  
     input::-webkit-outer-spin-button,
     input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
     }
  
     .currency-wrap{
          position:relative;
     }
    
     .currency-code{
          position:absolute;
          top:7px;
          padding-left: 10px
     }
    
     .text-currency{
          padding:2px 22px;
          border:solid 1px #ccc;
          border-radius:5px;
     }

     .currency-wrap-payment{
          position:relative;
     }
    
     .currency-code-payment{
          position:absolute;
          top:3px;
          padding-left: 10px
     }
    
     .text-currency-payment{
          padding:2px 22px;
          border:solid 1px #ccc;
          border-radius:5px;
     }
    
     body{
          background-color:#829460;
          margin: 0px;
          padding: 0px;
     }
     .sidenav{
          position: fixed;
          /* new */
          height: 100vh;
          margin-left: 1%;
     }
     
     ul.no-bullet{
          list-style-type: none;
          margin: 0;
          padding:0;
     }
  
     .active-bar{
          color:black;
          border-radius: 25px;
          background-color: #EDDBC0;
     }

     .active-bar span{
          color:black;
     }
  
     .dropdown-container {
          display: none;
          /* background-color: ;
          padding: 6px 16px 16px 16px; */
     }
  
     .fa-caret-down {
          float: right;
          /* padding-right: 20px; */
     }
  
     @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
     }
  
     .btn2{
          height: 20px;
          padding: 1px;
     }
  
  /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
  
  
  /* Optional: Style the caret down icon */
  
  
  /* Some media queries for responsiveness */
  
     .side-navbar  a {

          /* new */
          padding: 12px 15px;
          text-decoration: none;
          font-size: 18px;
          color: white;
          display: block;
          border: none;
          background: none;
          justify-content: center;
          
          /* width: 13vw; */
          text-align: left;
          cursor: pointer;
          outline: none;
     
     }
  

     .create-button:hover{
          border-radius: 30px; 
          border: 2px solid #788859;
          width: 110px;
          height: 37px; 
          color:white; 
          background: #788859;
     }

     .create-button{
          background: #829460;
          border-radius: 30px; 
          color:white; 
          border:#829460;
          width: 110px;
          height: 37px;
     }

     .close_button:hover{
          background: #829460;
          border-radius: 30px; 
          color:white; 
          border:#67764c;
          width: 110px;
          height: 37px;
     }

     .close_button{
          border-radius: 30px; 
          border: 2px solid #829460;
          width: 110px;
          height: 37px; 
          color:#829460; 
          background:transparent;
     }
  
     .dropdown-btn {
          /* new */
          text-decoration: none;
          font-size: 1.3vw;
          color: white;
          display: block;
          border: none;
          background: none;
          width: 100%;
          cursor: pointer;
          outline: none;
          text-align: left;
          padding-left: 17px;
     }
     /* On mouse-over */
     .side-navbar a:hover, .dropdown-btn:hover {
          color:black;
          border-radius: 25px;
          padding: 12px 15px;
          background-color: #EDDBC0;
     }
  
     .icon{
          height: 13% ;
          width: 13% ;
     }

     .icon-dropdown{
          height: 13% ;
          width: 13% ;
     }
     
     .main{
          background-color: bisque;
          border-radius: 25px;
          /* width: 82vw; */
          min-height: 95vh;
          margin-top: 18px;
          margin-right: 20px;
          margin-bottom: 18px
     }
     .add-left{
          margin-left: 20px;
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
     td{
          height: -20vh;
     }
     th{
          text-align: center;
     }
  
     .tbody{
          height: 100px
     }
     .modal-xl{
          width: 2000px;
     }
     .table{
          height:100px;
     }
  
     .viewbody{
          height: 600px;
     }
  
     .modal-footer{
          bottom: 50%;
     }
  
     #calendar {
          margin: 0 auto;
          background-color: white;
     }
  
     /* width */
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
 
    .note-editable{
          min-height: 300px;
          background-color: white   
     }

     /*   dashboard  */

     .dropup:hover{
          background-color: bisque;
          color:black;
     }

     .dropup label:hover{
          color:black;
     }

     .side-navbar {
          width: 260px;
          height: 100%;
          position: fixed;
          margin-left: -300px;
          background-color:#829460 ;
          transition: 0.5s;
     }

     .my-container {
          transition: 0.4s;
     }
     .active-nav {
          margin-left: 0;
     }

     .active-cont {
          margin-left: 265px;
     }

     #menu-btn {
          color: #fff;
          margin-left: -4px;
          border-radius: 5px
     }

     .remove-left{
          margin-left: 0px
     }

     .dropdown{
          margin-left: 20px;
     }

     .tab-content{
          padding: 0px
     }
     .dataTables_filter  {
          float: left !important;
          margin-bottom: 10px;
          background: #EDDBC0;
     }
</style>

<body >                                    {{--d-flex--}}
     <div class="side-navbar active-nav justify-content-between flex-wrap flex-column" style="z-index:9" id="sidebar">
          <div class="p-2.5 mt-1 d-flex  justify-content-center" style="padding-bottom: 20px;  border-bottom: 2px solid gray ">
               <img style="border-radius: 100%; height:100px; width: 100px;   " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
          </div>
        
          <div class="overflow-auto" style="height: 70vh; border-bottom: 2px solid gray "> 
               @if (Auth::user()->usertype == 'admin')
                    <ul class="nav flex-column text-white w-100">
                         <li class="  my-1 mx-3 {{Request::is('admin/dashboard') ? 'active-bar' : '';}}">
                              <a href="/admin/dashboard"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/home_wvybu9.png" alt=""> 
                                   <span>Home</span> 
                              </a>
                         </li>

                         <li class=" my-1 mx-3  {{Request::is('admin/user') ? 'active-bar' : '';}}">
                              <a href="/admin/user"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                              <span>User</span> 
                              </a>
                         </li>

                         <li class=" my-1 mx-3  {{Request::is('admin/pendinguser') ? 'active-bar' : '';}}">
                              <a href="/admin/pendinguser"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                              <span>Pending User</span> 
                              </a>
                         </li>

                         <li class="  my-1 mx-3  {{Request::is('admin/appointment') ? 'active-bar' : '';}}">
                              <a href="/admin/appointment"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" alt="">
                                   <span>Appointment</span>
                              </a>
                         </li> 

                         <li class="  my-1 mx-3  {{Request::is('admin/queuing') ? 'active-bar' : '';}}">
                              <a href="/admin/queuing"> 
                                   <img class="icon" src="{{url('/logo/queuing.png')}}" alt="">
                                   <span>Queuing</span> 
                              </a>
                         </li>  

                         <li class=" my-1 mx-3 {{Request::is('admin/transaction') ? 'active-bar' : '';}}">
                              <a href="/admin/transaction"> 
                                   <img class="icon" src="{{url('logo/transaction.png')}}" alt="">
                                   <span>Transaction</span> 
                              </a>
                         </li> 
                    
                         <li class=" my-1 mx-3 {{Request::is('admin/billing') ||
                                             Request::is('admin/billing/viewBilling/*')
                         ? 'active-bar' : '';}}">
                              <a href="/admin/billing"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/billing_b1dkbm.png" alt=""> 
                                   <span>Billing</span>
                              </a>
                         </li>

                         <li class=" my-1 mx-3 {{Request::is('admin/consultation') ||
                                                  Request::is('admin/consultation/create') ||
                                                  Request::is('admin/consultation/viewrecords/*') ||
                                                  Request::is('admin/consultation/edit/*/*') ||
                                                  Request::is('admin/consultation/viewconsultation/*/*')
                                             
                         ? 'active-bar' : '';}}">
                              <a href="{{route('consultation.index')}}"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/consult_las4n9.png" alt=""> 
                                   <span>Consultation</span>
                              </a>
                         </li>

                         <li class=" my-1 mx-3 {{Request::is('admin/document') ? 'active-bar' : '';}}">
                              <a href="{{route('document.index')}}"> 
                                   <img class="icon" src="{{url('logo/documents.png')}}" alt=""> 
                                   <span>Documents</span>
                              </a>
                         </li>

                         <li class=" my-1 mx-3 {{Request::is('admin/reports/user') ||
                                             Request::is('admin/reports/appointment') ||
                                             Request::is('admin/reports/audit_trail') ||
                                             Request::is('admin/reports/billing')
                                                  ? 'active-bar' : '';}}">
                                                       <a href="#report" data-bs-toggle="collapse" >
                                                            <img class="icon" src="{{url('/logo/report.png')}}" alt=""> 
                                                            <span>Reports</span>  <i style="padding-top:5px" class="fa fa-caret-down"></i>
                                                  </a>
                         </li>

                         <ul class="{{Request::is('admin/reports/user') ||
                                        Request::is('admin/reports/appointment') ||
                                        Request::is('admin/reports/audit_trail') ||
                                        Request::is('admin/reports/billing')
                                                  ? 'show' : 'collapse';}} flex-column list-unstyled" id="report" data-bs-parent="#menu">

                              <li class="my-1 mx-3 {{Request::is('admin/reports/user') ? 'active-bar' : '';}}">
                                   <a  href="/admin/reports/user"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                                        <span>Users</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('admin/reports/appointment') ? 'active-bar' : '';}}">
                                   <a href="/admin/reports/appointment"> 
                                        <img class="icon dropdown " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" alt=""> 
                                        <span>Appointment</span>
                                   </a>
                              </li>

                              {{-- <li class="my-1 mx-3  {{Request::is('') ? 'active-bar' : '';}}">
                                   <a href="#"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/consult_las4n9.png" alt=""> 
                                        <span>Transaction</span>
                                   </a>
                              </li> --}}

                              <li class="my-1 mx-3  {{Request::is('admin/reports/billing') ? 'active-bar' : '';}}">
                                   <a href="/admin/reports/billing"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/billing_b1dkbm.png" alt=""> 
                                        <span>Billing</span>
                                   </a>
                              </li>

                              <li class="my-1 mx-3  {{Request::is('admin/reports/audit_trail') ? 'active-bar' : '';}}">
                                   <a href="/admin/reports/audit_trail"> 
                                        <img class="icon dropdown" src="{{url('logo/audittrail.png')}}" alt=""> 
                                        <span>Audit Trail</span>
                                   </a>
                              </li>
                    
                         </ul> 
     
                         <li class=" my-1 mx-3 {{ Request::is('admin/service') ||
                                                  Request::is('admidn/discount') ||
                                                  Request::is('admin/business_hours') ||
                                                  Request::is('admin/guestpage') ||
                                                  Request::is('admin/reservationfee') ||
                                                  Request::is('admin/modeofpayment') 
                                                  ? 'active-bar' : '';}}">
                              <a href="#setting" data-bs-toggle="collapse" >
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/settings_ttbpof.png" alt=""> 
                                   <span>Settings</span>  <i style="padding-top:5px" class="fa fa-caret-down"></i>
                              </a>
                         </li>

                         <ul class="{{Request::is('admin/service') ||
                                        Request::is('admin/discount') ||
                                        Request::is('admin/business_hours') ||
                                        Request::is('admin/guestpage') ||
                                        Request::is('admin/reservationfee') ||
                                        Request::is('admin/modeofpayment') 
                              ? 'show' : 'collapse';}} flex-column list-unstyled" id="setting" data-bs-parent="#menu">
                              
                              <li class=" my-1 mx-3  {{Request::is('admin/service') ? 'active-bar' : '';}}">
                                   <a href="{{ route('admin.service.index') }}"> 
                                        <img class="icon dropdown" src="{{url('/logo/service.png')}}" alt=""> 
                                        <span>Service</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('admin/discount') ? 'active-bar' : '';}}">
                                   <a href="{{route('admin.discount.index')}}"> 
                                        <img class="icon dropdown" src="{{url('/logo/discount2.png')}}" alt=""> 
                                        <span>Discount</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('admin/modeofpayment') ? 'active-bar' : '';}}">
                                   <a href="{{route('admin.modeofpayment.index')}}"> 
                                        <img class="icon dropdown" src="{{url('/logo/discount2.png')}}" alt=""> 
                                        <span style="font-size: 17.5px" >Mode of Payment</span>
                                   </a>
                              </li>

                              <li class="my-1 mx-3  {{Request::is('admin/business_hours') ? 'active-bar' : '';}}">
                                   <a href="/admin/business_hours"> 
                                        <img class="icon dropdown" src="{{url('/logo/businesshours.png')}}" alt=""> 
                                        <span>Business Hours</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('admin/guestpage') ? 'active-bar' : '';}}">
                                   <a href="{{route('admin.guestpage.index')}}"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296805/JG%20marquez/guestpage_zylemm.png" alt=""> 
                                        <span>Guestpage</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('admin/reservationfee') ? 'active-bar' : '';}}">
                                   <a href="{{route('admin.reservationfee.index')}}"> 
                                        <img class="icon dropdown" src="{{url('logo/reservationsettings.png')}}" alt=""> 
                                        <span>Reservation Fee</span>
                                   </a>
                              </li>
                         </ul>  
                    </ul>
               @else
                    {{--navigation bar for secretary--}} 
                    <ul class="nav flex-column text-white w-100">

                         <li class="  my-1 mx-3 {{Request::is('secretary/dashboard') ? 'active-bar' : '';}}">
                              <a href="/secretary/dashboard"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/home_wvybu9.png" alt=""> 
                                   <span>Home</span> 
                              </a>
                         </li>

                         <li class=" my-1 mx-3  {{Request::is('secretary/user') ? 'active-bar' : '';}}">
                              <a href="/secretary/user"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                                   <span>User</span> 
                              </a>
                         </li>

                         <li class=" my-1 mx-3  {{Request::is('secretary/pendinguser') ? 'active-bar' : '';}}">
                              <a href="/secretary/pendinguser"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                              <span>Pending User</span> 
                              </a>
                         </li>

                         <li class="  my-1 mx-3  {{Request::is('secretary/appointment') ? 'active-bar' : '';}}">
                              <a href="/secretary/appointment"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" alt="">
                                   <span>Appointment</span>
                              </a>
                         </li> 

                         <li class="  my-1 mx-3  {{Request::is('secretary/queuing') ? 'active-bar' : '';}}">
                              <a href="/secretary/queuing"> 
                                   <img class="icon" src="{{url('/logo/queuing.png')}}" alt="">
                                   <span>Queuing</span> 
                              </a>
                         </li>

                         <li class=" my-1 mx-3 {{Request::is('secretary/transaction') ? 'active-bar' : '';}}">
                              <a href="/secretary/transaction"> 
                                   <img class="icon" src="{{url('logo/transaction.png')}}" alt="">
                                   <span>Transaction</span> 
                              </a>
                         </li> 
               
                         <li class=" my-1 mx-3 {{Request::is('secretary/billing')  ? 'active-bar' : '';}}">
                              <a href="/secretary/billing"> 
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/billing_b1dkbm.png" alt=""> 
                                   <span>Billing</span>
                              </a>
                         </li>

                         <li class=" my-1 mx-3 {{ Request::is('secretary/reports/user') ||
                                                  Request::is('secretary/reports/appointment') ||
                                                  Request::is('secretary/reports/billing') 
                                                  ? 'active-bar' : '';}}">
                                                       <a href="#report" data-bs-toggle="collapse" >
                                                            <img class="icon" src="{{url('/logo/report.png')}}" alt=""> 
                                                            <span>Reports</span>  <i style="padding-top:5px" class="fa fa-caret-down"></i>
                                                  </a>
                         </li>

                         <ul class="{{Request::is('secretary/reports/user') ||
                                        Request::is('secretary/reports/appointment') ||
                                        Request::is('secretary/reports/audit_trail') ||
                                        Request::is('secretary/reports/billing')
                                        ? 'show' : 'collapse';}} flex-column list-unstyled" id="report" data-bs-parent="#menu">

                              <li class="my-1 mx-3 {{Request::is('secretary/reports/user') ? 'active-bar' : '';}}">
                                   <a  href="/secretary/reports/user"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/profile_mubmbi.png" alt=""> 
                                        <span>Users</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('secretary/reports/appointment') ? 'active-bar' : '';}}">
                                   <a href="/secretary/reports/appointment"> 
                                        <img class="icon dropdown " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296625/JG%20marquez/booking_te8ipg.png" alt=""> 
                                        <span>Appointment</span>
                                   </a>
                              </li>

                              <li class="my-1 mx-3  {{Request::is('secretary/reports/billing') ? 'active-bar' : '';}}">
                                   <a href="/secretary/reports/billing"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/billing_b1dkbm.png" alt=""> 
                                        <span>Billing</span>
                                   </a>
                              </li>
                         </ul> 

               
                         <li class=" my-1 mx-3 {{Request::is('secretary/service') ||
                                        Request::is('secretary/discount') ||
                                        Request::is('secretary/business_hours') ||
                                        Request::is('secretary/guestpage') ||
                                        Request::is('secretary/reservationfee') ||
                                        Request::is('secretary/modeofpayment') 
                                        ? 'active-bar' : '';}}">
                              <a href="#setting" data-bs-toggle="collapse" >
                                   <img class="icon" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296487/JG%20marquez/settings_ttbpof.png" alt=""> 
                                   <span>Settings</span>  <i style="padding-top:5px" class="fa fa-caret-down"></i>
                              </a>
                         </li>

                         <ul class="{{Request::is('secretary/service') ||
                                        Request::is('secretary/discount') ||
                                        Request::is('secretary/business_hours') ||
                                        Request::is('secretary/guestpage') ||
                                        Request::is('secretary/reservationfee') ||
                                        Request::is('secretary/modeofpayment') 
                                        ? 'show' : 'collapse';}} flex-column list-unstyled" id="setting" data-bs-parent="#menu">
                              
                              <li class=" my-1 mx-3  {{Request::is('secretary/service') ? 'active-bar' : '';}}">
                                   <a href="{{route('secretary.service.index')}}"> 
                                        <img class="icon dropdown" src="{{url('/logo/service.png')}}" alt=""> 
                                        <span>Service</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('secretary/discount') ? 'active-bar' : '';}}">
                                   <a href="{{route('secretary.discount.index')}}"> 
                                        <img class="icon dropdown" src="{{url('/logo/discount2.png')}}" alt=""> 
                                        <span>Discount</span>
                                   </a>
                              </li>

                              <li class="my-1 mx-3  {{Request::is('secretary/business_hours') ? 'active-bar' : '';}}">
                                   <a href="/secretary/business_hours"> 
                                        <img class="icon dropdown" src="{{url('/logo/businesshours.png')}}" alt=""> 
                                        <span>Business Hours</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('secretary/guestpage') ? 'active-bar' : '';}}">
                                   <a href="{{route('secretary.guestpage.index')}}"> 
                                        <img class="icon dropdown" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1676296805/JG%20marquez/guestpage_zylemm.png" alt=""> 
                                        <span>Guestpage</span>
                                   </a>
                              </li>

                              <li class=" my-1 mx-3 {{Request::is('secretary/reservationfee') ? 'active-bar' : '';}}">
                                   <a href="{{route('secretary.reservationfee.index')}}"> 
                                        <img class="icon dropdown" src="{{url('logo/reservationsettings.png')}}" alt=""> 
                                        <span>Reservation Fee</span>
                                   </a>
                                   </li>

                              <li class=" my-1 mx-3 {{Request::is('secretary/modeofpayment') ? 'active-bar' : '';}}">
                                   <a href="{{route('secretary.modeofpayment.index')}}"> 
                                        <img class="icon dropdown" src="{{url('/logo/discount2.png')}}" alt=""> 
                                        <span style="font-size: 17.5px" >Mode of Payment</span>
                                   </a>
                              </li>
                         </ul>  
                    </ul>
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







