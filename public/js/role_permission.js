 var existingRuleId;

 $(document).ready(function() {

     $('#role_click').on('click', function(event) {
         event.preventDefault();
         var role_id = $("#role_id").val();
         if (role_id == 0) {
             alert("Please select a Role");
             return false;
         }
         var permission = [];
         $('#permission:checked').each(function() {
             permission.push($(this).val());
         });
         console.log(permission);
         // return false;
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: 'assign_permission_role',
             type: 'POST',
             dataType: 'JSON',
             data: { role_id: role_id, permission: permission },
             success: function(response) {
                alert(response.message);
             }
         })
     })
     $('#user_click').on('click', function(event) {
             event.preventDefault();
             var user_id = $("#user_id_for_role").val();
             // alert(user_id);
             // return 0;
             if (user_id == 0) {
                 $('#assign_role_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> <strong>' + Globals.messaage + ':' + ' </strong>' + Globals.user_select + '</div>');
                 return false;
             }
             var roles = [];
             $('#role:checked').each(function() {
                 roles.push($(this).val());
             });
             // console.log(roles);
             // return false;
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'assign_model_role',
                 type: 'POST',
                 dataType: 'JSON',
                 data: { user_id: user_id, roles: roles },
                 success: function(response) {
                     $('#assign_role_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.set_up + '</div>');
                 }
             })
         })
         // Assign permission to Model/User
     $('#save_permission').on('click', function(event) {
             // $( document ).delegate( "save_permission", "click", function() {
             event.preventDefault();

             var user_id = $("#user_id_for_permission").val();
             // alert(user_id);
             // return 0;
             if (user_id == 0) {
                 $('#assign_permission_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> <strong>' + Globals.message + ':' + '</strong>' + Globals.user_select + '</div>');
                 return false;
             }
             var permission = [];
             $('#permission:checked').each(function() {
                 permission.push($(this).val());
             });
             // console.log(user_id);
             // console.log(permission);
             // return false;
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'assign_permission_model',
                 type: 'POST',
                 dataType: 'JSON',
                 data: { user_id: user_id, permission: permission },
                 success: function(response) {
                     $('#assign_permission_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i><strong>' + Globals.message + ':' + '</strong>' + response.message + '</div>');
                     //   $("#div").load(" #div > *");
                 }
             })
         })
         // Permission Delete 
     function delete_permission_data(permission_id) {

         $.ajax({
             url: "permission_delete/" + permission_id,
             method: "GET",
             success: function(data) {
                 $('#permission_main_message').html('');
                 $('#permission_main_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i>' + Globals.message + ':' + '</strong> ' + data.permission_name + ' ' + data.message + '</div>');
                 $("#permission_list").load(" #permission_list > *");
             }
         });
     }

     $(document).on('click', '.permission_delete', function() {
         var permission_id_for_modal = $(this).attr("id");
         $('#delete_id').val('');
         $('#delete_id').val(permission_id_for_modal);

         $('#delete_type').val('');
         $('#delete_type').val('permission_delete');

         $('#delete_heading').html('');
         $('#delete_heading').html(Globals.permission_delete);
         var permission_name = $('#permission_name' + permission_id_for_modal).val();
         $('#delete_msg').html(Globals.permission_delete_confirm + ':' + permission_name);

         $('#delete_modal').modal('show');
     });




     //User Create
     $('#new_user_save').on('click', function(event) {
             event.preventDefault();
             // alert("Hi");
             // return false;
             var name = $("#name").val();
             var email = $("#email").val();
             var password = $("#password").val();
             var password_confirm = $("#password-confirm").val();
             if (name == "" || email == "" || password == "" || password_confirm == "") {
                 $('#user_message').html('<h3 class="text-danger">' + Globals.all_fields_required + '</h3>');
                 return false;
             }
             if (password != password_confirm) {
                 $('#user_message').html('<h3 class="text-danger">' + Globals.password_not_match + '</h3>');
                 return false;
             }

             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'user_create',
                 type: 'POST',
                 dataType: 'JSON',
                 data: { name: name, email: email, password: password },
                 success: function(response) {
                     console.log(response.message);

                     if (response.message == 'success') {
                         $("#div").load(" #div > *");
                         $('#new_user_modal').modal('hide');
                         $('#user_main_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.user_created + '</div>');
                     } else if (response.message == 'invalid') {
                         $('#user_message').html('<h4 class="text-danger">' + Globals.email_already_database + '</h4>');
                     } else if (response.message == 'name_required') {
                         $('#user_message').html('<h4 class="text-danger">' + Globals.name_length + '</h4>');
                     } else if (response.message == 'email_required') {
                         $('#user_message').html('<h4 class="text-danger">' + Globals.email_length + '</h4>');
                     } else if (response.message == 'pass_required') {
                         $('#user_message').html('<h4 class="text-danger">' + Globals.password_length + '</h4>');
                     }
                 }
             })
         })
         //User Create End


     // Add new User
     $(document).on('click', '#create_new', function() {
         $('#user_message').html('');
         $("#user_create")[0].reset();
         $('#new_user_modal').modal('show');
     });
     // Add new user end

     //User Delete

     function delete_user_data(user_id) {
         $.ajax({
             url: "user_delete/" + user_id,
             method: "GET",
             success: function(data) {
                 $('#user_main_message').html('');
                 $('#user_main_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i><strong>' + Globals.message + ':' + '</strong>' + data.user_name + ' ' + data.message + '</div>');
                 $("#div").load(" #div > *");
             }
         });
     }

     $(document).on('click', '.user_delete', function() {
         var user_id_for_modal = $(this).attr("id");
         $('#delete_id').val('');
         $('#delete_id').val(user_id_for_modal);
         $('#delete_type').val('');
         $('#delete_type').val('user_delete');

         $('#delete_heading').html('');
         $('#delete_heading').html(Globals.user_delete);
         var user_name = $('#user_name' + user_id_for_modal).val();
         // alert(user_name);
         // return 0;
         $('#delete_msg').html(Globals.user_delete_confirm + ': ' + user_name);

         $('#delete_modal').modal('show');
     });



     //role Delete
     function delete_role_data(role_id) {
         var role_delete_url = Globals.base_url + '/role_delete/';
         $.ajax({
             url: role_delete_url + role_id,
             method: "GET",
             success: function(response) {
                 $('#role_main_message').html('');
                 $('#role_main_message').html('<div class="alert ' + response.class_name + ' alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fa fa-check mx-2"></i><strong>' + Globals.message + ':' + '</strong>' + response.role_name + ' ' + response.message + '</div>');
                 $("#role_list").load(" #role_list > *");
             }
         });
     }

     $(document).on('click', '.role_delete', function() {
         var role_id_for_modal = $(this).attr("id");
         // alert(role_id_for_modal);
         // return 0;
         $('#delete_id').val('');
         $('#delete_id').val(role_id_for_modal);

         $('#delete_type').val('');
         $('#delete_type').val('role_delete');

         $('#delete_heading').html('');
         $('#delete_heading').html(Globals.role_delete);
         var role_name = $('#role_name' + role_id_for_modal).val();
         $('#delete_msg').html(Globals.role_delete_confirm + ':' + role_name);

         $('#delete_modal').modal('show');
     });

     $(document).on('click', '#delete_from_modal', function() {
         var delete_id = $('#delete_id').val();
         var delete_type = $('#delete_type').val();
         if (delete_type == 'role_delete') {
             delete_role_data(delete_id);
         } else if (delete_type == 'permission_delete') {
             delete_permission_data(delete_id);
         } else if (delete_type == 'user_delete') {
             delete_user_data(delete_id);
         }
         $('#delete_modal').modal('hide');
     })

     //role Delete End


     // User Update

     $('#update_user').on('submit', function(event) {
         event.preventDefault();
         // alert("Hi");
         // return false;
         var fileInput = $("#image").val();

         if (fileInput != "") {
             var ext = checkFileExt(fileInput);
             if (ext == "jpg" || ext == "jpeg" || ext == "png") {

             } else {
                 $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.select_image + '</div>');
                 //    alert('{{__("messages.select_image")}}');
                 return false;
             }
             var file_size = $("#image")[0].files[0].size / 1024 / 1024;
             if (file_size >= 1) {
                 alert(Globals.select_image);
                 return false;
             }

         }
         // var APP_URL = {!! json_encode(url('/')) !!}
         var APP_URL = Globals.base_url + 'update_user';
         $.ajax({
             method: 'POST',
             url: APP_URL,
             data: new FormData(this),
             dataType: 'JSON',
             processData: false,
             cache: false,
             contentType: false,
             success: function(response) {

                 if (response.message == "no_permission") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.no_permission_change_email + '</div>');
                 } else if (response.message == "fname_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.fname_required + '</div>');
                 } else if (response.message == "lname_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + lname_required + '</div>');
                 } else if (response.message == "full_name_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.full_name_required + '</div>');
                 } else if (response.message == "email_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.email_required + '</div>');
                 } else if (response.message == "phone_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.phone_required + '</div>');
                 } else if (response.message == "dob_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.dob_required + '</div>');
                 } else if (response.message == "image_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.select_image + '</div>');
                 } else if (response.message == "postal_required") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong>' + Globals.message + ':' + '</strong>' + Globals.postal_required + '</div>');
                 } else if (response.message == "exist") {
                     $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"><strong>' + Globals.message + ':' + '</strong>' + Globals.email_exist + '</div>');
                 } else if (response.message == "success") {
                     $('#user_update_message').html('<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"> <strong>' + Globals.message + ':' + '</strong>' + Globals.user_update + '</div>');
                     location.reload();
                 }


             }
         }).fail(function() {

             // alert('{{__("messages.no_permission_change_email")}}');
             // return false;
             $('#user_update_message').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i><strong></strong>' + Globals.check_internet_connection + '</div>');
         });
     });

     // User Update end

     // Extention check function
     function checkFileExt(filename) {
         filename = filename.toLowerCase();
         return filename.split('.').pop();
     }
     // Extention check function End

     // Password Change
     $(document).on('click', '.password_change', function() {
         var user_id = $(this).attr("id");
         // alert(user_id);
         // return false;
         $('#change_password_message').html('');
         $('#change_pass_user_id').val(user_id);
         $('#new_password').val('');
         $('#new_password_confirm').val('');

         $('#change_password_modal').modal('show');
     });


     $('#change_password_save').on('click', function(event) {
             event.preventDefault();

             var user_id = $("#change_pass_user_id").val();
             // alert(user_id);
             // return false;
             var password = $("#new_password").val();
             var password_confirm = $("#new_password_confirm").val();
             if (password == "" || password_confirm == "") {
                 $('#change_password_message').html('<h3 class="text-danger">' + Globals.all_fields_required + '</h3>');
                 return false;
             }
             if (password != password_confirm) {
                 $('#change_password_message').html('<h3 class="text-danger">' + Globals.password_not_match + '</h3>');
                 return false;
             }

             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'change_password',
                 type: 'POST',
                 dataType: 'JSON',
                 data: { user_id: user_id, password: password },
                 success: function(response) {
                     // console.log(response.message);
                     // return false;
                     if (response.message == 'success') {
                         $('#change_password_message').html('<h3 class="text-success">' + Globals.password_changed + '</h3>');
                         $("#div").load(" #div > *");
                     } else if (response.message == 'invalid') {
                         $('#change_password_message').html('<h3 class="text-danger">' + Globals.password_length + '</h3>');
                     }
                 }
             })
         })
         // Password change End

     //Permission show by user
     $(document).on('click', '.permission_view', function() {
         $('#all_permission_show').html('');
         var user_id = $(this).attr('id');
         var user_name = $('#user_name' + user_id).val();
         $('#permission_modal_heading').html('Permissions for the user: ' + user_name);
         permission_search(user_id);
         // alert(user_name);
         // return false;
         $('#permission_show_modal').modal('show');
     });

     function permission_search(user_id) {
         var permission_search_url = Globals.base_url + 'permission_search';
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             type: "post",
             url: permission_search_url,
             data: { user_id: user_id },
             dataType: "JSON",
             success: function(response) {
                 $('#total_permission').html('<h4>Total Permissions: ' + response.permission_count + '</h4>');
                 if (response.permission_implosed == '') {
                     $('#all_permission_show').html('This user has no permission');
                 } else {
                     $('#all_permission_show').html(response.permission_implosed);
                 }
             }
         });

     }


   


                 // type: 'POST',
                 // dataType: 'JSON',
                 // data: { name: name, email: email, password: password },












     $(document).on('click', '#single_permission_name', function(e) {
         e.preventDefault();
     });
     //Permission show by user end

     // changed password by user
     $(document).on('click', '.pc', function() {
         var user_id = $(this).attr("id");
         // alert(user_id);
         // return false;
         $('#user_change_password_message').html('');
         $('#user_id').val(user_id);
         $('#user_new_password').val('');
         $('#user_new_password_confirm').val('');

         $('#user_change_password_modal').modal('show');
     });


     $('#user_change_password_save').on('click', function(event) {
         event.preventDefault();

         var user_id = $("#user_id").val();
         // alert(user_id);
         // return false;
         var password = $("#user_new_password").val();
         var password_confirm = $("#user_new_password_confirm").val();
         // alert(password);
         // return false;
         if (password == "" || password_confirm == "") {
             $('#user_change_password_message').html('<h3 class="text-danger">' + Globals.all_fields_required + '</h3>');
             return false;
         }
         if (password != password_confirm) {
             $('#user_change_password_message').html('<h3 class="text-danger">' + Globals.password_not_match + '</h3>');
             return false;
         }

         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: 'change_password',
             type: 'POST',
             dataType: 'JSON',
             data: { user_id: user_id, password: password },
             success: function(response) {
                 // console.log(response.message);
                 // return false;
                 if (response.message == 'success') {
                     $('#user_change_password_message').html('<h3 class="text-success">' + Globals.password_changed + '</h3>');
                     $("#div").load(" #div > *");
                 } else if (response.message == 'invalid') {
                     $('#user_change_password_message').html('<h3 class="text-danger">' + Globals.password_length + '</h3>');
                 }
             }
         })
     })

     // changed password by user end 
     //    Select2 Use
     $('.js-example-basic-multiple').select2();
     $("#user_id_for_permission").change(function(e) {
         e.preventDefault();
         var user_id = $(this).val();
         if (user_id == 0) {
             $('#permissions').html(Globals.no_selected_user);
             $('#previus_permissions').html(Globals.no_selected_user);
             return 0;
         }
         var get_permission_model = Globals.base_url + 'get_permission_model';
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             type: "post",
             url: get_permission_model,
             data: { user_id: user_id },
             dataType: "JSON",
             success: function(response) {
                 if (response.not_matches.length == 0) {
                     $('#permissions').html(Globals.no_pemission_left);
                 } else {
                     var html = '';
                     var not_match_permissions = response.not_matches;
                     for (var i = 0; i < not_match_permissions.length; i++) {
                         html += '<div class="checkbox">';
                         html += '<label>';
                         html += '<input type="checkbox" name="permission[]" id="permission" value="' + not_match_permissions[i].id + '" ' + ($.inArray(not_match_permissions[i].id, response.permissions_exist_id) == -1 ? '' : 'checked') + '>' + not_match_permissions[i]['name'];
                         html += '</label>';
                         html += '</div>';
                     }
                     $('#permissions').html(html);
                     // $('#save_button').html('');
                     var permissions_html = '';
                     permissions_html += '<ol>';
                     var permissions_array = response.all_permissions_for_user_array;
                     for (var j = 0; j < permissions_array.length; j++) {
                         permissions_html += '<a href="" id="single_permission_name">';
                         permissions_html += '<li>';
                         permissions_html += permissions_array[j];
                         permissions_html += '</li>';
                         permissions_html += '</a>';
                     }
                     permissions_html += '</ol>';
                     // console.log(response.all_permissions_for_user_array);
                     $('#previus_permissions').html(permissions_html);
                 }
             }
         });
     });
     $("#user_id_for_role").change(function(e) {
         e.preventDefault();
         var user_id = $(this).val();
         show_role(user_id);
     });

     function show_role(user_id) {
         $('#role').load('get_role/' + user_id);
     }







 });







////from here rule code start 









    var autoIndex = 0;
    var i = 1;
    var selectIndex;
    var newHeader = [];
    $(document).ready(function(){
        //New colum add for creatting csv table 
          $('#add_new_col').click(function(){
             newHeader.push({newName: '',oldName: '',source:''});
            $("tbody#td_col_name_input").append('<tr><td style="width:40%"><input type="text" name="new_input_header" id="new_input_header-'+ autoIndex + '" class="form-control new_input" data-value="'+autoIndex+'" style="background-color:#e1e2e3;"></td><td style="width:40%" class="old-header" id="old_header-'+ autoIndex + '" data-index="'+autoIndex+'"></td> <td id="del_col_name_input"><button id="remove_key" type="button" class="btn btn-danger">Delete</button></td></tr>');
            autoIndex++;
            i++
          });
        //Add new Key Table for adding csv table 
        $("#add_new_key_col").click(function () {
            var new_row = '<tr id="myTableRow"><td><input type="text" class="form-control" id="key_name" placeholder="key name here"></td><td><input type="text" class="form-control" id="key_value" placeholder="Value name here"></td><td style="width: 30%"><button type="submit" class="btn btn-primary" id="key_button">Submit</button><button id="new_rol_delete" type="button" class="btn btn-danger">Delete</button></td></tr>';
            $('table#keytable').find('tbody').append(new_row);
        });
        // Fore Deleting Remove key row 
        $(document).ready(function(){
            $(document).on("click","#remove_key",function() {
                $(this).closest('tr').remove();
            });
        });

        //click header for coloring  old headr 
        $(document).on("click",".old-header",function() {
            $(this).toggleClass('clicked');
        });

        //click header for coloring  old headr for matching new new csv table 
        $(document).on("click",".old-data",function() {
            $(this).toggleClass('clicked');
        });

        // click  key table row for select data 
        $(document).on("click",".key_row",function() {
            $(this).toggleClass('clicked');
        });

        // remove key table colum 
        $(document).ready(function(){
            $(document).on("click","#new_rol_delete",function() {
                $(this).closest('tr').remove();
            });
        });
    });

    $(document).on("click",".old-header",function(e) {
        //select index for matching or adjust data-index with new csv table 
        selectIndex    = $(event.target).data('index');
        var new_input  = $('#new_input_header-'+selectIndex).val();
        var old_header = $('#old_header-'+selectIndex).text();
    });

    function setHeader(name,index) {
    
        $('#td_col_name_input tr').length;
        $("tbody#td_col_name_input tr").each(function(i,b) {
            if(selectIndex==i){
                $(this).find('.old-header').html(name);
                newHeader[selectIndex].oldName = name; 
                newHeader[selectIndex].source = "file";
            }
        });
    }

// Rule Create Function 
     function ruleInsert(){

        //fore getting rule name value 
        var rule_name = $("#rule_name").val();
        //for getting nnumber of colum of old csv table 
        var col_count = $('table#old_csv_table > tbody > tr:nth-child(1) td').length
        //console.log(col_count);
        var row=document.getElementById("old_csv_table").rows[0].cells;

        var old_csv_headers="";
        for (var i = 0; i < row.length; i++) {
            if (i==row.length-1) {
                old_csv_headers = old_csv_headers+row[i].innerHTML;
            }else{
                old_csv_headers = old_csv_headers+row[i].innerHTML+",";
            }
        }

        var row_count = $('table#down_csv > tbody > tr').length
        var datas_for_send=[];

        for (var i = 0; i <row_count; i++) {
            var row=document.getElementById("down_csv").rows[i].cells;
            var dataObj = {ex_name:"", new_name:"",source:""}
            dataObj.new_name=document.getElementById("new_input_header-"+i).value;
            dataObj.ex_name=row[1].innerHTML;
            if (newHeader[i].source=="") { 
                dataObj.source="key";
            }else{
                dataObj.source=newHeader[i].source;
            }
            datas_for_send.push(dataObj);
        }

        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });
        $.ajax({
            url:"rule_insert",
            type:"post",
            dataType: "JSON",
            data:{
                ruleName:rule_name,
                colCount:col_count,
                oldCsvHeaders:old_csv_headers,
                ruleFormat:datas_for_send
            },
           success:function(data){
              console.log("success");
           }
        });
    }

// Rule Create Function 
     function ruleUpdate(){

        var table = document.getElementById( "down_csv" );
        var tableArr = [];
        for ( var i = 0; i < table.rows.length; i++ ) {
            if (newHeader[i]["source"]=="") {
                tableArr.push({
                    newName: table.rows[i].cells[0].children[0].value,
                    oldName: table.rows[i].cells[1].innerHTML,
                    source_type:"key",
                    id:existingRuleId
                });
            }else{
                tableArr.push({
                    newName: table.rows[i].cells[0].children[0].value,
                    oldName: table.rows[i].cells[1].innerHTML,
                    source_type:newHeader[i]["source"],
                    id:existingRuleId
                });
            } 
        }


   $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });
        $.ajax({
            url:"rule_update",
            type:"post",
            dataType: "JSON",
            data:{
                updatdRules:tableArr,
                id:existingRuleId
            },
           success:function(data){
              alert("Update successfully Done");
           },
        });
        console.log(tableArr);
          alert("Update successfully Done");
    }


    function getRulesDetails(element){

         document.getElementById("rule_submit").style.display='none';

        var headerName=[];
        var id =  $(element).val();
        existingRuleId= $(element).val();
        //console.log("ajax id "+id);
        //before cliking getRulesDetails function or event this two table will be null.
        $("#down_csv > tbody").html("");
        $("#csv_header_view > tbody").html("");

        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" : jQuery('meta[name="csrf-token"]').attr("content]")}
        });
        //for getting data 
        $.ajax({
            url:"ruleDataShow/" + id,
            type:"get",
            dataType: "JSON",
            success:function(data){
                //alert("ajax data "+data);
                //for making an array  use split  split 
                headerName = data[0]["col_header"].split(",");

                data.forEach(function(a){
                    //for replacing rule name 
                    $("#rule_name").val(a["rule_name"]);
                    // for replacing in database rule table 
                    newHeader.push({newName: a["destination"],oldName: a["source"],source:a["source_type"]});
                    $("tbody#td_col_name_input").append('<tr><td style="width:40%"><input type="text" name="new_input_header" id="new_input_header-'+ autoIndex + '" class="form-control new_input" data-value="'+autoIndex+'" style="background-color:#e1e2e3;"></td><td style="width:40%" class="old-header" id="old_header-'+ autoIndex + '" data-index="'+autoIndex+'">'+a["source"]+'</td> <td id="del_col_name_input"><button id="remove_key" type="button" class="btn btn-danger">Delete</button></td></tr>');
                    $('#new_input_header-'+autoIndex).val(a["destination"]);
                    autoIndex++;
                    i++
                })

                headerName.forEach(function(singleHeader,i){
                   $('#csv_header_view').append('<tr  id="csv_head_name-'+ i + '" class="old-data"><td  style="max-width: 50%; width: 50%; min-width: 50%;">'+ singleHeader + '</td></tr>');
                    // $('#next').attr('onclick', '');
                    $('#csv_head_name-'+i).attr('onclick', 'setHeader("'+ singleHeader + '",'+ i + ')')
                    //onclick="setHeader('+ singleHeader + ','+ i + ')"
                })
            }
           ,
           error: function(request, status, error) {
                alert("ajax data error "+request.responseText);
                console.log(request.responseText);
            }
           
        })
        
    }


    function makeCsv(){

        var old_table = $('table#old_csv_table').html();
        var row_count=0;

        var col_count = $('table#old_csv_table > tbody > tr:nth-child(1) td').length
        var row_count = $('table#old_csv_table > tbody > tr').length
        $('table#down_csv > tbody  > tr').each(function() {
            var new_col_name = $(this).find('input').val();
            var old_col_name = $(this).find('td:nth-child(2)').text();

      
            var is_new_col = $(this).data('is_new_col');
            var is_new_col_val = $(this).data('val');

            if(is_new_col!=1){
                $('table#old_csv_table > tbody > tr:nth-child(1) td').each(function () {
                    if( $(this).text() == old_col_name){
                        $(this).text(new_col_name);
                        //$(this).css('background','yellow');
                        $(this).addClass('yes');
                    }
                });
            }else{
                for(i=1;i<=row_count; i++){
                    if(i==1){
                        $('table#old_csv_table > tbody > tr:nth-child('+i+')').append('<td> '+new_col_name+' </td>');
                    }else{
                        $('table#old_csv_table > tbody > tr:nth-child('+i+')').append('<td> '+is_new_col_val+' </td>');
                    }
                }
            }

        });
        $('table#old_csv_table > tbody > tr:nth-child(1) td').each(function () {
            var tdsl;
            if( $(this).attr('class') != 'yes'){
                tdsl = $(this).data('tdsl');
            }

            $('td[data-tdsl='+tdsl+']').remove();
        });
        $('table#modified_csv').html($('table#old_csv_table').html());
        $('table#old_csv_table').html(old_table);
    }






    // for selecting key name creating new csv
    function set_key_Header(name,value,index) {

        $('#td_col_name_input tr').length;
        //console.log(selectIndex,name);
        $("tbody#td_col_name_input tr").each(function(i,b) {
            if(selectIndex==i){
             newHeader[selectIndex].source = "key";

                $(this).find('.old-header').html(name);
                $(this).attr('data-val',value);
                $(this).attr('data-is_new_col',1);
            }
        });
    }

// Insert new key name in database using ajax
    $(document).on("click","#key_button",function() {
        var key_name  = $("#key_name").val();
        var key_value = $("#key_value").val();
       
        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });
        $.ajax({
            url:"key_insert",
            type:"post",
            dataType: "JSON",
            data:{
                keyName:key_name,
                keyValue:key_value
            },
           success:function(data){
              console.log("success");
           }
        });
    });

// Delete key name from database using ajax
    $(document).on("click","#key_delete",function(){
         var key_id = $(this).val();

         $.ajax({
            type: "get",
            url: "keyDelete/"+key_id,
            data:{
                keyId:key_id
            },
            success: function(data){
                console.log(data);
            }
         })
    })

    
    function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;
    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
    var csv = [];
    var rows = document.querySelectorAll("#modified_csv tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

// document.querySelector("#down_btn").addEventListener("click", function () {
//     var html = document.querySelector("#modified_csv").outerHTML;
//     export_table_to_csv(html, "table.csv");
// });
