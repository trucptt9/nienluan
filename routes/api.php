<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
 
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user/{id}', [UserController::class, 'show']); 
Route::get('/user', [UserController::class, 'getAllUser']); 
Route::get('/admin/nhanviens', [UserController::class, 'getAdmin']); 
Route::get('/admin/products', [ProductController::class, 'showAll']); 
Route::get('/admin/categorys', [ProductController::class, 'create']); 
Route::get('/create', [UserController::class, 'create']); 
// post dữ liệu tạo tk mới
Route::post('/user', [UserController::class, 'store']);
//post dữ liệu tạo sản phẩm
Route::post('/product', [ProductController::class, 'store']);