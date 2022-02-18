<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// frontend
Route::get('/', [HomeController::class, 'index']);
// Login
Route::get('/home/login', [LoginController::class, 'index']);
Route::post('/home/login', [LoginController::class, 'postLogin'])->name('postLogin');
// Register
Route::get('/home/register', [FrontendUserController::class, 'index']);
Route::post('/home/register', [FrontendUserController::class, 'register'])->name('postRegister');
// Blog
Route::get('/home/blog/list', [FrontendBlogController::class, 'index']);
Route::get('/home/blog/single/{id}', [FrontendBlogController::class, 'blogDetail'])->name('blogSingle');





// admin
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
