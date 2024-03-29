// update password..check current password start
$(document).ready(function() {
    //datatable
    $('#sections').DataTable();
    //datatable
    $('#categories').DataTable();
    //check admin password
    $('#products').DataTable();
    //check admin password
    $('#banners').DataTable();
    //check admin password
    $('#filters').DataTable();



    $('#current_password').keyup(function() {
        var current_password = $('#current_password').val();
        //alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data: {
                current_password: current_password
            },
            success: function(resp) {
                //alert(resp);
                if (resp == "false") {
                    $('#check_password').html("<font color='red'>Current password is incorrect!</font>");
                } else if (resp == "true") {
                    $('#check_password').html("<font color='green'>Current password is correct!</font>");
                }
            },
            error: function(resp) {
                //alert('error ');
            }
        });
    });


    //admin status update
    $(document).on('click', '.updateAdminStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var admin_id = $(this).attr('admin_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-admin-status',
            data: { status: status, admin_id: admin_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#admin-' + admin_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#admin-' + admin_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Admin status end

    //Section status update
    $(document).on('click', '.updateSectionStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var section_id = $(this).attr('section_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#section-' + section_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#section-' + section_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Section status end


    //Brand status update
    $(document).on('click', '.updateBrandStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var brand_id = $(this).attr('brand_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#brand-' + brand_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#brand-' + brand_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Brand status end



    //Product status update
    $(document).on('click', '.updateProductStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var product_id = $(this).attr('product_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#product-' + product_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#product-' + product_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Product status end

    //Attribute status update
    $(document).on('click', '.updateProductAttributStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var attribute_id = $(this).attr('attribute_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-attribute-status',
            data: { status: status, attribute_id: attribute_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#attribute-' + attribute_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#attribute-' + attribute_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Attribute status end


    //ProductImages status update
    $(document).on('click', '.updateProductImagesStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var images_id = $(this).attr('images_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-images-status',
            data: { status: status, images_id: images_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#images-' + images_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#images-' + images_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // ProductImages status end



    //Category status update
    $(document).on('click', '.updateCategoryStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var category_id = $(this).attr('category_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#category-' + category_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#category-' + category_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // Category status end

    //banner status update
    $(document).on('click', '.updateBannerStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var banner_id = $(this).attr('banner_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: { status: status, banner_id: banner_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#banner-' + banner_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#banner-' + banner_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // banner status end

    //Filter status update
    $(document).on('click', '.updateFilterStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var filter_id = $(this).attr('filter_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-filter-status',
            data: { status: status, filter_id: filter_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#filter-' + filter_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#filter-' + filter_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // FIlter status end


    //Filter Value status update
    $(document).on('click', '.updateFilterValueStatus', function() {
        //alert(6)
        var status = $(this).children('i').attr('status');
        //alert(status);
        var filtervalue_id = $(this).attr('filtervalue_id');
        //alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-filter-value-status',
            data: { status: status, filtervalue_id: filtervalue_id },
            success: function(resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#filtervalue-' + filtervalue_id).html("<i class='fa fa-toggle-off fa-lg' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    // $('#admin-' + admin_id).html("<i class='la la-bookmark' status='Inactive'></i>");
                    $('#filtervalue-' + filtervalue_id).html("<i class='fa fa-toggle-on fa-lg' status='Active'></i>");
                }
            },
            error: function() {
                alert(error);
            }
        });
    });
    // FIlter Value status end


    //simple confrim delete
    // $('.confirmDelete').click(function() {
    //     var title = $(this).attr('title');
    //     if (confirm('Are you sure deleted ' + title + '?')) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // });
    //simple confirm delete end

    //sweetalert2 confrim delete
    $('.confirmDelete').click(function() {
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        //alert(moduleid);
        //return false;
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
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location = '/admin/delete-' + module + '/' + moduleid;
            }
        })
    });
    //sweetalert2 confirm delete end


    //append categories level
    $('#section_id').change(function() {
        var section_id = $(this).val();
        //alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/append-categories-level',
            data: { section_id: section_id },
            success: function(resp) {
                $('#appendCategoriesLevel').html(resp);
            },
            error: function() {
                alert('Error');
            }

        })
    });
    //append categories level

    //attribute add and edit start
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" required style="width: 200px;"/> &nbsp;<input type="text" name="sku[]" placeholder="Sku" required style="width: 200px;"/> &nbsp;<input type="text" name="price[]" placeholder="Price" required style="width: 200px;"/> &nbsp;<input type="text" name="stock[]" placeholder="Stock" required style="width: 200px;"/> &nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    //atribute add and edit end

});
// update password..check current password end