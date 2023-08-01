$(document).ready(function() {

    $('#printer').on('click', function(e) {
        e.preventDefault();
        $('#encrypt-confirmation').modal('show');
    })

    $('#set-encrypt').on('click', function(e) {
        e.preventDefault();
        $('#adminpass, #userpass, #type ' ).html("");
        $('#type').val('encrypt');
        $('#encrypt-confirmation').modal('hide');
        $('#insert-password').modal('show');
    })

    $("#insert-password").on("hidden.bs.modal", function(e){
        e.preventDefault();
        $('#adminpass, #userpass, #type  ' ).html("");
    });

    window.addEventListener('beforeunload', function () {
        // Close any open modal windows
        $('#adminpass, #userpass, #type  ' ).html("");
        $('#insert-password').modal('hide');
        $('#encrypt-confirmation').modal('hide');
    });
})