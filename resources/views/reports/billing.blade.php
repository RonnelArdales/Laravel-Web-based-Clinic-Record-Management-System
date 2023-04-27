@extends('layouts.admin_navigation')

@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
 <h1>Billing report</h1>
    </div>

    <div style="margin-top: 15px; align-items:center;margin-bottom:1%;" >

      @if (Auth::user()->usertype == "admin")
      <form action="/admin/reports/print_billing" method="post">
        @csrf
        
        <div class="row" >
            <div class="col search_fullname" style="display: none;">
                <i class="fa fa-search"></i>
                <input type="text" name="fullname" id="fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" class="fullname" > 
           </div>

           <div class="col search_date" style="display: none;">
            <label for=""> from:</label>
            <input class="start_date" id="start_date" name="start_date" type="date">
            <label for="">to:</label>
            <input class="end_date" id="end_date" name="end_date" type="date">
       </div>

       <div class="col search_status" style="display: none;">
        <label for="">Status</label>
        <select name="status" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px" class="status" id="status">
         <option value="">Select Status</option>
         <option value="Paid">Paid</option>
         <option value="Pending">Pending</option>
       </select>
    </div>


      <div class="col search_modeofpayment" style="display: none;">
      <label for="">Status</label>
      <select name="mop" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px" class="mop" id="mop">
       <option value="">--Select-- </option>
       <option value="Cash">Cash </option>
        @foreach ($mops as $mop)
        <option value="{{$mop->modeofpayment}}">{{$mop->modeofpayment}}</option>
        @endforeach
     </select>
  </div>


    
           <div class="col  d-flex justify-content-end" style="width: 600px">
            <select name="filters" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:160px; margin-right:10px" class="filters" id="filters">
              <option value="">Select Filter</option>
              <option value="fullname">Fullname</option>
              <option value="date">Date</option>
              <option value="status">Status</option>
              <option value="modeofpayment">Mode of payment</option>
            </select> 
            <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
                Generate Report
              </button>
        </div>
          
        </div>
    </form>
      @else
      <form action="/secretary/reports/print_billing" method="post">
        @csrf
        
        <div class="row" >
            <div class="col search_fullname" style="display: none;">
                <i class="fa fa-search"></i>
                <input type="text" name="fullname" id="fullname" placeholder="search" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0;" class="fullname" > 
           </div>

           <div class="col search_date" style="display: none;">
            <label for=""> from:</label>
            <input class="start_date" id="start_date" name="start_date" type="date">
            <label for="">to:</label>
            <input class="end_date" id="end_date" name="end_date" type="date">
       </div>

       <div class="col search_status" style="display: none;">
        <label for="">Status</label>
        <select name="status" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px" class="status" id="status">
         <option value="">Select Status</option>
         <option value="Paid">Paid</option>
         <option value="Pending">Pending</option>
       </select>
    </div>


      <div class="col search_modeofpayment" style="display: none;">
      <label for="">Status</label>
      <select name="mop" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px" class="mop" id="mop">
       <option value="">--Select-- </option>
       <option value="Cash">Cash </option>
        @foreach ($mops as $mop)
        <option value="{{$mop->modeofpayment}}">{{$mop->modeofpayment}}</option>
        @endforeach
     </select>
  </div>


    
           <div class="col  d-flex justify-content-end" style="width: 600px">
            <select name="filters" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:160px; margin-right:10px" class="filters" id="filters">
              <option value="">Select Filter</option>
              <option value="fullname">Fullname</option>
              <option value="date">Date</option>
              <option value="status">Status</option>
              <option value="modeofpayment">Mode of payment</option>
            </select> 
            <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
                Generate Report
              </button>
        </div>
          
        </div>
    </form>
      @endif

   
      </div>

<div class="card table-div" style="background:#EDDBC0;border:none; ">
  <div class="billings" style="padding:0%; ">
    <div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
        <table class="table table-data table-bordered table-striped" style="background-color: white">
          <thead>
            <tr>
       
                <th>Transaction no</th>
                <th>Fullname</th>
                <th>Service</th> 
                <th>Total</th>
                <th>Mode of payment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="tbody" >
          @if (count($billings) > 0)
          @foreach ($billings as $billing)
          <tr class="overflow-auto" id="nouser">
              <td>{{$billing->transno}}</td>
              <td>{{$billing->fullname}}</td>
              <td>{{$billing->service}}</td>
              <td>{{$billing->total}}</td>
              <td>{{$billing->mode_of_payment}}</td>
              <td>{{$billing->status}}</td>
          </tr>
          @endforeach
          @else
          <tr id="nouser">
            <td colspan="7" style="text-align: center;">No user Found</td>
      
          </tr>
          @endif
           
        </tbody>
        </table>
    </div>

    <div>
      {!! $billings->links() !!}
    </div>

</div>
</div>
</div>   



@endsection



@section('scripts')
    
<script>
      $(document).ready(function (){


        function get_status(){
                            $('#status').empty();
                            $('#status').append('    <option value="">Select Status</option>\
                                                          <option value="Paid">Paid</option>\
                                                          <option value="Pending">Pending</option>\
                            ');
        }

        function clear_date(){
          $('#start_date').val("");
          $('#end_date').val("");
        }

        $('#filters').on('change', function(e){
                e.preventDefault();
                var filters = $(this).val();
               if(filters == 'fullname'){
                $('.billings').load(location.href+' .billings');
                    $('#fullname').val('');
                    $('.search_fullname').show();
                    $('.search_date').hide();
                    $('#mop').val('');
                    $('.search_modeofpayment').hide();
                    $('.search_status').hide();
                   
            
                    get_status();
                 clear_date();
               }else if(filters == 'date'){
                    $('.search_fullname').hide();
                    $('.search_date').show();
                    $('.search_status').hide();
                    $('.fullname').val('');
                    $('.billings').load(location.href+' .billings');
                    $('#mop').val('');
                    $('.search_modeofpayment').hide();
                    get_status();
                    clear_date();
               }else if(filters == 'status'){
                    $('.search_fullname').hide();
                    $('.search_date').hide();
                    $('.search_status').show();
                    $('.fullname').val('');
                    $('.billings').load(location.href+' .billings');
                    $('#mop').val('');
                    $('.search_modeofpayment').hide();
                    get_status();
                    clear_date();
               }else if(filters == 'modeofpayment'){
                    $('.search_fullname').hide();
                    $('.search_date').hide();
                    $('#mop').val('');
                    $('.search_modeofpayment').show();
                    $('.search_status').hide();
                    $('.fullname').val('');
                    $('.billings').load(location.href+' .billings');
          
                    get_status();
                    clear_date();
               }else{
                $('.billings').load(location.href+' .billings');
                    $('.search_fullname').hide();
                    $('.search_date').hide();
                    $('.search_status').hide();
                    $('#mop').val('');
                    $('.search_modeofpayment').hide();
                    $('.fullname').val('');
                 
                    get_status();
                    clear_date();
               }
            })


        

$(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
  
           let name = $('#fullname').val();
              let date = $('#start_date').val();
              let status = $('#status').val();
              let mop = $('#mop').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            if(name || date || status || mop){
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                    $('.billings').html(response);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.statusText);
                    }
                });
            }else{
                let page = $(this).attr('href').split('billings=')[1]
              billing(page);
            }
   
              
        });


        function billing(page){
          console.log(page);
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
              $.ajax({
                type: "GET",  
                url: "/report/billings/pagination/paginate-data?billings="+page ,
                datatype: "json",
                success: function(response){
                $('.billings').html(response);
                  }
              }) ;
        }

            
     


        //-------------fullname search ---------------/
        
        $('#fullname').on('keyup', function(e){
          e.preventDefault();
          let search = $('#fullname').val();
          console.log(search);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
          $.ajax({
            url: '/report/billing/fullname',
            method:'GET',
            data: {search:search,},
            success:function(response){
              $('.billings').html(response);
              if(response.message == 'Nofound'){       
                $('.billings').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                        <thead>\
                                                        <tr>\
                                                            <th>Transaction no</th>\
                                                            <th>Fullname</th>\
                                                            <th>Service</th> \
                                                            <th>Total</th>\
                                                            <th>Mode of payment</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">No transaction found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
        })


        $('#start_date, #end_date').change(function() {
    // Get the values of the input fields
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();

    // Check if both input fields have a value
    if (startDate !== '' && endDate !== '') {
      // Call the function to perform the search
      performSearch(startDate, endDate);
    }
  });

  function performSearch(startDate, endDate) {
    // Make an Ajax request to the server
    let filters = $('#filters').val();
    $.ajax({
      url: '/report/billing/date',
      type: 'GET',
      data: {
        date: filters,
        start_date: startDate,
        end_date: endDate
      },
      success: function(response) {
        $('.billings').html(response);
        if(response.message == 'Nofound'){       
                $('.billings').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                        <thead>\
                                                        <tr>\
                                                            <th>Transaction no</th>\
                                                            <th>Fullname</th>\
                                                            <th>Service</th> \
                                                            <th>Total</th>\
                                                            <th>Mode of payment</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">No transaction found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }

      },
      error: function(xhr, status, error) {
        // Handle any errors that occur
        console.log(error);
      }
    });
  }


  $(document).on('change', '#status', function(e){
              e.preventDefault();
          let  status = $(this).val();
          console.log(status);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(status.length > 0){
              $.ajax({
            url: '/report/billing/status',
            method:'GET',
            data: {status:status,},
            success:function(response){
              $('.billings').html(response);
              if(response.message == 'Nofound'){       
                $('.billings').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                        <thead>\
                                                        <tr>\
                                                            <th>Transaction no</th>\
                                                            <th>Fullname</th>\
                                                            <th>Service</th> \
                                                            <th>Total</th>\
                                                            <th>Mode of payment</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">No transaction found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
            }else{
              $('.billings').load(location.href+' .billings');
            }
         
        })


        
  $(document).on('change', '#mop', function(e){
              e.preventDefault();
          let  mop = $(this).val();
          console.log(mop);
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            if(mop.length > 0){
              $.ajax({
            url: '/report/billing/mop',
            method:'GET',
            data: {mop:mop,},
            success:function(response){
              $('.billings').html(response);
              if(response.message == 'Nofound'){       
                $('.billings').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                      <table class="table table-bordered table-striped" style="background-color: white" >\
                                        <thead>\
                                                        <tr>\
                                                            <th>Transaction no</th>\
                                                            <th>Fullname</th>\
                                                            <th>Service</th> \
                                                            <th>Total</th>\
                                                            <th>Mode of payment</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                            <tbody class="nofound" >\
                                                              <tr>\
                                                                <td colspan="8" style="text-align: center;">No transaction found</td>\
                                                                </tr>\
                                                            </tbody>\
                                                          </table>\
                                                          </div>');
               }
            }
          });
            }else{
              $('.billings').load(location.href+' .billings');
            }
         
        })


      })

</script>
@endsection
