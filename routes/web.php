<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;

use App\Http\Controllers\MauController;

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\QuanLyController;


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
Route::middleware('auth')->group(function(){
Route::get('/', [QuanLyController::class, 'trangChu'])->name('ADMIN.trang-chu');
/*-----------------------SANPHAM-------------------- */
Route::prefix('SAN-PHAM')->group(function(){
    Route::name('SAN-PHAM.')->group(function(){
        Route::get('/danh-sach',[SanPhamController::class,'view'] )->name('danh-sach');
        Route::get('/cap-nhat', function () {
            return view('SANPHAM/cap-nhat');
        })->name('cap-nhat');

        Route::get('nhap-hang',[SanPhamController::class,'themMoi'])->name('nhap-hang');
        Route::post('nhap-hang',[SanPhamController::class,'xuLyThemMoi'])->name('xl-nhap-hang');
    });
});
/*-----------------------LOAI-------------------- */
Route::prefix('LOAI')->group(function(){
    Route::name('LOAI.')->group(function(){
        Route::get('danh-sach',[LoaiController::class,'View'])->name('danh-sach');
        Route::get("/them",[LoaiController::class, 'themMoi'])->name('them');
        Route::post("/them",[LoaiController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get("/cap-nhat/{id}",[LoaiController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[LoaiController::class, 'xlEdit'])->name('xl-cap-nhat');
        Route::get("/xoa/{id}",[LoaiController::class, 'Delete'])->name('xoa');
    });
});
/*-----------------------MAU-------------------- */
Route::prefix('MAU')->group(function(){
    Route::name('MAU.')->group(function(){

    Route::get('/danh-sach-mau',[MauController::class,'View'])->name('danh-sach');
    Route::get("/them",[MauController::class, 'themMoi'])->name('them');
    Route::post("/them",[MauController::class, 'xuLyThemMoi'])->name('xl-them');

    Route::get("/cap-nhat/{id}",[MauController::class, 'Edit'])->name('cap-nhat');
    Route::post("/cap-nhat/{id}",[MauController::class, 'xlEdit'])->name('xl-cap-nhat');

    Route::get("/xoa/{id}",[MauController::class, 'Delete'])->name('xoa');
});
});
/*-----------------------------------SIZE-----------------------------------------*/
Route::prefix('SIZE')->group(function(){
    Route::name('SIZE.')->group(function(){
        Route::get('/danh-sach-size',[SizeController::class,'View'])->name('danh-sach');
        Route::get("/them",[SizeController::class, 'themMoi'])->name('them');
        Route::post("/them",[SizeController::class, 'xuLyThemMoi'])->name('xl-them');

        Route::get("/cap-nhat/{id}",[SizeController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[SizeController::class, 'xlEdit'])->name('xl-cap-nhat');

        Route::get("/xoa/{id}",[SizeController::class, 'Delete'])->name('xoa');

    });
});
Route::get('/dang-xuat',[QuanLyController::class,'dangXuat'])->name('dang-xuat');
Route::get('/thong-tin',[QuanLyController::class,'thongTinhNguoiDung'])->name('thong-tin');
});

//-------------------QUANLY-----------------------
Route::middleware('guest')->group(function(){
Route::get('/dang-nhap',[QuanLyController::class, 'dangNhap'])->name('dang-nhap');

Route::post('/dang-nhap',[QuanLyController::class, 'xuLyDangNhap'])->name('xl-dang-nhap');
});


