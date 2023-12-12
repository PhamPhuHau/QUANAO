<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangAPIController;
use  App\Http\Controllers\SanPhamAPIController;
use  App\Http\Controllers\BinhLuanAPIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[KhachHangAPIController::class,'login'])->middleware('api');
Route::post('me',[KhachHangAPIController::class,'me'])->middleware('api');

Route::post('/logout',[KhachHangAPIController::class,'logout'])->middleware('api');

Route::post('/regester',[KhachHangAPIController::class,'Regester'])->middleware('api');


route::get('danh-sach-san-pham',[SanPhamAPIController::class,'DanhSachSanPham']);

route::get('chi-tiet-san-pham/{id}',[SanPhamAPIController::class,'ChiTietSanPham']);

route::get('tim-kiem/{ten}',[SanPhamAPIController::class,'TimKiem']);

route::post('luu-binh-luan', [BinhLuanAPIController::class, 'ThemBinhLuanCapMot']);
route::get('danh-sach-binh-luan-cap-mot/{id}', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapMot']);

route::post('luu-binh-luan-cap-hai', [BinhLuanAPIController::class, 'ThemBinhLuanCapHai']);
route::post('danh-sach-binh-luan-cap-hai', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapHai']);
