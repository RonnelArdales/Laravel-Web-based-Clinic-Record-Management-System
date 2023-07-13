@extends('layouts.admin_navigation')
@section('title', 'Audit Trail')
@section('content')
<div class="row m-4">
    <div class="col-md-8 col-md-offset-5">
        <h1>  <b>AUDIT TRAIL</b> </h1>
    </div>



    <div style="margin-top: 15px; align-items:center;margin-bottom:1%;" >
        <form action="/admin/reports/print_audit_trail" method="post">
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
    
                <div class="col search_usertype" style="display: none;">
                    <label for="">Status</label>
                    <select name="status" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:180px; margin-right:10px" class="status" id="status">
                    <option value="" >Select usertype</option>
                    <option value="admin">Admin</option>
                    <option value="patient">Patient</option>
                    <option value="secretary">Secretary</option>
                    </select>
                </div>
        
                <div class="col  d-flex justify-content-end" style="width: 600px">
                    <select name="filters" style="font-family:Poppins;font-size:1.2vw; border-top: none;border-right:none; border-left:none; background:#EDDBC0; width:160px; margin-right:10px" class="filters" id="filters">
                        <option value="">Select Filter</option>
                        <option value="fullname">Username</option>
                        <option value="date">Date</option>
                        <option value="usertype">Usertype</option>
                    </select> 
                    <button style="border: none;background: #829460;border-radius: 20px;font-family:Poppins;font-weight: 400;font-size:1vw; color:white; padding-left:20px; padding-right:20px" type="submit" class="btn btn-primary ml-6 show-create" >
                        Generate Report
                        </button>
                </div>
            </div>
        </form>
    </div>


    <div class="card table-div" style="background:#EDDBC0;border:none; ">
        <div class="audits" style="padding:0%; ">
            <div class="card-body" style="width:100%; min-height:64vh; display: flex; overflow-x: auto;  font-size: 15px; ">
                <table class="table table-data table-bordered table-striped" style="background-color: white">
                    <thead>
                        <tr>
                            <th>User_id</th>
                            <th>Username</th>
                            <th>Activity</th> 
                            <th>usertype</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="tbody" >
                        @if (count($audits) > 0)
                            @foreach ($audits as $user)
                            <tr class="overflow-auto" id="nouser">
                                <td>{{$user->user_id}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->activity}}</td>
                                <td>{{$user->usertype}}</td>
                                <td>{{date('m-d-Y h:i:s A', strtotime($user->created_at))}}</td>
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
                {!! $audits->links() !!}
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
                            $('#status').append(' <option value="" >Select usertype</option>\
                                                <option value="admin">Admin</option>\
                                                <option value="patient">Patient</option>\
                                                <option value="secretary">Secretary</option>\
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
                $('#fullname').val('');
                $('.search_fullname').show();
                $('.search_date').hide();
                $('.search_usertype').hide();
                $('.audits').load(location.href+' .audits');
                get_status();
                clear_date();
            }else if(filters == 'date'){
                $('.search_fullname').hide();
                $('.search_date').show();
                $('.search_usertype').hide();
                $('.fullname').val('');
                $('.audits').load(location.href+' .audits');
                get_status();
                clear_date();
            }else if(filters == 'usertype'){
                $('.search_fullname').hide();
                $('.search_date').hide();
                $('.search_usertype').show();
                $('.fullname').val('');
                $('.audits').load(location.href+' .audits');
                get_status();
                clear_date();
            }else{
                $('.search_fullname').hide();
                $('.search_date').hide();
                $('.search_usertype').hide();
                $('.fullname').val('');
                $('.audits').load(location.href+' .audits');
                get_status();
                clear_date();
            }
        })

        $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
            var asd = $(this).attr('href');
            let name = $('#fullname').val();
            let usertype = $('#status').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(name || usertype || start_date || end_date){
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('.audits').html(response);
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.statusText);
                    }
                });
            }else{
                let page = $(this).attr('href').split('audits=')[1]
                audit(page);
            }
        });

        function audit(page){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",  
                url: "/report/audits/pagination/paginate-data?audits="+page ,
                datatype: "json",
                success: function(response){
                    $('.audits').html(response);
                }
            }) ;
        }

        //-------------fullname search ---------------/
        
        $('#fullname').on('keyup', function(e){
            e.preventDefault();
            let search = $('#fullname').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/report/audittrail/username',
                method:'GET',
                data: {search:search,},
                success:function(response){
                    $('.audits').html(response);
                    if(response.message == 'Nofound'){       
                        $('.audits').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto; font-size: 15px; " >\
                                            <table class="table table-bordered table-striped" style="background-color: white" >\
                                                <thead>\
                                                                            <tr>\
                                                                                <th>User_id</th>\
                                                                                <th>Username</th>\
                                                                                <th>Activity</th> \
                                                                                <th>usertype</th>\
                                                                                <th>Date</th>\
                                                                            </tr>\
                                                                        </thead>\
                                                                    <tbody class="nofound" >\
                                                                    <tr>\
                                                                        <td colspan="5" style="text-align: center;">No appointment Found</td>\
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
                url: '/report/audittrail/date',
                type: 'GET',
                data: {
                    date: filters,
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                        $('.audits').html(response);
                        if(response.message == 'Nofound'){       
                                $('.audits').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                                    <table class="table table-bordered table-striped" style="background-color: white" >\
                                                        <thead>\
                                                        <tr>\
                                                                                        <th>User_id</th>\
                                                                                        <th>Username</th>\
                                                                                        <th>Activity</th> \
                                                                                        <th>usertype</th>\
                                                                                        <th>Date</th>\
                                                                                    </tr>\
                                                                                </thead>\
                                                                            <tbody class="nofound" >\
                                                                            <tr>\
                                                                                <td colspan="5" style="text-align: center;">No user found</td>\
                                                                                </tr>\
                                                                            </tbody>\
                                                                        </table>\
                                                                        </div>');
                        }
                },
                error: function(xhr, status, error) {
                }
            });
        }


        $(document).on('change', '#status', function(e){
            e.preventDefault();
            let  status = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(status.length > 0){
                $.ajax({
                    url: '/report/audittrail/usertype',
                    method:'GET',
                    data: {usertype:status,},
                    success:function(response){
                        $('.audits').html(response);
                        if(response.message == 'Nofound'){       
                            $('.audits').append('<div class="card-body "style="width:100%; min-height:65vh;display: flex; overflow-x: auto;         font-size: 15px; " >\
                                                <table class="table table-bordered table-striped" style="background-color: white" >\
                                                    <thead>\
                                                    <tr>\
                                                                                    <th>User_id</th>\
                                                                                    <th>Username</th>\
                                                                                    <th>Activity</th> \
                                                                                    <th>usertype</th>\
                                                                                    <th>Date</th>\
                                                                                </tr>\
                                                                            </thead>\
                                                                        <tbody class="nofound" >\
                                                                        <tr>\
                                                                            <td colspan="5" style="text-align: center;">No user found</td>\
                                                                            </tr>\
                                                                        </tbody>\
                                                                    </table>\
                                                                    </div>');
                        }
                    }
                });
            }else{
                $('.appointments').load(location.href+' .appointments');
            }
        })
    })

</script>
@endsection