<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuanCapMot;

class BinhLuanAPIController extends Controller
{
    public function ThemBinhLuanCapMot(Request $request)  
    {
        $binhLuan = new BinhLuanCapMot();
        $binhLuan->san_pham_id=$request->san_pham_id;
        $binhLuan->khach_hang_id=$request->khach_hang_id;
        $binhLuan->noi_dung=$request->noi_dung;
        $binhLuan->save();
        
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }
   
    
    public function  DanhSachBinhLuanCapMot($id){
        $binhLuan = BinhLuanCapMot::where('san_pham_id',$id)->get();
        foreach ($binhLuan as $bl) {
            // Nếu có, in ra thông tin
            $bl->khach_hang;
        }
        return response()->json([
            'success' => true,
            'data' => $binhLuan
        ]);
    }
}
