<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;

use App\Http\Controllers\MauController;
use App\Http\Controllers\NhaCungCapController;

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\QuanLyController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\BinhLuanController;


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
Route::get('/', [QuanLyController::class, 'trangChu'])->name('quan-ly.trang-chu');
/*-----------------------SANPHAM-------------------- */
Route::prefix('san-pham')->group(function(){
    Route::name('san-pham.')->group(function(){
        Route::get('/danh-sach',[SanPhamController::class,'view'] )->name('danh-sach');
        Route::get('/cap-nhat', function () {
            return view('SANPHAM/cap-nhat');
        })->name('cap-nhat');

        Route::get('nhap-hang',[SanPhamController::class,'themMoi'])->name('nhap-hang');
        Route::post('nhap-hang',[SanPhamController::class,'xuLyThemMoi'])->name('xl-nhap-hang');
        Route::get('nhap-so-luong',[SanPhamController::class,'themSoLuong'])->name('nhap-so-luong');
        Route::get('lay-thong-tin-san-pham-loai',[SanPhamController::class,'layThongTinLoai'])->name('lay-thong-tin-san-pham-loai');
        Route::get('lay-thong-tin-san-pham-mau',[SanPhamController::class,'layThongTinMau'])->name('lay-thong-tin-san-pham-mau');
        Route::get('lay-thong-tin-san-pham-size',[SanPhamController::class,'layThongTinSize'])->name('lay-thong-tin-san-pham-size');
        Route::post('xu-ly-them-so-luong',[SanPhamController::class,'xuLyThemSoLuong'])->name('xu-ly-them-so-luong');

        Route::get("/xoa/{id}",[SanPhamController::class, 'Delete'])->name('xoa');

        Route::get('lich-su-nhap-hang',[SanPhamController::class,'lsNhapHang'])->name('lich-su-nhap-hang');
        Route::get('lich-su-chi-tiet-nhap-hang/{id}',[SanPhamController::class,'lsChiTietNhapHang'])->name('lich-su-chi-tiet-nhap-hang');
        Route::get('san-pham/{id}',[SanPhamController::class,'view_Chi_Tiet'])->name('chi-tiet-san-pham');
        Route::post('san-pham/{id}',[SanPhamController::class,'them_Anh'])->name('them-anh');
        Route::get('xoa-anh/{id}', [SanPhamController::class, 'xoa_Anh'])->name('xoa-anh');
        Route::post("sua",[SanPhamController::class,'xu_Ly_Sua'])->name('sua');

    });
});
/*-----------------------LOAI-------------------- */
Route::prefix('loai')->group(function(){
    Route::name('loai.')->group(function(){
        Route::get('danh-sach',[LoaiController::class,'View'])->name('danh-sach');
        Route::get("/them",[LoaiController::class, 'themMoi'])->name('them');
        Route::post("/them",[LoaiController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get("/cap-nhat/{id}",[LoaiController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[LoaiController::class, 'xlEdit'])->name('xl-cap-nhat');
        Route::get("/xoa/{id}",[LoaiController::class, 'Delete'])->name('xoa');
    });
});
/*-----------------------MAU-------------------- */
Route::prefix('mau')->group(function(){
    Route::name('mau.')->group(function(){

    Route::get('/danh-sach',[MauController::class,'View'])->name('danh-sach');
    Route::get("/them",[MauController::class, 'themMoi'])->name('them');
    Route::post("/them",[MauController::class, 'xuLyThemMoi'])->name('xl-them');

    Route::get("/cap-nhat/{id}",[MauController::class, 'Edit'])->name('cap-nhat');
    Route::post("/cap-nhat/{id}",[MauController::class, 'xlEdit'])->name('xl-cap-nhat');

    Route::get("/xoa/{id}",[MauController::class, 'Delete'])->name('xoa');
});
});
/*-----------------------------------SIZE-----------------------------------------*/
Route::prefix('size')->group(function(){
    Route::name('size.')->group(function(){
        Route::get('/danh-sach',[SizeController::class,'View'])->name('danh-sach');
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
//----------------------------------NHACUNGCAP--------------------------------------------
Route::prefix('nha-cung-cap')->group(function(){
    Route::name('nha-cung-cap.')->group(function(){
        Route::get('/danh-sach',[NhaCungCapController::class,'View'])->name('danh-sach');
        Route::get("/them",[NhaCungCapController::class, 'themMoi'])->name('them');
        Route::post("/them",[NhaCungCapController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get("/xoa/{id}",[NhaCungCapController::class, 'Delete'])->name('xoa');
        Route::get("/cap-nhat/{id}",[NhaCungCapController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[NhaCungCapController::class, 'xlEdit'])->name('xl-cap-nhat');
    });
});

//-------------------QUANLY-----------------------
Route::middleware('guest')->group(function(){
Route::get('/dang-nhap',[QuanLyController::class, 'dangNhap'])->name('dang-nhap');

Route::post('/dang-nhap',[QuanLyController::class, 'xuLyDangNhap'])->name('xl-dang-nhap');
});


//-----------------------------------------HOADON-------------------------------------------------
Route::prefix('hoa-don')->group(function(){
    Route::name('hoa-don.')->group(function(){
        Route::get('/danh-sach',[HoaDonController::class,'View'])->name('danh-sach');
    });
});

//-----------------------------------------DONHANG-------------------------------------------------
Route::prefix('don-hang')->group(function(){
    Route::name('don-hang.')->group(function(){
        Route::get('/danh-sach',[DonHangController::class,'View'])->name('danh-sach');
    });
});

//-----------------------------------------TAIKHOAN-------------------------------------------------
Route::prefix('tai-khoan')->group(function(){
    Route::name('tai-khoan.')->group(function(){
        Route::get('/danh-sach',[TaiKhoanController::class,'View'])->name('danh-sach');
    });
});

//-----------------------------------------BINHLUAN-------------------------------------------------
Route::prefix('binh-luan')->group(function(){
    Route::name('binh-luan.')->group(function(){
        Route::get('/danh-sach',[BinhLuanController::class,'View'])->name('danh-sach');
    });
});