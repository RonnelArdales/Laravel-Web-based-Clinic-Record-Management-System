@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">
    <div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
        <div class="me-auto">
        {{-- <i class="fa fa-search"></i>
            <input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
            <div class="col-md-8 col-md-offset-5">
                <h1><B>DISCOUNT</B></h1>
            </div>
        </div>
    
        <button type="button"  style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create"> Create
        </button>
    </div>

    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px;" id="message-success"></p> 
    </div>

    <div id="success"></div>

    <div class="card" style="background:#EDDBC0;border:none; height:500px " >
        <div class="card-body" style="width:100%; min-height:72vh; display: flex; overflow-x: auto;  font-size: 15px; ">
            <div class="" style="width:100%; " >
                <table class="table table-bordered table-striped"  style="background-color: white ; margin-bottom:0px" >
                    <thead>
                        <tr>
                            <th>discount code</th>
                            <th>discount name</th>
                            <th>percent</th>
                            <th  style="width: 205px">Actions</th>
                        </tr>
                    </thead>
                    <tbody >
                        @if (count($discounts)> 0 )
                            @foreach ($discounts as $discount)
                            <tr class="overflow-auto">
                                <td>{{$discount->discountcode}}</td>
                                <td>{{$discount->discountname}}</td>
                                <td>{{$discount->percentage}}</td>
                                <td style="text-align: center">
                                <button type="button" value="{{$discount->discountcode}}" class="edit btn btn-primary btn-sm">Edit</button>
                                <button type="button" value="{{$discount->discountcode}}" class="delete btn  btn-danger btn-sm">delete</button></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center;">No Discount Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  

    {{-- create modal --}}
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"  style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Discount</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-5 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Discount name</label>
                            <input class=" discountname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text"> 
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="name"></span>
                            </div>
                            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Percentage</label>
                            <input class="percentage bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" type="number">
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5 pb-4 text-danger" id="percent"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                    <button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" add_discount " >Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"  style="background: #EDDBC0;">
                <div class="modal-header" style="border-bottom-color: gray">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit discount</h1>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-5 pt-6  ">
                        <div class=" columns-1 sm:columns-2">
                            <input type="hidden" id="discountcode">
                            <label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Discount name</label>
                            <input class="discountname bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_discountname" type="text"> 
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_discountname"></span>
                            </div>
                            <label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Percentage</label>
                            <input class="percentage bg-white rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400" id="edit_percentage" type="number">
                            <br>
                            <div class="mt-0 mb-2">
                                <span  role="alert" class="block mt-5   text-danger" id="error_percent"></span>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top-color: gray">
                    <button  style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button"  data-bs-dismiss="modal">Close</button>
                    <button style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; "  class=" update_discount " >Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- //delete modal --}}

    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"  style="background: #EDDBC0;">
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                            <input type="hidden" id="discountcode">
                            <h4>Do you want to delete this data?</h4>
                        </div>
                    </div>
                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button"style="margin-right:15px; background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " data-bs-dismiss="modal">Close</button>
                        <button class=" delete_discount" style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " >Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        let usertype = "{{Auth::user()->usertype}}"; 
    </script>

    <script src="{{mix('js/system_settings/discount.js')}}"></script>

@endsection


