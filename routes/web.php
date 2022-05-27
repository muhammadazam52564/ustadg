<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });
Route::Redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=> 'admin', 'middleware'=>['isAdmin', 'auth', 'PreventBackHistory']], function(){

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');


    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/get-users', [AdminController::class, 'get_users'])->name('admin.get-users');
    Route::get('/delete-user/{id}', [AdminController::class, 'delete_user'])->name('admin.delete-user');
    Route::get('/status-updte-user/{id}/{status}', [AdminController::class, 'user_status'])->name('admin.status-updte-user');

    
    
    // 
    // 
    Route::get('/cities', [AdminController::class, 'cities'])->name('admin.cities');
    Route::get('/get-cities', [AdminController::class, 'get_cities'])->name('admin.get-cities');
    Route::post('/add-edit-city', [AdminController::class, 'add_edit_city'])->name('admin.add-edit-city');
    Route::get('/delete-city/{id}', [AdminController::class, 'delete_city'])->name('admin.delete-city');
    
    // 
    // 
    Route::get('/banners/{id?}', [AdminController::class, 'banners'])->name('admin.banners');
    Route::get('/get-banners/{id?}', [AdminController::class, 'get_banners'])->name('admin.get-banners');
    Route::post('/add-edit-banner', [AdminController::class, 'add_edit_banners'])->name('admin.add-edit-banner');
    Route::get('/delete-banner/{id}', [AdminController::class, 'delete_banner'])->name('admin.delete-banner');

    Route::get('/domains', [AdminController::class, 'domains'])->name('admin.domains');
    Route::get('/get-domains', [AdminController::class, 'get_domains'])->name('admin.get-domains');
    Route::get('/delete-domain/{id}', [AdminController::class, 'delete_domain'])->name('admin.delete-domain');
    Route::post('/add-domains', [AdminController::class, 'add_domains'])->name('admin.add-domains');


    Route::get('/categories/{id?}', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/get-categories/{id?}', [AdminController::class, 'get_categories'])->name('admin.get-categories');
    Route::post('/add-edit-category', [AdminController::class, 'add_edit_category'])->name('admin.add-edit-category');
    Route::get('/delete-category/{id}', [AdminController::class, 'delete__category'])->name('admin.delete-category');


    Route::get('/sub-categories/{id}', [AdminController::class, 'sub__categories'])->name('admin.sub-categories');
    Route::post('/add-edit-sub-category', [AdminController::class, 'add_edit_sub_category'])->name('admin.add-edit-sub-category');
    Route::get('/get-sub-categories/{id}', [AdminController::class, 'get_sub_categories'])->name('admin.get-sub-categories');
    Route::post('/delete-sub-category/{id}', [AdminController::class, 'delete_sub_category'])->name('admin.delete-sub-category');


    Route::get('/services/{id}', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/get-services', [AdminController::class, 'get_services'])->name('admin.get-services');
    Route::post('/add-edit-service', [AdminController::class, 'add_edit_service'])->name('admin.add-edit-service');
    Route::get('/delete-service/{id}', [AdminController::class, 'delete_service'])->name('admin.delete-service');

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
