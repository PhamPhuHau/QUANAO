<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SanPhamController;
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

Route::get('/', function () {
    return view('ADMIN/trang-chu');
});

/*-----------------------SANPHAM-------------------- */

Route::name('San_Pham_')->group(function(){
    Route::get('/san-pham-danh-sach', function () {
        return view('SANPHAM/danh-sach');
    })->name('Danh_Sach');
    Route::get('/cap-nhat-san-pham', function () {
        return view('SANPHAM/cap-nhat');
    })->name('Cap_Nhat');

    Route::get('Nhap',[SanPhamController::class,'View']);
});

/*-----------------------LOAI-------------------- */

Route::name('Loai_')->group(function(){
    Route::get('/loai-danh-sach', function () {
        return view('LOAI/danh-sach');
    })->name('Danh_Sach');
});

/*-----------------------MAU-------------------- */

Route::name('Mau_')->group(function(){
    Route::get('/mau-danh-sach', function () {
        return view('MAU/danh-sach');
    })->name('Danh_Sach');
});

/*----------------------------------------------------------------------------*/
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

