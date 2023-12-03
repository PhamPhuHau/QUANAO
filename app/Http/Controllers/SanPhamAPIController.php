<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

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
        
       
        
        $sanPham ->hinh_anh;
        
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }
}
