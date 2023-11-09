   
$(document).ready(function (){

    refresh_table();

    $(document).on('change', '#birthday', function(){
        const birthday = $(this).val();
        const currentDate = new Date();
        const dateObject = new Date(birthday);
        const birthYear = dateObject.getFullYear();
        const currentYear = currentDate.getFullYear();
        const birthMonth = dateObject.getMonth();
        const currentMonth = currentDate.getMonth();
        const birthDay = dateObject.getDate();
        const currentDay = currentDate.getDate();
        let age = currentYear - birthYear;

        if (currentMonth < birthMonth || (currentMonth === birthMonth && currentDay < birthDay)) {
            age--; // Adjust age if current month and day are earlier
        }
        $('#age').html("");
        $('#age').val(age);
    }) 

    $(document).on('change', '#edit_birthday', function(){
        const birthday = $(this).val();
        const currentDate = new Date();
        const dateObject = new Date(birthday);
        const birthYear = dateObject.getFullYear();
        const currentYear = currentDate.getFullYear();
        const birthMonth = dateObject.getMonth();
        const currentMonth = currentDate.getMonth();
        const birthDay = dateObject.getDate();
        const currentDay = currentDate.getDate();
        let age = currentYear - birthYear;

        // if (currentMonth < birthMonth || (currentMonth === birthMonth && currentDay < birthDay)) {
        //     age--; // Adjust age if current month and day are earlier
        // }
        $('#edit_age').html("");
        $('#edit_age').val(age);
    }) 

    function refresh_table(){
        var usertype = $('#usertypetable').val()
        if( usertype == 'secretary' ){
                $('#fullname').val("");
                $('.secretary').load(location.href+' .secretary');
        } else if (usertype == 'patient') {
                $('#fullname').val("");
                $('.patient').load(location.href+' .patient');
        } else if(usertype == 'admin') {
                $('#fullname').val("");
                $('.admin').load(location.href+' .admin');
        }
    }

    $(".modal").on("hidden.bs.modal", function(){ 
        $('#create, #edit, #delete').find('input, select').val("");
        $('#fname, #mname, #lname,#gender, #usertype,  #create_error_birthday, #create_error_age, #address, #mobileno, #email, #username, #confirmpassword, #password, #status, #age , #birthday'  ).html("");
        $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #error_status'  ).html("");
    });

    //show and hide table
    $('#usertypetable').on('change', function(e){
            e.preventDefault();
            var usertype = $(this).val();
           if( usertype == 'secretary' ){
                $('#patient').attr("hidden",true);
                $('#admin').attr("hidden",true);
                $("#secretary").attr("hidden",false);
                refresh_table();
           }else if (usertype == 'patient') {
                $('#patient').attr("hidden",false);
                $('#admin').attr("hidden",true);
                $("#secretary").attr("hidden",true);
                refresh_table();
           }else {
                $('#patient').attr("hidden",true);
                $('#admin').attr("hidden",false);
                $("#secretary").attr("hidden",true);
                refresh_table();
           }
        })
        $('#search').on('keyup', function(e){
          var search = $(this).val();
          alert(search);
        })

    //store data
    $(document).on('click', '.add_user', function(e){
        e.preventDefault();
        var data ={
            'first_name' : $('.fname').val(),
            'mname': $('.mname').val(), 
            'last_name': $('.lname').val(),
            'birthday': $('.birthday').val(),
            'age': $('.age').val(),
            'address': $('.address').val(),
            'gender': $('.gender').val(),
            'mobile_number': $('.mobileno').val(), 
            'email': $('.email').val(),
            'username': $('.username').val(),
            'address': $('.address').val(),
            'password': $('.create_password').val(),
            'password_confirmation': $('.create_password_confirmation').val(),
            'usertype': $('.usertype').val(),
            'status': $('.status').val(),
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/admin/user",
            data: data,
            datatype: "json",
            beforeSend: function(){
                $('#accept-confirmation').modal('hide');
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            error: function(xhr, status, errorThrown){
                // This function handles the error response from the server
                console.log("AJAX request failed:");
                console.log("Status: " + status);
                console.log("Error thrown: " + errorThrown);
            },
            success: function(response){
                if(response.status == 400){
                    $('#fname, #mname, #lname,#gender, #usertype, #create_error_birthday, #create_error_age, #address, #mobileno, #email, #username, #confirmpassword, #password, #status '  ).html("");
                    $.each(response.errors.first_name, function (key, err_values){
                    $('#fname').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.last_name, function (key, err_values){
                    $('#lname').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.birthday, function (key, err_values){
                    $('#create_error_birthday').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.age, function (key, err_values){
                    $('#create_error_age').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.address, function (key, err_values){
                    $('#address').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.mobile_number, function (key, err_values){
                    $('#mobileno').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.email, function (key, err_values){
                    $('#email').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.username, function (key, err_values){
                    $('#username').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.password, function (key, err_values){
                    $('#password').append('<span>'+err_values+' </span>');
                    })
                    $.each(response.errors.confirm_password, function (key, err_values){
                    $('#confirmpassword').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.gender, function (key, err_values){
                    $('#gender').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.status, function (key, err_values){
                    $('#status').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.usertype, function (key, err_values){
                    $('#usertype').append('<span>'+err_values+'</span>');
                    })
                }else{
                    refresh_table();
                    $('#success').html();
                    $('#success').text('Created successfully');
                    $('#success').show();
                    setTimeout(function() {
                        $("#success").fadeOut(500);
                    }, 2000);
                    $('#create').modal('hide');
                    $('.modal-create').load(location.href+' .modal-create');
                }
            }, 
        });
    });

    //view form
    $(document).on('click', '.view', function(e){
        e.preventDefault();
        var id = $(this).val();
       $('#view').modal('show');
        let url =  '/admin/user/' + id + '/edit' ;
       $.ajax({
            type: "GET",   
            url: url,
            datatype: "json",
            success: function(response){ 
                if(response.status == 400){
                  $('#update_errform' ).html("");
                    $('#update_errform' ).addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_values){
                    $('#update_errform').append('<li>'+err_values+'</li>');
                    })
                }else{
                    const fullname = response.user.fname ;
                    $('#view_fname').val(fullname.concat(" ", response.user.lname  )  );
                    $('#view_mname').val(response.user.mname);
                    $('#view_lname').val(response.user.lname);
                    $('#view_birthday').val(response.user.birthday);
                    $('#view_age').val(response.user.age);
                    $('#view_address').val(response.user.address);
                    $('#view_gender').val(response.user.gender); 
                    $('#view_mobileno').val(response.user.mobileno);
                    $('#view_email').val(response.user.email);  
                    $('#view_usertype').val(response.user.usertype);
                    $('#view_username').val(response.user.username);  
                    $('#view_status').val(response.user.status);  
                    $('#usercode').val(id);
                }
            }
        });
    });

    //show data in edit form
    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        var id = $(this).val();
        $('#edit').modal('show');
        $.ajax({
            type: "GET",   
            url: '/admin/user/' + id + '/edit',
            datatype: "json",
            success: function(response){ 
                if(response.status == 400){
                    $('#update_errform' ).html("");
                    $('#update_errform' ).addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_values){
                    $('#update_errform').append('<li>'+err_values+'</li>');
                    })
                }else{
                    $('#edit_fname').val(response.user.fname);
                    $('#edit_mname').val(response.user.mname);
                    $('#edit_lname').val(response.user.lname);
                    $('#edit_birthday').val(response.user.birthday);
                    $('#edit_age').val(response.user.age);
                    $('#edit_address').val(response.user.address);
                    $('#edit_gender').val(response.user.gender); 
                    $('#edit_username').val(response.user.username);
                    $('#edit_mobileno').val(response.user.mobileno);
                    $('#edit_email').val(response.user.email);  
                    $('#edit_usertype').val(response.user.usertype); 
                    $('#edit_status').val(response.user.status); 
                    $('#usercode').val(id);
                }
            }
        });
    });

    //update data from database
    $(document).on('click', '.update_user', function(e){
        e.preventDefault();
        var id = $('#usercode').val();
        var data ={
            _method: 'PUT',
            'first_name' : $('#edit_fname').val(),
            'mname': $('#edit_mname').val(), 
            'last_name': $('#edit_lname').val(),
            'birthday': $('#edit_birthday').val(),
            'age': $('#edit_age').val(),
            'address': $('#edit_address').val(),
            'gender': $('#edit_gender').val(),
            'mobile_number': $('#edit_mobileno').val(), 
            'email': $('#edit_email').val(),
            'password': $('#edit_password').val(),
            'password_confirmation': $('#edit_password_confirmation').val(),
            'usertype': $('#edit_usertype').val(),
            'status': $('#edit_status').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: 'POST', 
            url: '/admin/user/' + id,
            data: data,
            datatype: "json",
            beforeSend: function(){
                $('#accept-confirmation').modal('hide');
                $(".main-spinner").show();
            },
            complete: function(){
                $(".main-spinner").hide();
            },
            success: function(response){
                
                console.log(response);
                if(response.status == 400){
                    $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #error_status'  ).html("");
                    $.each(response.errors.first_name, function (key, err_values){
                    $('#error_fname' ).append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.last_name, function (key, err_values){
                    $('#error_lname' ).append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.birthday, function (key, err_values){
                    $('#error_birthday').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.age, function (key, err_values){
                    $('#error_age').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.address, function (key, err_values){
                    $('#error_address').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.mobile_number, function (key, err_values){
                    $('#error_mobileno').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.email, function (key, err_values){
                    $('#error_email').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.password, function (key, err_values){
                    $('#error_pass').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.gender, function (key, err_values){
                    $('#error_gender').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.usertype, function (key, err_values){
                    $('#error_usertype').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.status, function (key, err_values){
                    $('#error_status').append('<span>'+err_values+'</span>');
                    })
                    $.each(response.errors.password, function (key, err_values){
                    $('#error_password').append('<span>'+err_values+'</span>');
                    })
                }else{                  
                    $('#update_errform' ).html("");
                    $('#success').html();
                    $('#success').text('Updated successfully');
                    $('#success').show();
                    setTimeout(function() {
                        $("#success").fadeOut(500);
                    }, 2000);
                    $('#edit').modal('hide');
                    $('.modal-update').load(location.href+' .modal-update');
                    refresh_table();
                }
            }
        });
    });

    //get pagination page
    $(document).on('click',  '.pagination a', function(e){
        e.preventDefault();
        let usertype = $('#usertypetable').val();

        if (usertype == "patient") {
          let page = $(this).attr('href').split('patient=')[1]
          profile(page, usertype);
        } else if(usertype == "secretary"){
          let page = $(this).attr('href').split('secretary=')[1]
          profile(page, usertype);
        }else{
          let page = $(this).attr('href').split('admin=')[1]
          profile(page, usertype);
          
        }
    });

    // render data from pagination
    function profile(page, usertype){
        let data = page;
        let usertypetable = usertype;

        console.log(data + " "  + usertypetable);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        if (usertypetable == "patient") {
            $.ajax({
                type: "GET", 
                data: {usertypetable :usertypetable},  
                url: "/admin/user/pagination/paginate-data?patient="+page , 
                datatype: "json",
                success: function(response){
                $('.patient').html(response);
                }
            });
        } else if (usertypetable == "secretary"){
            $.ajax({
                type: "GET", 
                data: {usertypetable :usertypetable},  
                url: "/admin/user/pagination/paginate-data?secretary="+page , 
                datatype: "json",
                success: function(response){ 
                $('.secretary').html(response);
                }
            });
        }else{
            $.ajax({
                type: "GET", 
                data:{usertypetable :usertypetable},  
                url: "/admin/user/pagination/paginate-data?admin="+page , 
                datatype: "json",
                success: function(response){
                $('.admin').html(response);
                }
            });
        }
    }

    $('#search-fullname').on('keyup', function(e){
        e.preventDefault();
        let usertype = $('#usertypetable').val();
        let search = $('#search-fullname').val();

        console.log(usertype + " " + search);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/user/search-name',
            method:'GET',
            data: {search:search,
                    usertype:usertype,
                                    },
            success:function(response){
                
                if(usertype == 'patient'){
                    $('.patient').html("");
                    if(response.message == 'Nofound'){
                            $('.patient').append('<div class="card-body" style="width:100%; min-height:65vh; display: flex; overflow-x: auto;  font-size: 15px; ">' +
                            '<table class="table table-bordered table-striped" style="background-color: white;">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>Id</th>' +
                            '<th>First name</th>' +
                            '<th>Middle name</th>' +
                            '<th>Last name</th>' +
                            '<th>Age</th>' +
                            '<th>Sex</th>' +
                            '<th>Status</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '<tr>' +
                            '<td colspan="7" style="text-align: center;">no user Found</td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table>' +
                            '</div>');
                    }else {
                        $('.patient').html(response);
                    }
                }else if(usertype == 'secretary'){
                    $('.secretary').html("");
                    if(response.message == 'Nofound'){
                        $('.secretary').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                            <thead>\
                                                        <tr>\
                                                            <th>Id</th>\
                                                            <th>First name</th>\
                                                            <th>Middle name</th>\
                                                            <th>Last name</th> \
                                                            <th>Age</th>\
                                                            <th>Sex</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                    <tbody >\
                                                    <tr>\
                                                        <td colspan="7" style="text-align: center;">No Secretary Found</td>\
                                                    </tr>\
                                                    </tbody>\
                                                </table>');
                    }else {
                        $('.secretary').html(response);
                    }
                
                }else{
                    $('.admin').html("");
                    if(response.message == 'Nofound'){
                        $('.admin').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                            <thead>\
                                                        <tr>\
                                                            <th>Id</th>\
                                                            <th>First name</th>\
                                                            <th>Middle name</th>\
                                                            <th>Last name</th> \
                                                            <th>Age</th>\
                                                            <th>Sex</th>\
                                                            <th>Status</th>\
                                                        </tr>\
                                                    </thead>\
                                                    <tbody >\
                                                    <tr>\
                                                        <td colspan="7" style="text-align: center;">No Admin Found</td>\
                                                    </tr>\
                                                    </tbody>\
                                                </table>');
                    }else {
                        $('.admin').html(response);
                    }
                }
            }
        });
    })

    // hide and unhide button in create modal
    $(document).on('click','.create_show_password', function(){
              $('.create_show_password').hide();
              $('.create_password').attr('type', 'text');
              $('.create_hidden_password').show();
        });

        $(document).on('click','.create_hidden_password', function(){
              $('.create_show_password').show();
              $('.create_password').attr('type', 'password');
              $('.create_hidden_password').hide();
        });

        $(document).on('click','.create_show_confirm_password', function(){
              $('.create_show_confirm_password').hide();
              $('.create_password_confirmation').attr('type', 'text');
              $('.create_hidden_confirm_password').show();
        });

        $(document).on('click','.create_hidden_confirm_password', function(){
              $('.create_show_confirm_password').show();
              $('.create_password_confirmation').attr('type', 'password');
              $('.create_hidden_confirm_password').hide();
        });

        // hide and unhide button in edit modal
        $(document).on('click','.edit_show_password', function(){
              $('.edit_show_password').hide();
              $('.edit_password').attr('type', 'text');
              $('.edit_hidden_password').show();
        });

        $(document).on('click','.edit_hidden_password', function(){
              $('.edit_show_password').show();
              $('.edit_password').attr('type', 'password');
              $('.edit_hidden_password').hide();
        });

        $(document).on('click','.edit_show_confirm_password', function(){
              $('.edit_show_confirm_password').hide();
              $('.edit_password_confirmation').attr('type', 'text');
              $('.edit_hidden_confirm_password').show();
        });

        $(document).on('click','.edit_hidden_confirm_password', function(){
              $('.edit_show_confirm_password').show();
              $('.edit_password_confirmation').attr('type', 'password');
              $('.edit_hidden_confirm_password').hide();
        });

    });