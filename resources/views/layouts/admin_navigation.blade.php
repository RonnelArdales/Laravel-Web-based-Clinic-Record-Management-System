
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}

    {{-- //csrf token --}}

    <title>Document</title>
</head>
<body>
    
</body>
</html>



<style>
    body{
        background-color:#829460;
    }
  .sidenav{
    /* margin-top: 50px; */
    border-right: 3;
    height: 100vh;
    border-color: blue;
    padding-right: 15px;
    padding-left: 15px;
    width: 300px;
background-color: bisque;
    position: fixed;
  }
  .active {
  background-color: 
#829460;
  color: black;
}
.btn2{
  height: 20px;
  padding: 1px;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: ;
  padding: 6px 16px 16px 16px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 20px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

ul.no-bullet{
    list-style-type: none;
    margin: 0;
    padding:0px
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: black;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  
}


.dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: black;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}
/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color:black;
  
  background-color: 
#829460;
}

.main{
    width: 165vh;
    height: 94vh;
    margin-left: 320px;
    margin-top: 20px;
    margin-right: 20px;
    margin-bottom: 20px
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

</style>

<div class="d-flex d-flex-1">

<aside id="sidebar" class="sidenav border-right border-dark">
                
    <div class="p-2.5 mt-3 d-flex  justify-content-center">
        <h1>Logo</h1>
    </div>
    <hr>
    @if (Auth::user()->usertype == 'admin')
    <ul class="no-bullet">
      <li class="  my-2 mx-3  {{Request::is('admin/dashboard') ? 'active' : '';}}">
        <a href="/admin/dashboard"><i>dashboard</i> </a>
    </li>
        <li class=" my-2 mx-3  {{Request::is('admin/profile') ? 'active' : '';}}">
            <a href="/admin/profile"><i>Profile</i> </a>
        </li>
        <li class=" my-2 mx-3  {{Request::is('admin/appointment') ? 'active' : '';}}">
            <a href="/admin/appointment"><i></i>appointment </a>
        </li>  
        <li class=" my-2 mx-3 {{Request::is('dashboard') ? 'active' : '';}}">
            <a href="/admin/dashboard"><i>Booking</i> </a>
        <li>
            <button class="btn dropdown-btn rounded">settings 
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-container">
                <a href="/admin/service">service</a>
                <a href="/admin/discount">discount</a>
                <a href="#">Guest Page</a>
              </div>
        </li>
          <form action="/logout" method="POST">
            @csrf
            <li class="nav-item">
                <button type="submit" class="btn dropdown-btn rounded">LOGOUT</button>
            </li>
            </form>
            <li class=" my-2 mx-3 {{Request::is('dashboard') ? 'active' : '';}}">
              <a href="/admin/dashboard"><i>Reports</i> </a>
          <li>
  </ul>
  @else
  <ul class="no-bullet">
    <li class="  my-2 mx-3  {{Request::is('secretary/dashboard') ? 'active' : '';}}">
      <a href="/secretary/dashboard"><i>dashboard</i> </a>
  </li>
      <li class=" my-2 mx-3  {{Request::is('secretary/profile') ? 'active' : '';}}">
          <a href="/secretary/profile"><i>Profile</i> </a>
      </li>
      <li class=" my-2 mx-3  {{Request::is('secretary/appointment') ? 'active' : '';}}">
          <a href="/secretary/appointment"><i></i>appointment </a>
      </li>  
      <li class=" my-2 mx-3 {{Request::is('') ? 'active' : '';}}">
          <a href="/secretary/dashboard"><i>Booking</i> </a>
      <li>
          <button class="btn dropdown-btn rounded">settings 
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <a href="/secretary/service">service</a>
              <a href="/secretary/discount">discount</a>
              <a href="#">Guest Page</a>
            </div>
      </li>
        <form action="/logout" method="POST">
          @csrf
          <li class="nav-item">
              <button type="submit" class="btn dropdown-btn rounded">LOGOUT</button>
          </li>
          </form>
</ul>

    @endif

</aside>

<main class="main  border overflow-auto ">
    @yield('content')
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          // if(Request::is('admin/appointment')){
          //   this.classList.toggle("active");
          //   dropdownContent.style.display = "none";
          // }
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script>

@yield('scripts')


</div>