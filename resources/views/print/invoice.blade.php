{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<style>
    @font-face {
    font-family: 'Inter';
    src: url('{{ public_path('fonts/Inter-VariableFont_slnt,wght.ttf') }}') format("truetype");
}


    body{
        font-family: 'Inter';
    }
        .addtocart_input, .service_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        text-align: center; 
    }

    table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid;
}

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
</style>
<body>
    <header  style="width:100%; text-align: center;" >
        <img class="border border-dark" style="height: 90px; width:530px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('logo/report-logo.png'))) }}">
      <hr style="width:100%; border:solid; margin-top:10px;margin-bottom:10px ;padding:0px" >
      </header>

      <div class="row m-3" >
        <label style=" text-align: center;">INVOICE RECEIPT</label>
        <hr>
        <div class="container" >
                    
            <div class="column column1">
    
                <label for="">User ID:</label>
                <label for="">{{$infos->user_id}}</label>
                  <br>
                <label style="margin-top: 2px" for="">Fullname:</label>
                <label for="">{{$infos->fullname}}</label>
                <br>
                <label style="margin-top: 2px" for="">Gender:</label>
                <label for="">{{$infos->user->gender}}</label>
                <br>
                <label style="margin-top: 2px" for="">Address:</label>
                <label for="">{{$infos->user->address}}</label>
                <br>
                <label style="margin-top: 2px" for="">Contact Number:</label>
                <label for="">{{$infos->user->mobileno}}</label>
                <br>
                <label style="margin-top: 2px" for="">Email :</label>
                <label for="">{{$infos->user->email}}</label>
                <br>
             
            </div>
    
            <div class="column column2" >
                <div style="margin-left:140px">
                    <label for="">Billing No.:</label>
                    <label for="">{{$infos->transno}}</label>
                   
                   <br> <label style="margin-top: 2px" for="">Billing Date:</label>
                  <label for="">{{$infos->created_at->format('M d, Y')}}</label>
                
                  </div>
            </div>
            </div> 
    
    <br>

            <div style="margin-top:140px; text-align: center;">
                <label style="" >Services</label>
            </div>
    
            <table >
                <thead>
                    <tr style="text-align: center;">
                        <th>Description</th>
                        <th>Price</th>
                  
                    </tr>
                </thead>
    
                <tbody class="patient-error" >
                    @if (count($services)> 0 )
                    @foreach ($services as $service)
                    <tr class="overflow-auto">
                        <td style="text-align: center;">{{$service->service}}</td>
                        <td style="text-align: center;">{{$service->price}}</td>
                   
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                      </tr>
                    @endif
                </tbody>
            </table>
    



    <div class="container" style="margin-top:15px" >
                    
        <div class="column column1">
         
        </div>

        <div class="column column2" >
            <div style="margin-left:135px">
                @if ($infos->status == 'Pending')
    
                @else
                <label for="">Discount:</label> 
                <label for="">PHP {{$infos->discount_price}}</label> <br> 
                @endif
              
               <label style="margin-top: 2px" for="">Total:</label>
               <label for="">PHP {{number_format("$infos->total",2)}}</label>

               @if ($infos->status == 'Pending')
               <br> <label style="margin-top: 2px" for="">Status:</label>
               <label for="">{{$infos->status}}</label>
               @else
               <label style="margin-top: 2px" for="">Mode of payment:</label>
               <label for="">{{$infos->mode_of_payment}}</label> 
               @if ($infos->mode_of_payment == "Cash")
                <label style="margin-top: 2px" for="">Payment:</label>
               <label for="">PHP {{number_format("$infos->payment",2)}}</label> 
               <br>
               <label style="margin-top: 2px" for="">Change:</label>
               <label for="">PHP {{number_format("$infos->change",2)}}</label>
               @else
               <br> <label style="margin-top: 2px" for="">Reference no.:</label>
               <label for="">{{$infos->reference_no}}</label>
               @endif
            @endif
              </div>
        </div>
        </div> 


    
    </div>

</body>

</html> --}}

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
    font-size:16px;
    line-height: 20px;
    
}
.addtocart_input, .service_input{
        background: #D0B894;
        border-radius: 10px;
        border:none;
        margin-bottom: 1%;
        text-align: center; 
}
table {
  border-collapse: collapse;
  width: 100%;
  padding: 0 2% 0 2%; 
}

table, td, th {
  border: 1px solid;
}
.docname{
   margin: 0%;
   padding:0;
   margin-top: -25px;
   border-bottom:1px solid black;
   font-size: 16px;
    line-height: 19px;
    text-align: center;
     
}
.signature{
    text-align: center;
    margin:25% 30% 0 30%;
    
}



</style>
<body>
    <head> 
        <div>
            <div class="container">
         
                    <div class="column1" style="width: 35%; height: 160px; text-align:right"><img style="margin-top: 21px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('jg.png'))) }}" alt="Company Logo"> </div>
           
                <div class="column2" style="padding-left:15px;text-align:justify;">
                    <h1 style="font-size: 25px;line-height: 25px;margin:40px 0 0 0;padding-bottom:0;" >JGMARQUEZ, RPSY<br>PSYCHOLOGICAL SERVICES</h1>
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
                        line-height: 24px;">INVOICE RECEIPT.</h1>
                    </div>
                </div>
            </div>

        </div>
    </head>
      
         
    <div class="container"  style="margin:3% 0 5% 0;width:100%;">
                
        <div class="column column1" style="padding:0 0 0 10%;">

            <label style="margin-top: 2px" for="">Fullname:</label>
            <label for="">{{$infos->fullname}}</label>
            <br>
            <label style="margin-top: 2px" for="">Gender:</label>
            <label for="">{{$infos->user->gender}}</label>
            <br>
            <label style="margin-top: 2px" for="">Address:</label>
            <label for="">{{$infos->user->address}}</label>
            <br>
            <label style="margin-top: 2px" for="">Contact Number:</label>
            <label for="">{{$infos->user->mobileno}}</label>
            <br>
            <label style="margin-top: 2px;" for="">Email :</label>
            <label style="" for="">{{$infos->user->email}}</label>
            <br>
         
        </div>

        <div class="column column2"  style="padding: 0 10% 0 0;">
            <div style="margin-left:140px">
                <label for="">Billing No.:</label>
                <label for="">{{$infos->transno}}</label>
               
               <br> <label style="" for="">Billing Date:</label>
              <label for="">{{$infos->created_at->format('M d, Y')}}</label>
            
              </div>
        </div>
        </div> 
        <div style="padding-left: 5%;">
            <h2 style="font-weight: 800;
            font-size: 24px;
            line-height: 20px;">SERVICES.</h2>
        </div>
        <table >
            <thead>
                <tr style="text-align: center;">
              
                    <th>Description</th>
                    <th>Price</th>
              
                </tr>
            </thead>

            <tbody class="patient-error" >
                @if (count($services)> 0 )
                @foreach ($services as $service)
                <tr class="overflow-auto">
       
                    <td style="text-align: center;">{{$service->service}}</td>
                    <td style="text-align: center;">{{$service->price}}</td>
               
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" style="text-align: center; height:280px ">No Service Found</td>
                  </tr>
                @endif
            </tbody>
        </table>

        <div style="margin-top:5%; padding-left:5%;">
            @if ($infos->status == 'Pending')

            @else
            <label for="">Discount:</label> 
            <label for="">PHP {{$infos->discount_price}}</label>
            @endif
          
           @if ($infos->status == 'Pending')
           <br> <label style="margin-top: 2px" for="">Status:</label>
           <label for="">{{$infos->status}}</label>
           @else
           <br>
           <label style="margin-top: 2px" for="">MOP:</label>
           <label for="">{{$infos->mode_of_payment}}</label> 
           @if ($infos->mode_of_payment == "Cash")
            <br><label style="margin-top: 2px" for="">Payment:</label>
           <label for="">PHP {{number_format("$infos->payment",2)}}</label> 
           <br>
           <label style="margin-top: 2px" for="">Change:</label>
           <label for="">PHP {{number_format("$infos->change",2)}}</label>
           @else
           <br> <label style="margin-top: 2px" for="">Reference no.:</label>
           <label for="">{{$infos->reference_no}}</label>
           @endif
            <br>
            <br>
           <label style="margin-top: 2px;font-size:24px;font-weight:800;" for="">TOTAL:</label>
           <label style="margin-top: 2px;font-size:24px;font-weight:800;" for="">PHP {{number_format("$infos->total",2)}}</label>
        @endif
        </div>
        <div class="signature">
            <img height="50" width="110" style="margin-bottom:0px" src="{{ "data:image/png;base64,".base64_encode(file_get_contents(public_path('signature.png'))) }}" alt="Psychologist Signature">
            <p class="docname">JOSEPH G. MARQUEZ</p>
                
                    <p style="margin:0;padding:0;line-height: 17px;
                    text-align: center;font-style: italic;">Psychologists</p>
          </div>
</body>

</html>
