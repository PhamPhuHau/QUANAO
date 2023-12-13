<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuanCapMot;
use App\Models\BinhLuanCapHai;

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
            $bl->binh_luan_cap_hai->load('khach_hang');
        }
        return response()->json([
            'success' => true,
            'data' => $binhLuan
        ]);
    }


    public function ThemBinhLuanCapHai(Request $request)  
    {
        $binhLuan = new BinhLuanCapHai();
        $binhLuan->binh_luan_cap_mot_id=$request->binh_luan_cap_mot_id;
        $binhLuan->san_pham_id=$request->san_pham_id;
        $binhLuan->khach_hang_id=$request->khach_hang_id;
        $binhLuan->noi_dung=$request->noi_dung;
        $binhLuan->save();
        
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }
    // public function  DanhSachBinhLuanCapHai(Request $request){
    //     $binhLuan = BinhLuanCapHai::where('binh_luan_cap_mot_id',$request->binh_luan_cap_mot)->get();
    //     foreach ($binhLuan as $bl) {
    //         // Nếu có, in ra thông tin
    //         $bl->khach_hang;
    //         $bl->binh_luan_cap_hai;
    //     }
    //     return response()->json([
    //         'success' => true,
    //         'data' => $binhLuan
    //     ]);
    // }
    
    public function TimBinhLuan(request $request)
    {
        $binhLuan = ThemBinhLuanCapMot::where('id',$request->id)->first();
        return response()->json([
            'success' => true,
            'data' => $binhLuan,
        ]);
    }
}
