@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
        <h1><b>GUEST PAGE</b></h1>
    </div>
    <p style="font-size: 18px; margin-bottom:10px">Edit page</p>

    <hr>

    <div class="container">
        @foreach ($errors->all() as $message) 
        <div class="alert alert-danger error" id="error">{{ $message }}</div>
        @endforeach

        @if (Auth::user()->usertype === "admin")
            <form action="{{route('admin.guestpage.update', $guestpages->id)}}" method="POST" enctype="multipart/form-data">
        @else
            <form action="{{route('secretary.guestpage.update', $guestpages->id)}}" method="POST" enctype="multipart/form-data">
        @endif
                @method('PUT')
                @csrf
                <div class="row"  >
                    <div class="col-sm" style="width:3">
                        <div class="form-group">
                            <label style="font-size: 20px" for="">Title</label> <br>
                            <input  type="text" value="" class="image_status" id="image_status" name="image_status" hidden>
                            <input type="text" class=" text-gray-700 focus:outline-none border-b-4 border-gray-400" name="title" style="width:500px; border-radius:10px  ;border:none ;background: rgba(208, 184, 148, 1);
                            ; padding:6px" readonly style="" value="{{$guestpages->title}}">
                        </div>
                        <div class="form-group" style="width:800px; margin-top: 40px">
                            <label style="font-size: 20px" for="">Content</label><br>
                            <textarea name="content" style="padding: 30px" id="content" cols="30" rows="10" value=" {{$guestpages->content}}"> {{$guestpages->content}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm " style="width:50px; margin-left:20px; margin-right:20px">
                        <div class=" d-flex justify-content-center"> 
                            <button style="padding-left:40px; padding-right:40px;padding-top:10px; padding-bottom:10px; border-radius:20px; border:none; outline:none ;background-color: rgba(130, 148, 96, 1); margin-top:30px;color:white
                            "  >Update</button>
                        </div>
                        <hr>
                            @if($guestpages->image == "none")
                                   <div class="column justify-content-center  " style="margin-top:20px">
                                    <h6 style="text-align: center">Featured image</h6>
                                    <div style="text-align: center">
                                        <p>none</p>
                                    </div>
                                </div> 
                            @elseif($guestpages->image == "")
                                <div class="column justify-content-center  " style="margin-top20px">
                                    <h6 style="text-align: center">Featured image</h6>
                                    <div style="text-align: center">
                                        <img style="" width="200"  height="200" src="{{url('/guestpage/noimage.png')}}" alt="">
                                    </div>
                                </div> 
                                <input style="border:1px; border-color:black; margin-top:10px" type="file" style="width: 450px" id="image" name="image"><br> 
                            @else
                            <div class="column justify-content-center " style="margin-top:20px;">
                                <h6 style="text-align: center">Featured image</h6>
                                <div style="text-align: center" class="image_featured">
                                    <img style="" width="200"  height="200" src="{{url('/guestpage/'.$guestpages->image)}}" alt="">
                                </div>
                                <div style="text-align: center; display:none" class="image_noicon">
                                    <img style="" width="200"  height="200" src="{{url('/guestpage/noimage.png')}}" alt="">
                                </div>
                            </div>
                            <div style="text-align: center">
                                <button type="button" style="color: red; text-decoration:none"  class="remove btn btn-link" >Remove</button>
                                <button type="button" style="color: chocolate; text-decoration:none"  class="btn btn-link change" >change</button>
                                <input style="border:1px; border-color:black; display:none" class="image" type="file" style="width: 450px" id="image" name="image"><br>
                            </div>  
                            @endif
                    </div>
                </div>
            </form>
    </div>
    
</div>
@endsection

@section('scripts')

<script src="{{mix('js/system_settings/guestpage/edit.js')}}"></script>

@endsection