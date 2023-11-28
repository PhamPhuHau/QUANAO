<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\NhaCungCap;
use App\models\Loai;
use App\models\Mau;
use App\models\Size;
use App\models\NhapHang;
use App\models\ChiTietNhapHang;
use App\models\SanPham;
use App\models\ChiTietSanPham;
use App\models\HinhAnh;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    public function view()
    {
        $san_Pham = SanPham::all();
        return view('SANPHAM/danh-sach',compact('san_Pham'));

    }
    public function lsNhapHang()
    {
        $nhap_Hang = NhapHang::all();
        return view('NHAPHANG/lich-su-nhap-hang',compact('nhap_Hang'));
    }
    public function lsChiTietNhapHang($id)
    {
        $ChiTietNhapHang = ChiTietNhapHang::where('NhapHang_id',$id)->get();

        dd($ChiTietNhapHang);
    }
    public function themMoi()
    {
        $nha_Cung_Cap = NhaCungCap::all();
        $loai = Loai::all();
        $mau = Mau::all();
        $size = Size::all();
        return view('NHAPHANG/danh-sach',compact('nha_Cung_Cap','loai','mau','size'));
    }
    public function Delete($id)
    {
        $san_Pham=SanPham::find($id);
        if(empty($san_Pham))
        {
            return redirect()->route("san-pham.danh-sach");
        }
        $san_Pham->delete();
        return redirect()->route("san-pham.danh-sach");
    }

    public function xuLyThemMoi(Request $request)
    {

        //if này kiểm tra xem đã có nhà cung cấp và tên chưa nếu chưa có thì 1 trong 2 thì sẽ trả về thông báo
        if (empty($request->nha_cung_cap) || empty($request->ten)) {
            return redirect()->route('san-pham.nhap-hang')->with('thong_bao', 'vui lòng nhập đầy đủ thông tin');
        }

       //tạo mới nhập hàng
        $NhapHang = new NhapHang();
        $NhapHang->tong_tien = 0;
        $NhapHang->nha_cung_cap_id = (int)$request->nha_cung_cap;
        $NhapHang->trang_thai = 1;
        $NhapHang->save();
        //biến dùng để tính lại tổng tiền từng thành tiền của sản phẩm cộng lại
        $tong_Tien = 0;

        for($i = 0; $i < count($request->ten) ; $i++){
            //biến này dùng để lưu thanhf tiền từng sản phẩm
            $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
            $tong_Tien += $thanh_Tien;
            $san_Pham = SanPham::where('ten', $request->ten[$i])->first();
            //if này kiểm tra sản phẩm có tồn tại chưa nếu chưa thì sẽ tạo 1 sản phẩm mới
            if(empty($san_Pham)){

                //if này kiểm tra xem người dùng đã ghi đầy đủ thông tin chưa nếu chưa thì sẽ bỏ qua sản phẩm đó
                if($request->so_Luong[$i] == null || $request->gia_Nhap[$i] == null || $request->gia_Ban[$i] == null || $request->loai[$i] == null || $request->mau[$i] == null || $request->size[$i] == null){
                    continue;
                }

                $san_Pham = new SanPham();
                $san_Pham->ten = $request->ten[$i];
                $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
                $san_Pham->gia_ban	= (double)$request->gia_Ban[$i];
                $san_Pham->so_luong = (int)$request->so_Luong[$i];
                $san_Pham->thong_tin=$request->Thong_Tin[$i];
                $san_Pham->trang_thai = 1;
                $san_Pham->save();

                $chi_Tiet_San_Pham = new ChiTietSanPham();
                $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
                $chi_Tiet_San_Pham->save();
            }
            else
            {
                $chi_Tiet_San_Pham = ChiTietSanPham::where('san_pham_id',$san_Pham->id)->where('mau_id',$request->mau)->where('loai_id',$request->loai)->where('size_id',$request->size)->first();
                //if này kiểm tra xem màu trong chi tiết đó có tồn tại chưa nếu chưa tồn tại thì sẽ tạo mới
                //nếu đã tông tại thì sẽ update số lượng và các thay đổi đã nhập vào
                if(empty($chi_Tiet_San_Pham))
                {
                    $chi_Tiet_San_Pham = new ChiTietSanPham();
                    $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                    $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                    $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                    $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                    $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
                    $chi_Tiet_San_Pham->save();
                }
                else
                {
                    if(!empty($request->gia_Nhap[$i])){
                        $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
                    }

                    if (!empty($request->gia_Ban[$i])) {
                        $san_Pham->gia_ban = (double)$request->gia_Ban[$i];
                    }
                    if(!empty($request->mau[$i])){
                        $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                    }
                    if(!empty($request->size[$i])){
                        $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                    }

                    if(!empty($request->loai[$i])){
                        $chi_Tiet_San_Pham->loai_id = (int)$request->loai[$i];
                    }
                    $chi_Tiet_San_Pham->so_luong += (int)$request->so_Luong[$i];
                    $chi_Tiet_San_Pham->save();
                }




                $san_Pham->so_luong += (int)$request->so_Luong[$i];
                $san_Pham->trang_thai = 1;
                 $san_Pham->thong_tin=$request->Thong_Tin[$i];
                $san_Pham->save();
            }



            $ChiTietNhapHang = new ChiTietNhapHang();
            $ChiTietNhapHang->nhap_hang_id = (int)$NhapHang->id;
            $ChiTietNhapHang->san_pham_id = (int)$san_Pham->id;
            $ChiTietNhapHang->gia_nhap = (double)$request->gia_Nhap[$i];
            $ChiTietNhapHang->gia_ban = (double)$request->gia_Ban[$i];
            $ChiTietNhapHang->so_luong = (int)$request->so_Luong[$i];
            $ChiTietNhapHang->thanh_tien	= (double)$thanh_Tien;
            $ChiTietNhapHang->save();


        }
        $NhapHang->tong_tien = $tong_Tien;
        $NhapHang->save();
        return redirect()->route('san-pham.danh-sach');
    }

    public function view_Chi_Tiet($id)
    {
        $CT_San_Pham = ChiTietSanPham::where('san_pham_id',$id)->get();

        $san_Pham = SanPham::where('id',$id)->first();
        $hinh_Anh = HinhAnh::where('san_pham_id',$id)->get();
        return view('SANPHAM/danh-sach-chi-tiet',compact('CT_San_Pham','san_Pham','hinh_Anh'));
    }

    public function them_Anh(Request $request,$id)
    {
        $files = $request->HinhAnh;
        if($files)
        {
            foreach ($files as $file) {
                $HinhAnh= new HinhAnh();
                $HinhAnh->url = $file->store('Hinh_Anh');
                $HinhAnh->san_pham_id = $id;
                $HinhAnh->save();
            }
        }
        return redirect()->route('san-pham.chi-tiet-san-pham', $id)->with('success', 'Thêm ảnh thành công');

    }
    public function xoa_Anh($id)
    {
        $hinhAnh = HinhAnh::find($id);

        if ($hinhAnh) {
            Storage::delete($hinhAnh->url);

            $hinhAnh->delete();

            return redirect()->back()->with('success', 'Xóa ảnh thành công');
        }
        

}
    public function xu_Ly_Sua(Request $request)
    {
        
        $san_Pham = SanPham::where('id',$request->id)->first();
        $san_Pham->ten = $request->ten;
        $san_Pham->save();
        return response()->json([
            'success' => true,
            'message' => 'sửa thành công'
        ]);
    }
}
