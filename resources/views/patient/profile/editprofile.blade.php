@extends('layouts.navbar')
@section('content')
    
<h1 class="text-center text-[30px]">Edit Profile</h1>
<div class="h-screen bg-[#EDDBC0]">
    <form action="/patient/profile/update/{{Auth::user()->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-5 pt-6  ">
            <div class=" columns-1 sm:columns-2">
            
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >first Name</label>
            <input class="bg-white rounded  focus:outline-none " value="{{Auth::user()->fname}}" type="text" name="fname"> 
            @error('fname'){{$message}}@enderror
            <br>
    
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Middle name</label>
            <input class="bg-white rounded  focus:outline-none " value="{{Auth::user()->mname}}" type="text" name="mname">
            @error('mname'){{$message}}@enderror
            <br>
    
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Last name</label>
            <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->lname}}" type="text" 
            name="lname">
            @error('lname'){{$message}}@enderror
            
            <br>
            
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Birthday</label>
            <input class="bg-white rounded  focus:outline-none" type="date" value="{{Auth::user()->birthday}}" name="birthday">
            @error('birthday'){{$message}}@enderror
            <br>
            
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Address</label>
            <input class="bg-white rounded  focus:outline-none" type="text" value="{{Auth::user()->address}}"  name="address">
            @error('address'){{$message}}@enderror
            <br>
    
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Gender</label>
            <select name="gender">
                <option value="" {{Auth::user()->gender == "" ? 'selected' : ''}}></option>
                <option value="Male" {{Auth::user()->gender == "Male" ? 'selected' : ''}}>Male</option>
                <option value="Female" {{Auth::user()->gender == "Female" ? 'selected' : ''}}>Female</option>
              </select>
              @error('gender'){{$message}}@enderror
            <br>
            
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mobile no.</label>
            <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->mobileno}}"  type="text" name="mobileno">
            @error('mobileno'){{$message}}@enderror
            <br>
    
            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >email</label>
            <input class="bg-white rounded  focus:outline-none" value="{{Auth::user()->email}}" type="email" name="email">
            @error('email'){{$message}}@enderror
            <br>
    
            {{-- <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Username</label>
            <input class="bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 
            border-gray-400 mg-5" type="text" name="username">
            @error('username'){{$message}}@enderror
            <br>

            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >old Password</label>
            <input class="bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 
            border-gray-400 mg-5" type="text" name="username">
            @error('username'){{$message}}@enderror
            <br>
    
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" for="password" >Password</label>
            <input class="bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="password" name="password" >
            @error('password'){{$message}}@enderror
            <br>
    
            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3" for="password_confirmation" >Confirm Password</label>
            <input class="bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="text" name="password_confirmation">
            @error('password_confirmation'){{$message}}@enderror
            </div> --}}
    
          <button class="p-2 w-30 bg-[#829460]  mt-7 rounded" type="submit">update</button>
          </form>
        </div>
    
    </div>
         
          </form>
        </div>
    
    </div>



@endsection