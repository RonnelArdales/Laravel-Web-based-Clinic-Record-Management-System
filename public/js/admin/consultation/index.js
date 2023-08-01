/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/admin/consultation/index.js ***!
  \**************************************************/
$(document).ready(function () {
  $('.getappointment').on('click', function (e) {
    e.preventDefault();
    $('#viewappointments').modal('show');
  });
  var consultations = $('.consultation').DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/consultation",
    dom: 'frtp',
    pageLength: 10,
    responsive: true,
    columns: [{
      data: 'user_id',
      name: 'user_id',
      orderable: false,
      searchable: false
    }, {
      data: 'fullname',
      name: 'fullname',
      orderable: false
    }, {
      data: 'gender',
      name: 'gender',
      orderable: false
    }, {
      data: 'age',
      name: 'age',
      orderable: false
    }, {
      width: "10%",
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
    }]
  });
});
/******/ })()
;