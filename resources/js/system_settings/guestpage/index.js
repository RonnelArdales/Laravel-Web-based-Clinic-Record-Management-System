$(document).ready(function (){
    setTimeout(function() {
        $(".success").fadeOut(800);
        }, 2000);

    // deleteall();

    // function deleteall () {
    //     if (window.location.href) {
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             type: "post",
    //             url: "/admin/billing/addtocart/deleteall",
    //             datatype: "json",
    //             success: function(response){ 
    //             }
    //         });   
    //     }
    // }
});