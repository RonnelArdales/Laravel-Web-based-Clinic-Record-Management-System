
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


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
    /* border-right: 3;
    height: 100vh;
    border-color: blue;
    padding-right: 15px;
    padding-left: 15px;
    width: 300px;
    background-color: #829460; */
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

  .active {
    background-color: bisque;
  color: black;
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

.sidenav a {
  /* padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: black;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none; */

  /* new */
  padding: 6% 3% 6% 6%;
  text-decoration: none;
  font-size: 1.3vw;
  color: white;
  display: block;
  border: none;
  background: none;
  width: 13vw;
  text-align: left;
  cursor: pointer;
  outline: none;
  
}


.dropdown-btn {
  /* padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: black;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none; */

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
  padding-left: 23px;
}
/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color:black;
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
  background-color: 
  #EDDBC0;
}

.icon{
  height: 13% ;
  width: 13% ;
}

.main{
  background-color: bisque;
    border-radius: 25px;
    width: 80vw;
    min-height: 94vh;
    margin-left: 280px;
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

.table{
  
}

.tbody{
  height: 100px
}
.modal-xl{
width: 2000px;


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

</style>

<div class="whole d-flex d-flex-1">

<h1>upload file</h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>filename</th>
                
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody >
                @if (count($uploads)> 0 )
                @foreach ($uploads as $upload)
                <tr class="overflow-auto">
                    <td>{{$upload->id}}</td>
                    <td>{{$upload->file}}</td>
                    <td>
                        <a href="upload/show/{{$upload->id}}">view</a>
                        <a href="upload/download/{{$upload->file}}">download</a>
                            {{-- <button class="edit btn btn-primary btn-sm">show</button>   
                            <button type="button" value="" class="edit btn btn-primary btn-sm">Edit</button>   
                            <button type="button" value="" class="edit btn btn-primary btn-sm">Edit</button>    --}}
                    {{-- <button type="button" value="{{$service->servicecode}}" class="edit btn btn-primary btn-sm">Edit</button>
                    <button type="button" value="{{$service->servicecode}}" class="delete btn  btn-danger btn-sm">delete</button></td> --}}
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" style="text-align: center;">No Service Found</td>
              
                  </tr>
                   
                @endif
              
            </tbody>
        </table>
    
    </div>
 
</div>


</div>
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
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
    </script>

@yield('scripts')