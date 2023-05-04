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
        <h2 style=" text-align: center;">INVOICE RECEIPT</h2>
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
    
    
            <div style="margin-top:140px">
                <h2>Services</h2>
            </div>
    
            <table >
                <thead>
                    <tr style="text-align: center;">
                  
                        <th>Service code</th>
                        <th>Name</th>
                        <th>Price</th>
                  
                    </tr>
                </thead>
    
                <tbody class="patient-error" >
                    @if (count($services)> 0 )
                    @foreach ($services as $service)
                    <tr class="overflow-auto">
                        <td style="text-align: center;"> {{$service->servicecode}}</td>
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

</html>

