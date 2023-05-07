@extends('layouts.admin_navigation')
@section('title', 'Home')
@section('content')


    <div class="row m-4" style="font-family: Poppins;">
        <div style="margin-top: 20px; margin-bottom:30px" class="d-flex justify-content-between">
            <h3>GOOD DAY, <b>ADMIN</b></h3>

          <div >
            <div>
              {{ now()->format('M d, Y') }}
            </div>
            <div style="text-align: right;" id="demo"></div>
          </div>
            
        </div>
        
        {{-- <a href="/admin/sendsms">Send sms</a> --}}

        <div class="container">
            <div class="row " >
              <div class="col-sm " style=" border-left:12px solid white;
              height: 135px; border-radius: 10px; background-color:#829460;" >
              <div >

              </div>
              
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 > <b>USERS:</b> </h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                        <h1 style="font-size: 45px" >{{$users}}</h1>
                </div>
                
              </div>
              <div class="col-sm " style="margin-left: 15px; margin-right:15px; border-radius: 10px;background: #829460;
              border-left:12px solid white;
              height: 135px;" >
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 > <b>TODAY SALES:</b> </h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: white; font-size:40px;">
                  <h1 style="font-size: 45px" >₱ {{ number_format($transaction, 2) }}</h1>
                </div>
              </div>

              <div class="col-sm" style=" border-radius: 10px; border-left:12px solid white;background-color:#829460; height:135px">
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 > <b>PENDING APPOINTMENTS:</b> </h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                  <h1 style="font-size: 45px" >{{$pending}}</h1>
          </div>
              </div>

              
            </div>
          </div>
              <div class="container" style="margin-top: 20px" style="background: #EDDBC0;">
            <div class="row " >
              <div class="col-sm " style=" border-radius: 10px;  height:450px; padding-top:25px" >
                <h3 > <b>LATEST USER</b> </h3>
                <table style="width:100%; margin-top:10px; " class=" table table-bordered table-striped" >
                  <thead style="background-color: burlywood" >
                    <tr>
                        <th>id</th>
                        <th>fullname</th>
                        <th>Username</th>
                        <th>Usertype</th>
                        <th>Date created</th>       
                    </tr>
                </thead>
                <tbody style="text-align: center" >
                  @if (count($latests)> 0 )
                  @foreach ($latests as $latest)
                  <tr class="overflow-auto">
                      <td>{{$latest->id}}</td>
                      <td>{{$latest->fname}} {{$latest->lname}} </td>
                      <td>{{$latest->username}}</td>
                      <td>{{$latest->usertype}}</td>
                      <td>{{date('M d, Y h:i A', strtotime($latest->created_at))}}</td>
         
                       
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="5" style="text-align: center;">No appointment Found</td>
              
                  </tr>
                  @endif
                   
                </tbody>
                </table>
              </div>
             
            </div>
          </div>

          <div class="d-flex bd-highlight container" style="padding: 0; margin-top:px">
            <div class=" " style=" width:100%; ">
              <div id="highcharts"></div>
            </div>

          </div>
 
     
     
       
          <div class="d-flex bd-highlight container" style="padding: 0; margin-top:30px">
            <div class=" " style=" width:100%; ">
              <div class="select-wrapper" style="margin-bottom: 10px">
                <label for="">Filter</label>
                <select name="" id="year-filter">
                  <option value="">--select year--</option>
                  @foreach (range(date('Y') + 3 , 1900) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                  @endforeach
                </select>
              </div>
              <div id="diagnosis"></div>
            </div>

          </div>

        </div>
        @endsection



@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

  function myClock() {         
  setTimeout(function() {   
    const d = new Date();
    const date = d.toLocaleDateString();
    const n = d.toLocaleTimeString();
    document.getElementById("demo").innerHTML = n ; 
    myClock();             
  }, 1000)
}
myClock();  



  var sales = {!! json_encode($transactionArray) !!} ;
  transactionArray = sales.map(function(value) {
        return parseFloat(value);
    });
  var totals = {!! json_encode($totals) !!} ;
  var dataArray = [];

// Loop through the keys of the object and create an array of arrays
for (var key in totals) {
  if (totals.hasOwnProperty(key)) {
    dataArray.push([parseInt(key) - 1 , totals[key]]);
  }
}

console.log(dataArray);

// The resulting array can be used in Highcharts

  Highcharts.chart('highcharts',{
      chart:{
        height: 380,
        backgroundColor:  '#EDDBC0',
       
      },
          title:{
          text:'Monthly Sales'
        },

      xAxis:{
        categories:['January', 'Febraury', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
      
      },

      yAxis: {
        title: {
            text: 'Amount'
        },
        gridLineColor: '#000000'
      
    },

      series:[{
        name: 'total sales',
        data:  dataArray,
      }]

      

  })


      var diagnosis = {!! json_encode($diagnosis) !!} ;
      var male = {!! json_encode($males) !!} ;
      var female = {!! json_encode($females) !!} ;


  var diagnosis_graph =   Highcharts.chart('diagnosis',{
      chart:{
        height: 380,
        type:'column',
        backgroundColor: '#EDDBC0'
      },
      title:{
        text:'Yearly Mental Health Statistic'
      },
      xAxis:{
        categories:diagnosis
      },
      yAxis:{
        title:{
          text:'Gender'
        }
      },
      series:[{
        name: 'Male',
        data: male,
        
      },{
        name: 'female',
        data: female

      }]
    })





  $('#year-filter').on( 'change', function() {
    var selectedYear = $(this).val();

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "GET", 
                url: "/diagnosis/filter/"+selectedYear , 
                datatype: "json",
                success: function(response){ 
                  if (response.diagnosis.length  == 0 ) {
                    diagnosis_graph.setTitle({ text: 'No Record Found' }); 
                    diagnosis_graph.series[0].setData(response.male);
                diagnosis_graph.series[1].setData(response.female);
                  } else {
                    diagnosis_graph.setTitle({ text: 'Yearly Mental Health Statistic' }); 
                    diagnosis_graph.xAxis[0].setCategories(response.diagnosis); 
                diagnosis_graph.series[0].setData(response.male);
                diagnosis_graph.series[1].setData(response.female);
                  }

           
                }

            }); 
  });



  


})


</script>

@endsection


