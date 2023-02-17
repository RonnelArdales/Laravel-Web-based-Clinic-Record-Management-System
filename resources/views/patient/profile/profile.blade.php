@extends('layouts.navbar')
@section('content')
    

<h1 class="text-center text-[30px]">Profile</h1>


<label for="">profile picture</label>

<h6>first name: <label for="">{{Auth::user()->fname}}</label></h6> 



<h6>Middle name: <label for="">{{Auth::user()->mname}}</label> </h6> 



<h6>Last name: <label for="">{{Auth::user()->lname}}</label> </h6> 



<h6>birthday : <label for="">{{Auth::user()->birthday}}</label> </h6> 



<h6>address : <label for="">{{Auth::user()->address}}</label> </h6> 



<h6>gender : <label for="">{{Auth::user()->gender}}</label> </h6> 



<h6>Mobile No. : <label for="">{{Auth::user()->mobileno}}</label> </h6> 

 

<h6>email : <label for="">{{Auth::user()->email}}</label></h6> 



<h6>username: <label for="">{{Auth::user()->username}}</label> </h6>



<a href="/patient/profile/edit">change profile</a>

@endsection