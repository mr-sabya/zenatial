<?php 
Route::prefix('admin')->group(function() {
  // Admin Dashboard & Profile
  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Admin\LoginController@login')->name('admin.login.submit');
  Route::get('/forgot', 'Admin\LoginController@showForgotForm')->name('admin.forgot');
  Route::post('/forgot', 'Admin\LoginController@forgot')->name('admin.forgot.submit');
  Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::get('/profile', 'Admin\DashboardController@profile')->name('admin.profile');
  Route::post('/profile/update', 'Admin\DashboardController@profileupdate')->name('admin.profile.update');
  Route::get('/password', 'Admin\DashboardController@passwordreset')->name('admin.password');
  Route::post('/password/update', 'Admin\DashboardController@changepass')->name('admin.password.update');

  Route::group(['middleware'=>'permissions:orders'],function(){
    Route::get('/orders/{status?}', 'Admin\OrderController@index')->name('admin-order-index');
    Route::get('/order/edit/{id}', 'Admin\OrderController@edit')->name('admin-order-edit');
    Route::post('/order/update/{id}', 'Admin\OrderController@update')->name('admin-order-update');
    Route::get('/order/{id}/show', 'Admin\OrderController@show')->name('admin-order-show');
    Route::get('/order/{id}/invoice', 'Admin\OrderController@invoice')->name('admin-order-invoice');
    Route::get('/order/{id}/print', 'Admin\OrderController@printpage')->name('admin-order-print');

      // Order Tracking

    Route::get('/order/{id}/track', 'Admin\OrderTrackController@show')->name('admin-order-track');
    Route::get('/order/{id}/all-track', 'Admin\OrderTrackController@index')->name('admin-order-track');
    Route::get('/order/{id}/trackload', 'Admin\OrderTrackController@load')->name('admin-order-track-load');
    Route::post('/order/track/store', 'Admin\OrderTrackController@store')->name('admin-order-track-store');
    Route::get('/order/track/add', 'Admin\OrderTrackController@add')->name('admin-order-track-add');
    Route::get('/order/track/edit/{id}', 'Admin\OrderTrackController@edit')->name('admin-order-track-edit');
    Route::post('/order/track/update/{id}', 'Admin\OrderTrackController@update')->name('admin-order-track-update');
    Route::get('/order/track/delete/{id}', 'Admin\OrderTrackController@delete')->name('admin-order-track-delete');

  });
  Route::group(['middleware'=>'permissions:products'],function(){
    Route::get('/products', 'Admin\ProductController@index')->name('admin-prod-index');
    Route::get('/products/deactive', 'Admin\ProductController@deactive')->name('admin-prod-deactive');
    Route::get('/products/catalogs/', 'Admin\ProductController@catalogs')->name('admin-prod-catalog-index');

    Route::get('/products/create', 'Admin\ProductController@createProduct')->name('admin-prod-create');
    Route::post('/products/store', 'Admin\ProductController@store')->name('admin-prod-store');
    Route::get('/getattributes', 'Admin\ProductController@getAttributes')->name('admin-prod-getattributes');

    // Product Status
    Route::get('/products/status/{id1}/{id2}', 'Admin\ProductController@status')->name('admin-prod-status');
    Route::get('/products/delete/{id}', 'Admin\ProductController@destroy')->name('admin-prod-delete');

    // Product Edit
    Route::get('/products/edit/{id}', 'Admin\ProductController@edit')->name('admin-prod-edit');
    Route::post('/products/edit/{id}', 'Admin\ProductController@update')->name('admin-prod-update');
  });

  Route::group(['middleware'=>'permissions:customers'],function(){
    Route::get('/users', 'Admin\UserController@index')->name('admin-user-index');
    Route::get('/user/{id}/show', 'Admin\UserController@show')->name('admin-user-show');
  });

  Route::group(['middleware'=>'permissions:vendors'],function(){
    Route::get('/vendors', 'Admin\VendorController@index')->name('admin-vendor-index');
    Route::get('/vendors/withdraws', 'Admin\VendorController@withdraws')->name('admin-vendor-withdraw-index');

    Route::get('/vendors/{id}/show', 'Admin\VendorController@show')->name('admin-vendor-show');
    Route::get('/vendor/edit/{id}', 'Admin\VendorController@edit')->name('admin-vendor-edit');
    Route::post('/vendor/edit/{id}', 'Admin\VendorController@update')->name('admin-vendor-update');    

    // Vendor Verification
    Route::get('/verifications/{status?}', 'Admin\VerificationController@index')->name('admin-vr-index');
    Route::get('/verifications/status/{id1}/{id2}', 'Admin\VerificationController@status')->name('admin-vr-st');
    Route::get('/verifications/delete/{id}', 'Admin\VerificationController@destroy')->name('admin-vr-delete');

    Route::get('/vendors/delete/{id}', 'Admin\VendorController@destroy')->name('admin-vendor-delete');

    // Vendor Withdraw
    Route::get('/vendors/withdraw/{id}/show', 'Admin\VendorController@withdrawdetails')->name('admin-vendor-withdraw-show');
    Route::get('/vendors/withdraws/accept/{id}', 'Admin\VendorController@accept')->name('admin-vendor-withdraw-accept');
    Route::get('/vendors/withdraws/reject/{id}', 'Admin\VendorController@reject')->name('admin-vendor-withdraw-reject');
  });

  Route::group(['middleware'=>'permissions:categories'],function(){

    Route::get('/category/datatables', 'Admin\CategoryController@datatables')->name('admin-cat-datatables'); //JSON REQUEST
    Route::get('/category', 'Admin\CategoryController@index')->name('admin-cat-index');
    Route::get('/category/create', 'Admin\CategoryController@create')->name('admin-cat-create');
    Route::post('/category/create', 'Admin\CategoryController@store')->name('admin-cat-store');
    Route::get('/category/edit/{id}', 'Admin\CategoryController@edit')->name('admin-cat-edit');
    Route::post('/category/edit/{id}', 'Admin\CategoryController@update')->name('admin-cat-update');
    Route::get('/category/delete/{id}', 'Admin\CategoryController@destroy')->name('admin-cat-delete');
    Route::get('/category/status/{id1}/{id2}', 'Admin\CategoryController@status')->name('admin-cat-status');
  
  
    //------------ ADMIN ATTRIBUTE SECTION ------------
  
    Route::get('/attribute/datatables', 'Admin\AttributeController@datatables')->name('admin-attr-datatables'); //JSON REQUEST
    Route::get('/attribute', 'Admin\AttributeController@index')->name('admin-attr-index');
    Route::get('/attribute/{catid}/attrCreateForCategory', 'Admin\AttributeController@attrCreateForCategory')->name('admin-attr-createForCategory');
    Route::get('/attribute/{subcatid}/attrCreateForSubcategory', 'Admin\AttributeController@attrCreateForSubcategory')->name('admin-attr-createForSubcategory');
    Route::get('/attribute/{childcatid}/attrCreateForChildcategory', 'Admin\AttributeController@attrCreateForChildcategory')->name('admin-attr-createForChildcategory');
    Route::post('/attribute/store', 'Admin\AttributeController@store')->name('admin-attr-store');
    Route::get('/attribute/{id}/manage', 'Admin\AttributeController@manage')->name('admin-attr-manage');
    Route::get('/attribute/{attrid}/edit', 'Admin\AttributeController@edit')->name('admin-attr-edit');
    Route::post('/attribute/edit/{id}', 'Admin\AttributeController@update')->name('admin-attr-update');
    Route::get('/attribute/{id}/options', 'Admin\AttributeController@options')->name('admin-attr-options');
    Route::get('/attribute/delete/{id}', 'Admin\AttributeController@destroy')->name('admin-attr-delete');
  
  
    // SUBCATEGORY SECTION ------------
  
    Route::get('/subcategory/datatables', 'Admin\SubCategoryController@datatables')->name('admin-subcat-datatables'); //JSON REQUEST
    Route::get('/subcategory', 'Admin\SubCategoryController@index')->name('admin-subcat-index');
    Route::get('/subcategory/create', 'Admin\SubCategoryController@create')->name('admin-subcat-create');
    Route::post('/subcategory/create', 'Admin\SubCategoryController@store')->name('admin-subcat-store');
    Route::get('/subcategory/edit/{id}', 'Admin\SubCategoryController@edit')->name('admin-subcat-edit');
    Route::post('/subcategory/edit/{id}', 'Admin\SubCategoryController@update')->name('admin-subcat-update');
    Route::get('/subcategory/delete/{id}', 'Admin\SubCategoryController@destroy')->name('admin-subcat-delete');
    Route::get('/subcategory/status/{id1}/{id2}', 'Admin\SubCategoryController@status')->name('admin-subcat-status');
    Route::get('/load/subcategories/{id}/', 'Admin\SubCategoryController@load')->name('admin-subcat-load'); //JSON REQUEST
  
    // SUBCATEGORY SECTION ENDS------------
  
    // CHILDCATEGORY SECTION ------------
  
    Route::get('/childcategory/datatables', 'Admin\ChildCategoryController@datatables')->name('admin-childcat-datatables'); //JSON REQUEST
    Route::get('/childcategory', 'Admin\ChildCategoryController@index')->name('admin-childcat-index');
    Route::get('/childcategory/create', 'Admin\ChildCategoryController@create')->name('admin-childcat-create');
    Route::post('/childcategory/create', 'Admin\ChildCategoryController@store')->name('admin-childcat-store');
    Route::get('/childcategory/edit/{id}', 'Admin\ChildCategoryController@edit')->name('admin-childcat-edit');
    Route::post('/childcategory/edit/{id}', 'Admin\ChildCategoryController@update')->name('admin-childcat-update');
    Route::get('/childcategory/delete/{id}', 'Admin\ChildCategoryController@destroy')->name('admin-childcat-delete');
    Route::get('/childcategory/status/{id1}/{id2}', 'Admin\ChildCategoryController@status')->name('admin-childcat-status');
    Route::get('/load/childcategories/{id}/', 'Admin\ChildCategoryController@load')->name('admin-childcat-load'); //JSON REQUEST
  
    // CHILDCATEGORY SECTION ENDS------------
  });

  Route::group(['middleware'=>'permissions:product_discussion'],function(){
    // Product Ratings
    Route::get('/ratings', 'Admin\RatingController@index')->name('admin-rating-index');
    Route::get('/ratings/delete/{id}', 'Admin\RatingController@destroy')->name('admin-rating-delete');
    Route::get('/ratings/show/{id}', 'Admin\RatingController@show')->name('admin-rating-show');

    // Product Comments
    Route::get('/comments', 'Admin\CommentController@index')->name('admin-comment-index');
    Route::get('/comments/delete/{id}', 'Admin\CommentController@destroy')->name('admin-comment-delete');
    Route::get('/comments/show/{id}', 'Admin\CommentController@show')->name('admin-comment-show');

    // Product Reports
    Route::get('/reports', 'Admin\ReportController@index')->name('admin-report-index');
    Route::get('/reports/delete/{id}', 'Admin\ReportController@destroy')->name('admin-report-delete');
    Route::get('/reports/show/{id}', 'Admin\ReportController@show')->name('admin-report-show');
  });

  //------------ ADMIN COUPON SECTION ------------

  Route::group(['middleware'=>'permissions:set_coupons'],function(){

    Route::get('/coupon/datatables', 'Admin\CouponController@datatables')->name('admin-coupon-datatables'); //JSON REQUEST
    Route::get('/coupon', 'Admin\CouponController@index')->name('admin-coupon-index');
    Route::get('/coupon/create', 'Admin\CouponController@create')->name('admin-coupon-create');
    Route::post('/coupon/create', 'Admin\CouponController@store')->name('admin-coupon-store');
    Route::get('/coupon/edit/{id}', 'Admin\CouponController@edit')->name('admin-coupon-edit');
    Route::post('/coupon/edit/{id}', 'Admin\CouponController@update')->name('admin-coupon-update');
    Route::get('/coupon/delete/{id}', 'Admin\CouponController@destroy')->name('admin-coupon-delete');
    Route::get('/coupon/status/{id1}/{id2}', 'Admin\CouponController@status')->name('admin-coupon-status');
  
    });
  
    //------------ ADMIN COUPON SECTION ENDS------------

  Route::group(['middleware'=>'permissions:messages'],function(){
    Route::get('/tickets', 'Admin\MessageController@index')->name('admin-message-index');
    Route::get('/disputes', 'Admin\MessageController@disputes')->name('admin-message-dispute');
    Route::get('/message/{id}', 'Admin\MessageController@message')->name('admin-message-show');
    Route::get('/message/load/{id}', 'Admin\MessageController@messageshow')->name('admin-message-load');
    Route::post('/message/post', 'Admin\MessageController@postmessage')->name('admin-message-store');
    Route::get('/message/{id}/delete', 'Admin\MessageController@messagedelete')->name('admin-message-delete');
    Route::post('/user/send/message', 'Admin\MessageController@usercontact')->name('admin-send-message');  
  });

  Route::group(['middleware'=>'permissions:general_settings'],function(){
    Route::get('/general-settings/logo', 'Admin\GeneralSettingController@logo')->name('admin-gs-logo');
    Route::get('/general-settings/favicon', 'Admin\GeneralSettingController@fav')->name('admin-gs-fav');
    Route::get('/general-settings/loader', 'Admin\GeneralSettingController@load')->name('admin-gs-load');
    // ------------ GLOBAL ----------------------
  Route::post('/general-settings/update/all', 'Admin\GeneralSettingController@generalupdate')->name('admin-gs-update');
  Route::get('/general-settings/stock/{status}', 'Admin\GeneralSettingController@stock')->name('admin-gs-stock');

  //------------ ADMIN SHIPPING ------------

  Route::get('/shipping/datatables', 'Admin\ShippingController@datatables')->name('admin-shipping-datatables');
  Route::get('/shipping', 'Admin\ShippingController@index')->name('admin-shipping-index');
  Route::get('/shipping/create', 'Admin\ShippingController@create')->name('admin-shipping-create');
  Route::post('/shipping/create', 'Admin\ShippingController@store')->name('admin-shipping-store');
  Route::get('/shipping/edit/{id}', 'Admin\ShippingController@edit')->name('admin-shipping-edit');
  Route::post('/shipping/edit/{id}', 'Admin\ShippingController@update')->name('admin-shipping-update');
  Route::get('/shipping/delete/{id}', 'Admin\ShippingController@destroy')->name('admin-shipping-delete');

  //------------ ADMIN SHIPPING ENDS ------------

    Route::get('/general-settings/contents', 'Admin\GeneralSettingController@contents')->name('admin-gs-contents');
    Route::get('/general-settings/top-header', 'Admin\GeneralSettingController@topHeader')->name('admin-gs-top-header');
    Route::get('/general-settings/footer', 'Admin\GeneralSettingController@footer')->name('admin-gs-footer');
    Route::get('/general-settings/popup', 'Admin\GeneralSettingController@popup')->name('admin-gs-popup');
    Route::get('/general-settings/seo', 'Admin\GeneralSettingController@seo')->name('admin-gs-seo');
    Route::get('/general-settings/social', 'Admin\GeneralSettingController@social')->name('admin-gs-social');
  });

  //------------ ADMIN HOME PAGE SETTINGS SECTION ------------

  Route::group(['middleware'=>'permissions:home_page_settings'],function(){
    //------------ ADMIN PAGE SETTINGS SECTION ------------
  
    Route::get('/page-settings/customize', 'Admin\PageSettingController@customize')->name('admin-ps-customize');
    Route::get('/page-settings/big-save', 'Admin\PageSettingController@big_save')->name('admin-ps-big-save');
    Route::get('/page-settings/best-seller', 'Admin\PageSettingController@best_seller')->name('admin-ps-best-seller');
  
    //------------ ADMIN BANNER SECTION ------------
    Route::get('/homepage/{type}', 'Admin\BannerController@index')->name('admin-banner');
    Route::get('/banner/create/{type}', 'Admin\BannerController@create')->name('admin-banner-create');
    Route::post('/banner/store', 'Admin\BannerController@store')->name('admin-banner-store');
    Route::get('/banner/edit/{id}', 'Admin\BannerController@edit')->name('admin-banner-edit');
    Route::post('/banner/edit/{id}', 'Admin\BannerController@update')->name('admin-banner-update');
    Route::get('/banner/delete/{id}', 'Admin\BannerController@destroy')->name('admin-banner-delete');
    //------------ ADMIN BANNER SECTION ENDS ------------
  
  });
  //------------ ADMIN HOME PAGE SETTINGS SECTION ENDS ------------

  //------------ ADMIN BLOG SECTION ------------

  Route::group(['middleware'=>'permissions:blog'],function(){

    Route::get('/blog/datatables', 'Admin\BlogController@datatables')->name('admin-blog-datatables'); //JSON REQUEST
    Route::get('/blog', 'Admin\BlogController@index')->name('admin-blog-index');
    Route::get('/blog/create', 'Admin\BlogController@create')->name('admin-blog-create');
    Route::post('/blog/create', 'Admin\BlogController@store')->name('admin-blog-store');
    Route::get('/blog/edit/{id}', 'Admin\BlogController@edit')->name('admin-blog-edit');
    Route::post('/blog/edit/{id}', 'Admin\BlogController@update')->name('admin-blog-update');
    Route::get('/blog/delete/{id}', 'Admin\BlogController@destroy')->name('admin-blog-delete');
  
    Route::get('/blog/category/datatables', 'Admin\BlogCategoryController@datatables')->name('admin-cblog-datatables'); //JSON REQUEST
    Route::get('/blog/category', 'Admin\BlogCategoryController@index')->name('admin-cblog-index');
    Route::get('/blog/category/create', 'Admin\BlogCategoryController@create')->name('admin-cblog-create');
    Route::post('/blog/category/create', 'Admin\BlogCategoryController@store')->name('admin-cblog-store');
    Route::get('/blog/category/edit/{id}', 'Admin\BlogCategoryController@edit')->name('admin-cblog-edit');
    Route::post('/blog/category/edit/{id}', 'Admin\BlogCategoryController@update')->name('admin-cblog-update');
    Route::get('/blog/category/delete/{id}', 'Admin\BlogCategoryController@destroy')->name('admin-cblog-delete');
  
  });

  //------------ ADMIN SUBSCRIBERS SECTION ------------

  Route::group(['middleware'=>'permissions:subscribers'],function(){
    Route::get('/subscribers', 'Admin\SubscriberController@index')->name('admin-subs-index');
    Route::get('/subscribers/download', 'Admin\SubscriberController@download')->name('admin-subs-download');
  });
  
    //------------ ADMIN SUBSCRIBERS ENDS ------------  
  
  //------------ ADMIN BLOG SECTION ENDS ------------  

  Route::group(['middleware'=>'permissions:menu_page_settings'],function(){

    //------------ ADMIN MENU PAGE SETTINGS SECTION ------------

  //------------ ADMIN PAGE SECTION ------------

  Route::get('/page', 'Admin\PageController@index')->name('admin-page-index');
  Route::get('/page/create', 'Admin\PageController@create')->name('admin-page-create');
  Route::post('/page/create', 'Admin\PageController@store')->name('admin-page-store');
  Route::get('/page/edit/{id}', 'Admin\PageController@edit')->name('admin-page-edit');
  Route::post('/page/update/{id}', 'Admin\PageController@update')->name('admin-page-update');
  Route::get('/page/delete/{id}', 'Admin\PageController@destroy')->name('admin-page-delete');
  Route::get('/page/header/{id1}/{id2}', 'Admin\PageController@header')->name('admin-page-header');
  Route::get('/page/footer/{id1}/{id2}', 'Admin\PageController@footer')->name('admin-page-footer');

  //------------ ADMIN PAGE SECTION ENDS------------    
  
    //------------ ADMIN FAQ SECTION ------------
  
    Route::get('/faq', 'Admin\FaqController@index')->name('admin-faq-index');
    Route::get('/faq/create', 'Admin\FaqController@create')->name('admin-faq-create');
    Route::post('/faq/create', 'Admin\FaqController@store')->name('admin-faq-store');
    Route::get('/faq/edit/{id}', 'Admin\FaqController@edit')->name('admin-faq-edit');
    Route::post('/faq/update/{id}', 'Admin\FaqController@update')->name('admin-faq-update');
    Route::get('/faq/delete/{id}', 'Admin\FaqController@destroy')->name('admin-faq-delete');
    
    // FAQ Category
    Route::get('/faqcat', 'Admin\FaqController@catIndex')->name('admin-faqcat-index');
    Route::get('/faqcat/create', 'Admin\FaqController@catCreate')->name('admin-faqcat-create');
    Route::post('/faqcat/create', 'Admin\FaqController@catStore')->name('admin-faqcat-store');
    Route::get('/faqcat/edit/{id}', 'Admin\FaqController@catEdit')->name('admin-faqcat-edit');
    Route::post('/faqcat/update/{id}', 'Admin\FaqController@catUpdate')->name('admin-faqcat-update');
    Route::get('/faqcat/delete/{id}', 'Admin\FaqController@catDestroy')->name('admin-faqcat-delete');
  
    //------------ ADMIN FAQ SECTION ENDS ------------  
  
    Route::get('/general-settings/contact/{status}', 'Admin\GeneralSettingController@iscontact')->name('admin-gs-iscontact');
    Route::get('/general-settings/faq/{status}', 'Admin\GeneralSettingController@isfaq')->name('admin-gs-isfaq');
    Route::get('/page-settings/contact', 'Admin\PageSettingController@contact')->name('admin-ps-contact');
    Route::post('/page-settings/update/all', 'Admin\PageSettingController@update')->name('admin-ps-update'); 
  
  });

  //------------ ADMIN STAFF SECTION ------------

  Route::group(['middleware'=>'permissions:manage_staffs'],function(){

    Route::get('/staff/datatables', 'Admin\StaffController@datatables')->name('admin-staff-datatables');
    Route::get('/staff', 'Admin\StaffController@index')->name('admin-staff-index');
    Route::get('/staff/create', 'Admin\StaffController@create')->name('admin-staff-create');
    Route::post('/staff/create', 'Admin\StaffController@store')->name('admin-staff-store');
    Route::get('/staff/edit/{id}', 'Admin\StaffController@edit')->name('admin-staff-edit');
    Route::post('/staff/update/{id}', 'Admin\StaffController@update')->name('admin-staff-update');
    Route::get('/staff/show/{id}', 'Admin\StaffController@show')->name('admin-staff-show');
    Route::get('/staff/delete/{id}', 'Admin\StaffController@destroy')->name('admin-staff-delete');
  
  });
  
    //------------ ADMIN STAFF SECTION ENDS------------     
  Route::group(['middleware'=>'permissions:super'],function(){
    // ------------ ROLE SECTION ----------------------

    Route::get('/role', 'Admin\RoleController@index')->name('admin-role-index');
    Route::get('/role/create', 'Admin\RoleController@create')->name('admin-role-create');
    Route::post('/role/create', 'Admin\RoleController@store')->name('admin-role-store');
    Route::get('/role/edit/{id}', 'Admin\RoleController@edit')->name('admin-role-edit');
    Route::post('/role/edit/{id}', 'Admin\RoleController@update')->name('admin-role-update');
    Route::get('/role/delete/{id}', 'Admin\RoleController@destroy')->name('admin-role-delete');

    // ------------ ROLE SECTION ENDS ----------------------
  });
});
Route::prefix('user')->group(function() {
  // User Dashboard
  Route::get('/dashboard', 'User\UserController@index')->name('user-dashboard');
  Route::get('/orders', 'User\UserController@orders')->name('user-orders');
  // User Login
  Route::get('/login', 'User\LoginController@showLoginForm')->name('user.login');
  Route::post('/login', 'User\LoginController@login')->name('user.login.submit');

  // User Register
  Route::get('/register', 'User\RegisterController@showRegisterForm')->name('user-register');
  Route::post('/register', 'User\RegisterController@register')->name('user-register-submit');
  Route::get('/register/verify/{token}', 'User\RegisterController@token')->name('user-register-token');

  // User Profile
  Route::get('/profile', 'User\UserController@profile')->name('user-profile');
  Route::post('/profile', 'User\UserController@profileupdate')->name('user-profile-update');
  // User Profile Ends  

  // User Forgot
  Route::get('/forgot', 'User\ForgotController@showforgotform')->name('user-forgot');
  Route::post('/forgot', 'User\ForgotController@forgot')->name('user-forgot-submit');
  
  // User Wishlist
  Route::get('/wishlists','User\WishlistController@wishlists')->name('user-wishlists');
  Route::get('/wishlist/add/{id}','User\WishlistController@addwish')->name('user-wishlist-add');
  Route::get('/wishlist/remove/{id}','User\WishlistController@removewish')->name('user-wishlist-remove');

  // User Order Tracking
  Route::get('/order/tracking', 'User\OrderController@ordertrack')->name('user-order-track');
  Route::get('/order/trackings/{id}', 'User\OrderController@trackload')->name('user-order-track-search');  
  Route::get('/order/{id}', 'User\OrderController@order')->name('user-order');

  // User Reset
  Route::get('/reset', 'User\UserController@resetform')->name('user-reset');
  Route::post('/reset', 'User\UserController@reset')->name('user-reset-submit');
  // User Reset End
  
  // User Logout
  Route::get('/logout', 'User\LoginController@logout')->name('user-logout');
  // User Logout Ends  
});
// ************************************ VENDOR SECTION **********************************************


Route::prefix('vendor')->group(function() {


  Route::group(['middleware'=>'vendor'],function(){
    // Vendor Dashboard
    Route::get('/dashboard', 'Vendor\VendorController@index')->name('vendor-dashboard');
    
    //------------ VENDOR ORDER SECTION ------------
    Route::get('/orders', 'Vendor\OrderController@index')->name('vendor-order-index');
    Route::get('/order/{id}/show', 'Vendor\OrderController@show')->name('vendor-order-show');
    Route::get('/order/{id}/invoice', 'Vendor\OrderController@invoice')->name('vendor-order-invoice');
    Route::get('/order/{id}/print', 'Vendor\OrderController@printpage')->name('vendor-order-print');
    Route::get('/order/{id1}/status/{status}', 'Vendor\OrderController@status')->name('vendor-order-status');
    Route::post('/order/email/', 'Vendor\OrderController@emailsub')->name('vendor-order-emailsub');
    Route::post('/order/{slug}/license', 'Vendor\OrderController@license')->name('vendor-order-license');
    //------------ VENDOR CATEGORY SECTION ENDS------------

    //------------ VENDOR PRODUCT SECTION ------------

    Route::get('/products/datatables', 'Vendor\ProductController@datatables')->name('vendor-prod-datatables'); //JSON REQUEST
    Route::get('/products', 'Vendor\ProductController@index')->name('vendor-prod-index');

    Route::post('/products/upload/update/{id}', 'Vendor\ProductController@uploadUpdate')->name('vendor-prod-upload-update');

    // CREATE SECTION
    Route::get('/products/types', 'Vendor\ProductController@types')->name('vendor-prod-types');
    Route::get('/products/create', 'Vendor\ProductController@createProduct')->name('vendor-prod-create');
    Route::post('/products/store', 'Vendor\ProductController@store')->name('vendor-prod-store');
    Route::get('/getattributes', 'Vendor\ProductController@getAttributes')->name('vendor-prod-getattributes');

    Route::get('/products/catalog/datatables', 'Vendor\ProductController@catalogdatatables')->name('admin-vendor-catalog-datatables');
    Route::get('/products/catalogs', 'Vendor\ProductController@catalogs')->name('admin-vendor-catalog-index');

    // CREATE SECTION

    // EDIT SECTION
    Route::get('/products/edit/{id}', 'Vendor\ProductController@edit')->name('vendor-prod-edit');
    Route::post('/products/edit/{id}', 'Vendor\ProductController@update')->name('vendor-prod-update');

    Route::get('/products/catalog/{id}', 'Vendor\ProductController@catalogedit')->name('vendor-prod-catalog-edit');
    Route::post('/products/catalog/{id}', 'Vendor\ProductController@catalogupdate')->name('vendor-prod-catalog-update');

    // EDIT SECTION ENDS

    // STATUS SECTION
    Route::get('/products/status/{id1}/{id2}', 'Vendor\ProductController@status')->name('vendor-prod-status');
    // STATUS SECTION ENDS

    // DELETE SECTION
    Route::get('/products/delete/{id}', 'Vendor\ProductController@destroy')->name('vendor-prod-delete');
    // DELETE SECTION ENDS

    //------------ VENDOR PRODUCT SECTION ENDS------------

    //------------ VENDOR WITHDRAW SECTION START ------------
    Route::get('/withdraw', 'Vendor\WithdrawController@index')->name('vendor-wt-index');
    Route::get('/withdraw/create', 'Vendor\WithdrawController@create')->name('vendor-wt-create');
    Route::post('/withdraw/create', 'Vendor\WithdrawController@store')->name('vendor-wt-store');
    //------------ VENDOR WITHDRAW SECTION END ------------
    });
});
// ************************************ VENDOR SECTION ENDS *****************************************

  // Frontend
  Route::get('/', 'Front\FrontendController@index')->name('front.index');
  Route::get('/extras', 'Front\FrontendController@extraIndex')->name('front.extraIndex');
  Route::get('/currency/{id}', 'Front\FrontendController@currency')->name('front.currency');
  Route::get('/products/{type}', 'Front\FrontendController@products')->name('front.products');
  // CART SECTION
  Route::get('/carts/view','Front\CartController@cartview');
  Route::get('/carts/','Front\CartController@cart')->name('front.cart');
  Route::get('/addtocart/{product_id}','Front\CartController@addToCart')->name('product.cart.add');
  Route::get('/addnumcart','Front\CartController@addnumcart')->name('product.addnumcart');
  Route::get('/addtonumcart','Front\CartController@addtonumcart');
  Route::get('/addbyone','Front\CartController@addbyone');
  Route::get('/reducebyone','Front\CartController@reducebyone');
  Route::get('/upcolor','Front\CartController@upcolor');
  Route::get('/removecart/{id}','Front\CartController@removecart')->name('product.cart.remove');
  Route::get('/carts/coupon','Front\CartController@coupon');
  Route::get('/carts/coupon/check','Front\CartController@couponcheck');

  // CHECKOUT SECTION
  Route::get('/checkout/','Front\CheckoutController@checkout')->name('front.checkout');
  Route::get('/checkout/payment/{slug1}/{slug2}','Front\CheckoutController@loadpayment')->name('front.load.payment');
  Route::get('/order/track/{id}','Front\FrontendController@trackload')->name('front.track.search');
  Route::get('/checkout/payment/return', 'Front\PaymentController@payreturn')->name('payment.return');
  Route::get('/checkout/payment/cancle', 'Front\PaymentController@paycancle')->name('payment.cancle');
  Route::post('/checkout/payment/notify', 'Front\PaymentController@notify')->name('payment.notify');

  Route::post('/cashondelivery', 'Front\CheckoutController@cashondelivery')->name('cash.submit');
  Route::post('/bkash', 'Front\CheckoutController@bkash')->name('bkash.submit');
  Route::post('/gateway', 'Front\CheckoutController@gateway')->name('gateway.submit');

  Route::get('/product/quick/view/{id}/','Front\CatalogController@quick')->name('product.quick');
  Route::get('/product/{slug}','Front\CatalogController@product')->name('front.product');
  Route::post('/subscriber/store', 'Front\FrontendController@subscribe')->name('front.subscribe');


  // CATEGORY SECTION
  Route::get('/category/{category?}/{subcategory?}/{childcategory?}','Front\CatalogController@category')->name('front.category');
  Route::get('/category/{slug1}/{slug2}','Front\CatalogController@subcategory')->name('front.subcat');
  Route::get('/category/{slug1}/{slug2}/{slug3}','Front\CatalogController@childcategory')->name('front.childcat');
  Route::get('/categories/','Front\CatalogController@categories')->name('front.categories');
  Route::get('/childcategories/{slug}', 'Front\CatalogController@childcategories')->name('front.childcategories');
  // CATEGORY SECTION ENDS

  // CONTACT SECTION
  Route::get('/contact','Front\FrontendController@contact')->name('front.contact');
  Route::post('/contact','Front\FrontendController@contactemail')->name('front.contact.submit');
  Route::get('/contact/refresh_code','Front\FrontendController@refresh_code');
  // CONTACT SECTION  ENDS
  // BLOG SECTION
  Route::get('/blog','Front\FrontendController@blog')->name('front.blog');
  Route::get('/blog/{id}','Front\FrontendController@blogshow')->name('front.blogshow');
  Route::get('/blog/category/{slug}','Front\FrontendController@blogcategory')->name('front.blogcategory');
  Route::get('/blog/tag/{slug}','Front\FrontendController@blogtags')->name('front.blogtags');
  Route::get('/blog-search','Front\FrontendController@blogsearch')->name('front.blogsearch');
  Route::get('/blog/archive/{slug}','Front\FrontendController@blogarchive')->name('front.blogarchive');
  // BLOG SECTION ENDS
  // FAQ SECTION
  Route::get('/faq','Front\FrontendController@faq')->name('front.faq');
  // FAQ SECTION ENDS
  // PAGE SECTION
  Route::get('/{slug}','Front\FrontendController@page')->name('front.page');
  // PAGE SECTION ENDS
?>