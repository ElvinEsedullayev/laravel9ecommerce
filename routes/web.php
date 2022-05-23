<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::redirect('/','admin/login');
    ############### Admin Login ##############
    Route::match(['get','post'],'login','AdminController@login')->name('admin.login');

    ############# Admin Home #############
    Route::group(['middleware' => 'admin'],function(){
        Route::get('homepage','AdminController@index')->name('admin.home');

        ############# Admin Password Update ############
        Route::match(['get','post'],'password-update','AdminController@updatePassword')->name('admin.password');

        ############# Check Admin Password ############
        Route::post('check-current-password','AdminController@checkPassword');

        ############# Admin Details Update ############
        Route::match(['get','post'],'details-update','AdminController@updateDetail');

        ############# Admin Vendor Details Update ############
        Route::match(['get','post'],'vendor-details-update/{slug}','AdminController@updateVendor');

        ############# Admin / Subadmins / Vendors ############
        Route::get('admins/{type?}','AdminController@admin');

        ############# View Vendor Details ############
        Route::get('view-vendor-details/{id}','AdminController@viewVendorDetail');

        ############# Update admin status ############
        Route::post('update-admin-status','AdminController@updateAdminStatus');

        ########### Section Management #############endregion
        Route::get('section','SectionController@section');
        ############# Update section status ############
        Route::post('update-section-status','SectionController@updateSectionStatus');
        //############## Section Delete (sweetalert2)################
        Route::get('delete-section/{id}','SectionController@deleteSection');
        ############# Section add edit page #############
        Route::match(['get', 'post'], 'section-add-edit/{id?}', 'SectionController@addEditSection');

        ########### Brand Management #############endregion
        Route::get('brands','BrandController@brand');
        ############# Update Brand status ############
        Route::post('update-brand-status','BrandController@updateBrandStatus');
        //############## Brand Delete (sweetalert2)################
        Route::get('delete-brand/{id}','BrandController@deleteBrand');
        ############# Brand add edit page #############
        Route::match(['get', 'post'], 'brand-add-edit/{id?}', 'BrandController@addEditBrand');


        ###########  Category  #############endregion
        Route::get('categories','CategoryController@category');
        ############# Update Category status ############
        Route::post('update-category-status','CategoryController@updateCategoryStatus');
        ############# Category add edit page #############
        Route::match(['get', 'post'], 'category-add-edit/{id?}', 'CategoryController@addEditCategory');
        ########## Append Category level #############
        Route::get('append-categories-level','CategoryController@appendCategoriesLevel');
        //############## Category Delete (sweetalert2)################
        Route::get('delete-category/{id}','CategoryController@deleteCategory');
        //############## Category Image Delete (sweetalert2)################
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');

        ##########  Product  #############endregion
        Route::get('products','ProductController@product');
        ############# Update product status ############
        Route::post('update-product-status','ProductController@updateProductStatus');
        //############## product Delete (sweetalert2)################
        Route::get('delete-product/{id}','ProductController@deleteProduct');

        ############ Admin Logout ##########
        Route::get('logout','AdminController@logout')->name('admin.logout');
    });
    
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
