<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\ChiTietSanPham;
use App\Models\SlideShow;


class SanPhamAPIController extends Controller
{
    public function DanhSachSanPham(){
        $sanPham = SanPham::orderBy('id', 'desc')->get();

        foreach($sanPham as $item)
        {
            $item->hinh_anh;

        }
        $slideShow = SlideShow::all();
        return response()->json([
            'success' => true,
            'data' => $sanPham,
            'dataSlideShow' => $slideShow
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

    public function TimKiemGiaTang($ten)
    {
        $sanPham = SanPham::where('ten', 'like', '%' . $ten . '%')->orderBy('gia_ban', 'asc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function TimKiemGiaGiam($ten)
    {
        $sanPham = SanPham::where('ten', 'like', '%' . $ten . '%')->orderBy('gia_ban', 'desc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }


    public function TimKiem($ten, request $request)
    {
        if(isset($request->giaTu) && $request->giaDen)
        {
            $sanPham= SanPham::where('ten', 'like', '%' . $ten . '%')->whereBetween('gia_ban', [$request->giaTu, $request->giaDen])->orderBy('id', 'desc')->get();
            foreach($sanPham as $item)
            {
                $item->hinh_anh;
            }
        }
        else{
            $sanPham = SanPham::where('ten','like','%'.$ten.'%')->orderBy('id', 'desc')->get();
            foreach($sanPham as $item)
            {
                $item->hinh_anh;
            }
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function LocLoaiSanPham($idLoai, request $request)
    {
        if(isset($request->giaTu) && $request->giaDen)
        {
            $sanPham = SanPham::where('loai_id',$idLoai)->whereBetween('gia_ban', [$request->giaTu, $request->giaDen])->orderBy('id', 'desc')->get();
        }
        else
        {
            $sanPham = SanPham::where('loai_id',$idLoai)->get();
        }


        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function GiaTang()
    {
        $sanPham = SanPham::orderBy('gia_ban', 'asc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function GiaGiam()
    {
        $sanPham = SanPham::orderBy('gia_ban', 'desc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }


}
