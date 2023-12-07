<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
class TaiKhoanController extends Controller
{
    public function View()
    {
        $khachHang = KhachHang::paginate(9);
        return view('TAIKHOAN/danh-sach',compact('khachHang'));
    }
    public function HienKhoa()
    {
    $khachHang = KhachHang::onlyTrashed()->paginate(9);
       return view('TAIKHOAN/danh-sach-khoa',compact('khachHang'));
    }
    public function Khoa($id)
    {
         $khachHang = KhachHang::where('id',$id);
         $khachHang->delete();
         return redirect()->route('tai-khoan.danh-sach');
    }

    public function MoKhoa($id)
    {
         $khachHang = KhachHang::where('id',$id);
         $khachHang->restore();
         return redirect()->route('tai-khoan.danh-sach');
    }
}
