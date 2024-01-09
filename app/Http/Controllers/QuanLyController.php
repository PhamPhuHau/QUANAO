<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\QuanLy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\KhachHang;
use App\Models\SanPham;
use App\Models\NhapHang;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;

class QuanLyController extends Controller
{
    public function dangNhap()
    {
        return view('QUANLY.dang-nhap');
    }
    public function trangChu()
    {
        $khachHang = KhachHang::all();
        $demSanPham = SanPham::all();
        $nhapHang = NhapHang::all();
        $namHienTai = now()->year;
        $HoaDon = HoaDon::whereYear('created_at', $namHienTai)->get();
        $chiTietHoaDon = ChiTietHoaDon::select('chi_tiet_san_pham_id', \DB::raw('count(*) as count'))
        ->groupBy('chi_tiet_san_pham_id')
        ->orderByDesc('count')
        ->with('chi_tiet_san_pham')
        ->first();


        $hoaDonNhieuNhat = HoaDon::select('khach_hang_id', \DB::raw('count(*) as count'))
        ->groupBy('khach_hang_id')
        ->orderByDesc('count')
        ->with('khach_hang')
        ->first();

        $sanPham = SanPham::latest()->take(5)->get();
      
        
        return view('ADMIN.trang-chu', [
            'khachHang' => $khachHang,
            'demSanPham' => $demSanPham,
            'nhapHang' => $nhapHang,
            'HoaDon' => $HoaDon,
            'sanPham' => $sanPham,
            'namHienTai' => $namHienTai,
            'hoaDonNhieuNhat' => $hoaDonNhieuNhat,
            'chiTietHoaDon' => $chiTietHoaDon,
        ]);
        
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
