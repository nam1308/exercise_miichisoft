<?php

use App\Http\Controllers\HomeController;
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

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('register',[RegisterAdminController::class, 'showRegistrationForm'])->name('admin.register.showForm');
    Route::post('register/store', [RegisterAdminController::class, 'store'])->name('admin.register.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login',[LoginAdminController::class, 'showLoginForm'])->name('admin.showLoginForm');
    Route::post('login',[LoginAdminController::class, 'login'])->name('admin.login');
});
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
});


// superAdmin
Route::group(['prefix' => 'superAdmin'], function () {
    Route::get('register/{token}',[RegisterSuperAdminController::class, 'showRegistrationForm'])->name('superAdmin.register.showForm');
    Route::post('register/store', [RegisterSuperAdminController::class, 'store'])->name('superAdmin.register.store');
});

Route::group(['prefix' => 'superAdmin', 'middleware' => 'guest:superAdmin'], function () {
    Route::get('login',[LoginSuperAdminController::class, 'showLoginForm'])->name('superAdmin.showLoginForm');
    Route::post('login',[LoginSuperAdminController::class, 'login'])->name('superAdmin.login');
});
Auth::routes();

Route::group(['prefix' => 'superAdmin', 'middleware' => 'auth:superAdmin'], function () {
    Route::get('/', [HomeSuperAdminController::class, 'index'])->name('superAdmin.home');
});



