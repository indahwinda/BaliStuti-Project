<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' =>true]);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Frontend\FrontendController@index');
Route::get('/list-products', 'Frontend\FrontendController@products');
Route::get('/product_detail/{id}', 'Frontend\FrontendController@product_detail');
Route::get('/search', 'Frontend\FrontendController@search');
Route::get('/viewcategory/{slug}', 'Frontend\FrontendController@viewcategory');
Route::get('/about', 'Frontend\FrontendController@about');


Route::middleware(['verified','auth','isAdmin'])->group(function()
{
    Route::get('/admin_dashboard', 'Admin\FrontendController@index');
    Route::get('/profile', 'Admin\ProfileCompanyController@index');
    Route::get('/list-orders', 'Admin\OrderController@listOrders');
    Route::get('/view-order/{id}', 'Admin\OrderController@viewOrder');
    Route::post('/update-order', 'Admin\OrderController@updateOrder');
    Route::get('categories', 'Admin\CategoryController@index');
    Route::get('add-category', 'Admin\CategoryController@add');
    Route::post('insert-category', 'Admin\CategoryController@insert');
    Route::post('update-category', 'Admin\CategoryController@update');
    Route::post('delete-category', 'Admin\CategoryController@destroy');
    Route::get('products', 'Admin\ProductController@index');
    Route::get('add-product', 'Admin\ProductController@add');
    Route::post('insert-product', 'Admin\ProductController@insert');
    Route::post('update-product', 'Admin\ProductController@update');
    Route::post('delete-product', 'Admin\ProductController@destroy');
    Route::get('/view_gallery/{id}', 'Admin\ProductController@gallery');
    Route::post('/mark-as-read', 'Admin\FrontendController@markNotification')->name('markNotification');
    Route::post('/update-profile', 'Admin\ProfileCompanyController@updateProfile');
    Route::post('/update-company', 'Admin\ProfileCompanyController@updateCompany');
<<<<<<< Updated upstream
=======
    Route::get('/history', 'Admin\HistoryController@index');

    Route::get('/list-customs', 'Admin\CustomProductController@index');

    //update status custom product
    Route::post('/update-custom', 'Admin\CustomProductController@updateLink');
    Route::post('/update-custom-status', 'Admin\CustomProductController@updateStatus');
>>>>>>> Stashed changes
});

Route::middleware(['verified','auth'])->group(function()
{
    Route::get('user_dashboard', 'Customer\CustomerController@index');
    Route::get('/profile-information', 'Customer\ProfileController@index');
    Route::post('/update-info', 'Customer\ProfileController@updateProfile');
    Route::get('/my-orders', 'Customer\CustomerController@my_orders');
    Route::get('/view_order/{id}', 'Customer\CustomerController@viewOrder');
    Route::get('notify', 'Customer\CustomerController@notify');
    Route::post('/add-to-cart', 'Frontend\CartController@addProduct');
    Route::post('/delete-cart-item', 'Frontend\CartController@deleteItem');
    Route::post('/update-cart-item', 'Frontend\CartController@updateCartItem');
    Route::get('/cart', 'Frontend\CartController@viewcart');
    Route::get('/checkout', 'Frontend\CheckoutController@index');
    Route::get('/ongkir', 'Frontend\CheckoutController@index');
    Route::post('/ongkir', 'Frontend\CheckoutController@check_ongkir');
    Route::get('/cities/{province_id}', 'Frontend\CheckoutController@getCities');
    Route::post('/place-order', 'Frontend\CheckoutController@placeOrder');

<<<<<<< Updated upstream
=======
    
    Route::post('pay', [PaymentController::class, 'pay'])->name('payment');
    Route::get('/view-payment', [PaymentController::class, 'view'])->name('view-payment');
    Route::get('success', [PaymentController::class, 'success']);
    Route::get('error',[PaymentController::class, 'error']);

    Route::get('/checkoutPay/{order}', 'Frontend\CheckoutController@checkoutPay');
    Route::post('transaction', [TransactionController::class, 'transaction'])->name('transaction');
    Route::get('transaction/{reference}', [TransactionController::class, 'show'])->name('transaction.show');

    Route::get('wishlist',  [WishlistController::class, 'index']);

    // custom product
    Route::post('/request-product', 'Frontend\CustomProductController@store');
    
    //list
    Route::get('/my-custom',  'Customer\CustomerController@my_custom');

    //review
    Route::post('/post-review', 'Frontend\FrontendController@postReview');
>>>>>>> Stashed changes
});