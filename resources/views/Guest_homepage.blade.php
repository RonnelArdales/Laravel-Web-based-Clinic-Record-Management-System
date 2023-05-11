@extends('layouts.navbar')
@section('title', 'Homepage')
@section('content')
<style>
    .bgpic{
        height:50vw;
        width:100%;
        background-image:url('https://res.cloudinary.com/uhno-dos-tres/image/upload/v1683471986/asdasdasada_beggm7.png');
        background-repeat: no-repeat;
        background-size:cover;
        background-position:center;
        background-attachment:scroll;
    }
    .textpage1{
        margin-left:3%;margin-top:5%; margin-right:3%
    }
    @media(max-width: 1269px) {
        .bgpic {
            background-size:contain;
        }
        .textpage1{
        background-color:#eddbc0bb;
    }
        }
</style>

<div class="container-fluid" style="padding: 0px" >
<div class="bgpic" >
    <div style="box-shadow: 20px 20px 15px rgba(0, 0, 0, 0.25);height: auto; left: 65%; padding: 0.3rem;padding-bottom:11%; text-align: center; background-color:#829460; width: 33%; top:0px; border-radius:0 0 500px 500px; position: absolute;  "class="collapse dont-collapse-lg"> 
        <img style="height: 19vw; width: 19vw; margin-top: 2.5rem; margin-left:auto; margin-right: auto; border-radius: 9999px; " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
        <h1 style="margin-top: 1.75rem;font-family:Poppins; text-align:center; font-size:2vw; color:white;font-weight: 900; "> PSYCHOLOGICAL SERVICES </h1>
        <p style="font-size: 1vw; margin-top:5%; margin-bottom:5%; color:white; text-align:center;font-family:Song Myung; "> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae dolorem tenetur quam! Assumenda explicabo architecto voluptate, rerum minima vel, id vitae, aliquid in reiciendis fugit sunt pariatur? Dignissimos, et iste. </p>
        {{-- <a href="" style="Poppins; background-color:#EDDBC0; color:#829460; text-align:center; font-weight:700; font-size: 1.5vw; border-radius: 1.5vw 0vw;padding:0.5vw 5vw 0.5vw 5vw; text-decoration:none;">Read More</a> --}}
        </div>
    
    <div class="textpage1">
            <h1 style="font-size: 6vw; margin-left:3%; margin-top:2.5rem; font-family:Song Myung; color:black; ">Speak.</h1>
            <h2 style="font-size:2.8vw; margin-left:8.5%; margin-top: -2%; font-family:Song Myung; color:black;">We're here for you.</h2>
            <div class="speakforyou"  style="margin-left:1.25rem; margin-right:1.25rem ;  margin-bottom: 3%;" >
                {!!$speakwithyou->content!!}
            </div>
           <div class="" style="margin-top: 25px">
            <a href="/register" style="text-decoration:none; font-weight:900; font-family:Poppins; background-color: #829460; text-align:center; color:white;   line-height: 1vw; border-radius: 2vw 0vw;margin-left: 5%; padding:0.5vw 1vw 0.5vw 1vw" class="button-size" >Register</a> 
            <a href="/login"  style="text-decoration:none; font-family:Poppins; font-weight:900; text-align:center; color:#829460; border: 0.2vw solid; line-height: 1vw;  border-radius: 2vw 0vw; margin-left: 0.5%; padding:0.4vw 2vw 0.4vw 2vw" class="button-size" >Log in</a> 
           </div>
           
    </div>
    </div>
    
    <div style="width: 100%; height: 55vw; background-color:#829460; text-align:center; font-family:Poppins;color:white;">
        <p style="padding-top: 3vw; font-size:1.2vw;color:#EDDBC0;font-weight:700;"> SERVICES</p>
        <p style="color: white; font-size: 2vw;font-weight:700;">WHAT WE CAN DO FOR YOU</p>
        <div style="margin:auto; height: 0.5%; width:35%; border: 0; background: white;">  </div>
      
        <div style="display: flex;flex-direction:row; justify-content: center; margin-top:3%;">
              <div style="margin-left:1% ;margin-right:1%;background-color: #AA8B56;  border-radius:500px 500px 0 0; height:25vw ; width:15vw;padding:2%; padding-top:0%;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.25);">
                      <img style="height:5vw; width:5vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_9_kh8esy.png" alt="">
                      <div style="text-align: left;font-size:1vw; ">
                          <p> psychotherapy and counseling</p>
                          <li style="">Individuals with depression, anxiety, life, stress, and burn out.</li>
                      </div>
              </div>
              <div style="margin-left:1% ;margin-right:1%;background-color: #AA8B56;  border-radius:500px 500px 0 0; height:25vw ; width:15vw;padding:2%; padding-top:0%;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.25);">
                  <img style="height:5vw; width:5vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_11_rxp9dh.png" alt="">
                  <div style="text-align: left; font-size:1vw; ">
                      <p>Provides consultancy services about mental health policy in corporate settings</p>
                  </div>
              </div>
               <div style=" margin-left:1% ;margin-right:1%;background-color: #AA8B56;  border-radius:500px 500px 0 0; height:25vw ; width:15vw;padding:2%; padding-top:0%;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.25);">
                  <img style="height:5vw; width:5vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_10_efuw5v.png" alt="">
                  <div style="text-align:center; font-size:1.5vw; ">
                      <p >gives talks about mental health</p>
                  </div>
              </div>
              <div style="margin-left:1% ;margin-right:1%;background-color: #AA8B56;  border-radius:500px 500px 0 0; height:25vw ; width:15vw;padding:2%; padding-top:0%;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.25);">
                  <img style="height:5vw; width:5vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1677319628/JG%20marquez/image_12_ikiipz.png" alt="">
                  <div style="text-align: left; font-size:1vw; ">
                      <p>psychological evaluation</p>
                       <li>For therapeutic intervention</li>  
                     <li>for adoption purposes (child and couple)</li>
                     <li>Pre-employment testing </li>     
                      <li>Intelligence testing</li>
                  </div>
              </div>
        </div>
        <div >
          <p style="margin-top:3%;font-size:1.3vw; ">For more information, contact us at the provided  contact details at the bottom. <br> For interested clients, book an appointment <a style="color:white;text-decoration:none; font-family:'Poppins'; font-weight:900;" href=""> here.</a> </p>
        </div>
        
  
      </div>


      <div style="width: 100%; height: 60vw; text-align:center; font-family:Poppins;">
        <p style="padding-top: 3vw; font-size:1.2vw;color:#395144;font-weight:700;">GET TO KNOW US</p>
        <p style="color: black ; font-size: 2vw;font-weight:700;">ABOUT US</p>
        <div style="margin:auto; height: 0.5%; width:35%; border: 0; background: black;">  </div>
       
        {{-- <div style="display: flex;flex-direction:row; justify-content: center;margin-top:1%; margin-left:2%; margin-right:2%;">

            <div style="height:40vw; width:auto; padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%">
                <img style="height: 19vw; width:20vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="">
                <div style="height: 18vw; font-family:'Song Myung';font-weight: 400;">
                    <p style="font-size: 1.3vw; margin-bottom:1%;text-align:justify;">{!! \Illuminate\Support\Str::limit(strip_tags($aboutus1->content), 20) !!}</p>   
                </div>
  
              <a style="font-size: 1.5vw; text-decoration:none; color:black;font-weight: 900; text-align:center;" href="/about_us"> Read More >> </a>
            </div>

            <div style="height:40vw; width:auto;  padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%">
                <img style="height: 19vw; width:20vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="">

                <div style="height: 18vw">
                <p style="font-size: 1.3vw; font-family:'Song Myung';font-weight: 400;margin-bottom:1%;text-align:justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam in similique veritatis magnam enim non quod aliquam reiciendis nesciunt velit expedita, ducimus ipsam, suscipit laudantium minus eum mollitia quam repellat? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta veritatis suscipit tempora obcaecati at exercitationem voluptatibus odio officia sint modi voluptatem, recusandae quae fuga, repellat nemo, sed fugiat quos. Amet.</p>     
            </div>

                <a style="font-size: 1.5vw; text-decoration:none; color:black;font-weight: 900; text-align:center;" href="/about_us"> Read More >> </a>
            </div>
        </div> --}}
        

        <div style="margin-top:1%; margin-left:2%; margin-right:2%;">
            <div class="row " >
                <div class="col-sm " style="padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%; height:auto" >

                    @if ($aboutus1->image == "") 
                    <img style="height: 19vw; width:20vw; margin-bottom:5%;"   src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img style="height: 19vw; width:20vw; margin-bottom:5%;"  src="{{url('/guestpage/'.$aboutus1->image)}}" alt="">
                @endif

                    <div style="font-family:'Song Myung';font-weight: 400;  margin-bottom:20px">
                        <p style="font-size: 1.3vw; margin-bottom:1%;text-align:justify;">{!! \Illuminate\Support\Str::limit(strip_tags($aboutus1->content), 448) !!}</p>   
                    </div>
                    <a style="font-size: 1.5vw; text-decoration:none;color:black;font-weight: 900; text-align:center;" href="/about_us"> Read More >> </a>
                </div>
                <div class="col-sm "  style="padding-top:1%; padding-bottom:1%; padding-left:2%; padding-right:2%;height:auto ">

                    @if ($aboutus2->image == "") 
                    <img style="height: 19vw; width:20vw; margin-bottom:5%;"   src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img style="height: 19vw; width:20vw; margin-bottom:5%;"  src="{{url('/guestpage/'.$aboutus2->image)}}" alt="">
                @endif

                    <div style="font-family:'Song Myung';font-weight: 400; margin-bottom:20px">
                        <p style="font-size: 1.3vw; margin-bottom:1%;text-align:justify;">{!! \Illuminate\Support\Str::limit(strip_tags($aboutus2->content), 448) !!}</p>   
                    </div>
                    <a style="font-size: 1.5vw; text-decoration:none;color:black;font-weight: 900; text-align:center;" href="/about_us"> Read More >> </a>
         
                </div>
    
                
              </div>
        </div>




    </div>

      <div style="width: 100%; height: 50vw;background-color: #AA8B56;display: flex;flex-direction:row; justify-content: center; padding: 3%;">
        <div style="margin-right: 3%; align-self:center;">

            @if ($doctorsinfo->image == "") 
            <img style="height: 35vw; width:31vw;border-radius: 10% 0px;"   src="{{url('/guestpage/noimage.png')}}" alt="">
        @else
            <img style="height: 35vw; width:31vw;border-radius: 10% 0px;"  src="{{url('/guestpage/'.$doctorsinfo->image)}}" alt="">
        @endif

        </div>
    
        <div style="text-align: left; padding-top:5%;">
     
            <div style="margin-bottom: 3%; color:white; font-family:'Song Myung';font-weight: 400;"  >
                {!! $doctorsinfo->content !!}
            </div>
       

            
        </div>
    </div>

    <div style="width: 100%; height: 40vw;display: flex;flex-direction:row; justify-content: center; padding:4%;">
           
        <div style="text-align: justify; ">
            <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; color:black; font-size:2.5vw;margin-bottom:0%; text-align:center;"> WHY SPEAKING UP IS IMPORTANT? </p>
            {{-- <p style="font-size: 1.5vw; font-family:'Song Myung';font-weight: 400; color:black;margin-right: 3%; margin-top:8%; margin-bottom:5%;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat beatae repellat eius dolor culpa amet nesciunt vitae nobis sequi, inventore, temporibus voluptatum non distinctio quidem est molestias accusantium tenetur ratione! <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem maiores veritatis sapiente maxime magnam ab, culpa explicabo facilis! Obcaecati, ipsa illo. Nisi qui porro similique quaerat, tempore perspiciatis ratione sequi.</p> --}}
          
            <div style="margin-right: 3%; font-weight: 400; ;margin-top:8%; margin-bottom:5%;">
                <p>{!! $speakingup->content !!}</p>
            </div>
        </div>
       

        <div style=" align-self:auto">

            @if ($speakingup->image == "") 
            <img style="height: 28vw; width:38vw;"  src="{{url('/guestpage/noimage.png')}}" alt="">
        @else
            <img style="height: 28vw; width:38vw;"  src="{{url('/guestpage/'.$speakingup->image)}}" alt="">
        @endif
        </div>

    </div>
    
</div>
@endsection