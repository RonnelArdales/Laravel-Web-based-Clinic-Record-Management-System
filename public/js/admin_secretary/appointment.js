/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/js/admin_secretary/appointment.js ***!
  \*****************************************************/
$(document).ready(function () {
  var url_pendings = usertype === 'admin' ? '/admin/appointment' : '/secretary/appointment';
  var url_completes = usertype === 'admin' ? '/admin/complete-appointment' : '/secretary/complete-appointment';
  var url_cancels = usertype === 'admin' ? '/admin/cancelled-appointment' : '/secretary/cancelled-appointment';
  var url_transactions = usertype === 'admin' ? '/admin/transaction-appointment' : '/secretary/transaction-appointment';
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();
  $('#available-time').empty();
  $('#available-time').append('<option value="0" disabled selected></option>');
  $('#reschedtime').empty();
  $('#reschedtime').append('<option value="0" disabled selected></option>');
  var usertable = null;
  setTimeout(function () {
    $(".success").fadeOut(500);
  }, 3000);
  var pendings = $('#pendings').DataTable({
    processing: true,
    serverSide: true,
    ajax: url_pendings,
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'id',
      name: 'id',
      orderable: false,
      searchable: false
    }, {
      data: 'user_id',
      name: 'user_id',
      orderable: false,
      searchable: false
    }, {
      data: 'fullname',
      name: 'fullname',
      orderable: false
    }, {
      data: 'contact_no',
      name: 'contact_no',
      orderable: false,
      searchable: false
    }, {
      data: 'email',
      name: 'email',
      orderable: false,
      searchable: false
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
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
    }]
  });
  var complete = $('#complete').DataTable({
    processing: true,
    serverSide: true,
    ajax: url_completes,
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'id',
      name: 'id',
      orderable: false,
      searchable: false
    }, {
      data: 'user_id',
      name: 'user_id',
      orderable: false,
      searchable: false
    }, {
      data: 'fullname',
      name: 'fullname',
      orderable: false
    }, {
      data: 'contact_no',
      name: 'contact_no',
      orderable: false,
      searchable: false
    }, {
      data: 'email',
      name: 'email',
      orderable: false,
      searchable: false
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
      data: 'status',
      name: 'status',
      orderable: false,
      searchable: false
    }]
  });
  var cancel = $('#cancel').DataTable({
    processing: true,
    serverSide: true,
    ajax: url_cancels,
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'id',
      name: 'id',
      orderable: false,
      searchable: false
    }, {
      data: 'user_id',
      name: 'user_id',
      orderable: false,
      searchable: false
    }, {
      data: 'fullname',
      name: 'fullname',
      orderable: false
    }, {
      data: 'contact_no',
      name: 'contact_no',
      orderable: false,
      searchable: false
    }, {
      data: 'email',
      name: 'email',
      orderable: false,
      searchable: false
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
      data: 'status',
      name: 'status',
      orderable: false,
      searchable: false
    }]
  });
  var transaction = $('#transaction').DataTable({
    processing: true,
    serverSide: true,
    ajax: url_transactions,
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'id',
      name: 'id',
      orderable: false,
      searchable: false
    }, {
      data: 'user_id',
      name: 'user_id',
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
      data: 'appointment_method',
      name: 'appointment_method',
      orderable: false,
      searchable: false
    }, {
      data: 'mode_of_payment',
      name: 'mode_of_payment',
      orderable: false,
      searchable: false
    }, {
      data: 'status',
      name: 'status',
      orderable: false,
      searchable: false
    }, {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
    }]
  });
  $('.viewpatients').on('shown.bs.modal', function () {
    var url = usertype === 'admin' ? "/admin/appointment/show_user" : "/secretary/appointment/show_user";
    if (!usertable) {
      usertable = $('#users').DataTable({
        "ajax": url,
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
          orderable: false,
          searchable: true
        }, {
          data: 'gender',
          name: 'gender',
          orderable: false,
          searchable: false
        }, {
          data: 'age',
          name: 'age',
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
      usertable.ajax.reload();
    }
  });
  $('.viewpatients').on('hidden.bs.modal', function () {
    if (usertable) {
      usertable.destroy();
      usertable = null;
    }
  });
  $('#pendings').on('click', '.complete', function (e) {
    e.preventDefault();
    var appointcode = $(this).data('id');
    $('#appointmentcode').val(appointcode);
    $('#complete-confirmation').modal('show');
  });
  $('#pendings').on('click', '.resched', function (e) {
    e.preventDefault();
    var appointid = $(this).data('id');
    $('#reschedid').val("");
    $('#reschedid').val(appointid);
    $('#reschedcalendar').modal('show');
  });
  $('#pendings').on('click', '.cancel', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#cancel_id').val(id);
    $('#cancel-confirmation').modal('show');
  });
  $('#users').on('click', '.select', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var url = usertype === 'admin' ? "/admin/appointment/getuser/" + id : "/secretary/appointment/getuser/" + id;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "GET",
      url: url,
      datatype: "json",
      success: function success(response) {
        //return galing sa function sa controller
        $('#userid').val(response.users.id);
        $('#fullname').val(response.fullname);
        $('#contactno').val(response.users.mobileno);
        $('#email').val(response.users.email);
        $('#viewpatients').modal('hide');
      }
    });
  });
  $('.show-create').on('click', function (e) {
    e.preventDefault();
    $('.create-form').modal('show');
    $('#available-time').empty();
    $('#available-time').append('<option value="0" disabled selected></option>');
  });
  $(".create-form").on("hidden.bs.modal", function (e) {
    e.preventDefault();
    $('.create-form').find('.refresh').val("");
    $('#cash, #gcash').hide();
    $('#error_user, #error_date, #error_time, #error_modepayment, #error_payment, #error_reference_no ').html("");
  });
  $("#reschedcalendar").on("hidden.bs.modal", function (e) {
    e.preventDefault();
    $('#reschedcalendar').find('.refresh').val("");
    $('#reschedtime').empty();
    $('#reschedtime').append('<option value="0" disabled selected></option>');
    $(' #error_resched_date, #error_resched_tim').html("");
  });
  $(document).on('click', '.patients', function (e) {
    e.preventDefault();
    $('#viewpatients').modal('show');
    $('#modal-status').val('show');
  });
  $(document).on('click', '.calendar', function (e) {
    e.preventDefault();
    $('#viewcalendar').modal('show');
  });

  //---------------store appointment--------------------------//
  $(document).on('click', '.store_appointment', function (e) {
    e.preventDefault();
    payment = $('#payment').val();
    reservation_fee = $('#reservation_fee').val();
    var url = usertype === 'admin' ? "/admin/appointment" : "/secretary/appointment";
    var data = {
      'userid': $('#userid').val(),
      'fullname': $('#fullname').val(),
      'contactno': $('#contactno').val(),
      'email': $('#email').val(),
      'date': $('#date').val(),
      'time': $('#available-time').val(),
      'reservation_fee': $('#reservationfee').val(),
      'modeofpayment': $('#mode_payment').val(),
      'payment': $('#payment_cash').val(),
      'change': $('#change').val(),
      'reference_no': $('#reference_no').val()
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
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $(".main-spinner").hide();
      },
      success: function success(response) {
        console.log(response);
        if (response.status == 400) {
          $('#error_user, #error_date, #error_time, #error_modepayment, #error_payment, #error_reference_no ').html("");
          $.each(response.errors.userid, function (key, err_values) {
            $('#error_user').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.date, function (key, err_values) {
            $('#error_date').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.time, function (key, err_values) {
            $('#error_time').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.modeofpayment, function (key, err_values) {
            $('#error_modepayment').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.payment, function (key, err_values) {
            $('#error_payment').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.reference_no, function (key, err_values) {
            $('#error_reference_no').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Created successfully');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
          $('#create-form').modal('hide');
          $('#create-form').find('.refresh').val("");
          pendings.draw();
        }
      }
    });
  });

  //update data from database
  $('.update_appointment').on('click', function (e) {
    e.preventDefault();
    var id = $('#appointmentcode').val();
    var status = "Success";
    var url = usertype === 'admin' ? "/admin/appointment/" + id : "/secretary/appointment/" + id;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "PUT",
      url: url,
      datatype: "json",
      data: {
        status: status
      },
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $('#complete-confirmation').modal('hide');
        $(".main-spinner").hide();
      },
      success: function success(response) {
        console.log(response);
        $('#success').html();
        $('#success').text('Updated successfully');
        $('#success').show();
        setTimeout(function () {
          $("#success").fadeOut(500);
        }, 2000);
        pendings.draw();
        complete.draw();
      }
    });
  });
  $('.cancel_appointment').on('click', function (e) {
    e.preventDefault();
    var status = "Cancel";
    var id = $('#cancel_id').val();
    var url = usertype === 'admin' ? "/admin/appointment/" + id : "/secretary/appointment/" + id;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "PUT",
      url: url,
      data: {
        status: status
      },
      datatype: "json",
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $('#cancel-confirmation').modal('hide');
        $(".main-spinner").hide();
      },
      success: function success(response) {
        console.log(response);
        $('#success').html();
        $('#success').text('Cancel successfully');
        $('#success').show();
        setTimeout(function () {
          $("#success").fadeOut(500);
        }, 2000);
        pendings.draw();
      }
    });
  });
  $('.resched_button').on('click', function (e) {
    $('#reschedid').val();
    $('#resched_date').val();
    $('#reschedtime').val();
    var status = "Reschedule";
    var id = $('#reschedid').val();
    console.log(id);
    var url = usertype === 'admin' ? "/admin/appointment/" + id : "/secretary/appointment/" + id;
    data = {
      _method: "PUT",
      "status": status,
      "date": $('#resched_date').val(),
      "time": $('#reschedtime').val()
    };
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "PUT",
      url: url,
      datatype: "json",
      data: data,
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $(".main-spinner").hide();
      },
      success: function success(response) {
        console.log(response);
        if (response.status == 400) {
          $('#error_resched_date, #error_resched_tim').html("");
          $.each(response.errors.date, function (key, err_values) {
            $('#error_resched_date').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.time, function (key, err_values) {
            $('#error_resched_tim').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#reschedcalendar').modal('hide');
          $('#success').html();
          $('#success').text('Reschedule successfully');
          $('#success').show();
          setTimeout(function () {
            $("#success").fadeOut(500);
          }, 2000);
          pendings.draw();
          complete.draw();
        }
      }
    });
  });

  //-------------------- View Calendar --------------------//
  var calendar = $('#calendar').fullCalendar({
    height: 470,
    editable: true,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    // events:'/admin/appointment',
    selectable: true,
    color: 'red',
    contentHeight: "auto",
    selectHelper: true,
    viewRender: function viewRender(view, element) {
      if (day_off.includes("0")) {
        $('.fc-day.fc-sun').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("1")) {
        $('.fc-day.fc-mon').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("2")) {
        $('.fc-day.fc-tue').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("3")) {
        $('.fc-day.fc-wed').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("4")) {
        $('.fc-day.fc-thu').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("5")) {
        $('.fc-day.fc-fri').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("6")) {
        $('.fc-day.fc-sat').css('backgroundColor', '#cc6666');
      }
      $('.fc-day.fc-today').css('backgroundColor', 'white');
      element.find('.fc-day').each(function () {
        var date = $(this).data('date');
        if (date_off.includes(date)) {
          $(this).css('backgroundColor', '#cc6666'); // Red for dates in the array
        } else {
          // $(this).css('background-color', '#829460'); // Green for dates not in the array
        }
      });
      element.find('.fc-day').each(function () {
        var currentDate = new Date();
        var date = $(this).data('date');
        var day = new Date(date);
        // Check if the date is in the past
        if (day < currentDate) {
          $(this).css('backgroundColor', '#cc6666');
          $('.fc-day.fc-today').css('backgroundColor', 'white');
        }
      });
      $('.fc-day.fc-today').css('backgroundColor', 'white');
    },
    select: function select(start, end, allDay) {
      var startDate = moment(start);
      date = startDate.clone();
      var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
      var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
      var dayOfWeek = $.fullCalendar.moment(date).day();
      var currentDate = new Date(Date.now());
      var year = currentDate.getFullYear();
      var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if necessary
      var day = currentDate.getDate().toString().padStart(2, '0'); // Add leading zero if necessary
      var selected_date = new Date(start);
      var formattedDate = "".concat(year, "-").concat(month, "-").concat(day);
      if (formattedDate == start) {
        return false;
      } else {
        var url = usertype === 'admin' ? "/admin/appointment/Calendar-fetch" : "/secretary/appointment/Calendar-fetch";
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: url,
          type: "Get",
          datatype: "json",
          data: {
            start: start
          },
          beforeSend: function beforeSend() {
            $(".main-spinner").show();
          },
          complete: function complete() {
            $(".main-spinner").hide();
          },
          success: function success(response) {
            $('#date').val("");
            $('#available-time').empty();
            if (date_off.includes(start)) {
              $('#available-time').append('<option value="0" disabled selected></option>');
              $('#message-error').text("Sorry this day is off");
              $(".error-calendar").show();
              setTimeout(function () {
                $(".error-calendar").fadeOut(500);
              }, 3000);
            } else {
              if (selected_date < currentDate) {
                $('#available-time').append('<option value="0" disabled selected></option>');
                $('#message-error').text("This day is not available");
                $(".error-calendar").show();
                setTimeout(function () {
                  $(".error-calendar").fadeOut(500);
                }, 3000);
              } else {
                if (response.status == "405") {
                  $('#available-time').append('<option value="0" disabled selected></option>');
                  $('#message-error').text('This day is full');
                  $(".error-calendar").show();
                  setTimeout(function () {
                    $(".error-calendar").fadeOut(500);
                  }, 3000);
                } else {
                  $('#date').val(start);
                  $('#viewcalendar').modal('hide');
                  $('#date').val(response.date);
                  $('#form-dateselected').val(response.date);
                  $("#available-time").append("<option value=''>-- select --</option>");
                  $.each(response.available_time, function (index, val) {
                    $("#available-time").append("<option value='" + val + "'>" + val + "</option>");
                  });
                }
              }
            }
          }
        });
      }
    }
  });
  var calendar_res = $('#calendar_res').fullCalendar({
    height: 470,
    editable: true,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    // events:'/admin/appointment',
    selectable: true,
    color: 'red',
    contentHeight: "auto",
    selectHelper: true,
    viewRender: function viewRender(view, element) {
      if (day_off.includes("0")) {
        $('.fc-day.fc-sun').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("1")) {
        $('.fc-day.fc-mon').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("2")) {
        $('.fc-day.fc-tue').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("3")) {
        $('.fc-day.fc-wed').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("4")) {
        $('.fc-day.fc-thu').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("5")) {
        $('.fc-day.fc-fri').css('backgroundColor', '#cc6666');
      }
      if (day_off.includes("6")) {
        $('.fc-day.fc-sat').css('backgroundColor', '#cc6666');
      }
      $('.fc-day.fc-today').css('backgroundColor', 'white');
      element.find('.fc-day').each(function () {
        var date = $(this).data('date');
        if (date_off.includes(date)) {
          $(this).css('backgroundColor', '#cc6666'); // Red for dates in the array
        } else {
          // $(this).css('background-color', '#829460'); // Green for dates not in the array
        }
      });
      element.find('.fc-day').each(function () {
        var currentDate = new Date();
        var date = $(this).data('date');
        var day = new Date(date);
        // Check if the date is in the past
        if (day < currentDate) {
          $(this).css('backgroundColor', '#cc6666');
          $('.fc-day.fc-today').css('backgroundColor', 'white');
        }
      });
      $('.fc-day.fc-today').css('backgroundColor', 'white');
    },
    select: function select(start, end, allDay) {
      var startDate = moment(start);
      date = startDate.clone();
      var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
      var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
      var dayOfWeek = $.fullCalendar.moment(date).day();
      var currentDate = new Date(Date.now());
      var year = currentDate.getFullYear();
      var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if necessary
      var day = currentDate.getDate().toString().padStart(2, '0'); // Add leading zero if necessary
      var selected_date = new Date(start);
      var formattedDate = "".concat(year, "-").concat(month, "-").concat(day);
      if (formattedDate == start) {
        return false;
      } else {
        var url = usertype === 'admin' ? "/admin/appointment/Calendar-fetch" : "/secretary/appointment/Calendar-fetch";
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: url,
          type: "Get",
          datatype: "json",
          data: {
            start: start
          },
          beforeSend: function beforeSend() {
            $(".main-spinner").show();
          },
          complete: function complete() {
            $(".main-spinner").hide();
          },
          success: function success(response) {
            $('#resched_date').val("");
            $('#reschedtime').empty();
            if (date_off.includes(start)) {
              $('#reschedtime').append('<option value="0" disabled selected></option>');
              $('#message-error').text("Sorry this day is off");
              $(".error-calendar").show();
              setTimeout(function () {
                $(".error-calendar").fadeOut(500);
              }, 3000);
            } else {
              if (selected_date < currentDate) {
                $('#reschedtime').append('<option value="0" disabled selected></option>');
                $('#message-error').text("Sorry this day is off");
                $(".error-calendar").show();
                setTimeout(function () {
                  $(".error-calendar").fadeOut(500);
                }, 3000);
              } else {
                if (response.status == "405") {
                  $('#reschedtime').append('<option value="0" disabled selected></option>');
                  $('#message-error').text(response.message);
                  $(".error-calendar").show();
                  setTimeout(function () {
                    $(".error-calendar").fadeOut(500);
                  }, 3000);
                } else {
                  var dateObject = new Date(start);
                  var _formattedDate = "".concat(dateObject.getMonth() + 1, "-").concat(dateObject.getDate(), "-").concat(dateObject.getFullYear());
                  $('#resched_date').val(_formattedDate);
                  $("#reschedtime").append("<option value=''>-- select --</option>");
                  $.each(response.available_time, function (index, val) {
                    $("#reschedtime").append("<option value='" + val + "'>" + val + "</option>");
                  });
                }
              }
            }
          }
        });
      }
    }
  });
  $('#mode_payment').on('change', function (e) {
    var payment = $(this).val();
    $('#payment_cash, #change, #reference_no').val(" ");
    if (payment == "Cash") {
      $('#cash').show();
      $('#gcash').hide();
    } else {
      $('#cash').hide();
      $('#gcash').show();
    }
  });

  // payment change 
  $('#payment_cash').on('keyup', function (e) {
    e.preventDefault();
    var total = $('#reservationfee').val();
    var payment = $(this).val();
    var change = parseInt(payment) - parseInt(total);
    // let change_replace =Number(parseFloat(change).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2});

    if (parseFloat(payment) < parseFloat(total)) {
      console.log('payment is lower than total');
      $('#change').val('');
    } else if (payment == "") {
      console.log('null inputs');
      $('#change').val('');
    } else {
      console.log('payment is greater than total');
      $('#change').val(change);
    }
  });
});
/******/ })()
;