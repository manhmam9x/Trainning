<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

//Login

Route::controller(AdminController::class)->group(function (){
    // Login
    Route::get('/admin/login', 'login')->name('admin.login');

    Route::post('/admin/login', 'postLogin')->name('admin.postLogin');

    Route::get('/admin', 'index')->name('admin.index');
    //Logout
    Route::get('/admin/logout', 'logout')->name('admin.logout');
});

// Admin
Route::group(['middleware' => 'checkLogin', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::resource('user', UserController::class);

});
