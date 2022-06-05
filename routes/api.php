<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Auth;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/update_profile_image', [AuthController::class, 'update_profile_image']);
Route::post('/update_profile', [AuthController::class, 'update_profile']);
Route::post('/change_password', [AuthController::class, 'change_password']);
Route::post('/add_address', [AuthController::class, 'add_address']);
Route::post('/address-list', [AuthController::class, 'address_list']);

Route::post('/domains', [MainController::class, 'domains']);
Route::post('/categories', [MainController::class, 'categories']);
Route::post('/sub_categories', [MainController::class, 'sub_categories']);
Route::post('/services', [MainController::class, 'services']);
Route::post('/trending', [MainController::class, 'trending']);
Route::post('/search', [MainController::class, 'search']);
Route::post('/notifications', [MainController::class, 'notifications']);
Route::post('/banner', [MainController::class, 'banner']);
Route::post('/points', [MainController::class, 'points']);


Route::post('/order', [MainController::class, 'order']);
Route::post('/order-list', [MainController::class, 'orders_list']);




