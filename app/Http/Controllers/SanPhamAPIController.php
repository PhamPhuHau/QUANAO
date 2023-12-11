<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\ChiTietSanPham;


class SanPhamAPIController extends Controller
{
    public function DanhSachSanPham(){
        $sanPham = SanPham::orderBy('id', 'desc')->get();

        foreach($sanPham as $item)
        {
            $item->hinh_anh;

        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function ChiTietSanPham($id){
        $sanPham = SanPham::where('id',$id)->first();
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$id)->get();

        $sanPham->nha_cung_cap;
        $sanPham ->hinh_anh;
        foreach ($chiTietSanPham as $ctsp) {

                        // Nếu có, in ra thông tin
            $ctsp->size;
            $ctsp->loai;
            $ctsp->mau;
        }


        return response()->json([
            'success' => true,
            'data' => $sanPham,
            'data2' => $chiTietSanPham,
        ]);

    }

    public function TimKiem($ten)
    {
        $sanPham = SanPham::where('ten','like','%'.$ten.'%')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

}
