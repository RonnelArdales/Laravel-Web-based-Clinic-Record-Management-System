$(document).ready(function () {

    var url = (usertype === 'admin') ? '/admin/pendinguser' : '/secretary/pendinguser';

    console.log("hello world!");

    var user = $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: url ,
        dom: 'frtp',
        pageLength: 10,
        responsive: true,
        columns: [
            {data: 'id', name: 'id' , orderable: false, searchable: false},
            {data: 'fullname', name: 'fullname' , orderable: false},
            {data: 'gender', name: 'gender' , orderable: false, searchable: false},
            {data: 'age', name: 'age' , orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at' , orderable: false, searchable: false},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $('#users').on('click', '.verify', function(e) {
        e.preventDefault();
      
        var id = $(this).data('id');

        $('#userid').val(" ");
        $('#userid').val(id);
        $('#verify').modal('show');
    });

    $(document).on('click', '.verify_user', function(e) {
        e.preventDefault();
        const id = $('#userid').val();
        var url = (usertype === 'admin') ? "/admin/pendinguser/"+ id : "/secretary/pendinguser/"+ id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",   
            url: url, 
            datatype: "json",
            beforeSend: function(){
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
                $('#verify').modal('hide');
            },
            success: function(response){ 
                console.log(response);
                $('#userid').val(" ");
                $('#userid').val(id);
                $('#message-success').text("Updated Successfully");
                $(".success").show();
                setTimeout(function() {
                    $(".success").fadeOut(500);
                }, 3000);
                user.draw();
            }
        });
    })
});