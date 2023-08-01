
    $(document).ready(function (){

        $('#birthday').on('change', function(){
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
        
        $('#edit_birthday').on('change', function(){
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
            $('#edit_age').html("");
            $('#edit_age').val(age);
        }) 

        $(".modal").on("hidden.bs.modal", function(){ 
            $('#create, #edit, #delete').find('input, select').val("");
            $('#fname, #mname, #lname,#gender, #usertype, #create_error_birthday, #address, #mobileno, #email, #username, #confirmpassword, #password, #status, #age '  ).html("");
            $('#error_fname, #error_lname, #error_gender, #error_usertype, #error_birthday, #error_address, #error_mobileno, #error_email, #error_password, #error_status'  ).html("");

            $('.create_show_confirm_password, .create_show_password').show();
            $('.create_password_confirmation, .create_password').attr('type', 'password');
            $('.create_hidden_confirm_password, .create_hidden_password').hide();
        });

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
                url: "/secretary/user",
                data: data,
                dataType: "json",
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
                        $('#fname, #mname, #lname,#gender, #usertype,#create_error_birthday, #address, #mobileno, #email, #username, #confirmpassword, #password, #status,#age '  ).html("");
                        $.each(response.errors.first_name, function (key, err_values){
                            $('#fname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.last_name, function (key, err_values){
                            $('#lname').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.birthday, function (key, err_values){
                          $('#create_error_birthday').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.address, function (key, err_values){
                            $('#address').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.mobile_number, function (key, err_values){
                            $('#mobileno').append('<span>'+err_values+'</span>');
                        })
                        $.each(response.errors.age, function (key, err_values){
                            $('#age').append('<span>'+err_values+'</span>');
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
                        $('#success').html();
                        $('#success').text('Created successfully');
                        $('#success').show();
                        setTimeout(function() {
                            $("#success").fadeOut(500);
                        }, 2000);
                        $('#create').modal('hide');
                        $('.modal-create').load(location.href+' .modal-create');
                        $('.patient').load(location.href+' .patient');
                    }
                }
            });

        });

        //view form
        $(document).on('click', '.view', function(e){
            e.preventDefault();
            var id = $(this).val();
            var url =  '/secretary/user/' + id + '/edit' ;
            $('#view').modal('show');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                        const fullname = response.user.fname;
                        $('#view_fname').val(fullname.concat(" ", response.user.lname  )  );
                        $('#view_mname').val(response.user.mname);
                        $('#view_lname').val(response.user.lname);
                        $('#view_birthday').val(response.user.birthday);
                        $('#view_age').val(response.user.age);
                        $('#view_address').val(response.user.address);
                        $('#view_gender').val(response.user.gender); 
                        $('#view_mobileno').val(response.user.mobileno);
                        $('#view_email').val(response.user.email);  
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",   
                url: '/secretary/user/' + id + '/edit',
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
                url: '/secretary/user/' + id,
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
                        $.each(response.errors.gender, function (key, err_values){
                            $('#error_gender').append('<span>'+err_values+'</span>');
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
                        $('.patient').load(location.href+' .patient');
                    }
                }
            });
        });

                //pagination
        $(document).on('click',  '.pagination a', function(e){
            e.preventDefault();
            let usertype = $('#usertypetable').val();
       
            let page = $(this).attr('href').split('patient=')[1]
            profile(page);
        });

        

        function profile(page){
            let data = page;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET", 
                url: "/secretary/user/pagination/paginate-data?patient="+page , 
                datatype: "json",
                success: function(response){
                    console.log(response);
                    $('.patient').html(response);
                }
            });
        }

        $('#search-fullname').on('keyup', function(e){
            e.preventDefault();
            let search = $('#search-fullname').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/user/search-name',
                method:'GET',
                data: {search:search },
                success:function(response){
                    $('.patient').html("");
                    $('.patient').html(response);
                    if(response.message == 'Nofound'){  
                        $('.patient').append(' <table class="table table-bordered table-striped" style="background-color: white">\
                                                <thead>\
                                                    <tr>\
                                                        <th>id</th>\
                                                        <th>First name</th>\
                                                        <th>Middle name</th>\
                                                        <th>Last name</th> \
                                                        <th>Birthday</th>\
                                                        <th>Address</th>\
                                                        <th>Gender</th>\
                                                        <th>Mobile no.</th>\
                                                        <th>Email</th>\
                                                        <th>Action</th>\
                                                    </tr>\
                                                </thead>\
                                                <tbody >\
                                                <tr>\
                                                    <td colspan="10" style="text-align: center;">no user Found</td>\
                                                </tr>\
                                                </tbody>\
                                            </table>');
                    }
                }
            });
        })

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
    });
