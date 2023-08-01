/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/admin/consultation/create.js ***!
  \***************************************************/
$(document).ready(function () {
  setTimeout(function () {
    $(".error").fadeOut(800);
  }, 2000);
  $('.getappointment').on('click', function (e) {
    e.preventDefault();
    $('#viewappointments').modal('show');
  });
  var appointmentsTable = null;
  $('.viewappointments').on('shown.bs.modal', function () {
    if (!appointmentsTable) {
      appointmentsTable = $('.appointments').DataTable({
        "ajax": "/admin/consultation/show_appointment",
        processing: true,
        serverSide: true,
        dom: 'frtp',
        pageLength: 6,
        responsive: true,
        "columns": [{
          data: 'id',
          name: 'id',
          orderable: false,
          searchable: false
        }, {
          data: 'fullname',
          name: 'fullname',
          orderable: false
        }, {
          data: 'date',
          name: 'date',
          orderable: false,
          searchable: false
        }, {
          data: 'time',
          name: 'time',
          orderable: false,
          searchable: false
        }, {
          width: "10%",
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }]
      });
    } else {
      appointmentsTable.ajax.reload();
    }
  });
  $('.viewappointments').on('hidden.bs.modal', function () {
    if (appointmentsTable) {
      appointmentsTable.destroy();
      appointmentsTable = null;
    }
  });
  $('.appointments').on('click', '.select', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/admin/consultation/getappointment/" + id,
      datatype: "json",
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $(".main-spinner").hide();
      },
      success: function success(response) {
        $('#appoint_id,#user_id,#fullname,#date,#time, #gender,#age').val("");
        $('#appoint_id').val(response.appointment.id);
        $('#userid').val(response.appointment.user_id);
        $('#fullname').val(response.appointment.fullname);
        $('#date').val(response.appointment.date);
        $('#time').val(response.appointment.time);
        $('#gender').val(response.gender);
        $('#age').val(response.age);
        $('#viewappointments').modal('hide');
      }
    });
  });
  $('#getservice').on('change', function () {
    var id = $(this).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/admin/consultation/getservice/" + id,
      datatype: "json",
      success: function success(response) {
        $('#typeservice');
      }
    });
  });
});
/******/ })()
;