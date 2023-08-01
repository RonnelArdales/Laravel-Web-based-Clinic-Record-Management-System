$(document).ready(function (){

    $(".modal").on("hidden.bs.modal", function(){
        $('#create, #edit, #delete').find('input').val("");
        $('#name, #percent, #error_discountname, #error_percent').html("");
    });

    $(document).on('click', '.add_discount', function(e){
        e.preventDefault();
        var url = (usertype === 'admin') ? '/admin/discount' : '/secretary/discount' ;
        var data ={
            'discountname' : $('.discountname').val(),
            'percentage': $('.percentage').val(), 
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
            success: function(response){
                if(response.status == 400){
                    $('#percent, #name' ).html("");
                    $.each(response.errors.discountname, function (key, err_values){
                        $('#name').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.percentage, function (key, err_values){
                        $('#percent').append('<span>'+err_values+'</span>');
                    })
                }else{
                    $('#message-success').text('Created successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#create').modal('hide');
                    $('#create').find('input').val("");
                    $('.table').load(location.href+' .table');
                }
            }
        });
    });

    //show data in edit form
    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        var discode = $(this).val();
        var url = (usertype === 'admin') ? "/admin/discount/" + discode + "/edit" : "/secretary/discount/" + discode + "/edit";
        $('#edit').modal('show');
        $.ajax({
            type: "GET",   
            url: url, 
            datatype: "json",
            success: function(response){
                console.log(response);
                if(response.status == 400){
                    $('#percent, #name' ).html("");
                    $('#percent, #name' ).addClass('alert alert-danger');
                    $('#message' ).text(response.messages);
                }else{
                    $('#edit_discountname').val(response.discount[0].discountname);
                    $('#edit_percentage').val(response.discount[0].percentage);
                    $('#discountcode').val(discode);
                }
            }
        });
    });
            //update data from database
    $(document).on('click', '.update_discount', function(e){
        e.preventDefault();
        var discode = $('#discountcode').val();
        var url = (usertype == 'admin') ? "/admin/discount/"+ discode : "/secretary/discount/"+ discode;
        var data ={
            _method: 'PUT',
            'discountname' : $('#edit_discountname').val(),
            'percentage': $('#edit_percentage').val(), 
        }
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
      
        $.ajax({
            type: 'PUT', 
            url: url,
            data: data,
            datatype: "json",
            success: function(response){ 
                if(response.status == 400){
                    $('#error_discountname, #error_percent' ).html("");
                    // $('#update_errform' ).addClass('alert alert-danger');
                    $.each(response.errors.discountname, function (key, err_values){
                        $('#error_discountname').append('<span>'+err_values+'</span>');
                    });
                    $.each(response.errors.percentage, function (key, err_values){
                        $('#error_percent').append('<span>'+err_values+'</span>');
                    })
                }else{                     
                    $('#message-success').text('Updated successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#edit').modal('hide');
                    $('#edit').find('input').val("");
                    $('.table').load(location.href+' .table');
                }
            }
        });
    });

    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        var discode = $(this).val();
        $('#delete').modal('show');
        $('#discountcode').val(discode);
        });

    $(document).on('click', '.delete_discount', function(e){
        e.preventDefault();
        var discode = $('#discountcode').val();
        var url = (usertype == 'admin') ? "/admin/discount/"+ discode : "/secretary/discount/"+ discode;
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
       $.ajax({
            type: 'DELETE', 
            url: url,
            data: discode,
            datatype: "json",
            success: function(response){ 
                    $('#message-success').text('Deleted successfully');
                    $(".success").show();
                    setTimeout(function() {
                        $(".success").fadeOut(500);
                    }, 3000);
                    $('#delete').modal('hide');
                    $('#delete').find('input').val("");
                    $('.table').load(location.href+' .table');
            }
        });
    });
});