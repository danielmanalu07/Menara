<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/login', function () {
//     return view('admin/login');
// });

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::resource('category', 'CategoryController');
        Route::resource('flavor', 'FlavorController');
        Route::resource('product', 'ProductController');
    });
});
