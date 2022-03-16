<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Ajax\CommentController;
use App\Http\Controllers\Ajax\rateController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\frontend\sendMailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// frontend
Route::get('/', [HomeController::class, 'index']);
// Login
Route::get('/home/login', [LoginController::class, 'index'])->name('getLogin');
Route::post('/home/login', [LoginController::class, 'postLogin'])->name('postLogin');
// Register
Route::get('/home/register', [FrontendUserController::class, 'index'])->name('getRegister');
Route::post('/home/register', [FrontendUserController::class, 'register'])->name('postRegister');
// Blog
Route::get('/home/blog/list', [FrontendBlogController::class, 'index'])->name('blogList');
Route::get('/home/blog/single/{id}', [FrontendBlogController::class, 'blogDetail'])->name('blogSingle');
// Check login
Route::post('/checklogin', [rateController::class, 'postScore'])->name('checkLogin');
Route::post('/checkcomment', [CommentController::class, 'postComment'])->name('postComment');
Route::post('/commentchild', [CommentController::class, 'postCommentChild'])->name('commentchild');
// Logout
Route::get('logout', [FrontendUserController::class, 'logout'])->name('postLogout');
// Get Account getAccount
Route::get('/getAccount', [AccountController::class, 'getAccount'])->name('getAccount');
Route::put('/postAccount', [AccountController::class, 'postAccount'])->name('postAccount');
// Get Product
Route::get('/listProduct', [ProductController::class, 'getListProductOfMember'])->name('listProduct');
Route::get('/getProduct', [ProductController::class, 'getCreate'])->name('getProduct');
Route::post('/AddProduct', [ProductController::class, 'postProduct'])->name('addProduct');
Route::get('/getEditProduct/{id}', [ProductController::class, 'getProduct'])->name('editProduct');
Route::put('/updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::get('/getDetailProduct/{id}', [ProductController::class, 'getDetailProduct'])->name('getDetailProduct');
// Cart
Route::get('/getCart', [CartController::class , 'getCart'])->name('getCart');
Route::post('/postCart', [CartController::class , 'postCart'])->name('postCart');
Route::post('/postUpQuantityCart', [CartController::class , 'UpQuantity'])->name('UpQuantity');
Route::post('/postDownQuantityCart', [CartController::class , 'DownQuantity'])->name('DownQuantity');
Route::post('/posDeleteCart', [CartController::class , 'DeleteCart'])->name('DeleteCart');
// Check out
Route::get('/getCheckout', [CheckoutController::class, 'getCheckout'])->name('getCheckout');
// send mail register
Route::post('/sendMail', [CheckoutController::class, 'sendMail'])->name('sendMail');
// Search
Route::post('/getSearchName', [SearchController::class, 'searchName'])->name('searchName');
Route::get('/searchAll', [SearchController::class, 'getSearchAll'])->name('getSearchAll');
Route::post('/searchAll', [SearchController::class, 'searchAllValue'])->name('searchAllValue');
Route::post('/searchPrice', [SearchController::class, 'searchPrice'])->name('searchPrice');


Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin/home', [DashboardController::class, 'index']);
    // Users
    Route::resource('user', UserController::class);
    // Country
    Route::resource('country', CountryController::class);
    // blog
    Route::resource('blog', BlogController::class);
});
