$(document).ready(function (){
    var usertable = null;
    get_maxid();

    function message_success(){
        setTimeout(function() {
            $(".success").show();
        }, 500);
    }


$('.viewpatients').on('shown.bs.modal', function() {
    let url = (usertype == "admin") ? "/admin/appointment/show_user" : "/secretary/appointment/show_user";
    if (!usertable) {
        usertable =  $('#users').DataTable({
            "ajax": url,
            processing: true,
            serverSide: true,
            dom: 'frtp',
            pageLength: 6,
            responsive: true,
            "columns": [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false, searchable:true},
                {data: 'gender', name: 'gender' , orderable: false},
                {data: 'age', name: 'age' , orderable: false},
                { width: "10%",data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    }else{
        usertable.ajax.reload();
    }
});

$('.viewpatients').on('hidden.bs.modal', function() {
    if (usertable) {
        usertable.destroy();
        usertable = null;
    }
});

// ------ get max biling no --------------//
function get_maxid(){
    let url = (usertype == "admin") ? "/admin/transaction/getid" : "/secretary/transaction/getid";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: url,
        datatype: "json",
        success: function(response){ 
            $('#getid, #getbillingno').val(response.id);
        }
    });
};

//------------------ show patient modal -------------------//
$(document).on('click', '.getpatient', function(e){
    e.preventDefault();
    $('#modal-status').val('show');
    $('#viewpatients').modal('show');
});

//------------------ Select patient info -------------------//
$('#users').on('click', '.select', function(e){
    e.preventDefault();
    let id = $(this).data('id');
    let url = (usertype == "admin") ? "/admin/appointment/getuser/"+ id : "/secretary/appointment/getuser/"+ id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",   
        url: url, 
        datatype: "json",
        beforeSend: function(){
            $(".main-spinner").show();
        },
        complete: function(){
            $(".main-spinner").hide();
        },
        success: function(response){ //return galing sa function sa controller
            $(' #userid, #fullname').html("");
            $('#userid').val(response.users.id);
            $('#fullname').val(response.fullname);
            $('#viewpatients').modal('hide');
        }
    });
});

$(document).on('change', '.getservice', function(e){
    e.preventDefault();
    let id = $(this).val();
    let url = (usertype == "admin") ? "/admin/transaction/getservice/"+id : "/secretary/transaction/getservice/"+id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(id.length > 0){
        $.ajax({
            type: "GET",   
            url: url ,
            datatype: "json",
            success: function(response){ 
                $('.price, .servicename').val("");
                $('.servicename').val(response.service.services);
                $('.price').val(response.service.price);
            }
        });
    }else{
        $('.price, .servicename').val("");
    }
});

//------------------ store to add to cart -------------------//
$(document).on('click','.store_addtocart' ,function(e){
    e.preventDefault();
    let url = (usertype == "admin") ? "/admin/transaction/addtocart/store" : "/secretary/transaction/addtocart/store";
    let data ={
        'transno' : $('#getid').val(),
        'user_id': $('#userid').val(),
        'fullname': $('#fullname').val(),
        'servicecode': $('#getservice').val(),
        'service': $('#servicename').val(),
        'price': $('#price').val(),
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",   
        url: url, 
        data: data,
        datatype: "json",
        beforeSend: function(){
            $(".main-spinner").show();
        },
        complete: function(){
            $(".main-spinner").hide();
        },
        success: function(response){ 
            $('#error_fullname, #error_service, #error_price' ).html("");
            if(response.status == 200){   
                console.log(response);  
                $('#sub-total').val(response.subtotal);
                $('#message').text(response.message);
                $('.subtotal').load(location.href+' .subtotal');
                $('.data-table').load(location.href+' .data-table');
                $('#servicename').val("");
                $('#getservice').val("");
                $('#price').val("");
                $(".success").show();
                $('#message-success').text('Added Successfully');
                setTimeout(function() {
                    $(".success").fadeOut(500);
                }, 2000);
            }else if(response.status == 401){
                $.each(response.errors.fullname, function (key, err_values){
                    $('#error_fullname').append('<span>'+err_values+'</span>');
                })
                $.each(response.errors.servicecode, function (key, err_values){
                    $('#error_service').append('<span>'+err_values+'</span>');
                })
                $.each(response.errors.price, function (key, err_values){
                    $('#error_price').append('<span>'+err_values+'</span>');
                })
            }else{
                $('#message-error').text(response.message);
                $(".error").show();
                setTimeout(function() {
                    $(".error").fadeOut(500);
                }, 2000);
            }
        }
    });
});

// ------------------- save to transaction table ----------------//
$(document).on('click', '.saveaddtocart', function(e){
    e.preventDefault();
    let url = (usertype == "admin") ? "/admin/transaction/addtocart/billing_store" : "/secretary/transaction/addtocart/billing_store";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",   
        url: url, 
        datatype: "json",
        data: {transno : $('#getid').val() },
        beforeSend: function(){
        $(".main-spinner").show();
        },
        complete: function(){
            $(".main-spinner").hide();
        },
        success: function(response){ 
            if(response.status == "400"){
                $('#message-error').text("");
                $('#message-error').text("Please add service");
                $(".error").show();
                setTimeout(function() {
                    $(".error").fadeOut(500);
                }, 2000);
            }else{
                get_maxid();
                $('.subtotal').load(location.href+' .subtotal');
                $('.data-table').load(location.href+' .data-table');
                $('#userid').val("");
                $('#fullname').val("");
                $('#servicename').val("");
                $('#getservice').val("");
                $('#price').val("");
                $(".success").show();
                $('#message-success').text('Saved Successfully');
                setTimeout(function() {
                    $(".success").fadeOut(500);
                }, 2000);
            }  
        }
    });
});

$(document).on('click', '.delete', function(e){
    e.preventDefault();
    let id =  $(this).val();
    let url = (usertype == "admin") ? "/admin/transaction/" + id : "/secretary/transaction/" + id;
    // var url = "{{ route('transaction.destroy', ':id') }}".replace(':id', id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",   
        url: url, 
        datatype: "json",
        beforeSend: function(){
            $(".main-spinner").show();
        },
        complete: function(){
            $(".main-spinner").hide();
        },
        success: function(response){ 
            $(".success").show();
            $('#message-success').text(response.message);
            setTimeout(function() {
                $(".success").fadeOut(500);
            }, 2000);
            $('.subtotal').load(location.href+' .subtotal');
            $('.data-table').load(location.href+' .data-table');  
        }
    });
})  
});