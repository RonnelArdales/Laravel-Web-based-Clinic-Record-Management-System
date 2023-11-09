@extends('layouts.admin_navigation')
@section('content')
<div class="row m-4">

	<div style="margin-top: 15px; align-items:center; display:flex; d-flex;  margin-bottom:1%;" >
		<div class="me-auto">
		{{-- <i class="fa fa-search"></i>
		<input type="search" name="appointment_name" id="appointment_name" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" >  --}}
			<div class="col-md-12 col-md-offset-12">
				<h1><B>MODE OF PAYMENT</B></h1>
			</div>
		</div>
	

		<button type="button"  style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1.2vw; color:white; padding-left:20px; padding-right:20px" class="btn btn-primary ml-20" data-bs-toggle="modal" data-bs-target="#create">
			Create
		</button>

	</div>

	<div id="success" class="success alert alert-success" role="alert" style="display:none">
		<p style="margin-bottom: 0px" id="message-success"></p> 
	</div>

	<div class="card" style="background:#EDDBC0;border:none; height:500px " >
		<div class="" style="padding:0% " >
			<div class="card-body" style="width:100%; min-height:63vh; display: flex; overflow-x: auto;  font-size: 15px; " >
				<table class="table table-bordered table-striped"  style="background-color: white; margin-bottom:0px" >
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Image</th>
							<th >Actions</th>
						</tr>
					</thead>
					<tbody >
					@if (count($mops)> 0 )
						@foreach ($mops as $mop)
						<tr class="overflow-auto">
							<td>{{$mop->id}}</td>
							<td>{{$mop->modeofpayment}}</td>
							<td>{{$mop->image}}</td>
							<td style="text-align: center">
							<button type="button" value="{{$mop->id}}" class="edit btn btn-primary btn-sm">Edit</button>
							<button type="button" value="{{$mop->id}}" class="delete btn  btn-danger btn-sm">delete</button></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4" style="text-align: center;">No Mode of Payment Found</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
			<div style="">
				{!! $mops->links() !!}
			</div>
		</div>
	</div>
  

	{{-- create user modal --}}
	<div class="modal fade" id="create"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content"  style="background: #EDDBC0;">
				<div class="modal-header" style="border-bottom-color: gray">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Create Mode of Payment</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-5 pt-6  ">
						<div class=" columns-1 sm:columns-2">
							<form method="POST" id="store_data" enctype="multipart/form-data" >
							{{ csrf_field() }}
							<label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mode of payment</label>
							<input name="mop" class=" mop_name rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" type="text" style="background: #D0B894;"> 
							<br>
							<div class="mt-0 mb-2">
								<span  role="alert" class="block mt-5 pb-4 text-danger" id="mop"></span>
							</div>
							<label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Image</label><br>
							<input id="image" name="image" class="image " type="file">
							<div class="mt-0 mb-2">
								<span  role="alert" class="block mt-5 pb-4 text-danger" id="image"></span>
							</div>
							<br>
						</div>
					</div>
					<div class="modal-footer" style="border-top-color: gray">
						<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" add_discount " >Create</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- edit modal --}}
	<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
			<div class="modal-content"  style="background: #EDDBC0;">
				<div class="modal-header" style="border-bottom-color: gray">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-5 pt-6  ">
						<div class=" columns-1 sm:columns-2">
							<form method="POST" id="update_data" enctype="multipart/form-data" >
									{{ csrf_field() }}
							<label class="mb-0 rounded bg-[#EDDBC0] mb-2 ml-3" >Mode of payment</label>
							<input type="text" hidden id="mop_id">
							<input name="mop" class=" edit_mop_name rounded w-100 text-gray-700 focus:outline-none border-b-4 border-gray-400 mg-5" id="edit_mop_name" style="background: #D0B894;" type="text"> 
							<br>
							<div class="mt-0 mb-2">
							<span  role="alert" class="block mt-5 pb-4 text-danger" id="error_mop"></span>
							</div>
							<label class="mb-6 rounded bg-[#EDDBC0] mb-2 ml-3">Image</label><br>
							<input id="image" name="image" class="image " type="file">
							<div class="mt-0 mb-2">
								<span  role="alert" class="block mt-5 pb-4 text-danger" id="error_image"></span>
							</div>
							<br>
						</div>
					</div>
					<div class="modal-footer" style="border-top-color: gray">
						<button style="background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; " type="button" class=" close btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button  style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" add_discount " >Create</button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	{{-- //delete modal --}}

	<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" >
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
								<input type="text" hidden id="deletemopid">
							<h4>Do you want to delete this data?</h4>
					
						{{-- </form> --}}
					</div>
					</div>
					<div style=" display: flex; justify-content: center; margin-bottom:40px "  >
						<button style="margin-right:15px;background: transparent; border-radius: 30px; color:#829460; border: 2px solid #829460;width: 110px; height: 37px; "  type="button" class=" btn" data-bs-dismiss="modal">Close</button>
						<button style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; " class=" delete_mop" >Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


  

@endsection

@section('scripts')

	<script>
		var usertype = "{{Auth::user()->usertype}}"; 

	</script>

	@vite( 'resources/js/system_settings/modeofpayment.js')
	
@endsection

