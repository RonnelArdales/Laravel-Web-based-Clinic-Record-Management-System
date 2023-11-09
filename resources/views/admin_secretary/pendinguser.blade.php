@extends('layouts.admin_navigation')
@section('title', 'Pending user')
@section('content')

<div class="row m-4">
    <div class="main-spinner" style=" position:fixed; width:100%; left:0;right:0;top:0;bottom:0; background-color: rgba(255, 255, 255, 0.279); z-index:9999; display:none;"> 
        <div class="spinner">
            <div class="spinner-border" role="status" style="width: 8rem; height: 8rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>	

    <div style="margin-top: 3px; align-items:center; display:flex; margin-bottom:1%;" >
        <div class="me-auto col-md-8 col-md-offset-5">
                <h1> <b>PENDING USER</b> </h1>
        </div>
    </div>

    <div id="success" class="success alert alert-success" role="alert" style="display:none">
        <p style="margin-bottom: 0px;" id="message-success"></p> 
    </div>

    <div class="card"  style="background:#EDDBC0;border:none; " >
        <div class="table-user" style="padding: 0%" >
            <div class="card-body" style="width:100%; min-height:64vh;  font-size: 15px; ">
                <table class="table table-bordered table-striped  "  id="users" style="background-color: white; width:100%" >
                    <thead>
                        <tr>
                            <th>Patient Id</th>
                            <th>Fullname</th>
                            <th>username</th>
                            <th >Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="error">
        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

          {{---- Verify modal---}}
    <div class="modal fade" id="verify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #EDDBC0; margin-top:30%;">
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" style="margin-top:5px; margin-right:5px" class="btn-close text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-header" style="border-bottom-color: gray; display: flex; justify-content: center; padding:10px">
                    <h2 class="modal-title text-center" id="exampleModalLabel"> <b>HOLD ON.</b> </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-4  ">
                        <div class=" columns-1 sm:columns-2 " style="display: flex; justify-content: center; ">
                            <input type="text" hidden id="userid">
                            <h5>Do you want to verify this user?</h5>
                        </div>
                    </div>

                    <div style=" display: flex; justify-content: center; margin-bottom:40px "  >
                        <button type="button" class="close_button " style="margin-right: 15px" data-bs-dismiss="modal">Cancel</button>
                        <button class="verify_user create-button" id="verify_user">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')
<script>
        var usertype = '{{ Auth::user()->usertype }}';
</script>

@vite( 'resources/js/admin_secretary/pending.js')

@endsection

