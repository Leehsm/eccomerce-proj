<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ToyyibpayController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\StockController;

// use App\Http\Controllers\Backend\SubSubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\BlogController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\AllUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){
    //after login route Admin
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

    //ADMIN ALL ROUTE
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
});

//after login route User
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

//USER ALL ROUTE
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/reg', [IndexController::class, 'UserReg'])->name('user.register');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::get('/user/profile/edit', [IndexController::class, 'UserProfileEdit'])->name('user.profile.edit');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
Route::post('/user/password/update', [IndexController::class, 'UserUpdateChangePassword'])->name('user.password.update');



//Admin Brand All Route
Route::prefix('brand')->group(function(){
    
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');

});

//Admin Category All Route
Route::prefix('category')->group(function(){
    
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    
    //Admin Sub-Category All Route    
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    //Admin Sub-Sub-Category All Route    
    Route::get('/sub/sub/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
    Route::post('/sub/sub/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

    Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
    Route::get('/subsubcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);

    //Admin Sub-Sub-Sub-Category All Route    
    // Route::get('/sub/sub/sub/view', [SubSubSubCategoryController::class, 'SubSubSubCategoryView'])->name('all.subsubsubcategory');
    // Route::post('/sub/sub/sub/store', [SubSubSubCategoryController::class, 'SubSubSubCategoryStore'])->name('subsubsubcategory.store');
    // Route::get('/sub/sub/sub/edit/{id}', [SubSubSubCategoryController::class, 'SubSubSubCategoryEdit'])->name('subsubsubcategory.edit');
    // Route::post('/sub/sub/sub/update', [SubSubSubCategoryController::class, 'SubSubSubCategoryUpdate'])->name('subsubsubcategory.update');
    // Route::get('/sub/sub/sub/delete/{id}', [SubSubSubCategoryController::class, 'SubSubSubCategoryDelete'])->name('subsubsubcategory.delete');
    
    // Route::get('/subsubsubcategory/ajax/{subsubcategory_id}', [SubSubSubCategoryController::class, 'GetSubSubSubCategory']);
    
    
});

//Admin Product All Route
Route::prefix('product')->group(function(){
    
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('product-manage');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product-edit');
    Route::get('/review/{id}', [ProductController::class, 'ReviewProduct'])->name('product-review');
    Route::post('/data/update', [ProductController::class, 'UpdateDataProduct'])->name('product-update');
    Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product-multiimg-delete');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product-inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product-active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product-delete');    
});


//Admin Slider All Route
Route::prefix('slider')->group(function(){
    
    Route::get('/manage', [SliderController::class, 'SliderView'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');  

    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
});

//// Frontend All Routes /////

/// Multi Language All Routes ////
Route::get('/language/malay', [LanguageController::class, 'Malay'])->name('malay.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language'); 


// Frontend Product Details Page url 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);


// Frontend Product Tags Page 
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

//Color wise
Route::get('/product/color/{color}', [IndexController::class, 'ColorWiseProduct']);


// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// Frontend Sub-SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);

// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

//frontend others
Route::get('/contact-us', [IndexController::class, 'ContactUs'])->name('contact-us');
Route::get('/faq', [IndexController::class, 'Faq'])->name('faq');
Route::get('/delivery', [IndexController::class, 'Delivery'])->name('delivery');
Route::get('/blog', [IndexController::class, 'Blog'])->name('blog');
Route::get('/blog/blog-details/{id}', [IndexController::class, 'BlogDetail'])->name('blog-details');


// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);


// Wishlist page
Route::get('/user/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
Route::get('/user/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
Route::get('/user/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']); 

//Payment Page
Route::post('/user/stripe/order', [PaymentController::class, 'StripeOrder'])->name('stripe.order'); //card
// Route::post('/user/fpx/order', [PaymentController::class, 'FPXOrder'])->name('fpx.order'); //fpx

//ToyyibPay
Route::post('/user/toyyibpay', [ToyyibpayController::class, 'createBill'])->name('toyyibpay-create'); //fpx
Route::post('/user/toyyibpay/status', [ToyyibpayController::class, 'paymentStatus'])->name('toyyibpay-status'); //fpx
Route::post('/user/toyyibpay/callback', [ToyyibpayController::class, 'callBack'])->name('toyyibpay-callback'); //fpx

//Order History
Route::get('/user/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
Route::get('/user/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);
Route::get('/user/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

//my cart page
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// Admin Coupons All Routes 
Route::prefix('coupons')->group(function(){ 
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon'); 
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
}); 

// Admin Contact All Routes 
Route::prefix('contacts')->group(function(){ 
    Route::get('/view', [ContactController::class, 'ContactView'])->name('manage-contact'); 
    Route::post('/store', [ContactController::class, 'ContactStore'])->name('contact.store');
    Route::get('/edit/{id}', [ContactController::class, 'ContactEdit'])->name('contact.edit');
    Route::post('/update/{id}', [ContactController::class, 'ContactUpdate'])->name('contact.update');
    Route::get('/delete/{id}', [ContactController::class, 'ContactDelete'])->name('contact.delete');
}); 

// Admin Shipping All Routes 
Route::prefix('shipping')->group(function(){
    // Ship Division 
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

    // Ship District 
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
    Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

    // Ship State 
    Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');
    Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
    Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
    Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
    Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');
});    

// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Routes 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

// Admin customer order All Routes 
Route::prefix('orders')->group(function(){ 
    Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders'); 
    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrderDetails'])->name('pending-orders-details'); 

    Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders'); 
    Route::get('/confirmed/orders/details/{order_id}', [OrderController::class, 'ConfirmedOrderDetails'])->name('confirmed-orders-details'); 

    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders'); 
    Route::get('/processing/orders/details/{order_id}', [OrderController::class, 'ProcessingOrderDetails'])->name('processing-orders-details'); 

    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders'); 
    Route::get('/picked/orders/details/{order_id}', [OrderController::class, 'PickedOrderDetails'])->name('picked-orders-details'); 

    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders'); 
    Route::get('/shipped/orders/details/{order_id}', [OrderController::class, 'ShippedOrderDetails'])->name('shipped-orders-details'); 

    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders'); 
    Route::get('/delivered/orders/details/{order_id}', [OrderController::class, 'DeliveredOrderDetails'])->name('delivered-orders-details'); 

    Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders'); 
    Route::get('/cancel/orders/details/{order_id}', [OrderController::class, 'CancelOrderDetails'])->name('cancel-orders-details'); 

    //Update Status
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm'); 
    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm-processing'); 
    Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing-picked'); 
    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked-shipped'); 
    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped-delivered'); 
    Route::get('/cancel/{order_id}', [OrderController::class, 'CancelOrder'])->name('cancel-order'); 
    Route::get('/invoice/download/{order_id}', [OrderController::class, 'InvoiceDownload'])->name('invoice-download'); 
    
}); 

 //Report Route
Route::prefix('report')->group(function(){ 
    Route::get('/view', [ReportController::class, 'ReportView'])->name('all-report'); 
    Route::get('/view/custName', [ReportController::class, 'ReportViewCustName'])->name('report-by-cust-name'); 
    Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date'); 
    Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month'); 
    Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year'); 
    Route::post('/search/by/customerName', [ReportController::class, 'ReportByCustomerName'])->name('search-by-cust-name'); 
});

 //User List Route
 Route::prefix('alluser')->group(function(){ 
    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-user'); 
});

Route::prefix('blog')->group(function(){
    Route::get('/view', [BlogController::class, 'BlogView'])->name('all-blog');
    Route::get('/add', [BlogController::class, 'BlogAdd'])->name('blog.add');
    Route::post('/store', [BlogController::class, 'BlogStore'])->name('blog.store');
    Route::get('/edit/{id}', [BlogController::class, 'BlogEdit'])->name('blog.edit');
    Route::post('/update/{id}', [BlogController::class, 'BlogUpdate'])->name('blog.update');
    Route::get('/delete/{id}', [BlogController::class, 'BlogDelete'])->name('blog.delete');

    Route::get('/inactive/{id}', [BlogController::class, 'BlogInactive'])->name('blog.inactive');
    Route::get('/active/{id}', [BlogController::class, 'BlogActive'])->name('blog.active');
    Route::post('/image_slider/update', [BlogController::class, 'MultiImageSliderUpdate'])->name('update-blog-slider-image');
    Route::get('/multiimg_slider/delete/{id}', [BlogController::class, 'MultiImageSliderDelete'])->name('blog-multiimg-slider-delete');
});   

Route::prefix('contact')->group(function(){
    Route::get('/view', [ContactController::class, 'ContactView'])->name('all-contact');
    Route::get('/add', [ContactController::class, 'ContactAdd'])->name('contact.add');
    Route::post('/store', [ContactController::class, 'ContactStore'])->name('contact.store');
    Route::get('/edit/{id}', [ContactController::class, 'ContactEdit'])->name('contact.edit');
    Route::post('/update/{id}', [ContactController::class, 'ContactUpdate'])->name('contact.update');
    Route::get('/delete/{id}', [ContactController::class, 'ContactDelete'])->name('contact.delete');    
});   

//Search route
Route::post('/product/search', [CartController::class, 'Search'])->name('product.search');

//Stock cart route
Route::get('/stock-cart', [StockController::class, 'StockCart'])->name('stock-cart');
Route::get('/edit/{id}', [StockController::class, 'StockCartEdit'])->name('stock.edit');
Route::post('/update', [StockController::class, 'StockCartUpdate'])->name('stock.update');
Route::get('/delete/{id}', [StockController::class, 'StockCartDelete'])->name('stock.delete'); 


//Stock Cart search route
Route::post('/stock/search', [StockController::class, 'Search'])->name('stock.search');

//Bag Stock All Route
Route::prefix('bag')->group(function(){
    
    Route::get('/manage', [StockController::class, 'BagView'])->name('manage-bag');
    Route::get('/add', [StockController::class, 'AddBag'])->name('add-bag');
    Route::post('/store', [StockController::class, 'BagStore'])->name('bag.store');
    Route::get('/edit/{id}', [StockController::class, 'BagEdit'])->name('bag.edit');
    Route::post('/update', [StockController::class, 'BagUpdate'])->name('bag.update');
    Route::get('/delete/{id}', [StockController::class, 'BagDelete'])->name('bag.delete');  
});
//Clothing Stock All Route
Route::prefix('clothing')->group(function(){
    
    Route::get('/manage', [StockController::class, 'ClothView'])->name('manage-cloth');
    Route::get('/add', [StockController::class, 'AddCloth'])->name('add-cloth');
    Route::post('/store', [StockController::class, 'ClothStore'])->name('cloth.store');
    Route::get('/edit/{id}', [StockController::class, 'ClothEdit'])->name('cloth.edit');
    Route::post('/update', [StockController::class, 'ClothUpdate'])->name('cloth.update');
    Route::get('/delete/{id}', [StockController::class, 'ClothDelete'])->name('cloth.delete');  
});
//Wallet Stock All Route
Route::prefix('wallet')->group(function(){
    
    Route::get('/manage', [StockController::class, 'WalletView'])->name('manage-wallet');
    Route::get('/add', [StockController::class, 'AddWallet'])->name('add-wallet');
    Route::post('/store', [StockController::class, 'WalletStore'])->name('wallet.store');
    Route::get('/edit/{id}', [StockController::class, 'WalletEdit'])->name('wallet.edit');
    Route::post('/update', [StockController::class, 'WalletUpdate'])->name('wallet.update');
    Route::get('/delete/{id}', [StockController::class, 'WalletDelete'])->name('wallet.delete');  
});
//Skincare Stock All Route
Route::prefix('skincare')->group(function(){
    
    Route::get('/manage', [StockController::class, 'SkincareView'])->name('manage-skincare');
    Route::get('/add', [StockController::class, 'AddSkincare'])->name('add-skincare');
    Route::post('/store', [StockController::class, 'SkincareStore'])->name('skincare.store');
    Route::get('/edit/{id}', [StockController::class, 'SkincareEdit'])->name('skincare.edit');
    Route::post('/update', [StockController::class, 'SkincareUpdate'])->name('skincare.update');
    Route::get('/delete/{id}', [StockController::class, 'SkincareDelete'])->name('skincare.delete');  
});
