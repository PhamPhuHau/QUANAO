<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\QuanLy;
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
        $request->validate([
            'ten_dang_nhap'=>'required',
            'password'=>'required|min:6',
        ],[
            'ten_dang_nhap.required'=>'không được để trống',
            'password.required' => 'không được để trống mật khẩu',
            'password.min' => 'mật khẩu có ít nhất 6 ký tự',
        ]);


        if (Auth::attempt(['ten_dang_nhap' => $request->ten_dang_nhap, 'password' => $request->password])) {
            return redirect()->route('quan-ly.trang-chu');
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
