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
    </div>

    <div class="container-fluid" style="background-color: #829460;width:100%">
        <div class="row">
            <div class="col-sm-5" style="text-align: left;padding-left:0">
                @if ($aboutus1->image == "") 
                    <img class="image1"   src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img class="image1"  src="{{url('/guestpage/'.$aboutus1->image)}}" alt="">
                @endif
            </div>

            <div class="col letters flex-column  " style="color: rgb(255, 255, 255); padding-top:7.5%;padding-right:2%;background-color: #829460;text-align:  justify;  align-items:center;  font-family: Inter;">
                <p  class="letters" style="color: rgb(255, 255, 255);" >   {!! $aboutus1->content !!}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="width:100%;">
        <div class="row">
            <div class="col-sm" style="text-align:justify;display: flex; align-items:center;padding:2%; color: rgb(33, 37, 41); background-color: rgb(237, 219, 192);  font-family: Inter;">
                <p class="letters"> {!! $aboutus2->content !!}</p>
            </div>

            <div class="col-sm-5" style="padding: 0;text-align:right;">
                @if ($aboutus2->image == "")
                    <img class="image2" src="{{url('/guestpage/noimage.png')}}" alt="">
                @else
                    <img class="image2" alt="" src="{{url('/guestpage/'.$aboutus2->image)}}"> 
                @endif
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



 




  
  
   
  
  