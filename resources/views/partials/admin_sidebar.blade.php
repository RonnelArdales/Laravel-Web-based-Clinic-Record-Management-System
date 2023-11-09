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
          <img class="icon" src="{{url('/logo/pendinguser.jpg')}}" alt=""> 
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
                   <img class=" dropdown icon" src="{{url('/logo/modeofpayment1.png')}}" alt=""> 
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