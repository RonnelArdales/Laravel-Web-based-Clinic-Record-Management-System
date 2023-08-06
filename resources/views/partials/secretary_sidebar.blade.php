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