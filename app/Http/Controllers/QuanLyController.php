<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quan_Ly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QuanLyController extends Controller
{
    public function dangNhap()
    {
        return view('QUANLY.dang-nhap');
    }
    public function trangChu(Request $request)
    {
        return view('ADMIN.trang-chu');
    }
    public function xuLyDangNhap(Request $request)
    {
        if (Auth::attempt(['ten_dang_nhap' => $request->ten_dang_nhap, 'password' => $request->password])) {
            return redirect()->route('ADMIN.trang-chu');
        }

    return redirect()->route('dang-nhap');
    }
    public function thongTinNguoiDung()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user;
        }
        return 'Chưa đăng nhập';
    }
    public function dangXuat(Request $request)
{
    Auth::logout();
    return redirect()->route('dang-nhap');
}

}
