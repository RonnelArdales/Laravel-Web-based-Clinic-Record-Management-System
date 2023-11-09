$(document).ready(function(){

    const textarea = $('#note');

    function adjustTextareaHeight() {
      textarea.css('height', 'auto');
      textarea.css('height', textarea.prop('scrollHeight') + 'px');
    }
  
    textarea.on('input', adjustTextareaHeight);
    

    setTimeout(function() {
        $(".success").fadeOut(500);
    }, 3000);

    window.addEventListener('beforeunload', function () {
    $('#view').modal('hide');
    });

    var document = $('#document').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/document",
        dom: 'frtp',
        pageLength: 10,
        responsive: true,
        columns: [
            {data: 'id', name: 'id' , orderable: false, searchable: false},
            {data: 'appointment_date', name: 'appointment_date' , orderable: false, searchable: false},
            {data: 'fullname', name: 'fullname' , orderable: false, searchable: false},
            {data: 'documenttype', name: 'documenttype' , orderable: false, searchable: false},
            {data: 'action', name: 'Action', orderable: false, searchable: false},
        ]
    });

    $('#viewappointments').on('shown.bs.modal', function() {
        $('.appointment').DataTable({
            "ajax": "/admin/consultation/show_appointment",
            processing: true,
            serverSide: true,
            dom: 'frtp',
            pageLength: 6,
            responsive: true,
            "columns": [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'fullname', name: 'fullname' , orderable: false},
                {data: 'date', name: 'date' , orderable: false, searchable: false},
                {data: 'time', name: 'time' , orderable: false, searchable: false},
                { width: "10%",data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $('.show-create').on('click', function(){
        $('#create').modal('show');
        $('#note').html();
        $('#note').val('I hope this message finds you well. As requested, I\'m providing you with access to your consultation results and recommendations. You have the option to access the document securely through your account on our website or on email. This ensures both convenience and privacy in retrieving the information.\n\nPassword:');
    });
    $('#viewappointments').on('hidden.bs.modal', function() {
        $('.appointment').DataTable().destroy();
    });

    $(".create").on("hidden.bs.modal", function(e){
        e.preventDefault();
        textarea.css('height', '160px'); //
        $('#create').find('input, select, textarea').val("");
    });



    $('.getappointment').on('click', function(e){
        e.preventDefault();
        $('#viewappointments').modal('show');
    })     

    //---------------store data ------------------//

    $('#store_data').on('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",   
            url: "/admin/document/", 
            data: formData,
            datatype: "json",
            contentType:false,
            cache:false,
            processData: false,
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){ 
                console.log(response);
                if(response.status == 400){
                    $('#error_userid, #error_file, #error_doc_type' ).html("");
                    $.each(response.errors.fullname, function (key, err_values){
                        $('#error_userid').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.pdf, function (key, err_values){
                        $('#error_file').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.doc_type, function (key, err_values){
                        $('#error_doc_type').append('<span>'+err_values+'</span>');
                    })
                }else{
                    $('#message-success').text('Created Successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#create').modal('hide');
                    document.draw();
                }
            }
        });
    });

    //----------------------- Get User -----------------------------//
    $('.appointment').on('click', '.select', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            url: "/admin/consultation/getappointment/" +id,
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){ 
                    $('#appointment_id,#user_id,#fullname,#date,#time ').val("");
                    $('#appointment_id').val(response.appointment.id);
                    $('#user_id').val(response.appointment.user_id);
                    $('#fullname').val(response.appointment.fullname);
                    $('#date').val(response.appointment.date);
                    $('#viewappointments').modal('hide');
            }
        });
    });
    $('#document').on('click', '.view', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type: "GET",   
            url: "/admin/document/"+ id + "/edit", 
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){ 
                console.log(response);
                $('#view').modal('show');
                $('#fileview').html("");
                $('#view').find('input, textarea').html("");
                $('#view_appointemntid').val(response.document.appointment_id);
                $('#view_fullname').val(response.document.fullname);
                $('#view_doc_type').val(response.document.documenttype);
                $('#view_date').val(response.document.appointment_date);
                $('#view_file').val(response.document.filename);
                $('#view_note').val(response.document.note);
                $('#fileview').append('  <a href="/admin/document/download/' + response.document.id+'" class=" p-2 w-30 bg-[#829460]  mt-7 " style="background: #829460;border-radius: 30px; color:white; border:#829460;width: 110px;height: 37px; text-decoration:none; " >Download</a>\
                ');
            }
        });
    });

    $('#document').on('click', '.edit', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#edit').modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
       $.ajax({
            type: "GET",   
            url: "/admin/document/"+ id + "/edit", 
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){ 
                $('#fileview').html("");
                $('#edit').find('input, textarea').val("");
                $('#document_id').val(response.document.id);
                $('#edit_appointmentid').val(response.document.appointment_id);
                $('#edit_userid').val(response.document.user_id);
                $('#edit_fullname').val(response.document.fullname);
                $('#edit_doc_type').val(response.document.documenttype);
                $('#edit_date').val(response.document.appointment_date);
                $('#edit_note').val(response.document.note);
            }
        });
    });

    //-------------------update-----------------------------//
    $('#update_data').on('submit', function(e){
        e.preventDefault();
        var id = $('#document_id').val();
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $.ajax({
            type: 'POST', 
            url: "/admin/document/update/"+ id,
            data: formData,
            datatype: "json",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){ 
                console.log(response);
                if(response.status == 400){
                    $('#error_userid, #error_file, #error_doc_type' ).html("");
                    $.each(response.errors.pdf, function (key, err_values){
                        $('#error_edit_file').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.doc_type, function (key, err_values){
                        $('#error_edit_doc_type').append('<span>'+err_values+'</span>');
                    })
                }else{                  
                    $('#message-success').text('Updated Successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#edit').modal('hide');
                    $('#edit').find('input, textarea').val("");
                    document.draw();
                }
            }
        });
    });

    
    $('#document').on('click', '.delete', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#documentid').val(id);
       $('#delete').modal('show');
    });

    $('#deletefile').on('click',  function(e) {
        e.preventDefault();
        let id =  $('#documentid').val();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
            type: 'DELETE', 
            url: "/admin/document/"+ id,
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){

                $(".main-spinner").hide();
            },
            success: function(response){ 
                    $('#documentid' ).html("");
                    $('#message-success').text('Deleted Successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    document.draw();
              }
        });
       $('#delete').modal('hide');
    });
});