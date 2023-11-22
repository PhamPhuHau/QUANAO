<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Nha_Cung_Cap;
use App\models\Loai;
use App\models\Mau;
use App\models\Size;
use App\models\Nhap_Hang;
use App\models\Chi_Tiet_Nhap_Hang;
use App\models\San_Pham;
use App\models\Chi_Tiet_San_Pham;
class SanPhamController extends Controller
{
    public function view()
    {
        $san_Pham = San_Pham::all();
        return view('SANPHAM/danh-sach',compact('san_Pham'));
            
    }
    public function lsnhaphang()
    {
        return view('NHAPHANG/lich-su-nhap-hang');
    }
    public function themMoi()
    {
        $nha_Cung_Cap = Nha_Cung_Cap::all();
        $loai = Loai::all();
        $mau = Mau::all();
        $size = Size::all();
        return view('NHAPHANG/danh-sach',compact('nha_Cung_Cap','loai','mau','size'));
    }

    public function xuLyThemMoi(Request $request)
    {
        if (empty($request->nha_cung_cap)) {
            return redirect()->route('SAN-PHAM.nhap-hang')->with('thong_bao', 'vui lòng nhập đầy đủ thông tin');
        }
       
        $nhap_Hang = new Nhap_Hang();
        $nhap_Hang->tong_tien = 0;
        $nhap_Hang->nha_cung_cap_id = (int)$request->nha_cung_cap;
        $nhap_Hang->trang_thai = 1;
        $nhap_Hang->save();
        $tong_Tien = 0;
        for($i = 0; $i < count($request->ten) ; $i++){
             
            $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
            $tong_Tien += $thanh_Tien;
            $san_Pham = San_Pham::where('ten', $request->ten[$i])->first();
            if(empty($san_Pham)){
                if($request->so_Luong[$i] == null || $request->gia_Nhap[$i] == null || $request->gia_Ban[$i] == null || $request->loai[$i] == null || $request->mau[$i] == null || $request->size[$i] == null){
                    continue;
                }
                $san_Pham = new San_Pham();
                $san_Pham->ten = $request->ten[$i];
                $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
                $san_Pham->gia_ban	= (double)$request->gia_Ban[$i];
                $san_Pham->so_luong = (int)$request->so_Luong[$i];
                $san_Pham->trang_thai = 1;
                $san_Pham->save();

                $chi_Tiet_San_Pham = new Chi_Tiet_San_Pham();
                $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                $chi_Tiet_San_Pham->save();
            }

            $chi_Tiet_San_Pham = Chi_Tiet_San_Pham::where('san_pham_id',$san_Pham->id)->where('mau_id',$request->mau)->where('loai_id',$request->loai)->where('size_id',$request->size)->first();

            if(empty($chi_Tiet_San_Pham))
            {
                $chi_Tiet_San_Pham = new Chi_Tiet_San_Pham();
                $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                $chi_Tiet_San_Pham->save();
            }
            else{

                if(!empty($request->gia_Nhap[$i])){
                    $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
                }
                if (!empty($request->gia_Ban[$i])) {
                    $san_Pham->gia_ban = (double)$request->gia_Ban[$i];
                }
                
                
                $san_Pham->so_luong += (int)$request->so_Luong[$i];
                $san_Pham->trang_thai = 1;
                $san_Pham->save();


                $chi_Tiet_San_Pham = Chi_Tiet_San_Pham::where('san_pham_id',$san_Pham->id)->first();
                if(!empty($request->mau[$i])){
                    $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                }
                if(!empty($request->size[$i])){
                    $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                }

                if(!empty($request->loai[$i])){
                    $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                }
                $chi_Tiet_San_Pham->save();
            }

            $chi_Tiet_Nhap_Hang = new Chi_Tiet_Nhap_Hang();
            $chi_Tiet_Nhap_Hang->nhap_hang_id = (int)$nhap_Hang->id;
            $chi_Tiet_Nhap_Hang->san_pham_id = (int)$san_Pham->id;
            $chi_Tiet_Nhap_Hang->gia_nhap = (double)$request->gia_Nhap[$i];
            $chi_Tiet_Nhap_Hang->gia_ban = (double)$request->gia_Ban[$i];
            $chi_Tiet_Nhap_Hang->so_luong = (int)$request->so_Luong[$i];
            $chi_Tiet_Nhap_Hang->thanh_tien	= (double)$thanh_Tien;
            $chi_Tiet_Nhap_Hang->save();

            
        }
        $nhap_Hang->tong_tien = $tong_Tien;
        $nhap_Hang->save();
        return redirect()->route('SAN-PHAM.danh-sach');
    }

    public function view_Chi_Tiet($id)
    {
        $CT_San_Pham = Chi_Tiet_San_Pham::where('san_pham_id',$id)->get();
        $san_Pham = San_Pham::where('id',$id)->first();
        return view('SANPHAM/danh-sach-chi-tiet',compact('CT_San_Pham','san_Pham'));
    }
}
