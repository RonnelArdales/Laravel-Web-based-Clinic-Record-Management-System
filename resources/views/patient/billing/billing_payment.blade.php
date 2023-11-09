@extends('layouts.navbar')
@section('content')
    
<div>
    <div style="width:100%; height:150px" class="d-flex justify-content-center">
        <img style="width:100%; height:150px" src="{{url('guestpage/share.png')}}" alt="">
    </div>
    <div class="container" style="margin-top: 20px; margin-bottom:20px"> 
        Home >> <b>BOOK NOW</b>
    </div>

    <div class="container" style="margin-bottom: 140px">
        <div class="row"  >
            <p style="margin-bottom:5px"><b>Billing Process</b></p>
            {{-- box-sizing: border-box;font-family:Poppins; background:#EDDBC0; margin-bottom:4%;padding-bottom:1%;margin-top:5%;box-shadow: 10px 10px 10px 5px rgba(0, 0, 0, 0.25); --}}
            <div class="rounded  col-sm-9 row" style="padding-left:35px;padding-right:35px;padding-top:100px; padding-bottom:100px; margin:0px; box-shadow: 10px 10px 10px 5px rgba(0, 0, 0, 0.25); ">  
                <div class="col-sm "> 
                    <form action="" method="post">
                        @csrf
                        <div class="form-group" style="">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 " >ID:</label>  
                            <input class="view1 bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" name="user_id" readonly value="{{Auth::user()->id}}"  type="text">
                        </div>

                        <div class="form-group" style="">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 " >Fullname:</label>  
                            <input class="view1 mname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" name="fullname" readonly value="{{Auth::user()->fname }} {{Auth::user()->lname }}"  type="text">
                        </div>
                    
                        <div class="form-group" style="">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 " >Date:</label>  
                            <input class="view1 mname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" name="date" readonly value="{{{$info['date']}}}"  type="text">
                        </div>

                        <div class="form-group" style="">
                            <label class="mb-0 rounded bg-[#EDDBC0]  mb-2 ml-3 " >Time:</label>  
                            <input class="view1 mname bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" name="time" id="view_fname" readonly value="{{{$info['time']}}}"  type="text">
                        </div>

                        <div class="form-group" style="">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3 " >Reservation fee:</label>  
                            <input class="view1 bg-[#EDDBC0] rounded text-gray-700 focus:outline-none border-b-4 border-gray-400" name="reservation_fee" readonly value="{{$fee->reservationfee}}"  type="text">
                        </div>

                        <div class="form-group mb-2 ml-3 " style="">
                            <label class="mb-0 rounded bg-[#EDDBC0] " >Mode of payment:</label>
                            <select name="mop" id="mop" class="text-currency rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background:#DDDDDD ; width:170px" >
                            <option value="">--select--</option>
                            @foreach ($mops as $mop)
                                <option value="{{$mop->modeofpayment}}">{{$mop->modeofpayment}}</option>
                            @endforeach  
                            </select>  
                            @error('mop')
                                <br><span style="margin-bottom:10px"  role="alert" class="block  text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-2 ml-3 ">
                            <label for="">Reference code:</label>
                            <input type="text" class="text-currency rounded text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" style="background:#DDDDDD ; width:170px" name="reference_no" id="reference"><br>
                            @error('reference_no')
                                <span  style="margin-bottom:10px" role="alert" class="block  text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <div class="d-flex justify-content-center row" style="text-align: center; margin-top:35px">
                            <a style=" background: transparent; line-height: 30px;;text-decoration:none;border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; margin-right:20px "   href="/patient/appointment"> Cancel </a>
                            <button   class="proceed"  type="button" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px; height: 37px; ">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm mt-4 mt-sm-0 d-flex justify-content-center modeofpay" style="width: 300px; height:300px">
                    {{-- <img src="{{url('/logo/gcash.png')}}" style="border-radius:20px" width="300" height="300" alt=""> --}}
                </div>
            </div>   
            <div class="col-sm " style="margin-left: 20px"  > </div>
        </div>
    </div>

    <div class="modal fade" id="billing-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #EDDBC0;">
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                            <h4>Are you sure you want to continue?</h4>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class=" close " style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px;height: 37px; " data-bs-dismiss="modal">No</button>
                        <form action="{{route('appointment.store')}}" method="POST">
                            @csrf
                            <input hidden type="text"  name="reference_no" id="confirmation-referenceno">
                            <input hidden name="user_id" readonly value="{{Auth::user()->id}}"  type="text">
                            <input hidden name="fullname" readonly value="{{Auth::user()->fname }} {{Auth::user()->lname }}"  type="text">
                            <input hidden name="mop" id="confirmation-mop" readonly   type="text">
                            <input hidden name="reservation_fee" readonly value="{{$fee->reservationfee}}"  type="text">
                            <input hidden name="date" readonly value="{{{$info['date']}}}"  type="text">
                            <input hidden name="time" id="view_fname" readonly value="{{{$info['time']}}}"  type="text">
                            <button type="submit" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; ">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

    $(document).ready(function(){
        $('.proceed').on('click', function(){
            var mop = $('#mop').val();
            var reference = $('#reference').val();
            $('#confirmation-referenceno, #confirmation-mop').val("");
            $('#confirmation-referenceno').val(reference);
            $('#confirmation-mop').val(mop);
            console.log(reference + ' ' + mop); 
            $('#billing-confirmation').modal('show');
        });

        $('#mop').on('change', function(){
            var mop = $(this).val();
            $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
            if(mop.length > 0){
                $.ajax({
                    url:"/patient/billing/getmop/"+mop,
                    datatype: "json",
                    data:{
                    },
                    success:function(response){
                        $('.modeofpay').html("");
                        var imageUrl = "{{ url('/modeofpayment') }}" + '/' +response.mop.image;
                        $('.modeofpay').append(`<img src="${imageUrl}" style="border-radius:20px" width="300" height="300" alt="">`);
                    }
                });
            }else{
                $('.modeofpay').html("");
            }
        })
    });

</script>
@endsection