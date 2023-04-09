@extends('layouts.navbar')
@section('content')



  
<div class="container">

      <div class="col-sm-9  mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="login d-flex justify-content-center py-5">
            <div class="container">
          
                <div class="col-md-9 col-lg-8 mx-auto text-center">
               
                  <h3 class="login-heading mb-4"> Available time for {{ session('datetoday') }}</h3>
            
                  <div class="column">
{{-- 
                    @foreach(session('workinghours') as $hour)
                    @if ($appointment['time'] == $hour->from )
                        
                    @else
                        
                    @endif
                    @endforeach --}}

                    <div class="col 1">
                            @foreach(session('workinghours') as $hour)
                                <input type="hidden" class="date" name="date" value=" {{ session('datetodays') }}">
                                <input type="hidden" name="time" class="time" value="{{$hour->from}}">
                                    <button class="add waves-effect waves-light btn info bg-primary" value=" {{$hour['from']}}" type="submit">
                                        {{$hour['from']}}
                                    </button>
                                    <br>
                                    <br>
                               
                               
                                    {{-- <p>{{$hour->from}}</p> --}}
                            @endforeach
                        </div>
                   
  
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
</div>

    
{{-- <div class="">
    <h1 class="center">
      Available time for {{ session('datetoday') }}
    </h1>

    <div class="row">
        @foreach(session('workinghours') as $hour)
                  <div class="col 1">
                    @if ($loop->first)
                    <h5 class="center">
                        {{$hour['day']}}
                    </h5>
                @endif
                @endforeach
                @foreach(session('workinghours') as $hour)
                    <input type="hidden" class="date" name="date" value=" {{ session('datetoday') }}">
                    <input type="hidden" name="time" value="{{$hour}}">
                        <button class="add waves-effect waves-light btn info bg-primary" value="  {{$hour['from']}}" type="submit">
                            {{$hour['from']}}
                        </button>
                        <br>
                        <br>
               
                @endforeach
            </div>
        </div> --}}



        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Appointment</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-5 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <input type="hidden" id="fulldate">
                        <label class="mb-0 rounded bg-[#EDDBC0] ml-3" >Date</label>
                        <input class="servicename bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" readonly id="date" type="text"> 
                      
                        <label class="mb-0 rounded bg-[#EDDBC0] mt-2 ml-3" >time</label>
                        <input class="servicename bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 " readonly id="time" type="text"> 
                   
                        <label class="mb-0 rounded bg-[#EDDBC0] mt-2 ml-3" >Service: </label><br>
                        <select name="gender" class="service" id="servicename" >
                          <option value="" ></option>
                          @foreach ($services as $service)
                          <option value="{{$service->servicename}}" >{{$service->servicename}}</option>
                          @endforeach
                        
                        </select>
                        <br>
                        <label class="price mb-6 rounded bg-[#EDDBC0] mt-2 ml-3">Price</label>
                        <input class="price bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" readonly id="price" type="text">
                            
                        <div class="mt-0 mb-2">
                            <span  role="alert" class="block mt-5   text-danger" id="error_price"></span>
                        </div>
                      {{-- </form> --}}
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class=" book p-2 w-30 bg-[#829460]  mt-7 rounded" >Book</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            twelveHour:false
        });
    });

    $(document).ready(function (){

        $(document).on('click', '.add', function(e){
            e.preventDefault();
            //open yung value
            var time = $(this).val();
            var date = $('.date').val();


            //open yung modal
            $('#edit').modal('show');
            $('#date').val(date);
            $('#time').val(time);

        });

            $('#servicename').on('change', function(e){
                e.preventDefault();
                let servicename = $(this).val();

                $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                     }
                });
     
                $.ajax({
                type: "GET",   
                url: "/patient/service-get/" + servicename, 
                datatype: "json",
                success: function(response){ 
                    $('#price').val(response.price[0].price);
                }
            });
            })

            $(document).on('click', '.book', function(e){
              e.preventDefault();

              var data ={
                'date' : $('#date').val(),
                'time': $('#time').val(),
                'service': $('.service').val(),
                'price': $('#price').val(), 
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // console.log(data);
            $.ajax({
              type: "POST",
              url: "/patient/appointment/create",
              data: data,
              datatype: "json",
              success: function(response){
                  console.log(response);
                  // window.location.href = response;
                  }
              });


            });
    });
</script>

@endsection

