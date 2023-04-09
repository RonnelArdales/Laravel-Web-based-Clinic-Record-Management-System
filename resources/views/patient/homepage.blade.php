@extends('layouts.patient_navbar')
@section('content')
    
{{-- <h1 class="text-center text-[30px]">Patient homepage</h1> --}}
{{-- @if (session('success'))
<div class="alert success alert-success" role="alert" style="width:250px; right:25px;  position:fixed">
  <p id="message-error"> {{ session('success') }}</p> 
</div>
@endif --}}

<div style="height:50vw ;background-color: #EDDBC0;">
  <div style="box-shadow: 20px 20px 15px rgba(0, 0, 0, 0.25);height: auto; left: 65%; padding: 0.3rem;padding-bottom:11%; text-align: center; background-color:#829460; width: 33%; top:0px; border-radius:0 0 500px 500px; position: absolute;  " class="collapse dont-collapse-lg"> 
  <img style="height: 19vw; width: 19vw; margin-top: 2.5rem; margin-left:auto; margin-right: auto; border-radius: 9999px; " src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="JGRPSYlogo">
  <h1 style="margin-top: 1.75rem;font-family:Poppins; text-align:center; font-size:2vw; color:white;font-weight: 900; "> PSYCHOLOGICAL SERVICES </h1>
  <p style="font-size: 1vw; margin-top:5%; margin-bottom:5%; color:white; text-align:center;font-family:Song Myung; "> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae dolorem tenetur quam! Assumenda explicabo architecto voluptate, rerum minima vel, id vitae, aliquid in reiciendis fugit sunt pariatur? Dignissimos, et iste. </p>
  <a href="" style="Poppins; background-color:#EDDBC0; color:#829460; text-align:center; font-weight:700; font-size: 1.5vw; border-radius: 1.5vw 0vw;padding:0.5vw 5vw 0.5vw 5vw; text-decoration:none;">Read More</a>
  </div>
  
  <div style="margin-left:3%;margin-top:5%;">
          <h1 style="font-size: 6vw; margin-left:3%; margin-top:2.5rem; font-family:Song Myung; color:black; ">Speak.</h1>
          <h2 style="font-size:2.8vw; margin-left:8.5%; margin-top: -2%; font-family:Song Myung; color:black;">We're here for you.</h2>
          <p style="margin-bottom: 3%; margin-left:5%; font-size: 1.3vw; font-family:Song Myung; font-style:normal; margin-left:1.25rem;">Many individuals can experience symptoms associated with painful <br>
              and traumatic circumstances. Anxiety, fear, and hopelessness are a <br> few 
              emotions that can linger post traumatic events. We can help you <br>overcome these 
              symptoms and guide you through the process of <br> grief and healing. </p>
              <a href="/" style="text-decoration:none; font-weight:900; font-family:Poppins; background-color: #829460; text-align:center; color:white; font-size: 1vw; line-height: 1vw; border-radius: 2vw 0vw;margin-left: 5%; padding:0.5vw 1vw 0.5vw 1vw" >BOOK NOW</a> 
         
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
     
      <div style="display: flex;flex-direction:row; justify-content: center;margin-top:1%; margin-left:2%; margin-right:2%;">

          <div style="height:40vw; width:35vw; padding:1%;">
              <img style="height: 19vw; width:20vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="">
              <p style="font-size: 1.1vw; font-family:'Song Myung';font-weight: 400;margin-bottom:1%;text-align:justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam in similique veritatis magnam enim non quod aliquam reiciendis nesciunt velit expedita, ducimus ipsam, suscipit laudantium minus eum mollitia quam repellat? Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis vero fuga assumenda consectetur at dolor, voluptate odio nobis, quisquam necessitatibus architecto pariatur enim maiores facere vitae quo nemo asperiores sit.</p>         
             <a style="font-size: 1.5vw; text-decoration:none; color:black;font-weight: 900; text-align:center;" href=""> Read More >> </a>
          </div>

          <div style="height:40vw; width:35vw;  padding:1%;">
              <img style="height: 19vw; width:20vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="">
              <p style="font-size: 1.1vw; font-family:'Song Myung';font-weight: 400;margin-bottom:1%;text-align:justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam in similique veritatis magnam enim non quod aliquam reiciendis nesciunt velit expedita, ducimus ipsam, suscipit laudantium minus eum mollitia quam repellat? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta veritatis suscipit tempora obcaecati at exercitationem voluptatibus odio officia sint modi voluptatem, recusandae quae fuga, repellat nemo, sed fugiat quos. Amet.</p>         
             <a style="font-size: 1.5vw; text-decoration:none; color:black;font-weight: 900; text-align:center;" href=""> Read More >> </a>
          </div>

          <div style="height:40vw; width:35vw;  padding:1%;">
              <img style="height: 19vw; width:20vw; margin-bottom:5%;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt="">
              <p style="font-size: 1.1vw; font-family:'Song Myung';font-weight: 400; margin-bottom:1%; text-align:justify;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam in similique veritatis magnam enim non quod aliquam reiciendis nesciunt velit expedita, ducimus ipsam, suscipit laudantium minus eum mollitia quam repellat? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id nulla voluptas, doloribus architecto consectetur suscipit. Doloremque ab sunt culpa expedita quos, deserunt sed, eum aliquam excepturi asperiores eaque dolorum recusandae!</p>         
             <a style="font-size: 1.5vw; text-decoration:none; color:black;font-weight: 900; text-align:center; " href=""> Read More >> </a>
          </div>    
      </div>
  </div>

  <div style="width: 100%; height: 50vw;background-color: #AA8B56;display: flex;flex-direction:row; justify-content: center; padding: 3%;">
      <div style="margin-right: 3%; align-self:center;">
          <img style="height: 35vw; width:31vw;border-radius: 10% 0px;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt=""> 
      </div>
  
      <div style="text-align: left; padding-top:5%;">
          <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; color:white; font-size:2.5vw;margin-bottom:0%;"> DOCTOR'S NAME</p>
          <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; color:white; font-size:1vw;margin-top:0%;line-height:0%;">title</p>
          <p style="font-size: 2vw; font-family:'Song Myung';font-weight: 400; margin-bottom:3%; color:white; ">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat beatae repellat eius dolor culpa amet nesciunt vitae nobis sequi, inventore, temporibus voluptatum non distinctio quidem est molestias accusantium tenetur ratione! <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem maiores veritatis sapiente maxime magnam ab, culpa explicabo facilis! Obcaecati, ipsa illo. Nisi qui porro similique quaerat, tempore perspiciatis ratione sequi.</p>
          <a style="font-size: 1.8vw; text-decoration:none; color:white;font-weight: 900; text-align:center; " href=""> Read More >> </a>
      </div>
    
  </div>

  <div style="width: 100%; height: 40vw;display: flex;flex-direction:row; justify-content: center; padding:4%;">
         
      <div style="text-align: justify; ">
          <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; color:black; font-size:2.5vw;margin-bottom:0%; text-align:center;"> WHY SPEAKING UP IS IMPORTANT? </p>
          <p style="font-size: 1.5vw; font-family:'Song Myung';font-weight: 400; color:black;margin-right: 3%; margin-top:8%; margin-bottom:5%;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat beatae repellat eius dolor culpa amet nesciunt vitae nobis sequi, inventore, temporibus voluptatum non distinctio quidem est molestias accusantium tenetur ratione! <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem maiores veritatis sapiente maxime magnam ab, culpa explicabo facilis! Obcaecati, ipsa illo. Nisi qui porro similique quaerat, tempore perspiciatis ratione sequi.</p>
          <a style="font-size: 1.8vw; text-decoration:none; color:black;font-weight: 900; text-align:center; " href=""> Read More >> </a>
      </div>
     

      <div style=" align-self:auto">
          <img style="height: 28vw; width:38vw;" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1674970093/JG%20marquez/logo_oeppyy.png" alt=""> 
      </div>

  </div>
<script>
       setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);
</script>

@endsection