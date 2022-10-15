<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user/{id}', [UserController::class, 'getById']);

Route::post('/user', [UserController::class, 'store']);

Route::delete('/user/{id}', [UserController::class, 'deleteById']);

Route::put('/user/{id}', [UserController::class, 'updateById']);

Route::post('/admin/login', [AdminController::class, 'login']);

Route::get('/admin/info', [AdminController::class, 'getAdminByRequest'])->middleware([
    'auth:sanctum',
    'CheckAuthUser:App\Models\Admin'
]);
