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
Route::prefix('SAN-PHAM')->group(function(){
    Route::name('SAN-PHAM.')->group(function(){
        Route::get('/san-pham-danh-sach', function () {
            return view('SANPHAM/danh-sach');
        })->name('danh-sach');
        Route::get('/cap-nhat', function () {
            return view('SANPHAM/cap-nhat');
        })->name('cap-nhat');

        Route::get('nhap-hang',[SanPhamController::class,'View'])->name('nhap-hang');
    });
});

/*-----------------------LOAI-------------------- */
Route::prefix('LOAI')->group(function(){
    Route::name('LOAI.')->group(function(){
        Route::get('/danh-sach', function () {
            return view('LOAI/danh-sach');
        })->name('danh-sach');
    });
});

/*-----------------------MAU-------------------- */
Route::prefix('MAU')->group(function(){
    Route::name('MAU.')->group(function(){
        Route::get('/mau-danh-sach', function () {
            return view('MAU/danh-sach');
        })->name('danh-sach');
    });
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

