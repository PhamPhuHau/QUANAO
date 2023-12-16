<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangAPIController;
use  App\Http\Controllers\SanPhamAPIController;
use  App\Http\Controllers\BinhLuanAPIController;
use  App\Http\Controllers\LoaiAPIController;
use  App\Http\Controllers\HoaDonAPIController;
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
//-------------TÀI KHOẢNG-------------------
Route::post('login',[KhachHangAPIController::class,'login'])->middleware('api');
Route::post('me',[KhachHangAPIController::class,'me'])->middleware('api');

Route::post('/logout',[KhachHangAPIController::class,'logout'])->middleware('api');

Route::post('/regester',[KhachHangAPIController::class,'Regester'])->middleware('api');
Route::post('/doi-mat-khau',[KhachHangAPIController::class,'doiMatKhau'])->middleware('api');
Route::post('/cap_nhat_thong_tin',[KhachHangAPIController::class,'capNhatThongTin'])->middleware('api');


//---------------SẢN PHẨM-----------------------------------
route::get('danh-sach-san-pham',[SanPhamAPIController::class,'DanhSachSanPham']);

route::get('chi-tiet-san-pham/{id}',[SanPhamAPIController::class,'ChiTietSanPham']);

route::post('tim-kiem/{ten}',[SanPhamAPIController::class,'TimKiem']);

route::get('tim-kiem-gia-tang/{ten}',[SanPhamAPIController::class,'TimKiemGiaTang']);

route::get('tim-kiem-gia-giam/{ten}',[SanPhamAPIController::class,'TimKiemGiaGiam']);

route::post('loc-loai/{idLoai}',[SanPhamAPIController::class,'LocLoaiSanPham']);

route::get('gia-tang',[SanPhamAPIController::class,'GiaTang']);

route::get('gia-giam',[SanPhamAPIController::class,'GiaGiam']);
//------------------BÌNH LUẬN---------------------------

route::post('luu-binh-luan', [BinhLuanAPIController::class, 'ThemBinhLuanCapMot']);
route::get('danh-sach-binh-luan-cap-mot/{id}', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapMot']);

Route::post('/tim-binh-luan',[BinhLuanAPIController::class,'TimBinhLuan'])->middleware('api');

route::post('luu-binh-luan-cap-hai', [BinhLuanAPIController::class, 'ThemBinhLuanCapHai']);
route::post('danh-sach-binh-luan-cap-hai', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapHai']);

//-----------------LOAI----------------------------

route::get('danh-sach-loai',[LoaiAPIController::class,'DanhSachLoai']);

//---------------------HOÁ ĐƠN-------------------


route::post('thanh-toan',[HoaDonAPIController::class,'ThanhToan']);
