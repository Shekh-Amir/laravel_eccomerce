<?php



//......................backend rouutes.....................................

Route::match(['get','post'],'/admin','AdminLoginController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
////  .....START.HOME PaGE/........................
Route::get('/','IndexController@index');
//............category/listing page.............
Route::get('/products/{url}','ProductsController@products');
/// ...........product detail page............
Route::get('/product/{id}','ProductsController@product');
/// ........get...products atribute price ............
Route::get('/get-product-price','ProductsController@getProductPrice');
/// .......add to cart route ............
Route::match(['get','post'],'/add-cart','ProductsController@addtoCart');


/// .......cart page route ............
Route::match(['get','post'],'/cart','ProductsController@Cart');
//...........delete product from cart page.............
Route::get('/cart/delete-product/{id}', 'ProductsController@deletecartProduct');
//...........update product from cart page.............
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updatequantityCart');
//.......apply for coupon.............
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

//USERS login/Register routes
Route::get('/login-register', 'UserController@UserloginRegister');
//USERS Register from submit routes
Route::post('/user-register', 'UserController@register');
//confirm account routes
Route::get('/confirm/{code}', 'UserController@confirmAccount');
// user login form...
Route::post('/user-login', 'UserController@login');
//USERS logout   routes
Route::get('/user-logout', 'UserController@logout');
//all routes after login

// Search Products
Route::post('/search-products','ProductsController@searchProducts');


Route::group(['middleware'=>['frontlogin']],function(){
	//USERS account   routes
     Route::match(['get','post'],'/account','UserController@account');
     Route::post('/check-user-pwd', 'UserController@chkUserPassword');
     Route::post('/update-user-pwd', 'UserController@updateUserPassword');
     //billing checkout routes
    
     Route::match(['get','post'],'/checkout','ProductsController@checkout');
     // order review routes
     Route::match(['get','post'],'/order-review','ProductsController@orderReview');
     //place order  routes
     Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
     //thanks page.........
     Route::get('/thanks', 'ProductsController@thanks');
     //paypal page.........
     Route::get('/paypal', 'ProductsController@paypal');
     //user order page.........
     Route::get('/orders', 'ProductsController@userOrders');
      //user order products page.........
     Route::get('/orders/{id}', 'ProductsController@userOrderDetails');



});



//......check if user is already exists

Route::match(['get','post'],'/check-email','UserController@checkEmail');


Route::group(['middleware'=>['adminlogin']],function(){

     Route::get('/dashboard', 'AdminLoginController@dashboard');
     Route::get('/admin_setting', 'AdminLoginController@setting');
     Route::get('/admin/check-pwd','AdminLoginController@chkPassword');
     Route::match(['get','post'],'/admin_update_pwd','AdminLoginController@updatePassword');
     /// ...........category route (admin)............

     Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
     Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
     Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
     Route::get('/admin/view-categories','CategoryController@viewCategories');

     // .......Products Routes...................................
     Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
     Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
     Route::get('/admin/view-products','ProductsController@viewProducts');
     Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
     Route::get('/admin/delete-products-image/{id}','ProductsController@deleteProductsImage');

     Route::get('/admin/add-images/delete-alt-image/{id}','ProductsController@deleteAltImage');
     //////.........products attributes route...............
     Route::match(['get','post'],'/admin/add-attribute/{id}','ProductsController@addAttributes');
     Route::match(['get','post'],'/admin/edit-attribute/{id}','ProductsController@editAttributes');
     Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');

     Route::get('/admin/add-attribute/delete-attribute/{id}','ProductsController@deleteAttribute');

     //............coupons routes.........
     Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
     Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
     Route::get('/admin/view-coupons','CouponsController@viewCoupons');
     Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');
     //////.......admin banner route......
     Route::match(['get','post'],'/admin/add-banner','BannerController@addBanner');
     Route::match(['get','post'],'/admin/edit-banner/{id}','BannerController@editBanner');
     Route::get('/admin/view-banner','BannerController@viewBanner');
     Route::get('/admin/delete-banner/{id}','BannerController@deleteBanner');

     //..admin ordeers route...........
     Route::get('/admin/view-orders','ProductsController@viewOrders');
     //admin order details route
     Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');
     //update order status
      Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');
       //update order status
      Route::get('/admin/view-users','UserController@viewUsers');



});

Route::get('/logout','AdminLoginController@logout');









