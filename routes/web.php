<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'admin', 'middleware'=>['isAdmin', 'auth', 'PreventBackHistory']], function(){

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/category', [AdminController::class, 'category'])->name('admin.category');
    Route::post('/delete-category/{id}', [AdminController::class, 'delete__category'])->name('admin.delete-category');


    Route::get('/sub-categories/{id}', [AdminController::class, 'sub__categories'])->name('admin.sub-categories');
    Route::post('/sub-category', [AdminController::class, 'sub__category'])->name('admin.sub-category');
    Route::post('/delete-sub-category/{id}', [AdminController::class, 'delete__sub__category'])->name('admin.delete-sub-category');


    Route::get('/services/{id}', [AdminController::class, 'services'])->name('admin.services');
    Route::post('/service', [AdminController::class, 'service'])->name('admin.service');
    Route::post('/delete-service/{id}', [AdminController::class, 'service'])->name('admin.service');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');


    //
    // Profile Settings
    //
    Route::get('/change-password', [AdminController::class, 'change_password'])->name('admin.change-password');
    Route::post('/change-password', [AdminController::class, 'update_password'])->name('admin.change-password');
    Route::get('/change-email', [AdminController::class, 'change_email'])->name('admin.change-email');
    Route::post('/change-email', [AdminController::class, 'update_email'])->name('admin.change-email');
});




































Route::group(['prefix'=> 'agent', 'middleware'=>['isAgent', 'auth', 'PreventBackHistory']], function(){

    Route::get('/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
});

Route::group(['prefix'=> 'user', 'middleware'=>['isUser', 'auth', 'PreventBackHistory']], function(){

    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');


});
