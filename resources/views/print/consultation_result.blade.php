<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<style>
    .container {
            width: 100%;
        }

        .column {
            width: 50%;
            float: left;
        }

        .column1 {
            padding-right: 15px;
        }

        .column2 {
            padding-left: 15px;
        }

        .docname{
   margin: 0%;
   padding:0;
   font-size: 16px;
    text-align: center;
     
}

</style>
<body>
    <header  style="width:100%; text-align: center;" >
        <img class="border border-dark" style="height: 90px; width:530px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('logo/report-logo.png'))) }}">
      <hr style="width:100%; border:solid; margin-top:10px;margin-bottom:10px ;padding:0px" >
      </header>

      <div style="text-align: center">
        <h2> Consultation Result</h2>
      </div>

      <div class="container" >
                    
        <div class="column column1">

            <label style="margin-top: 2px" for="">Fullname:</label>
            <label for="">{{$userinfo->fname}} {{$userinfo->lname}}</label>
            <br>
            <label style="margin-top: 2px" for="">Gender:</label>
            <label for="">{{$userinfo->gender}}</label>
            <br>
            <label style="margin-top: 2px" for="">Address:</label>
            <label for="">{{$userinfo->address}}</label>
            <br>
            <label style="margin-top: 2px" for="">Contact Number:</label>
            <label for="">{{$userinfo->mobileno}}</label>
            <br>
            <label style="margin-top: 2px" for="">Email :</label>
            <label for="">{{$userinfo->email}}</label>
            <br>
         
        </div>

        <div class="column column2" >
            <div style="">
                <label for="">Appointment Date:</label>
                <label for="">{{$consultations->date}}</label>
               
               <br> <label style="margin-top: 2px" for="">Service:</label>
              <label for="">{{$consultations->service}}</label>
                
                <br>
                <br>

                {{-- <label style="margin-top: 2px" for="">Date:</label> --}}
              {{-- <label for="">{{}}</label> --}}
                
              </div>
        </div>
        </div> 

 
        <div style="text-align:left; margin-top:120px" >
            <label  for="">Behavioral Observation</label>
            <textarea class="addtocart_input" style="width: 98%;text-align:justify ;min-height:65px ; height:auto ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; margin-bottom:20px; border-radius:5px" name="observation" id=""  rows="10">{{$consultations->behavioral_observation}}</textarea>

            <label for="">Brief Summary Encounter</label>
            <textarea class="addtocart_input" style="width: 98%;text-align:justify ;height:auto ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; margin-bottom:20px;min-height:65px; border-radius:5px" name="observation" id=""  rows="10">{{ $consultations->brief_summary_encounter }}</textarea>

            <label for="">Clinical Impression</label>
            <textarea class="addtocart_input" style="width: 98%;text-align:justify ;height:auto ; padding:10px; text-justify: inter-word;  white-space: pre-wrap; margin-bottom:20px;min-height:65px;  border-radius:5px" name="observation" id=""  rows="10">{{$consultations->clinical_impression}}</textarea>

            <label for="">Treatment Given</label>
            <textarea class="addtocart_input" style="width: 98%;text-align:justify; height:auto ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; margin-bottom:20px;min-height:65px;  border-radius:5px" name="observation" id=""  rows="10">{{$consultations->treatment_given}}</textarea>

            <label for="">Recommendation</label>
            <textarea class="addtocart_input" style="width: 98%;text-align:justify ;padding:10px; text-justify: inter-word;  white-space: pre-wrap; margin-bottom:10px;min-height:65px;  border-radius:5px" name="observation" id=""  rows="10">{{$consultations->recommendation}}</textarea>
        </div>

        <div class="container" >
                    
            <div class="column column1">
    
             
             
            </div>
    
            <div class="column column2" >
                <div style="text-align: center">
                    <img height="60" width="120"  style="margin-bottom:0px; padding-bottom:0px; margin-bottom:-25px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('signature.png'))) }}" alt="Psychologist Signature">
                    <p style="" class="docname">JOSEPH G. MARQUEZ</p>
                    <label style="   margin-top:-50px;" for="">License # 0987364</label>
                            <p style="margin:0;padding:0;
                            text-align: center;font-style: italic;">Psychologists</p>
                  </div>
            </div>
            </div> 
     
        
<script>


</script>
        
</body>
</html>
