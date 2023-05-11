
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;800&display=swap" rel="stylesheet">
</head>

<style>
    
    body{
        border: 5px solid #829460;
        font-family: 'Inter';
    }
    .container {
    display: table;
    width: 100%;
}

.column1,
.column2 {
    display: table-cell;
}

.title {
    display: table;
    width: 100%;
    margin-top: 15px; 
}

.title .column {
    display: table-cell;
    vertical-align: middle;
}

.title .column:first-child {
    background-color: #829460;
    width: 50%;
    height: 35px;
  
}

.title .column:last-child {
    width: 50%;
}
label{
    font-size:18px;
    line-height: 20px;
    
}
.contentparent{
    width:100%;
    height:500px;

}
.content{
    padding-left:25%; 
    margin: 15% 0 0 0;
}
.docname{
   margin: 0%;
   margin-top: -25px;
   padding:0;
   border-bottom:1px solid black;
   font-size: 16px;
    line-height: 19px;
    text-align: center;
     
}
.signature{
    text-align: center;
    margin:7% 30% 0 30%;
}

</style>
<body>
        <div>
            <div class="container">
                <div class="column1" style="width: 35%; height: 160px; text-align:right"><img style="margin-top: 21px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('jg.png'))) }}" alt="Company Logo"> </div>

                <div class="column2" style="padding-left:15px;text-align:justify;">
                    <h1 style="font-size: 25px;line-height: 25px;margin:40px 0 0 0;padding-bottom:0;       font-family: 'Inter';" >JGMARQUEZ, RPSY<br>PSYCHOLOGICAL SERVICES</h1>
                    <p style="font-size: 16px;margin-top:0;padding-top:0;line-height: 19px;">2nd Floor Everlasting Bldg. #172 Rizal Ave. <br> Brgy. San Juan, Taytay, Rizal
                             <br> NVAT Reg. TIN : 272-212-109-000  <br>09171732844 / 09083992102
                       </p>
                </div>
            </div>
            
            <div class="title">
                <div class="column" style="background-color:#829460;width:50%;height:35px"></div>
                <div class="column">
                    <div class="titletext" style="text-align:center" >
                        <h1 style="font-weight: 800;padding:5px 0 0 0;margin-bottom:0;font-size: 25px;
                        line-height: 24px;">RESERVATION RECEIPT.</h1>
                    </div>
                </div>
            </div>

        </div>
     <div class="contentparent"> 
        <div class="content" > 
            <label style="margin-top: 2px" for="">Name:</label>
            <label for="">{{$appointments->fullname}}</label>
            <br>
            <label style="margin-top: 2px" for="">Contact Number:</label>
            <label for="">{{$appointments->contact_no}}</label>
            <br>
            <label style="margin-top: 2px" for="">Email:</label>
            <label for="">{{$appointments->email}}</label>
            <br>
            <label for="">Appointment Date:</label>
            <label for="">{{date('M d, Y', strtotime($appointments->date))}}</label>
            <br>
            <label for="">Appointment Time:</label>
            <label for="">{{date('h:i A', strtotime($appointments->time))}}</label>
             <br> <label style="margin-top: 2px" for="">Billing Date:</label>
                  <label for="">{{now()->format('M d, Y')}}</label>
            <br>
            <br>
            <label style="margin-top: 2px" for="">MOP:</label>
            <label for="">{{$appointments->mode_of_payment}}</label>
            <br>
            <label style="margin-top: 2px" for="">Status:</label>
            <label for="">{{$appointments->status}}</label>
            <br>
            <br>
            <br>
            <label style="margin-top: 2px;font-weight: 800;font-size:20px;" for="">RESERVATION FEE:</label>
            <label style="font-weight: 800;font-size:20px;" for="">{{$appointments->reservation_fee}}</label>
        </div>
      </div>

      <div class="signature">
        <img height="50" width="110" style="margin-bottom:0px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('signature.png'))) }}" alt="Psychologist Signature">
        <p class="docname">JOSEPH G. MARQUEZ</p>
            
                <p style="margin:0;padding:0;line-height: 17px;
                text-align: center;font-style: italic;">Psychologists</p>
      </div>
       
            

</body>
    
</html>