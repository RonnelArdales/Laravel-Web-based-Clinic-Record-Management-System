@extends('layouts.navbar')
@section('title', 'Homepage')
@section('content')
<style>
    .slant-text {
        display: inline-block;
        transform: rotate(-15deg);
        position:fixed;
        top:200px;
        left:500px;
        text-align: center
    }
</style>

@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#829460',
            confirmButtonBorder: '#829460',
        });
    </script>
@endif

<div class="container-fluid" style="padding: 0px" >
    <div class="first-div-container">
        <div class="first-div-content-bgcolor">
            <div style="display: flex; flex-direction:row" class="container-fluid">
                <div style=" "class="collapse dont-collapse-lg right-top-container"> 
                    <img style=" " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
                    <h1> PSYCHOLOGICAL SERVICES </h1>
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae dolorem tenetur quam! Assumenda explicabo architecto voluptate, rerum minima vel, id vitae, aliquid in reiciendis fugit sunt pariatur? Dignissimos, et iste. </p>
                </div>
                
                <div class="textpage1">
                    <h1 class="speak">Speak.</h1>
                    <h2 class="werehere">We're here for you.</h2>
                    
                    <div class="speakforyou" >
                        {!!$speakwithyou->content!!}
                    </div>
        
                    <div class="btnloginregister" style="padding-top:16px">
                        @if(Auth::user()->status == 'pending')
                            <a hidden href="" class="btnlogin" >Book now</a>
                        @else
                            <a href="" class="btnlogin">Book now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="bgpic" >  
        <div style="box-shadow: 20px 20px 15px rgba(0, 0, 0, 0.25);height: auto; left: 65%; padding: 0.3rem;padding-bottom:11%; text-align: center; background-color:#829460; width: 33%; top:0px; border-radius:0 0 500px 500px; position: absolute; z-index:1; "class="collapse dont-collapse-lg"> 
            <img style="height: 19vw; width: 19vw; margin-top: 2.5rem; margin-left:auto; margin-right: auto; border-radius: 9999px; " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
            <h1 style="margin-top: 1.75rem;font-family:Poppins; text-align:center; font-size:2vw; color:white;font-weight: 900; "> PSYCHOLOGICAL SERVICES </h1>
            <p style="font-size: 1vw; margin-top:5%; margin-bottom:5%; color:white; text-align:center;font-family:Song Myung; "> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae dolorem tenetur quam! Assumenda explicabo architecto voluptate, rerum minima vel, id vitae, aliquid in reiciendis fugit sunt pariatur? Dignissimos, et iste. </p>
        </div>
        
        <div class="textpage1">
            <h1 style="font-size: 6vw; margin-left:3%; margin-top:2.5rem; font-family:Song Myung; color:black; ">Speak.</h1>
            <h2 style="font-size:2.8vw; margin-left:8.5%; margin-top: -2%; font-family:Song Myung; color:black;">We're here for you.</h2>
            <div class="speakforyou"  style="margin-left:1.25rem; margin-right:1.25rem ;  margin-bottom: 3%;" >
                {!!$speakwithyou->content!!}
            </div>
            <div class="" style="margin-top: 25px">
                @if (Auth::user()->status == 'pending')
                <a hidden href="/patient/appointment/"  style="text-decoration:none; font-family:Poppins; font-weight:900; text-align:center; color:#829460; border: 0.2vw solid; line-height: 1vw;  border-radius: 2vw 0vw; margin-left: 0.5%; padding:0.4vw 2vw 0.4vw 2vw" class="button-size" >Book now</a> 
                @else
                <a href="/patient/appointment/"  style="text-decoration:none; font-family:Poppins; font-weight:900; text-align:center; color:#829460; border: 0.2vw solid; line-height: 1vw;  border-radius: 2vw 0vw; margin-left: 0.5%; padding:0.4vw 2vw 0.4vw 2vw" class="button-size" >Book now</a> 
                @endif
            </div>
        </div>
    </div> --}}
    
    <div class="servicescontainer">
        <p class="servicestitle"> SERVICES</p>
        <p class="whatwe">WHAT WE CAN DO FOR YOU</p>
        <div class="whiteline">  </div>
        <div class="colcontainer">
            <div class="row">
                <div class="col-sm p-0" >
                    <div class="servicescontainer2">  
                        <div class="brownshape">
                            <img class="servicesimg" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_9_kh8esy.png" alt="">
                            <div class="txtbrown124">
                                <p> psychotherapy and counseling</p>
                                <li >Individuals with depression, anxiety, life, stress, and burn out.</li>
                            </div>
                        </div>
                
                        <div class="brownshape">
                            <img class="servicesimg"  src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_11_rxp9dh.png" alt="">
                            <div class="txtbrown124" >
                                <p>Provides consultancy services about mental health policy in corporate settings</p>
                            </div>
                        </div>
                
                    </div>
                </div>
                <div class="col-sm p-0">
                    <div class="servicescontainer2">

                        <div class="brownshape" >
                            <img class="servicesimg"  src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_10_efuw5v.png" alt="">
                            <div class="txtbrown3">
                                <p >gives talks about mental health</p>
                            </div>
                        </div>
                
                        <div class="brownshape">
                            <img class="servicesimg"  src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_12_ikiipz.png" alt="">
                            <div class="txtbrown124">
                                <p>psychological evaluation</p>
                                <li>For therapeutic intervention</li>  
                                <li>for adoption purposes (child and couple)</li>
                                <li>Pre-employment testing </li>     
                                <li>Intelligence testing</li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div >
            <p class="undertxt">For more information, contact us at the provided  contact details at the bottom. <br> For interested clients, book an appointment <a style="color:white;text-decoration:none; font-family:'Poppins'; font-weight:900;" href=""> here.</a> </p>
        </div>
    </div>
</div>

<div style="width: 100%; height: auto; text-align:center; font-family:Poppins;">
    <p class="gettoknow">GET TO KNOW US</p>
    <p class="aboutus">ABOUT US</p>
    <div class="blackline">  </div>

    <div style="margin-top:1%; margin-left:2%; margin-right:2%;">
        <div class="row " >
            <div class="col-sm " style="padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%; height:auto" >
                @if ($aboutus1->image == "") 
                    <img class="aboutimg"   src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img class="aboutimg"  src="{{url('/guestpage/'.$aboutus1->image)}}" alt="">
                @endif

                <div class="abouttxtcontainer">
                    <p class="abouttxt">{!! \Illuminate\Support\Str::limit(strip_tags($aboutus1->content), 448) !!}</p>   
                </div>
                <a class="aboutreadmore" href="/about_us"> Read More >> </a>
            </div>

            <div class="col-sm "  style="padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%; ">

                @if ($aboutus2->image == "") 
                <img class="aboutimg"   src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img class="aboutimg"  src="{{url('/guestpage/'.$aboutus2->image)}}" alt="">
                @endif

                <div class="abouttxtcontainer">
                    <p class="abouttxt">{!! \Illuminate\Support\Str::limit(strip_tags($aboutus2->content), 448) !!}</p>   
                </div>
                <a class="aboutreadmore" href="/about_us"> Read More >> </a>
        
            </div>
        </div>
    </div>
</div>

<div style="width: 100%; height: auto;background-color: #AA8B56; padding: 3%; ">
    <div class="colcontainer2"  >
        <div class="row" > 
            <div class="col-xl-4">
                <div class="doccontainer1">
                    @if ($doctorsinfo->image == "") 
                        <img class="docimg"  src="{{url('/guestpage/noimage.png')}}" alt="">
                    @else
                        <img  class="docimg"  src="{{url('/guestpage/'.$doctorsinfo->image)}}" alt="">
                    @endif
                </div>
            </div>
            
            <div class="col-xl" >
                <div class="doccontainer2">
                    <div class="doctxt"  >
                        {!! $doctorsinfo->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    

<div style="width: 100%; height: auto; padding:4%;">
    <div class="container-fluid">
        <div class="row">
    
            <div class="col-lg">
                <div style="text-align: justify; ">
                    <p class="whytitle"> WHY SPEAKING UP IS IMPORTANT? </p>
                
                    
                    <div class="whycontent">
                        <p>{!! $speakingup->content !!}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-5">
                <div class="imgwhycontainer">

                    @if ($speakingup->image == "") 
                    <img class="whyspeakimg"  src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img class="whyspeakimg"  src="{{url('/guestpage/'.$speakingup->image)}}" alt="">
                @endif
                </div>
            </div>
    
        </div>
    </div>
</div> 
</div>

@endsection

