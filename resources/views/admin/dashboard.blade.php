@extends('layouts.admin_navigation')
@section('content')
    <div class="row m-4" style="font-family: Poppins;">
        <div style="margin-top: 20px; margin-bottom:20px">
            <h3>GOOD DAY, <b>ADMIN</b></h3>

            <label for="">time</label>
            <div id="demo"></div>
        </div>
        
        
        <div class="container">
            <div class="row " >
              <div class="col-sm " style=" border-left:12px solid white;
              height: 135px; border-radius: 10px; background-color:#829460;" >
              <div >

              </div>
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 >USERS:</h5>
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
                    <h5 >SALES:</h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: white; font-size:40px;">
                  <h1 style="font-size: 45px" >₱ 2000.00</h1>
                </div>
              </div>

              {{-- <div class="col-sm border border-secondary" style=" margin-right:15px; border-radius: 10px; background-color:#829460; height:130px" >
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h4 >SALES:</h4>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                  <h1 style="font-size: 50px" >2000.00</h1>
                </div>
              </div> --}}

              <div class="col-sm" style=" border-radius: 10px; border-left:12px solid white;background-color:#829460; height:135px">
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 >PENDING:</h5>
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
                <h3 >Current Appointment</h3>
                <table style="width:100%; margin-top:10px; " class=" table table-bordered table-striped" >
                  <thead>
                    <tr>
                        <th>id</th>
                        <th>Fullname</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>       
                    </tr>
                </thead>
                <tbody style="text-align: center" >
                  @if (count($appointments)> 0 )
                  @foreach ($appointments as $appointment)
                  <tr class="overflow-auto;" style="text-align: center">
                      <td>{{$appointment->user_id}}</td>
                      <td>{{$appointment->fullname}}</td>
                      <td>{{date('m/d/Y', strtotime($appointment->date))}}</td>
                      <td>{{date('h:i A', strtotime($appointment->time))}}</td>
                       <td>{{$appointment->service}}</td>
                       
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4" style="text-align: center;">No appointment Found</td>
              
                  </tr>
                  @endif
                   
                </tbody>
                </table>
              </div>
             
            </div>
          </div>

          <div class="d-flex bd-highlight container" style="padding: 0; margin-top:30px">
            <div class="p-2  bd-highlight" style="border-radius: 25px; background-color:#829460; height:400px; width:70%; margin-right:20px">
              <div id="highcharts"></div>
            </div>

            <div class="p-2 bd-highlight" style="border-radius: 25px; background-color:#829460; height:400px; width:30%">Flex item</div>
          </div>
        </div>
        @endsection

{{-- @extends('layouts.admin_navigation')
@section('content')
    <div class="row m-4">
        <div style="margin-top: 20px; margin-bottom:20px">
            <h3>GOOD DAY, <b>ADMIN</b></h3>
        </div>
        
        
        <div class="container">
            <div class="row " >
              <div class="col-sm " style=" border-left:12px solid white;
              height: 135px; border-radius: 10px; background-color:#F26969;" >
              <div >

              </div>
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 >USERS:</h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                        <h1 style="font-size: 45px" >{{$users}}</h1>
                </div>
                
              </div>
              <div class="col-sm " style="margin-left: 15px; margin-right:15px; border-radius: 10px; background-color:#40DE7A; border-left:12px solid white;
              height: 135px;" >
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 >SALES:</h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                  <h1 style="font-size: 45px" >₱ 2000.00</h1>
                </div>
              </div>

              <div class="col-sm" style=" border-radius: 10px; border-left:12px solid white;background-color:#3B82F6; height:135px">
                <div class="p-1" style="color: aliceblue">
                    Total
                    <h5 >PENDING:</h5>
                </div>
                <div class="d-flex justify-content-center"  style="color: aliceblue; font-size:40px">
                  <h1 style="font-size: 45px" >{{$pending}}</h1>
          </div>
              </div>

              
            </div>
          </div>

          <div class="container" style="margin-top: 20px">
            <div class="row " >
              <div class="col-sm " style=" border-radius: 10px; background-color:white; height:450px; padding-top:25px" >
                <h3 >Current Appointment</h3>
                <table style="width:100%; margin-top:10px; background-color:aliceblue" class=" table table-bordered table-striped" >
                  <thead>
                    <tr>
                        <th>id</th>
                        <th>Fullname</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>       
                    </tr>
                </thead>
                <tbody style="text-align: center" >
                  @if (count($appointments)> 0 )
                  @foreach ($appointments as $appointment)
                  <tr class="overflow-auto">
                      <td>{{$appointment->user_id}}</td>
                      <td>{{$appointment->fullname}}</td>
                      <td>{{date('m/d/Y', strtotime($appointment->date))}}</td>
                      <td>{{date('h:i A', strtotime($appointment->time))}}</td>
                       <td>{{$appointment->service}}</td>
                       
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4" style="text-align: center;">No appointment Found</td>
              
                  </tr>
                  @endif
                   
                </tbody>
                </table>
              </div>
             
            </div>
          </div>

          
          <div class="d-flex bd-highlight container" style="padding: 0; margin-top:30px">
            <div class="p-2  bd-highlight" style="border-radius: 25px; background-color:#829460; height:400px; width:70%; margin-right:20px">
              <div id="highcharts"></div>
            </div>

            <div class="p-2 bd-highlight" style="border-radius: 25px; background-color:#829460; height:400px; width:30%">Flex item</div>
          </div>

          

    </div>




@endsection --}}


@section('scripts')
<script>
$(document).ready(function(){
  function myClock() {         
  setTimeout(function() {   
    const d = new Date();
    const n = d.toLocaleTimeString();
    document.getElementById("demo").innerHTML = n; 
    myClock();             
  }, 1000)
}
myClock();  
})
  $(function(){
      var services = {!! json_encode($services) !!} ;
      var male = {!! json_encode($males) !!} ;
      var female = {!! json_encode($females) !!} ;
    console.log(services ,male, female);

    $('#highcharts').highcharts({
      chart:{
        height: 380,
        type:'column',
        backgroundColor: 'rgba(130, 148, 96, 1)'
      },
      title:{
        text:'Monthly services'
      },
      xAxis:{
        categories:['January', 'Febraury', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]
      },
      yAxis:{
        title:{
          text:'Gender'
        }
      },
      series:[{
        name: 'Male',
        data: [6, 3, 6, 9, 2]
        // male
      },{
        name: 'female',
        data: [1, 3, 4, 6, 3]
        // female
      }]
    })
  });

</script>

@endsection


