<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSanPham;
use App\Models\SanPham;
use App\Models\Mau;
use App\Models\Size;

class HoaDonAPIController extends Controller
{
    public function ThanhToan(Request $request)
    {
   
        //tạo mới hoá đơn
        $hoaDon = new HoaDon();
        
        $hoaDon->khach_hang_id = $request->khach_hang;
        
        $hoaDon->tong_tien = $request->tong_tien;
        
        $hoaDon->trang_thai = 1;
        $hoaDon->save();

        for($i = 0; $i < count($request->ten) ; $i++){ 
            
            $mau = Mau::where('ten',$request->mau[$i])->first();
            $size = Size::where('ten',$request->size[$i])->first();    
            $sanPham = SanPham::where('ten',$request->ten[$i])->first();
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$sanPham->id)->where('mau_id',$mau->id)->where('size_id',$size->id)->first();
           
            if($chiTietSanPham)
            {
            $chiTietHoaDon = new ChiTietHoaDon(); 
            $chiTietHoaDon->hoa_don_id = $hoaDon->id;
            $chiTietHoaDon->chi_tiet_san_pham_id = $chiTietSanPham->id;
            $chiTietHoaDon->so_luong = (int)$request->so_luong[$i];
            $chiTietHoaDon->thanh_tien =  (int) $request->so_luong[$i] * $request->gia[$i] ;
            $chiTietHoaDon->save();

            $chiTietSanPham->so_luong -= (int)$request->so_luong[$i];
            $chiTietSanPham->save();

            $sanPham->so_luong -= (int)$request->so_luong[$i];
            $sanPham->save();
            }
        }

        //truyền thông tin vào hoá đơn
        return response()->json([
            
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon->id,
        ]);
    }
    public function KiemTraDonHang(Request $request)
    {
        $hoaDon = HoaDon::where('id',$request->hdID)->first();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
        ]);
    }


    public function ThanhCong(Request $request)
    {
        $hoaDon = HoaDon::where('id',$request->hdID)->first();
        $hoaDon->trang_thai = 4;
        $hoaDon->save();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
        ]);
    }
    
}
