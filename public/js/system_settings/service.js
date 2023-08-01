/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/system_settings/service.js ***!
  \*************************************************/
$(document).ready(function () {
  $(".modal").on("hidden.bs.modal", function () {
    $('#create, #edit, #delete').find('input').val("");
    $('#name, #price, #error_servicename, #error_price').html("");
  });

  //store data
  $(document).on('click', '.add_service', function (e) {
    e.preventDefault();
    var url = usertype === 'admin' ? '/admin/service' : '/secretary/service';
    var data = {
      'servicename': $('.servicename').val(),
      'price': $('.price').val()
    };
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
      success: function success(response) {
        if (response.status == 400) {
          $('#name').html("");
          // $('#price, #name' ).addClass('alert alert-danger');
          $.each(response.errors.servicename, function (key, err_values) {
            $('#name').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.price, function (key, err_values) {
            $('#price').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Created successfully');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
          $('#create').modal('hide');
          $('#create').find('input').val("");
          $('.table').load(location.href + ' .table');
        }
      }
    });
  });

  //show data in edit form
  $(document).on('click', '.edit', function (e) {
    e.preventDefault();
    var sercode = $(this).val();
    var url = usertype === 'admin' ? '/admin/service/' + sercode + '/edit' : '/secretary/service/' + sercode + '/edit';
    $('#edit').modal('show');
    $.ajax({
      type: "GET",
      url: url,
      datatype: "json",
      success: function success(response) {
        if (response.status == 400) {
          $('#price, #name').html("");
          $('#price, #name').addClass('alert alert-danger');
          $('#message').text(response.messages);
        } else {
          $('#edit_servicename').val(response.service[0].services);
          $('#edit_price').val(response.service[0].price);
          $('#servicecode').val(sercode);
        }
      }
    });
  });

  //update data from database
  $(document).on('click', '.update_service', function (e) {
    e.preventDefault();
    var sercode = $('#servicecode').val();
    var url = usertype === 'admin' ? '/admin/service/' + sercode : '/secretary/service/' + sercode;
    var data = {
      _method: 'PUT',
      'servicename': $('#edit_servicename').val(),
      'price': $('#edit_price').val()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
      datatype: "json",
      success: function success(response) {
        if (response.status == 400) {
          $('#error_servicename, #error_price').html("");
          $.each(response.errors.servicename, function (key, err_values) {
            $('#error_servicename').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.price, function (key, err_values) {
            $('#error_price').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Updated successfully');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
          $('#edit').modal('hide');
          $('#edit').find('input').val("");
          $('.table').load(location.href + ' .table');
        }
      }
    });
  });
  $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var sercode = $(this).val();
    $('#delete').modal('show');
    $('#servicecode').val(sercode);
  });
  $(document).on('click', '.delete_service', function (e) {
    e.preventDefault();
    var sercode = $('#servicecode').val();
    var url = usertype === 'admin' ? '/admin/service/' + sercode : '/secretary/service/' + sercode;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'DELETE',
      url: url,
      data: sercode,
      datatype: "json",
      success: function success(response) {
        $('#message-success').text('Deleted successfully');
        $(".success").show();
        setTimeout(function () {
          $(".success").fadeOut(500);
        }, 3000);
        $('#delete').modal('hide');
        $('#delete').find('input').val("");
        $('.table').load(location.href + ' .table');
      }
    });
  });
});
/******/ })()
;