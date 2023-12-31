<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\SanPham;
class DanhGiaAPIController extends Controller
{
    public function ThemDanhGia(Request $request)
    {
        $danhGia = DanhGia::where('san_pham_id',$request->san_pham)->where('khach_hang_id', $request->KhachHang)->first();
        if(empty($danhGia))
        {
            $danhGia = new DanhGia();
            $danhGia->khach_hang_id = $request->KhachHang;
            $danhGia->san_pham_id = $request->san_pham;
            $danhGia->so_sao = $request->SoSao;
            $danhGia->nhan_xet = $request->NhanXet;
            $danhGia->save();
        }
        else
        {
            $danhGia->so_sao = $request->SoSao;
            $danhGia->nhan_xet = $request->NhanXet;
            $danhGia->save();
        }

        $danhGia = DanhGia::where('san_pham_id',$request->san_pham)->get();
       
        $sanPham= SanPham::where('id', $request->san_pham)->first();
        $sanPham->so_sao = ($sanPham->so_sao+$request->SoSao)/ $danhGia->count();
        $sanPham->save();
        
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }

    public function LayDanhGia($id)
    {
        $danhGia = DanhGia::where('san_pham_id',$id)->get();
        foreach($danhGia as $DanhSachDanhGia)
        {
            $DanhSachDanhGia->khach_hang;
        }
        return response()->json([
            'message' => 'thanh cong',
            'data' => $danhGia
        ]);
    }
}
