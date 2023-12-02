<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class SanPhamAPIController extends Controller
{
    public function Danh_Sach_San_Pham(){
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
}
