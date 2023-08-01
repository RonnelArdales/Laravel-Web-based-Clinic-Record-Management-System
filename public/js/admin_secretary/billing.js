/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/admin_secretary/billing.js ***!
  \*************************************************/
$(document).ready(function () {
  var url_billing = usertype === "admin" ? "/admin/billing" : "/secretary/billing";
  var billing = $('#billingtable').DataTable({
    processing: true,
    serverSide: true,
    ajax: url_billing,
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'transno',
      name: 'transno',
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
      data: 'sub_total',
      name: 'sub_total',
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
  $("#payment_cash").on('change', function (e) {
    e.preventDefault();
    this.value = parseFloat(this.value).toFixed(2);
  });

  //---------------------Show payment modal---------------------//
  $(document).on('click', '.payment', function (e) {
    var id = $(this).data('id');
    var url = usertype === "admin" ? "/admin/billing/" + id + "/edit" : "/secretary/billing/" + id + "/edit";
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
        console.log(response);
        $('#payment_billingno').val(response.data.transno);
        $('#payment_userid').val(response.data.user_id);
        $('#payment_fullname').val(response.data.fullname);
        $('#compute_subtotal').val(response.data.sub_total); //dito cocompute
        $('#payment_subtotal').val("₱" + response.data.sub_total + ".00");
        $('#total_price').val("₱" + response.data.sub_total + ".00");
        $('#totalprice_nosymbol').val(response.data.sub_total);
        $('#payment_discount').val("");
        $('#mode_payment').val("");
        $('#change').val("");
        $('#reference_no').val("");
        $('#payment').modal('show');
      }
    });
  });
  $('.pay_billing').on('click', function () {
    var billing_no = $('#payment_billingno').val();
    var url = usertype === "admin" ? "/admin/billing/" + billing_no : "/secretary/billing/" + billing_no;
    var data = {
      'user_id': $('#payment_userid').val(),
      'fullname': $('#payment_fullname').val(),
      'subtotal': $('#compute_subtotal').val(),
      'discountcode': $('#payment_discount').val(),
      'discountname': $('#discount_name').val(),
      'discountprice': $('#discount_price').val(),
      'total': $('#totalprice_nosymbol').val(),
      'mode_of_payment': $('#mode_payment').val(),
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
        if (response.status == "400") {
          $('#error_modeofpayment, #error_payment, #error_reference_no').html(" ");
          $.each(response.errors.mode_of_payment, function (key, err_values) {
            $('#error_modeofpayment').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.payment, function (key, err_values) {
            $('#error_payment').append('<span>' + err_values + '</span>');
          });
          $.each(response.errors.reference_no, function (key, err_values) {
            $('#error_reference_no').append('<span>' + err_values + '</span>');
          });
        } else {
          $('#message-success').text('Updated Successfully');
          $(".success").show();
          setTimeout(function () {
            $(".success").fadeOut(500);
          }, 3000);
          $('#payment_billingno').val("");
          $('#payment_userid').val("");
          $('#payment_fullname').val("");
          $('#compute_subtotal').val(""); //dito cocompute
          $('#payment_subtotal').val("");
          $('#total_price').val("");
          $('#totalprice_nosymbol').val("");
          $('#status').val("");
          $('#payment').modal('hide');
          $('#payment_cash, #change, #reference_no').val(" ");
          $('#cash').hide();
          $('#gcash').hide();
          billing.draw();
        }
      }
    });
  });
  $('#payment').on('hidden.bs.modal', function () {
    $('#payment_billingno').val("");
    $('#payment_userid').val("");
    $('#payment_fullname').val("");
    $('#compute_subtotal').val(""); //dito cocompute
    $('#payment_subtotal').val("");
    $('#total_price').val("");
    $('#totalprice_nosymbol').val("");
    $('#status').val("");
    $('#payment').modal('hide');
    $('#payment_cash, #change, #reference_no').val(" ");
    $('#cash').hide();
    $('#gcash').hide();
  });
  $('#mode_payment').on('change', function (e) {
    var payment = $(this).val();
    $('#payment_cash, #reference_no, #change').val(" ");
    $(' #error_payment, #error_reference_no').html(' ');
    if (payment == "Cash") {
      $('#cash').show();
      $('#gcash').hide();
    } else {
      $('#cash').hide();
      $('#gcash').show();
    }
  });
  $('#payment_discount').on('change', function (e) {
    e.preventDefault();
    var discount = $(this).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    if (discount.length == 0 || discount == "None") {
      var total_price = $('#compute_subtotal').val();
      var subtotal = $('#payment_subtotal').val();
      $('#total_price').html("");
      $('#total_price').val(subtotal);
      $('#totalprice_nosymbol').val(total_price);
      $('#discount_price').val("");
    } else {
      var url = usertype === "admin" ? "/admin/billing/getdiscount/" + discount : "/secretary/billing/getdiscount/" + discount;
      $.ajax({
        type: "GET",
        url: url,
        datatype: "json",
        success: function success(response) {
          var total_price = $('#compute_subtotal').val();
          var divide = response.discount.percentage;
          var discount = divide / 100;
          var discountprice = total_price * discount;
          var total = total_price - discountprice;
          var number_total = Number(parseFloat(total).toFixed(2)).toLocaleString('en', {
            minimumFractionDigits: 2
          });
          var cars = [total_price, discount, total];
          $('#change').val("");
          $('#payment_cash').val("");
          $('#total_price').html("");
          $('#total_price').val('₱ ' + number_total);
          $('#totalprice_nosymbol').val(total);
          $('#discount_name').val(response.discount.discountname);
          $('#discount_price').val(discountprice);
        }
      });
    }
    ;
  });
  $('#payment_cash').on('keyup', function (e) {
    e.preventDefault();
    var total = $('#total_price').val();
    var payment = $('#payment_cash').val();
    var replace_total = total.replace(/[^a-z0-9. ]/gi, '');
    var change = parseInt(payment) - parseInt(replace_total, 10);
    var change_replace = Number(parseFloat(change).toFixed(2)).toLocaleString('en', {
      minimumFractionDigits: 2
    });
    if (parseFloat(payment) < parseFloat(replace_total)) {
      $('#change').val('');
    } else if (payment == "") {
      $('#change').val('');
    } else {
      $('#change').val(change_replace);
    }
  });
  $('#billingtable').on('click', '.delete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#delete_no').val("");
    $('#delete_no').val(id);
    $('#delete').modal('show');
  });
  $(document).on('click', '.delete_user', function (e) {
    e.preventDefault();
    id = $('#delete_no').val();
    var url = usertype === "admin" ? "/admin/billing/" + id : "/secretary/billing/" + id;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "DELETE",
      url: url,
      datatype: "json",
      beforeSend: function beforeSend() {
        $(".main-spinner").show();
      },
      complete: function complete() {
        $(".main-spinner").hide();
      },
      success: function success(response) {
        $('#delete_no').val("");
        $('#delete_no').val(id);
        $('#delete').modal('hide');
        $('#message-success').text('Deleted Successfully');
        $(".success").show();
        setTimeout(function () {
          $(".success").fadeOut(500);
        }, 3000);
        billing.draw();
      }
    });
  });
});
/******/ })()
;