@extends('layouts.navbar')
@section('content')

<style>

/********************STYLE NG MAY HOVER***********************************/
.hello, .hello:before, .hello:after{
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing:border-box;
  box-sizing: border-box;
}

 .main-title{
  color: #2d2d2d;
  text-align: center;
  text-transform: capitalize;
  padding: 0.7em 0;
}

.container2{
  padding: 1em 0;
  float: left;
  width: 50%;
 
}

@media screen and (max-width: 640px){
  .container2{
    display: block;
    width: 100%;
  }
}

@media screen and (min-width: 900px){
  .container2{
    width: 33.33333%;
  }
}

.container2 .title{
  color: #1a1a1a;
  text-align: center;
  margin-bottom: 10px;
  
}

.content1 {
  position: relative;
  width: 90%;
  max-width: 400px;
  margin: auto;
  overflow: hidden;
  box-shadow: 14px 14px 22px 5px rgba(0, 0, 0, 0.25)
}

.content1 .content-overlay {
  background: rgba(0,0,0,0.7);
  position: absolute;
  height: 99%;
  width: 100%;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  opacity: 0;
  -webkit-transition: all 0.4s ease-in-out 0s;
  -moz-transition: all 0.4s ease-in-out 0s;
  transition: all 0.4s ease-in-out 0s;
}

.content1:hover .content-overlay{
  opacity: 1;
}

.content-image{
  width: 100%;
  
}

.content-details {
  position: absolute;
  text-align: center;
  padding-left: 1em;
  padding-right: 1em;
  width: 100%;
  top: 50%;
  left: 50%;
  opacity: 0;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-transition: all 0.3s ease-in-out 0s;
  -moz-transition: all 0.3s ease-in-out 0s;
  transition: all 0.3s ease-in-out 0s;
}

.content1:hover .content-details{
  top: 50%;
  left: 50%;
  opacity: 1;
}

.content-details h3{
  color: #fff;
  font-weight: 500;
  letter-spacing: 0.15em;
  margin-bottom: 0.5em;
  text-transform: uppercase;
}

.content-details .content-text{
  color: #fff;
  font-size: 0.8em;
}

.fadeIn-bottom{
  top: 80%;
}

/**************************Gawa gawa**************************************/
.pic-heading{
  height: 171px;
  width:100%;
}
.image1{
 height:577px; 
}
.image2{
  height:577px; 
  width: 100%;
}
.letters{
  font-size:20px;
  font-weight: 500;
}
@media (max-width: 880px) {
  .pic-heading{
    height: 15vh;
  }
  .bot-text{
    font-size: 4vw;
  }
  .image1{
    height: 100%;
    width: 100%; 
  }
  .image2{
    height: 100%;
    width: 100%; 
  }
  .letters{
    font-size: 2vw;
    padding-top: 4%;
  }
}
@media (max-width: 800px) {
 .content-title{
  display: none;
  }
  .content-text{
    display: none;
  }
  .bot-text{
    display: none;
  }

}
@media (max-width: 560px) {
 .letters{
    font-size: 13px;
    
  }
}
</style>
<div style="  font-family: 'Inter';" >

    <div>
      <img class="pic-heading" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782573/Share_and_seek_help_pgtpay.png" alt="">
    </div>

    <div style="text-align: right;Padding:4% 9% 0 0;">
      <h3 style="margin:0;padding:0;font-weight:900;font-size: 32px;">ABOUT US</h3>
      <p style="margin:0;padding:0;">Home >> <b>About Us</b></p>

    </div>
<div class="hello" style="display: flex;flex-direction:row; justify-content:center;padding:5% 5% 5% 5%">
 

    {{-- <div class="row"> --}}

      {{-- <div class="col"> --}}
        <div class="container2" >

          <div class="content1">
            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782578/Untitled_design_8_iqojuo.png"  alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Explaining behavior</h3>
                <p class="content-text">Explaining behavior is probably what comes to mind for most people when they think about the goals of psychology. Why do people do the things they do? What factors contribute to development, personality, social behavior, and mental health problems?</p>
              </div>
            </a>
          </div>
          <div style="margin:0;padding:0;">
            <h3 class="bot-text" style="font-weight:800;margin:0;padding:2% 0 0 7%;">EXPLAINING </h3>
            <h3 class="bot-text"  style="margin:0;padding:0 0 0 7%;">BEHAVIOR </h3>

          </div>
    

        </div>
        
      {{-- </div> --}}

      {{-- <div class="col-sm"> --}}

        <div class="container2" >

          <div class="content1">
            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782580/Untitled_design_10_zvkemk.png" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Describing Behavior</h3>
                <p class="content-text">Simply describing the behavior of humans and other animals helps psychologists understand the motivations behind it. Such descriptions also serve as behavioral benchmarks that help psychologists gauge what is considered normal and abnormal.</p>
              </div>
            </a>
          </div>
          <div style="margin:0;padding:0;">
            <h3 class="bot-text"  style="font-weight:800;margin:0;padding:2% 0 0 7%;">DESCRIBING </h3>
            <h3 class="bot-text"  style="margin:0;padding:0 0 0 7%;">BEHAVIOR </h3>
          </div>
        </div>
      {{-- </div> --}}
{{-- 
      <div class="col-sm"> --}}

        <div class="container2">

          <div class="content1" >
            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
              <div class="content-overlay"></div>
              <img class="content-image" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782584/Untitled_design_7_sqbbzl.png" alt="">
              <div class="content-details fadeIn-bottom">
                <h3 class="content-title">Predicting Behavior</h3>
                <p class="content-text">Not surprisingly, another primary goal of psychology is to predict how we think and act. Once psychologists understand what happens and why, they can formulate predictions about when, why, and how it might happen again.</p>
              </div>
            </a>
          </div>
          <div style="margin:0;padding:0;">
            <h3 class="bot-text"  style="font-weight:800;margin:0;padding:2% 0 0 7%;">PREDICTING </h3>
            <h3 class="bot-text"  style="margin:0;padding:0 0 0 7%;">BEHAVIOR </h3>
          </div>
        </div>
      {{-- </div> --}}
     {{-- </div> --}}
 
</div>


    <div class="container-fluid" style="background-color: #829460;width:100%">

      <div class="row">

        <div class="col-sm-5" style="text-align: left;padding-left:0">
            <img class="image1"  src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782581/Untitled_design_11_zvl1ur.png" alt="">
        </div>

        <div class="col" style="padding-right:2%;background-color: #829460;text-align:justify;display: flex; align-items:center;">
          <p class="letters" style="color: #fff">JG Marquez,Rpsy is a Psychology clinic owned by Mr. Joseph G. Marquez. In 2018, the business started at his own house and was stopped before the pandemic. Going back to 2018, Mr. Marquez was accepting walk-ins and scheduled clients at his house in Taytay. The clinic was then established in 2020 located at 2nd Flr. Everlasting Bldg., #172 Rizal Avenue, Brgy. San Isidro, Taytay, Rizal and he is the only one who managed his clinic.
            <br><br> JG Marquez, Rpsy offers various psychological services like psychological evaluation, psychotherapy, and counseling. The appointment method is through walk-in and Facebook using google forms that they provide. The clinic has a Facebook page that advertises its services. The clinic can book 3-4 clients a day, it has 6 working hours and is open every Monday and Wednesday. </p>
        </div>

       </div>
    </div>

    
    <div class="container-fluid" style="width:100%;">

      <div class="row">

        <div class="col-sm" style="text-align:justify;display: flex; align-items:center;padding:2%">
          <p class="letters"> In JG Marquez,Rpsy Clinic, We take social responsibility seriously. We understand that mental health is a critical aspect of overall well-being, and we believe that everyone deserves access to quality mental health care. To this end, we strive to create a welcoming and inclusive environment that is accessible to all individuals, regardless of their background or financial situation. We work to reduce stigma surrounding mental health issues and actively engage with our local community through outreach and education initiatives. We also prioritize ethical and culturally sensitive treatment practices, recognizing the importance of understanding and respecting each individual's unique experiences and needs. By fulfilling our social responsibility, we hope to make a positive impact on the mental health and well-being of our clients and the wider community.</p>
        </div>

        <div class="col-sm-5" style="padding: 0;text-align:right;">
            <img class="image2" src="https://res.cloudinary.com/uhno-dos-tres/image/upload/v1682782582/Untitled_design_12_epw2dw.png" alt="">
        </div>

       </div>
    </div>



</div>

<script>
       setTimeout(function() {
                                $(".success").fadeOut(500);
                            }, 3000);
</script>

@endsection



 




  
  
   
  
  