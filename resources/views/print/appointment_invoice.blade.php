<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<style>
    label{
        font-family: 'Poppins';
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

      <div class="row m-3" style="font-family: poppins;">
        <h2 style=" text-align: center;">RESERVATION RECEIPT</h2>
        <hr>
        <div class="container" >
                    
            <div class="column column1">
    
                <label for="">User ID:</label>
                <label for="">{{$appointments->user_id}}</label>
                  <br>
                <label style="margin-top: 2px" for="">Fullname:</label>
                <label for="">{{$appointments->fullname}}</label>
                <br>
                <label style="margin-top: 2px" for="">Contact Number:</label>
                <label for="">{{$appointments->contact_no}}</label>
                <br>
                <label style="margin-top: 2px" for="">Email :</label>
                <label for="">{{$appointments->email}}</label>
                <br>
                <label style="margin-top: 2px" for="">Reservation fee :</label>
                <label for="">{{$appointments->reservation_fee}}</label>
                <br>
                <label style="margin-top: 2px" for="">Mode of payment :</label>
                <label for="">{{$appointments->mode_of_payment}}</label>
                <br>
                <label style="margin-top: 2px" for="">Status :</label>
                <label for="">{{$appointments->status}}</label>
                <br>
             
            </div>
    
            <div class="column column2" >
                <div style="margin-left:140px">
                    <label for="">Appointment No.:</label>
                    <label for="">{{$appointments->id}}</label>
                   
                   <br> <label style="margin-top: 2px" for="">Billing Date:</label>
                  <label for="">{{now()->format('M d, Y')}}</label>
                
                  </div>
            </div>
            </div> 


    <div class="container" style="margin-top:15px" >
                    
        <div class="column column1">
         
        </div>

        <div class="column column2" >

        </div>
        </div> 

    
    
    </div>

</body>

</html>