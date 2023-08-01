/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************!*\
  !*** ./resources/js/system_settings/modeofpayment.js ***!
  \*******************************************************/
$(document).ready(function () {
  $(".modal").on("hidden.bs.modal", function () {
    $('#create, #edit, #delete').find('input').val("");
    $('#name, #percent, #error_discountname, #error_percent').html("");
  });
  $('#store_data').on('submit', function (e) {
    e.preventDefault();
    var url = usertype == "admin" ? "/admin/modeofpayment/" : "/secretary/modeofpayment/";
    var formData = new FormData(this);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      datatype: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function success(response) {
        if (response.status == 400) {
          $('#mop, #image').html("");
          $.each(response.errors.mop, function (key, err_values) {
            $('#mop').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.image, function (key, err_values) {
            $('#image').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Created Successfully');
          $('#create').modal('hide');
          $('.table').load(location.href + ' .table');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
        }
      }
    });
  });

  //show data in edit form
  $(document).on('click', '.edit', function (e) {
    e.preventDefault();
    var id = $(this).val();
    var url = usertype == "admin" ? "/admin/modeofpayment/" + id + "/edit" : "/secretary/modeofpayment/" + id + "/edit";
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
          $('#mop_id, #edit_mop_name').val("");
          $('#mop_id').val(response.mop.id);
          $('#edit_mop_name').val(response.mop.modeofpayment);
        }
      }
    });
  });

  //-------------------update-----------------------------//
  $('#update_data').on('submit', function (e) {
    e.preventDefault();
    var id = $('#mop_id').val();
    var url = usertype == "admin" ? "/admin/modeofpayment/update/" + id : "/secretary/modeofpayment/update/" + id;
    var formData = new FormData(this);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      datatype: "json",
      cache: false,
      contentType: false,
      processData: false,
      success: function success(response) {
        console.log(response);
        if (response.status == 400) {
          $('#error_mop, #error_image').html("");
          $.each(response.errors.mop, function (key, err_values) {
            $('#error_mop').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.image, function (key, err_values) {
            $('#error_image').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Updated Successfully');
          $('#edit').modal('hide');
          $('.table').load(location.href + ' .table');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
        }
      }
    });
  });
  $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var id = $(this).val();
    $('#delete').modal('show');
    $('#deletemopid').val(id);
  });
  $(document).on('click', '.delete_mop', function (e) {
    e.preventDefault();
    var id = $('#deletemopid').val();
    var url = usertype == "admin" ? "/admin/modeofpayment/" + id : "/secretary/modeofpayment/" + id;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'DELETE',
      url: url,
      datatype: "json",
      success: function success(response) {
        $('#message-success').text('Deleted successfully');
        $(".success").show();
        setTimeout(function () {
          $(".success").fadeOut(500);
        }, 3000);
        $('#delete').modal('hide');
        $('#deletemopid').find('input').val("");
        $('.table').load(location.href + ' .table');
      }
    });
  });
});
/******/ })()
;