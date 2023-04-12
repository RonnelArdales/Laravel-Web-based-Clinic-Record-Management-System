@extends('layouts.admin_navigation')

@section('content')
    <div class="row m-4">
      <div class="col-md-8 col-md-offset-5">
        <h1>Queuing</h1>
    </div>
    

       <div id="success"></div>
       <div style="margin-top: 18px; align-items:center; display:flex; d-flex;  margin-bottom:1%;">
        <div class="me-auto">
          <i class="fa fa-search"></i>
          <input type="text" name="fullname" id="fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;"> 
        </div>
       </div>
   
       <div class="card table-appointment" style="background:#EDDBC0;border:none; "  >
           <div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; ">
             <div  style="width:100%; " >
               <table class="table table-bordered table-striped "  style="background-color: white" >
                   <thead>
                       <tr>
                           <th>id</th>
                           <th>Patient Id</th>
                           <th>Fullname</th>
                           <th>Date</th>
                           <th>Time</th>
                           <th>Service</th>
                           <th>Price</th>
                           <th>Status</th>
                           <th >Action</th>
                        
                       </tr>
                   </thead>
                   <tbody >
                     @if (count($appointments)> 0 )
                     @foreach ($appointments as $appointment)
                     <tr class="overflow-auto">
                       <td>{{$appointment->id}}</td>
                         <td>{{$appointment->user_id}}</td>
                         <td>{{$appointment->fullname}}</td>
                         <td>{{date('m/d/Y', strtotime($appointment->date))}}</td>
                         <td>{{date('h:i A', strtotime($appointment->time))}}</td>
                          <td>{{$appointment->service}}</td>
                          <td>{{$appointment->price}}</td>
                          <td>{{$appointment->status}}</td>
                         <td style="text-align: center;" >
                         <button type="button" value="{{$appointment->id}}" class="cancel btn btn-primary btn-sm">Cancel</button>
                         <button type="button" value="{{$appointment->id}}" class="delete btn  btn-danger btn-sm">Delete</button></td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                       <td colspan="9" style="text-align: center;">No appointment </td>
                 
                     </tr>
                     @endif
                      
                   </tbody>
               </table>
             </div>
           </div>
           <div>
            {!! $appointments->links() !!}
          </div>
       </div>


       
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){

      deleteall();
        
        function deleteall () {
            if (window.location.href) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/billing/addtocart/deleteall",
                datatype: "json",
                success: function(response){ 
                }
            });
                
            }
        }

        $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
              let page = $(this).attr('href').split('queuing=')[1]
              queuing(page);
        });

        function queuing(page){
          let data = page;
          console.log(page);
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
              $.ajax({
                type: "GET",  
                url: "/admin/queuing/pagination/paginate-data?queuing="+page ,
                data: {data: data}, 
                datatype: "json",
                success: function(response){
                  console.log(response);
                $('.table-appointment').html(response);
                  }
              });
        }

        $('#fullname').on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname').val();
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/queuing_fullname/search-name',
            method:'GET',
            data: {search:search,},
            success:function(response){ 
              $('.table-appointment').html(response);
              if(response.message == 'Nofound'){                 
                $('.table-appointment').append('<div class="card-body" style="width:100%; height:68vh; display: flex; overflow-x: auto;  font-size: 15px;">\
             <div  style="width:100%; ">\
               <table class="table table-bordered table-striped "  >\
                   <thead>\
                       <tr>\
                           <th>id</th>\
                           <th>Patient Id</th>\
                           <th>Fullname</th>\
                           <th>Date</th>\
                           <th>Time</th>\
                           <th>Service</th>\
                           <th>Price</th>\
                           <th>Status</th>\
                           <th style="width: 205px">Action</th>\
                       </tr>\
                   </thead>\
                   <tbody >\
                     <tr>\
                       <td colspan="9" style="text-align: center;">No appointment Found</td>\
                     </tr>\
                   </tbody>\
               </table>\
             </div>\
           </div>')
               }
            }
          });
        })



    });
</script>

@endsection