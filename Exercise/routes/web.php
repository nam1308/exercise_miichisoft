<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\MailController;
use App\Http\Controllers\directionalController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\LoginAdminController;
use App\Http\Controllers\Admin\Auth\RegisterAdminController;
use App\Http\Controllers\SuperAdmin\HomeSuperAdminController;
use App\Http\Controllers\SuperAdmin\Auth\LoginSuperAdminController;
use App\Http\Controllers\SuperAdmin\Auth\RegisterSuperAdminController;
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
Route::get('/', function () {
    return view('welcome');
});

//Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
//});

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('register',[RegisterAdminController::class, 'showRegistrationForm'])->name('admin.register.showForm');
    Route::post('register/store', [RegisterAdminController::class, 'store'])->name('admin.register.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login',[LoginAdminController::class, 'showLoginForm'])->name('admin.showLoginForm');
    Route::post('login',[LoginAdminController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
});


// superAdmin
Route::group(['prefix' => 'super-admin'], function () {
    Route::get('register',[RegisterSuperAdminController::class, 'showRegistrationForm'])->name('super-admin.register.showForm');
    Route::post('register/store', [RegisterSuperAdminController::class, 'store'])->name('super-admin.register.store');
});

Route::group(['prefix' => 'super-admin', 'middleware' => 'guest:super-admin'], function () {
    Route::get('login',[LoginSuperAdminController::class, 'showLoginForm'])->name('super-admin.showLoginForm');
    Route::post('login',[LoginSuperAdminController::class, 'login'])->name('super-admin.login');
});

Route::group(['prefix' => 'super-admin', 'middleware' => 'auth:super-admin'], function () {
    Route::get('/', [HomeSuperAdminController::class, 'index'])->name('super-admin.home');
});
Auth::routes();


