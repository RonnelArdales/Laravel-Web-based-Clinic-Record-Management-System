
@extends('layouts.navbar')
@section('content')

<div class="container card border-0 shadow rounded-3 border border-dark w-50">

  <form class="row g-3 "  action="/store" method="POST">
    @csrf
    <h1 class="mt-5" >Register form</h1>
    <hr>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">First name</label>
      <input type="text" class="form-control" name="first_name" placeholder="First name">
      @error('first_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">Middle name</label>
      <input type="text" class="form-control" name="mname" placeholder="Middle name">
    </div>
    <div class="col-md-4">
      <label for="inputPassword4" class="form-label">last name</label>
      <input type="text" class="form-control" name="last_name" placeholder="Last name">
      @error('last_name')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-12">
      <label for="inputAddress" class="form-label">Address</label>
      <input type="text" class="form-control" name="address" placeholder="Address">
      @error('address')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">Birthday</label>
      <input type="date" class="form-control"   name="birthday" placeholder="Birthday">
      @error('birthday')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">gender</label>
      <select name="gender" class="form-control">
        <option value="">--select--</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      @error('gender')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-md-4">
      <label for="inputEmail4" class="form-label">Mobile no.</label>
      <input type="text" class="form-control" name="mobile_number" placeholder="mobile no." >
      @error('mobile_number')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
        <div class="col-6">
      <label for="inputAddress" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" placeholder="Username">
      @error('username')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Email</label>
      <input type="text" class="form-control" name="email" placeholder="Email">
      @error('email')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
      @error('password')
      <span  role="alert" class="block mt-5 pb-4 text-danger">{{$message}}</span>
      @enderror
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Confirm-Password</label>
      <input type="text" class="form-control" name="password_confirmation"  placeholder="Confirm password">
    </div>
    <div class="col-12 text-right">
      <button type="submit" class="btn btn-primary mb-3 mt-2">Register</button>
    </div>
  </form>

</div>

@endsection