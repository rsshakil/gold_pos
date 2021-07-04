var product_id_unit_price = [];
$(document).ready(function() {
    $(".maker_id").select2();
    $('.making_end_date').datepicker({ dateFormat: 'yy-mm-dd' })
    console.log(Globals.setting_content);
    var exact_url = get_urls();
    switch (exact_url) {
        case 'outlets':
            outletlist();
            break;
        case 'category_list':
            category_list();
            break;
        case 'wholesale_purchase':
            wholesale_purchase_list();
            break;
        case 'settings':
            get_settings();
            break;
        case 'products':
            product_list();
            break;
        case 'maker_item':
            maker_item_list();
            break;
        case 'sales':
            sales_item_list();
            break;
        case 'exchange_product':
            returns_item_list();
            break;
        case 'orders':
            orders_item_list();
            break;

        default:
            break;
    }
    if (Globals.session_message_text != null) {
        success_message('session_message_id', 'alert-success', Globals.session_message_text);
    }
    $(".addrow_maker_item").click(function() {
        var markup = '';
        markup += "<tr>";
        markup += "<td><input type='hidden' class='maker_item_detail_id' name='maker_item_detail_id[]' value='0'><input name='item_name[]' type='text' class='form-control itms_name'></td>";
        markup += '<td><select name="carat_type[]" class="form-control carat_type"><option value="21">21 carat</option> <option value="22">22 carat</option></select></td>';
        markup += "<td><input type='number' name='given_waight[]' class='form-control given_waight'></td>";
        markup += "<td><input type='number' name='return_waight[]' class='form-control return_waight'></td>";
        markup += "<td><input type='file' name='sample_img[]' class='form-controls sample_img'></td>";
        markup += "<td><input type='number' name='maker_quantity[]' class='form-control maker_quantity'></td>";
        markup += '<td><span class="material-icons delete_maker_item_raw">delete_forever</span></td>';
        markup += "</tr>";
        tableBody = $(".add_maker_items_inputs");
        tableBody.append(markup);
    });
    // Add new vendor
    $(document).on('click', '.delete_maker_item_raw', function() {
        var maker_item_detail_id = $(this).closest('tr').children('td').find('.maker_item_detail_id').val();
   
        
        if(maker_item_detail_id!=0){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'delete_maker_detail_item_id/'+maker_item_detail_id,
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    console.log(response);
                }
            })
        }
        $(this).closest('tr').remove();
    })
    $(document).on('click', '#create_new_vendors', function() {
        $('.commn_message').html('');
        $("#vendor_create")[0].reset();
        $('.vendor_id').val(0);
        $('#new_vendor_modal').modal('show');
    });
    // Add new purchase
    $(document).on('click', '#create_new_wholesale_purchases', function() {
       
        $('.commn_message').html('');
        $("#wholsale_purchase_create")[0].reset();
        $('.wholesale_purchase_id').val(0);
        $('#new_wholesale_modal').modal('show');
        alert('34534');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_all_cat_list',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var vendor_list = response.vendor_list.original.vendorlist;
                var admin_cat_list = response.admin_cat_list.original.admin_cat;
                var product_cat_list = response.product_cat_list.original.product_categories;
                var product_sub_cat_list = response.product_sub_cat_list.original.product_sub_categories;

                var htmls = '';
                var admin_cat_htm = '';
                var pr_cat_htm = '';
                var pr_sub_cat_htm = '';
                var sub_cat_option_list = '';
                var admin_cat_option_list = '';
                var vendor_option_list = '';
                $('.vendor_lists_data').html('');
                $('.admin_cat_lists_data').html('');
                $('.product_cat_lists_data').html('');
                $('.product_sub_cat_lists_data').html('');
                var j = 1;
                var ac = 1;
                var pc = 1;
                var psc = 1;
                if (vendor_list.length > 0) {
                    for (var i = 0; i < vendor_list.length; i++) {
                        vendor_option_list += '<option value="' + vendor_list[i].vendor_id + '">' + vendor_list[i].vendor_name + '</option>';
                        htmls += '<tr>';
                        htmls += '<td>' + j + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_name + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_email + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_phone + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_address + '</td>';
                        htmls += '<td><button class="btn btn-info edit_vendor" row_id="' + vendor_list[i].vendor_id + '">Edit</button><button class="btn btn-danger delete_vendor" row_id="' + vendor_list[i].vendor_id + '">Delete</button></td>';
                        htmls += '</tr>';
                        j++;
                    }
                } else {
                    htmls += '<tr><td colspan="6">Vendor not found</td></tr>';
                }

                if (admin_cat_list.length > 0) {
                    for (var i = 0; i < admin_cat_list.length; i++) {
                        admin_cat_option_list += '<option value="' + admin_cat_list[i].admin_purchase_categeorie_id + '">' + admin_cat_list[i].purchase_cat_name + '</option>';
                        admin_cat_htm += '<tr>';
                        admin_cat_htm += '<td>' + ac + '</td>';
                        admin_cat_htm += '<td>' + admin_cat_list[i].purchase_cat_name + '</td>';
                        admin_cat_htm += '<td><button cat_type="1" class="btn btn-info edit_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Edit</button><button cat_type="1" class="btn btn-danger delete_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Delete</button></td>';
                        admin_cat_htm += '</tr>';
                        ac++;
                    }
                } else {
                    admin_cat_htm += '<tr><td colspan="3">purchase category not found</td></tr>';
                }
                $('.select_a_purchase_cat').html(admin_cat_option_list);
                $('.select_a_vendor').html(vendor_option_list);
            }
        })
    });


    // Add new User
    $(document).on('click', '#create_new_outlet', function() {
        $('#outlet_message').html('');
        $("#outlet_create")[0].reset();
        $('.outlet_id').val(0);
        $('#new_outlet_modal').modal('show');
    });
    // Add new User
    $(document).on('click', '.edit_outlet', function() {
        var outlet_id = $(this).attr('data_outlet_id');
        $('#outlet_message').html('');
        $('#new_outlet_modal').modal('show');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_outlet_by_id/' + outlet_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var response = response.outlet_list;
                $('.outlet_id').val(response.outlet_id);
                $('#name').val(response.outlet_name);
                $('#email').val(response.outlet_email);
                $('#outlet_phone').val(response.outlet_phone);
                $('#address').val(response.address);
                $('#outlet_opentime').val(response.outlet_opentime);
                $('#outlet_closetime').val(response.outlet_closetime);
                $('#weekend_day').val(response.weekend_day);
            }
        })
    });

    $(document).on('click', '.delete_outlet', function() {
        var outlet_id = $(this).attr('data_outlet_id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete_outlet_by_id/' + outlet_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                outletlist();
            }
        })
    });

    // Add new User
    $(document).on('click', '#new_outlet_save', function() {
        $('#outlet_message').html('');
        var form_data = $("#outlet_create").serialize();
        console.log(form_data);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_update_outlet',
            type: 'POST',
            data: { form_data: form_data },
            dataType: 'JSON',
            success: function(response) {
                outletlist();
            }
        })
        $("#outlet_create")[0].reset();
        $('#new_outlet_modal').modal('hide');
    });

    // Add new cat
    $(document).on('click', '#create_new_subs_cat', function() {
        var sub_cat_id = $('.product_sub_cat_id').val();
        var cat_id = $('.parent_cat_list option:selected').val();
        var sub_cat_name = $('.sub_category_name').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_update_sub_cat',
            type: 'POST',
            data: { cat_name: sub_cat_name, row_id: sub_cat_id, cat_id: cat_id },
            dataType: 'JSON',
            success: function(response) {
                category_list();
                $('.sub_category_name').val('');
                $('.product_sub_cat_id').val(0);
            }
        })
    });

    // Add new purchase
    $(document).on('click', '#new_wholesale_purchase_save', function() {
        var purchase_id = $('.wholesale_purchase_id').val();
        var item_name = $('.item_namess').val();
        var price = $('.price').val();
        var weight = $('.weight').val();
        var vendor_id = $('.select_a_vendor option:selected').val();
        var purchase_cat_id = $('.select_a_purchase_cat option:selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_update_wholesale_purchase',
            type: 'POST',
            data: { purchase_id: purchase_id, item_name: item_name, price: price, weight: weight, vendor_id: vendor_id, purchase_cat_id: purchase_cat_id },
            dataType: 'JSON',
            success: function(response) {
                wholesale_purchase_list();
                $('#new_wholesale_modal').modal('hide');
                $("#wholsale_purchase_create")[0].reset();
                $('.wholesale_purchase_id').val(0);
            }
        })
    });

    // settings update
    $(document).on('click', '#settings_update', function() {
        var company_name = $('#company_name').val();
        var vat_tax = $('#vat_tax').val();
        var company_logo = $('#company_logo').val();
        var platinam_21_carat_price = $('#platinam_21_carat_price').val();
        var platinam_22_carat_price = $('#platinam_22_carat_price').val();
        var gold_21_carat_price = $('#gold_21_carat_price').val();
        var gold_22_carat_price = $('#gold_22_carat_price').val();
        var diamond_21_carat_price = $('#diamond_21_carat_price').val();
        var diamond_22_carat_price = $('#diamond_22_carat_price').val();
        var return_decrease_percent = $('#return_decrease_percent').val();
        var purchase_decrease_percent = $('#purchase_decrease_percent').val();
        var form_data = $('#setting_update').serialize();
        var form = $('#setting_update');
        var formData = new FormData(document.getElementById("setting_update"));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'update_setting_data',
            type: 'POST',
            data: new FormData(document.getElementById("setting_update")),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {

                get_settings();
                $('#new_setting_modal').modal('hide');
                $("#setting_update")[0].reset();
            }
        })
    });

    // product update
    $(document).on('click', '#new_product_save', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_update_product',
            type: 'POST',
            data: new FormData(document.getElementById("product_create")),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                product_list();
                $('#new_product_modal').modal('hide');
                $("#product_create")[0].reset();
                Swal.fire(
                    'Good job!',
                    'You have successfully added product',
                    'success'
                  );
            }
        })
    });

    $(document).on('click', '.edit_product_sub_cat', function() {
        var parent_cat_id = $(this).attr('parent_cat_id');
        var row_id = $(this).attr('row_id');
        var cat_name = $(this).closest('tr').find('td:nth-child(3)').text();
        $('.sub_category_name').val(cat_name);
        $('.product_sub_cat_id').val(row_id);
        $(".parent_cat_list").val(parent_cat_id).change();
    });

    $(document).on('click', '.edit_vendor', function() {
        $('#new_vendor_modal').modal('show');
        var row_id = $(this).attr('row_id');
        var name = $(this).closest('tr').find('td:nth-child(2)').text();
        var email = $(this).closest('tr').find('td:nth-child(3)').text();
        var phone = $(this).closest('tr').find('td:nth-child(4)').text();
        var address = $(this).closest('tr').find('td:nth-child(5)').text();
        $('#name').val(name);
        $('.vendor_id').val(row_id);
        $('#email').val(email);
        $('#phone').val(phone);
        $('#address').val(address);
    });
    $(document).on('click', '.edit_setting', function() {
        $('#new_setting_modal').modal('show');
        var row_id = $(this).attr('row_id');
        var company_name = $(this).closest('tr').find('td:nth-child(1)').text();
        var vat_tax = $(this).closest('tr').find('td:nth-child(3)').text();
        var gold_22_carat_price = $(this).closest('tr').find('td:nth-child(5)').text();
        var gold_21_carat_price = $(this).closest('tr').find('td:nth-child(6)').text();
        var diamond_22_carat_price = $(this).closest('tr').find('td:nth-child(7)').text();
        var diamond_21_carat_price = $(this).closest('tr').find('td:nth-child(8)').text();
        var platinam_22_carat_price = $(this).closest('tr').find('td:nth-child(9)').text();
        var platinam_21_carat_price = $(this).closest('tr').find('td:nth-child(10)').text();
        var return_percent = $(this).closest('tr').find('td:nth-child(11)').text();
        var purchase_percent = $(this).closest('tr').find('td:nth-child(12)').text();
        $('#company_name').val(company_name);
        $('#vat_tax').val(vat_tax);
        $('#platinam_21_carat_price').val(platinam_21_carat_price);
        $('#platinam_22_carat_price').val(platinam_22_carat_price);
        $('#gold_21_carat_price').val(gold_21_carat_price);
        $('#gold_22_carat_price').val(gold_22_carat_price);
        $('#diamond_21_carat_price').val(diamond_21_carat_price);
        $('#diamond_22_carat_price').val(diamond_22_carat_price);
        $('#return_decrease_percent').val(return_percent);
        $('#purchase_decrease_percent').val(purchase_percent);
    });

    $(document).on('click', '.edit_wholesale_purchase', function() {
        $('#new_wholesale_modal').modal('show');

        var row_id = $(this).attr('row_id');
        var vendor_id = $(this).attr('data_vendor_id');
        var admin_purchase_categeorie_id = $(this).attr('data_admin_purchase_categeorie_id');
        var item_name = $(this).closest('tr').find('td:nth-child(3)').text();
        var weight = $(this).closest('tr').find('td:nth-child(5)').text();
        var price = $(this).closest('tr').find('td:nth-child(6)').text();
        $('.wholesale_purchase_id').val(row_id);
        $('.vendor_id').val(vendor_id);
        $('#item_names').val(item_name);
        $('.price').val(price);
        $('.weight').val(weight);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_all_cat_list',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var vendor_list = response.vendor_list.original.vendorlist;
                var admin_cat_list = response.admin_cat_list.original.admin_cat;
                var product_cat_list = response.product_cat_list.original.product_categories;
                var product_sub_cat_list = response.product_sub_cat_list.original.product_sub_categories;

                var htmls = '';
                var admin_cat_htm = '';
                var pr_cat_htm = '';
                var pr_sub_cat_htm = '';
                var sub_cat_option_list = '';
                var admin_cat_option_list = '';
                var vendor_option_list = '';
                $('.vendor_lists_data').html('');
                $('.admin_cat_lists_data').html('');
                $('.product_cat_lists_data').html('');
                $('.product_sub_cat_lists_data').html('');
                var j = 1;
                var ac = 1;
                var pc = 1;
                var psc = 1;
                if (vendor_list.length > 0) {
                    for (var i = 0; i < vendor_list.length; i++) {
                        vendor_option_list += '<option value="' + vendor_list[i].vendor_id + '">' + vendor_list[i].vendor_name + '</option>';
                        htmls += '<tr>';
                        htmls += '<td>' + j + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_name + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_email + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_phone + '</td>';
                        htmls += '<td>' + vendor_list[i].vendor_address + '</td>';
                        htmls += '<td><button class="btn btn-info edit_vendor" row_id="' + vendor_list[i].vendor_id + '">Edit</button><button class="btn btn-danger delete_vendor" row_id="' + vendor_list[i].vendor_id + '">Delete</button></td>';
                        htmls += '</tr>';
                        j++;
                    }
                } else {
                    htmls += '<tr><td colspan="6">Vendor not found</td></tr>';
                }

                if (admin_cat_list.length > 0) {
                    for (var i = 0; i < admin_cat_list.length; i++) {
                        admin_cat_option_list += '<option value="' + admin_cat_list[i].admin_purchase_categeorie_id + '">' + admin_cat_list[i].purchase_cat_name + '</option>';
                        admin_cat_htm += '<tr>';
                        admin_cat_htm += '<td>' + ac + '</td>';
                        admin_cat_htm += '<td>' + admin_cat_list[i].purchase_cat_name + '</td>';
                        admin_cat_htm += '<td><button cat_type="1" class="btn btn-info edit_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Edit</button><button cat_type="1" class="btn btn-danger delete_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Delete</button></td>';
                        admin_cat_htm += '</tr>';
                        ac++;
                    }
                } else {
                    admin_cat_htm += '<tr><td colspan="3">purchase category not found</td></tr>';
                }

                if (product_cat_list.length > 0) {
                    for (var i = 0; i < product_cat_list.length; i++) {
                        sub_cat_option_list += '<option value="' + product_cat_list[i].product_categorie_id + '">' + product_cat_list[i].category_name + '</option>';
                        pr_cat_htm += '<tr>';
                        pr_cat_htm += '<td>' + pc + '</td>';
                        pr_cat_htm += '<td>' + product_cat_list[i].category_name + '</td>';
                        pr_cat_htm += '<td><button cat_type="2" class="btn btn-info edit_cat" row_id="' + product_cat_list[i].product_categorie_id + '">Edit</button><button cat_type="2" class="btn btn-danger delete_cat" row_id="' + product_cat_list[i].product_categorie_id + '">Delete</button></td>';
                        pr_cat_htm += '</tr>';
                        pc++;
                    }
                } else {
                    pr_cat_htm += '<tr><td colspan="3">purchase category not found</td></tr>';
                }
                $('.select_a_purchase_cat').html(admin_cat_option_list);
                $('.select_a_vendor').html(vendor_option_list);

                $('.select_a_purchase_cat').val(admin_purchase_categeorie_id).change();
                $('.select_a_vendor').val(vendor_id).change();
            }
        })
    });

    $(document).on('click', '.edit_maker_item', function() {
        $('#new_maker_item_modal').modal('show');
        var maker_id = $(this).attr('maker_id');
        var row_id = $(this).attr('row_id');
        var item_id = $(this).attr('item_id');

    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_all_maker_item_list_by_item_id/'+row_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var maker_item_list = response.maker_list.original.maker_list;
                var pr_cat_htm = '';
                $('.maker_id').html('');
                $(".add_maker_items_inputs").html('');
                var markup = '';
                var item_details = response.maker_item_list;
                for(var i=0;i<item_details.length;i++){
                   
        markup += "<tr>";
        markup += "<td><input type='hidden' class='maker_item_detail_id' name='maker_item_detail_id[]' value='"+item_details[i].maker_item_detail_id+"'><input name='item_name[]' type='text' class='form-control itms_name' value='"+item_details[i].item_name+"'></td>";
        markup += '<td><select name="carat_type[]" class="form-control carat_type"><option value="21" '+(item_details[i].item_type=='21'?'selected':'')+'>21 carat</option> <option value="22" '+(item_details[i].item_type=='22'?'selected':'')+'>22 carat</option></select></td>';
        markup += "<td><input type='number' name='given_waight[]' class='form-control given_waight' value='"+item_details[i].given_weight+"'></td>";
        markup += "<td><input type='number' name='return_waight[]' class='form-control return_waight' value='"+item_details[i].return_weight+"'></td>";
        markup += "<td><input type='file' name='sample_img[]' class='form-controls sample_img'></td>";
        markup += "<td><input type='number' name='maker_quantity[]' class='form-control maker_quantity' value='"+item_details[i].quantity+"'></td>";
        markup += '<td><span class="material-icons delete_maker_item_raw">delete_forever</span></td>';
        markup += "</tr>";
        
                }
                tableBody = $(".add_maker_items_inputs");
        tableBody.append(markup);

                if (response.maker_list.original.maker_list.length > 0) {
                    var maker_item_list = response.maker_list.original.maker_list;
                    for (var i = 0; i < maker_item_list.length; i++) {
                        var selected = (item_details[0].maker_id==maker_item_list[i].maker_id?'selected':'');
                        pr_cat_htm += '<option value="' + maker_item_list[i].maker_id + '" '+selected+'>' + maker_item_list[i].maker_name + '</option>';

                    }
                }
                $('.making_end_date').val(item_details[0].making_end_date);
                $('.delivery_status option[value="' + item_details[0].delivery_status + '"]').attr("selected", "selected");
                $('.maker_id').html(pr_cat_htm);
                
                $('.maker_item_id').val(row_id);
            }
        });
    });

    $(document).on('click', '.print_maker_item', function() {
        $('#maker_item_print_modal').modal('show');
        var maker_id = $(this).attr('maker_id');
        var row_id = $(this).attr('row-id');
        var item_id = $(this).attr('item_id');

    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_all_maker_item_list_by_item_id/'+row_id,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                $(".print_maker_items").html('');
                var markup = '';
                var item_details = response.maker_item_list;
                for(var i=0;i<item_details.length;i++){
                   
        markup += "<tr>";
        markup += "<td>"+item_details[i].item_name+"</td>";
        markup += '<td>'+item_details[i].item_type+' Carat</td>';
        markup += "<td>"+item_details[i].given_weight+" gram</td>";
        markup += "<td>"+item_details[i].return_weight+" gram </td>";
        markup += "<td><img src="+Globals.base_url+'public/images/'+item_details[i].sample_img+" width='200px'/></td>";
        markup += "<td>"+item_details[i].quantity+" pc</td>";
        markup += "</tr>";
        
                }
                tableBody = $(".print_maker_items");
        tableBody.append(markup);
                $('.makers_nmese').text(item_details[0].maker_name);
                $('.makerphones').text(item_details[0].maker_phone);
                $('.makersaddresses').text(item_details[0].maker_address);
                $('.making_end_date').text(item_details[0].making_end_date);
                var delivery_statuss = (item_details[0].delivery_status=='0'?'Not delivery yet':'delivered');
                $('.mker_item_delivery_status').text(delivery_statuss);
                $('.mker_item_delivery_date').text(item_details[0].delivery_date);
              
            }
        });
    });
    $('#maker_item_print_exec').click(function(){
//         var divToPrint=document.getElementById("innerHTML");
//    newWin= window.open("");
//    newWin.document.write(divToPrint.outerHTML);
//    newWin.print();
//    newWin.close();
var printableContent = document.getElementById('maker_item_printable_sec').innerHTML;
var printWindow = window.open("", "Print_Content", 'scrollbars=1,width=900,height=900top=' + (screen.height - 700) / 2 + ',left=' + (screen.width - 700) / 2);
printWindow.document.write(printableContent);
// printWindow.document.close();
printWindow.focus();
printWindow.print();
// printWindow.close();
$('#maker_item_print_modal').modal('hide');
return false;
    })
    $('.product_barcode').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            $('.product_barcode').blur();
            $('#new_maker_modal').modal('hide');
            return false;
        }
    });

    $(document).on('blur', '.product_barcode', function(e) {
        var product_id = $(this).val();
        if (product_id == '') {
            alert('please input barcode');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_product_info',
            type: 'POST',
            data: { product_id: product_id },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var p_carat = response.product_lists.product_carat_type;
                var total_gold_price = 0;
                var unit_price = 0;
                var html = '';
                if (p_carat == 22) {
                    if (response.product_lists.product_categorie_id == 1) {
                        unit_price = Globals.setting_content.gold_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 2) {
                        unit_price = Globals.setting_content.diamon_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 3) {
                        unit_price = Globals.setting_content.platinam_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    }
                } else if (p_carat == 21) {
                    if (response.product_lists.product_categorie_id == 1) {
                        unit_price = Globals.setting_content.gold_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 2) {
                        unit_price = Globals.setting_content.diamon_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 3) {
                        unit_price = Globals.setting_content.platinam_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    }
                } else {

                }

                html += '<tr>';
                html += '<td>1</td>';
                html += '<td>' + response.product_lists.product_name + '</td>';
                html += '<td>' + p_carat + ' Carat</td>';
                html += '<td>' + response.product_lists.category_name + '-' + response.product_lists.product_sub_cat_name + '</td>';
                html += '<td>' + response.product_lists.weight + '</td>';
                html += '<td data_product_id="' + response.product_lists.product_id + '">' + unit_price + '</td>';
                html += '<td>' + total_gold_price + '</td>';
                html += '<td><button class="btn btn-danger delete_p_row">Delete</button></td>';
                html += '</tr>';
                $('.product_sale_data').prepend(html);
                $('.product_barcode').val('');
                add_sale_calculation();

            }
        })
    });

    /*add return*/

    $('.product_barcode_return').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            $('.product_barcode_return').blur();
            $('#new_maker_modal').modal('hide');
            return false;
        }
    });

    $(document).on('blur', ".product_sale_data td[contenteditable='true']", function(e) {
        var weight_u = $(this).text();
        weight_u = parseFloat(weight_u);
        var unit_price = $(this).closest('tr').find('td:nth-child(6)').text();
        unit_price = parseInt(unit_price);
        var total_gold_price = weight_u * unit_price;
        $(this).closest('tr').find('td:nth-child(7)').text(total_gold_price);
        add_return_calculation();
    })
    $(document).on('blur', '.product_barcode_return', function(e) {
        var product_id = $(this).val();
        if (product_id == '') {
            alert('please input barcode');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_product_info',
            type: 'POST',
            data: { product_id: product_id },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var p_carat = response.product_lists.product_carat_type;
                var total_gold_price = 0;
                var unit_price = 0;
                var html = '';
                if (p_carat == 22) {
                    if (response.product_lists.product_categorie_id == 1) {
                        unit_price = Globals.setting_content.gold_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 2) {
                        unit_price = Globals.setting_content.diamon_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 3) {
                        unit_price = Globals.setting_content.platinam_22_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    }
                } else if (p_carat == 21) {
                    if (response.product_lists.product_categorie_id == 1) {
                        unit_price = Globals.setting_content.gold_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 2) {
                        unit_price = Globals.setting_content.diamon_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    } else if (response.product_lists.product_categorie_id == 3) {
                        unit_price = Globals.setting_content.platinam_21_carat_price;
                        total_gold_price = response.product_lists.weight * unit_price;
                    }
                } else {

                }

                html += '<tr>';
                html += '<td>1</td>';
                html += '<td>' + response.product_lists.product_name + '</td>';
                html += '<td>' + p_carat + ' Carat</td>';
                html += '<td>' + response.product_lists.category_name + '-' + response.product_lists.product_sub_cat_name + '</td>';
                html += '<td contenteditable="true">' + response.product_lists.weight + '</td>';
                html += '<td data_product_id="' + response.product_lists.product_id + '">' + unit_price + '</td>';
                html += '<td>' + total_gold_price + '</td>';
                html += '<td><button class="btn btn-danger delete_p_row_return">Delete</button></td>';
                html += '</tr>';
                $('.product_sale_data').prepend(html);
                $('.product_barcode_return').val('');
                add_return_calculation();

            }
        })
    });

    /*add return*/


    $('.common_date_type_field').datepicker({
        dateFormat: 'yy/mm/dd'
    });

    $(document).on('click', '.add_new_maker', function(e) {
        e.preventDefault();
        alert(44);
        $('#new_maker_modal').modal('show');
        $("#maker_create")[0].reset();
        $('.user_type').val($(this).attr('user_type'));

    });

    $(document).on('click', '#new_maker_save', function() {
        var maker_name = $('#username').val();
        var phone = $('#userphone').val();
        alert(phone);
        alert(maker_name);
        if (maker_name != '' && phone != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'add_maker',
                type: 'POST',
                data: new FormData(document.getElementById("maker_create")),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#new_maker_modal').modal('hide');
                    var html = '<option value="' + response.maker_id + '">' + maker_name + '(' + phone + ')</option>';
                    $('.maker_id').prepend(html);
                    $('.maker_id').val(response.maker_id).change();
                    $("#maker_create")[0].reset();
                }
            })
        } else {
            alert('name and phone number required');
        }
    });

    $(document).on('click', '#new_maker_item_save', function() {
        var maker_id = $('.maker_id').val();
        var making_end_date = $('.making_end_date').val();
        var formdata = new FormData();
        var files =$('input[type=file]')[0].files;
    console.log(files.length);

    for(var i=0;i<files.length;i++){
        formdata.append("images[]", files[i], files[i]['name']);
    }
// console.log(formdata);return false;
        if (maker_id != '' && making_end_date != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'add_update_maker_item',
                type: 'POST',
                data: new FormData(document.getElementById("maker_item_create")),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#new_maker_item_modal').modal('hide');
                    $('.maker_item_id').val(0);
                    $("#maker_item_create")[0].reset();
                    maker_item_list();
                    Swal.fire(
                        'Good job!',
                        'You have successfully added',
                        'success'
                      );
                }
            })
        }
    });

    $(document).on('click', '.edit_products', function() {
        $('#new_product_modal').modal('show');

        var row_id = $(this).attr('row_id');
        var data_purchase_id = $(this).attr('data_purchase_id');
        var data_cat_id = $(this).attr('data_cat_id');
        var data_sub_cat_id = $(this).attr('data_sub_cat_id');
        var outlet_id = $(this).attr('outlet_id');
        var item_name = '';
        var weight = '';
        if (row_id == 0) {
            $("#product_create")[0].reset();
        } else {
            item_name = $(this).closest('tr').find('td:nth-child(2)').text();
            var data_carat_type = $(this).closest('tr').find('td:nth-child(3)').attr('data_carat_type');
            weight = $(this).closest('tr').find('td:nth-child(6)').text();
            $('#product_carat_type').val(data_carat_type).change();
        }


        $('.product_id').val(row_id);
        $('#product_name').val(item_name);
        $('#weight').val(weight);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get_all_product_cat_list',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                var product_cat_list = response.product_category.original.product_categories;
                var purchase_item_list = response.purchase_list.original.wholesale_purchase_list;
                var outlet_list = response.outlet_lists.original.outlet_list;
                var pr_cat_htm = '';
                var purchase_cat_htm = '';
                var outlet_htm = '';
                $('#wholesale_purchase_id').html('');
                $('#product_categorie_id').html('');
                $('#outlet_id').html('');

                if (purchase_item_list.length > 0) {
                    for (var i = 0; i < purchase_item_list.length; i++) {
                        purchase_cat_htm += '<option value="' + purchase_item_list[i].wholesale_purchase_id + '">' + purchase_item_list[i].item_name + '(' + purchase_item_list[i].weight + ') </option>';

                    }
                }

                if (product_cat_list.length > 0) {
                    for (var i = 0; i < product_cat_list.length; i++) {
                        pr_cat_htm += '<option value="' + product_cat_list[i].product_categorie_id + '">' + product_cat_list[i].category_name + '</option>';

                    }
                }

                if (outlet_list.length > 0) {
                    for (var i = 0; i < outlet_list.length; i++) {
                        outlet_htm += '<option value="' + outlet_list[i].outlet_id + '">' + outlet_list[i].outlet_name + '</option>';

                    }
                }
                $('#wholesale_purchase_id').html(purchase_cat_htm);
                $('#product_categorie_id').html(pr_cat_htm);
                $('#outlet_id').html(outlet_htm);
                if (row_id != 0) {
                    $('#wholesale_purchase_id').val(data_purchase_id).change();
                    $('#product_categorie_id').val(data_cat_id).change();
                    $('#outlet_id').val(outlet_id).change();
                    get_sub_cat_list_option(data_cat_id, data_sub_cat_id);
                } else {
                    var slect_op = $('#product_categorie_id option:selected').val();
                    get_sub_cat_list_option(slect_op, 0);
                }
            }
        })
    });

    $(document).on('change', '#product_categorie_id', function() {
        var cat_id = $(this).val();
        get_sub_cat_list_option(cat_id, 0);
    });

    $(document).on('click', '.delete_p_row', function() {
        $(this).closest('tr').remove();
        add_sale_calculation();
    });

    $(document).on('click', '.delete_p_row_return', function() {
        $(this).closest('tr').remove();
        add_return_calculation();
    });
    $(document).on('click', '.create_cats', function() {
        var cat_type = $(this).attr('cat_type');
        var cat_name = '';
        var row_id = 0;
        if (cat_type == 1) {
            cat_name = $('.parent_cat').val();
            row_id = $('.parent_cat').attr('row_id');
        } else {
            cat_name = $('.prodct_cat').val();
            row_id = $('.prodct_cat').attr('row_id');
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_update_purchase_product_cat',
            type: 'POST',
            data: { cat_name: cat_name, row_id: row_id, cat_type: cat_type },
            dataType: 'JSON',
            success: function(response) {
                category_list();
                $('.prodct_cat').val('');
                $('.prodct_cat').attr('row_id', 0);
                $('.parent_cat').val('');
                $('.parent_cat').attr('row_id', 0);
                Swal.fire(
                    'Good job!',
                    'You have successfully added',
                    'success'
                  );
            }
        })
        $("#outlet_create")[0].reset();
        $('#new_outlet_modal').modal('hide');
    });
    /*edit cat*/
    $(document).on('click', '.edit_cat', function() {
        var cat_type = $(this).attr('cat_type');
        var cat_name = $(this).closest('tr').find('td:nth-child(2)').text();
        var row_id = $(this).attr('row_id');;
        if (cat_type == 1) {
            $('.parent_cat').val(cat_name);
            $('.parent_cat').attr('row_id', row_id);
        } else {
            $('.prodct_cat').val(cat_name);
            $('.prodct_cat').attr('row_id', row_id);
        }
    });

    /*add sale*/
    $(document).on('click', '.add_sale_to_db', function(e) {
        e.preventDefault();
        var customer_id = $('.maker_id option:selected').val();
        var payment_type_id = $('.payment_type_id option:selected').val();
        var discount_amount = $('.discount_amount').val();
        var estimate_due_given_date = $('.estimate_due_given_date').val();
        var total_paid_amount = $('.total_paid_amount').val();
        var total_due_amount = $('.total_due_amount').text();
        var total_gold_price = $('.total_gold_price').text();
        var total_weight = $('.total_gold_price').attr('total_weight');
        var total_item = $('.total_gold_price').attr('total_item');
        var vat_tax_amount = $('.vat_tax_amount').text();
        var making_cost_amount = $('.making_cost_amount').text();
        var total_payable_amount = $('.total_payable_amount').text();
        var sale_id = $('.sale_id').val();
        var post_url = Globals.base_url + 'add_into_dbs';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: post_url,
            type: 'POST',
            data: {
                product_id_unit_price: product_id_unit_price,
                payment_type_id: payment_type_id,
                customer_id: customer_id,
                total_payable_amount: total_payable_amount,
                making_cost_amount: making_cost_amount,
                vat_tax_amount: vat_tax_amount,
                total_weight: total_weight,
                total_gold_price: total_gold_price,
                total_due_amount: total_due_amount,
                estimate_due_given_date: estimate_due_given_date,
                discount_amount: discount_amount,
                total_paid_amount: total_paid_amount,
                total_item: total_item,
                sale_status: 1,
                sale_id: sale_id,
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                //sales_list();
                Swal.fire(
                    'Good job!',
                    'You have successfully added',
                    'success'
                  );
                  window.location.href='print_sale/'+response.sale_id;
            }
        })
        $("#outlet_create")[0].reset();
        $('#new_outlet_modal').modal('hide');
    });
    /*add sale*/
    $(document).on('change', '.return_type', function(e) {
            add_return_calculation();
        })
    $(document).on('click', '.delete_maker_item', function(e) {
        var maker_item_id = $(this).attr('row-id');
        var maker_item_delete_url = Globals.base_url + 'delete_maker_item';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: maker_item_delete_url,
                    type: 'POST',
                    data: {
                        maker_item_id: maker_item_id,
                        
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        maker_item_list();
                        Swal.fire(
                            'Deleted!',
                            'Maker item has been deleted.',
                            'success'
                          )
                    }
                });
              
            }
          })
        })
        /*add return*/
    $(document).on('click', '.add_return_to_db', function(e) {
        e.preventDefault();
        var customer_id = $('.maker_id option:selected').val();
        var payment_type_id = $('.payment_type_id option:selected').val();
        var return_type = $('.return_type option:selected').val();
        var discount_amount = $('.discount_amount').val();
        var estimate_due_given_date = $('.estimate_due_given_date').val();
        var total_paid_amount = $('.total_paid_amount').val();
        var total_due_amount = $('.total_due_amount').text();
        var total_gold_price = $('.total_gold_price').text();
        var total_weight = $('.total_gold_price').attr('total_weight');
        var total_item = $('.total_gold_price').attr('total_item');
        var vat_tax_amount = $('.vat_tax_amount').text();
        var return_decrease_amount = $('.return_decrease_amount').text();
        var total_payable_amount = $('.total_payable_amount').text();
        var return_id = $('.return_id').val();
        var post_url = Globals.base_url + 'add_return_into_dbs';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: post_url,
            type: 'POST',
            data: {
                product_id_unit_price: product_id_unit_price,
                payment_type_id: payment_type_id,
                return_type: return_type,
                customer_id: customer_id,
                total_payable_amount: total_payable_amount,
                return_decrease_amount: return_decrease_amount,
                vat_tax_amount: vat_tax_amount,
                total_weight: total_weight,
                total_gold_price: total_gold_price,
                total_due_amount: total_due_amount,
                estimate_due_given_date: estimate_due_given_date,
                discount_amount: discount_amount,
                total_paid_amount: total_paid_amount,
                total_item: total_item,
                sale_status: 1,
                return_id: return_id,
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                //sales_list();
                Swal.fire(
                    'Good job!',
                    'You have successfully completed',
                    'success'
                  );
            }
        })
        $("#outlet_create")[0].reset();
        $('#new_outlet_modal').modal('hide');
    });
    /*add sale*/

}); //jquery end

function outletlist() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'outlet_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.outlet_list;
            var htmls = '';
            $('.outlet_lists_data').html('');
            var j = 1;
            if (response.length > 0) {
                for (var i = 0; i < response.length; i++) {
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i].outlet_name + '</td>';
                    htmls += '<td>' + response[i].outlet_email + '</td>';
                    htmls += '<td>' + response[i].outlet_phone + '</td>';
                    htmls += '<td>' + response[i].address + '</td>';
                    htmls += '<td>' + response[i].outlet_opentime + '</td>';
                    htmls += '<td>' + response[i].outlet_closetime + '</td>';
                    htmls += '<td>' + response[i].weekend_day + '</td>';
                    htmls += '<td><button class="btn btn-info edit_outlet" data_outlet_id="' + response[i].outlet_id + '">Edit</button><button class="btn btn-danger delete_outlet" data_outlet_id="' + response[i].outlet_id + '">Delete</button></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="8">Outlet not found</td></tr>';
            }
            $('.outlet_lists_data').html(htmls);
        }
    })
}

function maker_item_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_all_maker_item_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.maker_item_list;
            console.log(response);
            var htmls = '';
            $('.maker_item_lists_data').html('');
            var j = 1;
            if (response.length > 0) {

                for (var i = 0; i < response.length; i++) {
                    var delivery_status = (response[i].delivery_status == 1 ? 'Received' : 'Not Delivered');
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i].maker_name + '</td>';
                   
                    htmls += '<td>' + response[i].making_start_date + '</td>';
                    htmls += '<td>' + response[i].making_end_date + '</td>';
                    htmls += '<td>' + response[i].delivery_date + '</td>';
                    htmls += '<td data_delivery_status="' + response[i].delivery_status + '">' + delivery_status + '</td>';
                    htmls += '<td><button class="btn btn-info edit_maker_item" row_id="' + response[i].maker_item_id + '" maker_id="' + response[i].maker_id + '" item_id="' + response[i].wholesale_purchase_id + '">Edit</button><button class="btn btn-danger delete_maker_item" row-id="' + response[i].maker_item_id + '">Delete</button><button class="btn btn-danger print_maker_item" row-id="' + response[i].maker_item_id + '">Print preview</button></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="11">Maker Item Not Found</td></tr>';
            }
            $('.maker_item_lists_data').html(htmls);
        }
    })
}

function wholesale_purchase_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'wholesale_purchase_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.wholesale_purchase_list;
            var htmls = '';
            $('.wholesale_purchase_lists_data').html('');
            var j = 1;
            if (response.length > 0) {
                for (var i = 0; i < response.length; i++) {
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i].vendor_name + '</td>';
                    htmls += '<td>' + response[i].item_name + '</td>';
                    htmls += '<td>' + response[i].purchase_cat_name + '</td>';
                    htmls += '<td>' + response[i].weight + '</td>';
                    htmls += '<td>' + response[i].price + '</td>';
                    htmls += '<td><button data_vendor_id="' + response[i].vendor_id + '" data_admin_purchase_categeorie_id="' + response[i].admin_purchase_categeorie_id + '" class="btn btn-info edit_wholesale_purchase" row_id="' + response[i].wholesale_purchase_id + '">Edit</button><button class="btn btn-danger delete_wholesale_purchase" row_id="' + response[i].wholesale_purchase_id + '">Delete</button></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="7">Wholesale purchase not found</td></tr>';
            }
            $('.wholesale_purchase_lists_data').html(htmls);
        }
    })
}

function product_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'product_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            $('.total_product').text('');
            $('.total_product').text(response.product_count_weight.total_product);
            $('.total_wieght').text('');
            $('.total_wieght').text(response.product_count_weight.total_weight);
            var response = response.product_lists;
            console.log(response);
            
            var htmls = '';
            $('.product_lists_data').html('');
            var j = 1;
            if (response.length > 0) {
                for (var i = 0; i < response.length; i++) {
                    htmls += '<tr>';
                    htmls += '<td><input type="checkbox" class="form-controll product_id_bar_code" name="product_id[]" value="'+response[i].product_id+'"></td>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i].product_name + '</td>';
                    htmls += '<td data_carat_type="' + response[i].product_carat_type + '">' + response[i].product_carat_type + ' Carat</td>';
                    htmls += '<td>' + response[i].category_name + '</td>';
                    htmls += '<td>' + response[i].product_sub_cat_name + '</td>';
                    htmls += '<td>' + response[i].weight + '</td>';
                    htmls += '<td><img src="' + Globals.base_url + '/public/images/' + response[i].product_image + '" width="50" height="30"></td>';
                    htmls += '<td>' + response[i].outlet_name + '</td>';
                    if (Globals.outlet_id == 0) {
                        htmls += '<td><button outlet_id="' + response[i].outlet_id + '" data_purchase_id="' + response[i].wholesale_purchase_id + '" data_cat_id="' + response[i].product_categorie_id + '" data_sub_cat_id="' + response[i].product_sub_categorie_id + '" class="btn btn-info edit_products" row_id="' + response[i].product_id + '">Edit</button><button class="btn btn-danger delete_product" row_id="' + response[i].product_id + '">Delete</button></td>';
                    }
                    htmls += '</tr>';
                    j++;
                }
            } else {
                var num_cl = (Globals.outlet_id == 0 ? '9' : '8');
                htmls += '<tr><td colspan="' + num_cl + '">product not found</td></tr>';
            }
            $('.product_lists_data').html(htmls);
        }
    })
}

function get_settings() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_settings',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.settings;
            console.log(Globals.outlet_id);
            var htmls = '';
            $('.settings_lists_data').html('');
            htmls += '<tr>';
            htmls += '<td>' + response.company_name + '</td>';
            htmls += '<td>' + response.company_logo + '</td>';
            htmls += '<td>' + response.vat_tax + '</td>';
            htmls += '<td>' + response.currency + '</td>';
            htmls += '<td>' + response.gold_21_carat_price + '</td>';
            htmls += '<td>' + response.gold_22_carat_price + '</td>';
            htmls += '<td>' + response.diamond_21_carat_price + '</td>';
            htmls += '<td>' + response.diamond_22_carat_price + '</td>';
            htmls += '<td>' + response.platinam_21_carat_price + '</td>';
            htmls += '<td>' + response.platinam_22_carat_price + '</td>';
            htmls += '<td>' + response.ruturn_decrease_percent + '</td>';
            htmls += '<td>' + response.purchase_decrease_percent + '</td>';
            if (Globals.outlet_id == 0) {
                htmls += '<td><button class="btn btn-info edit_setting" row_id="' + response.setting_id + '">Edit</button></td>';
            } else {
                htmls += '<td></td>';
            }
            htmls += '</tr>';

            $('.settings_lists_data').html(htmls);
        }
    })
}

function category_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_all_cat_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var vendor_list = response.vendor_list.original.vendorlist;
            var admin_cat_list = response.admin_cat_list.original.admin_cat;
            var product_cat_list = response.product_cat_list.original.product_categories;
            var product_sub_cat_list = response.product_sub_cat_list.original.product_sub_categories;

            var htmls = '';
            var admin_cat_htm = '';
            var pr_cat_htm = '';
            var pr_sub_cat_htm = '';
            var sub_cat_option_list = '';
            $('.vendor_lists_data').html('');
            $('.admin_cat_lists_data').html('');
            $('.product_cat_lists_data').html('');
            $('.product_sub_cat_lists_data').html('');
            var j = 1;
            var ac = 1;
            var pc = 1;
            var psc = 1;
            if (vendor_list.length > 0) {
                for (var i = 0; i < vendor_list.length; i++) {
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + vendor_list[i].vendor_name + '</td>';
                    htmls += '<td>' + vendor_list[i].vendor_email + '</td>';
                    htmls += '<td>' + vendor_list[i].vendor_phone + '</td>';
                    htmls += '<td>' + vendor_list[i].vendor_address + '</td>';
                    htmls += '<td><button class="btn btn-info edit_vendor" row_id="' + vendor_list[i].vendor_id + '">Edit</button><button class="btn btn-danger delete_vendor" row_id="' + vendor_list[i].vendor_id + '">Delete</button></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="6">Vendor not found</td></tr>';
            }

            if (admin_cat_list.length > 0) {
                for (var i = 0; i < admin_cat_list.length; i++) {
                    admin_cat_htm += '<tr>';
                    admin_cat_htm += '<td>' + ac + '</td>';
                    admin_cat_htm += '<td>' + admin_cat_list[i].purchase_cat_name + '</td>';
                    admin_cat_htm += '<td><button cat_type="1" class="btn btn-info edit_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Edit</button><button cat_type="1" class="btn btn-danger delete_cat" row_id="' + admin_cat_list[i].admin_purchase_categeorie_id + '">Delete</button></td>';
                    admin_cat_htm += '</tr>';
                    ac++;
                }
            } else {
                admin_cat_htm += '<tr><td colspan="3">purchase category not found</td></tr>';
            }

            if (product_cat_list.length > 0) {
                for (var i = 0; i < product_cat_list.length; i++) {
                    sub_cat_option_list += '<option value="' + product_cat_list[i].product_categorie_id + '">' + product_cat_list[i].category_name + '</option>';
                    pr_cat_htm += '<tr>';
                    pr_cat_htm += '<td>' + pc + '</td>';
                    pr_cat_htm += '<td>' + product_cat_list[i].category_name + '</td>';
                    pr_cat_htm += '<td><button cat_type="2" class="btn btn-info edit_cat" row_id="' + product_cat_list[i].product_categorie_id + '">Edit</button><button cat_type="2" class="btn btn-danger delete_cat" row_id="' + product_cat_list[i].product_categorie_id + '">Delete</button></td>';
                    pr_cat_htm += '</tr>';
                    pc++;
                }
            } else {
                pr_cat_htm += '<tr><td colspan="3">purchase category not found</td></tr>';
            }


            if (product_sub_cat_list.length > 0) {
                for (var i = 0; i < product_sub_cat_list.length; i++) {

                    pr_sub_cat_htm += '<tr>';
                    pr_sub_cat_htm += '<td>' + psc + '</td>';
                    pr_sub_cat_htm += '<td>' + product_sub_cat_list[i].category_name + '</td>';
                    pr_sub_cat_htm += '<td>' + product_sub_cat_list[i].product_sub_cat_name + '</td>';
                    pr_sub_cat_htm += '<td><button class="btn btn-info edit_product_sub_cat" parent_cat_id="' + product_sub_cat_list[i].product_categorie_id + '" row_id="' + product_sub_cat_list[i].product_sub_categorie_id + '"><i class="material-icons">edit</i></button><button class="btn btn-danger delete_product_sub_cat" row_id="' + product_sub_cat_list[i].product_sub_categorie_id + '"><i class="material-icons">delete_forever</i></button></td>';
                    pr_sub_cat_htm += '</tr>';
                    psc++;
                }
            } else {
                pr_sub_cat_htm += '<tr><td colspan="4">purchase category not found</td></tr>';
            }

            $('.parent_cat_list').html(sub_cat_option_list);
            $('.vendor_lists_data').html(htmls);
            $('.admin_cat_lists_data').html(admin_cat_htm);
            $('.product_cat_lists_data').html(pr_cat_htm);
            $('.product_sub_cat_lists_data').html(pr_sub_cat_htm);



        }
    })
}

function get_sub_cat_list_option(id, selected_id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'product_sub_categorie_list_by_cat_id/' + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.product_sub_categories;
            var sub_cat_option_list = '';
            if (response.length > 0) {
                for (var i = 0; i < response.length; i++) {
                    sub_cat_option_list += '<option value="' + response[i].product_sub_categorie_id + '">' + response[i].product_sub_cat_name + '</option>';
                }
            }
            $('#product_sub_categorie_id').html(sub_cat_option_list);
            if (selected_id != 0) {
                $('#product_sub_categorie_id').val(selected_id).change();
            }
        }
    })
}
/*table sort by jan code*/
function sortTable_by_jan(table_bodys, jan_code, coll_num) {
    var rows = $('.' + table_bodys + ' tr').get();
    rows.sort(function(a, b) {

        var A = $(a).children('td').eq(coll_num).text();
        A = A.substr(A.length - 13);
        if (A == jan_code) {
            return -1;
        }
        return 0;

    });
    $.each(rows, function(index, row) {
        $('.' + table_bodys).append(row);
    });
}

function add_sale_calculation() {
    var total_weight = 0;
    var total_amount = 0;
    var making_cost = 0;
    var making_cost = 0;
    var vat_amount = 0;
    var total_payable_amount = 0;
    var settint_vat = parseInt(Globals.setting_content.vat_tax);
    var settint_making_cost = parseInt(Globals.setting_content.making_cos_per_gram);
    product_id_unit_price = [];
    var item_counter = 0;
    $('.product_sale_data tr').each(function() {

        var weight = $(this).find('td:nth(4)').text();
        var get_unit_gram = $(this).find('td:nth(4)').text();
        var get_unit_price = $(this).find('td:nth(5)').text();
        var get_product_id = $(this).find('td:nth(5)').attr('data_product_id');
        var total_gold_price = $(this).find('td:nth(6)').text();
        weight = parseFloat(weight);
        total_gold_price = parseFloat(total_gold_price);
        total_weight = parseFloat(total_weight);
        total_amount = parseFloat(total_amount);
        total_weight = (total_weight + weight);
        total_amount = (total_amount + total_gold_price);
        product_id_unit_price.push({ 'product_id': get_product_id, 'unit_price': get_unit_price, 'unit_gram': get_unit_gram });
        item_counter++;
    });
    var discount_amount = $('.discount_amount').val();
    var total_paid_amount = $('.total_paid_amount').val();
    discount_amount = parseFloat(discount_amount);
    total_paid_amount = parseFloat(total_paid_amount);
    making_cost = settint_making_cost * total_weight;
    vat_amount = (settint_vat * total_amount + making_cost) / 100;
    total_payable_amount = total_amount + making_cost + vat_amount - discount_amount;
    var due_amount = total_payable_amount - total_paid_amount;
    $('.total_gold_price').text(total_amount);
    $('.total_gold_price').attr('total_item', item_counter);
    $('.total_gold_price').attr('total_weight', total_weight);
    $('.vat_tax_amount').text(vat_amount);
    $('.making_cost_amount').text(making_cost);
    $('.total_payable_amount').text(total_payable_amount);
    $('.total_due_amount').text(due_amount);
    console.log(discount_amount);

}

function add_return_calculation() {
    var total_weight = 0;
    var total_amount = 0;
    var making_cost = 0;
    var making_cost = 0;
    var vat_amount = 0;
    var retrn_amount = 0;
    var total_payable_amount = 0;
    var settint_vat = 0;
    var settint_making_cost = 0;
    var return_type = $('.return_type option:selected').val();
    if (return_type == 0) {
        var return_decrease_percent = parseInt(Globals.setting_content.ruturn_decrease_percent);
    } else {
        var return_decrease_percent = parseInt(Globals.setting_content.purchase_decrease_percent);
    }
    product_id_unit_price = [];
    var item_counter = 0;
    $('.product_sale_data tr').each(function() {

        var weight = $(this).find('td:nth(4)').text();
        var get_unit_price = $(this).find('td:nth(5)').text();
        var get_unit_gram = $(this).find('td:nth(4)').text();
        var get_product_id = $(this).find('td:nth(5)').attr('data_product_id');
        var total_gold_price = $(this).find('td:nth(6)').text();
        weight = parseFloat(weight);
        total_gold_price = parseFloat(total_gold_price);
        total_weight = parseFloat(total_weight);
        total_amount = parseFloat(total_amount);
        total_weight = (total_weight + weight);
        total_amount = (total_amount + total_gold_price);
        product_id_unit_price.push({ 'product_id': get_product_id, 'unit_price': get_unit_price, 'unit_gram': get_unit_gram });
        item_counter++;
    });
    var discount_amount = $('.discount_amount').val();
    console.log(discount_amount);
    if (discount_amount == '') {
        discount_amount = 0;
    }
    console.log(discount_amount);
    var total_paid_amount = $('.total_paid_amount').val();
    discount_amount = parseFloat(discount_amount);
    total_paid_amount = parseFloat(total_paid_amount);
    making_cost = settint_making_cost * total_weight;
    vat_amount = (settint_vat * total_amount + making_cost) / 100;
    retrn_amount = (return_decrease_percent * total_amount) / 100;
    total_payable_amount = total_amount + making_cost + vat_amount + discount_amount - retrn_amount;
    var due_amount = total_payable_amount - total_paid_amount;
    $('.total_gold_price').text(total_amount);
    $('.return_decrease_amount').text(retrn_amount);
    $('.total_gold_price').attr('total_item', item_counter);
    $('.total_gold_price').attr('total_weight', total_weight);
    $('.vat_tax_amount').text(vat_amount);
    $('.making_cost_amount').text(making_cost);
    $('.total_payable_amount').text(total_payable_amount);
    $('.total_due_amount').text(due_amount);
    console.log(discount_amount);

}

function sales_item_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_all_sale_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.sale_list;
            console.log(response);
            //return false;
            var htmls = '';
            $('.sales_lists_data').html('');
            if (response.length > 0) {
                var j = 1;
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]['voucher_number']);
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i]['voucher_number'] + '</td>';
                    htmls += '<td>' + response[i]['customer_name'] + '</td>';
                    htmls += '<td>' + response[i]['customer_phone'] + '</td>';
                    htmls += '<td>' + response[i]['total_weight'] + '</td>';
                    htmls += '<td>' + response[i]['sale_amount'] + '</td>';
                    htmls += '<td>' + response[i]['discount_amount'] + '</td>';
                    htmls += '<td>' + response[i]['paid_amount'] + '</td>';
                    htmls += '<td>' + response[i]['due_amount'] + '</td>';
                    htmls += '<td>' + response[i]['sale_date'] + '</td>';
                    htmls += '<td><a href="' + Globals.base_url + '/edit_sale/' + response[i]['sale_id'] + '" class="btn btn-info edit_sales" row_id="' + response[i]['sale_id'] + '">Edit</a><a href="print_sale/' + response[i]['sale_id'] + '" class="btn btn-success print_sales" row_id="' + response[i]['sale_id'] + '">Print</a></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="12">No sales found</td></tr>';
            }
            $('.sales_lists_data').html(htmls);
        }
    })
}

function returns_item_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_all_return_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.return_list;
            console.log(response);
            //return false;
            var htmls = '';
            $('.returns_lists_data').html('');
            if (response.length > 0) {
                var j = 1;
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]['voucher_number']);
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i]['voucher_number'] + '</td>';
                    htmls += '<td>' + response[i]['customer_name'] + '</td>';
                    htmls += '<td>' + response[i]['customer_phone'] + '</td>';
                    htmls += '<td>' + response[i]['total_weight'] + '</td>';
                    htmls += '<td>' + response[i]['purchase_amount'] + '</td>';
                    htmls += '<td>' + response[i]['discount_amount'] + '</td>';
                    htmls += '<td>' + response[i]['return_decrease_amount'] + '</td>';
                    htmls += '<td>' + response[i]['paid_amount'] + '</td>';
                    htmls += '<td>' + response[i]['due_amount'] + '</td>';
                    htmls += '<td>' + response[i]['purchase_date'] + '</td>';
                    htmls += '<td><a href="' + Globals.base_url + '/edit_return/' + response[i]['return_purchase_id'] + '" class="btn btn-info edit_returns" row_id="' + response[i]['return_purchase_id'] + '">Edit</a><a href="print_sale/' + response[i]['return_purchase_id'] + '" class="btn btn-success print_returns" row_id="' + response[i]['return_purchase_id'] + '">Print</a></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="12">No returns found</td></tr>';
            }
            $('.returns_lists_data').html(htmls);
        }
    })
}

function orders_item_list() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_all_order_list',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            var response = response.order_list;
            console.log(response);
            var htmls = '';
            $('.orders_lists_data').html('');
            if (response.length > 0) {
                var j = 1;
                for (var i = 0; i < response.length; i++) {
                    console.log(response[i]['voucher_number']);
                    htmls += '<tr>';
                    htmls += '<td>' + j + '</td>';
                    htmls += '<td>' + response[i]['voucher_number'] + '</td>';
                    htmls += '<td>' + response[i]['customer_name'] + '</td>';
                    htmls += '<td>' + response[i]['customer_phone'] + '</td>';
                    htmls += '<td>' + response[i]['total_weight'] + '</td>';
                    htmls += '<td>' + response[i]['sale_amount'] + '</td>';
                    htmls += '<td>' + response[i]['discount_amount'] + '</td>';
                    htmls += '<td>' + response[i]['due_amount'] + '</td>';
                    htmls += '<td>' + response[i]['sale_date'] + '</td>';
                    htmls += '<td><button class="btn btn-info edit_sales" row_id="' + response[i]['sale_id'] + '">Edit</button><a href="print_sale/' + response[i]['sale_id'] + '" class="btn btn-success print_sales" row_id="' + response[i]['sale_id'] + '">Print</a></td>';
                    htmls += '</tr>';
                    j++;
                }
            } else {
                htmls += '<tr><td colspan="10">No Order found</td></tr>';
            }
            $('.orders_lists_data').html(htmls);
        }
    })
}

function get_urls() {
    var currentURL = window.location.href;
    var url_array = currentURL.split("/");
    var url_last_element = $(url_array).last()[0];
    return url_last_element;
}