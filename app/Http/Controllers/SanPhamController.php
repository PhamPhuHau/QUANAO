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
        // $san_Pham = SanPham::all();
        $san_Pham = SanPham::paginate(9);
        return view('SANPHAM/danh-sach',compact('san_Pham'));


    }

    public function lsNhapHang()
    {
        $nhap_Hang = NhapHang::all();
        return view('NHAPHANG/lich-su-nhap-hang',compact('nhap_Hang'));
    }

    public function lsChiTietNhapHang($id)
    {
        $ChiTietNhapHang = ChiTietNhapHang::where('nhap_hang_id',$id)->get();
       
        return view('NHAPHANG/lich-su-chi-tiet-nhap-hang',compact('ChiTietNhapHang'));
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

    public function themSoLuong()
    {
        $danhSachSanPham = SanPham::all();
        return view('NHAPHANG/nhap-hang-so-luong',compact('danhSachSanPham'));
    }
    public function layThongTinloai(Request $request)
    {
        $sanPham = SanPham::where('id',$request->id)->get();
       
       
        foreach ($sanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
           
                // Nếu có, in ra thông tin
                
                $loai[]=$ctsp->loai;
               
            
        }
        
        return response()->json([
            'success' => true,
            
            'data' => $sanPham,
            'message' => 'sửa thành công'
        ]);
    }


    public function layThongTinMau(Request $request)
    {
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->get();
        $size=[];
        $loai=[];
        $mau=[];
        
        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về size");
            }
        }
        
        return response()->json([
            'success' => true,
            'data' => $chiTietSanPham,
            'message' => 'sửa thành công'
        ]);
    }


    public function layThongTinSize(Request $request)
    {
        
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->where('mau_id',$request->mau)->get();
        $size=[];
        $loai=[];
        $mau=[];
        
        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về size");
            }
        }
        
        return response()->json([
            'success' => true,
            
            'data' => $chiTietSanPham,
            'message' => 'sửa thành công'
        ]);
    }

    public function xuLyThemSoLuong(Request $request)
    {
       
        $nhapHang = ChiTietNhapHang::where('san_pham_id',$request->san_Pham)->first();
        $sanPham = SanPham::where('id',$request->san_Pham)->first();
        $sanPham->so_luong += (int)$request->so_Luong;
        $nhaCungCap = $nhapHang->nhap_hang->nha_cung_cap_id;

        $nhapHang = new NhapHang();
        $nhapHang->tong_tien = 0;
        $nhapHang->nha_cung_cap_id = (int)$nhaCungCap;
        
        $nhapHang->save();

        $chiTietNhapHang = new ChiTietNhapHang();
        $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
        $chiTietNhapHang->san_pham_id = $request->san_Pham;
        $chiTietNhapHang->so_luong = (int)$request->so_Luong;
        
        if($request->gia_Nhap==null)
        {
            $chiTietNhapHang->gia_nhap = $sanPham->gia_nhap;
            $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $sanPham->gia_nhap;
        }
        else
        {
             $chiTietNhapHang->gia_nhap = $request->gia_Nhap;
             $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $request->gia_Nhap;
        }
        if($request->gia_Ban==null)
        {
            $chiTietNhapHang->gia_ban = $sanPham->gia_ban;
        }
        else 
        {
            $chiTietNhapHang->gia_ban = $request->gia_Ban;
        }
        if($request->thong_tin!=null)
        {
            $sanPham->thong_tin = $request->thong_Tin;  
        }

        $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $request->san_Pham)->where('size_id',$request->size)->where('mau_id',$request->mau)->first();
        $chiTietSanPham->so_luong +=  (int)$request->so_Luong;
        $chiTietNhapHang->save();
        $chiTietSanPham->save();
        $sanPham->save();
        return "thành công";
       
    }

    public function themMoi()
    {
        $nha_Cung_Cap = NhaCungCap::all();
        $loai = Loai::all();
        $mau = Mau::all();
        $size = Size::all();
        return view('NHAPHANG/danh-sach',compact('nha_Cung_Cap','loai','mau','size'));
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
                //tạo mới sản phẩm
                $san_Pham = new SanPham();
                $san_Pham->ten = $request->ten[$i];
                $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
                $san_Pham->gia_ban	= (double)$request->gia_Ban[$i];
                $san_Pham->so_luong = (int)$request->so_Luong[$i];
                $san_Pham->thong_tin=$request->Thong_Tin[$i];
                $san_Pham->loai_id = (int)$request->loai[$i];
                $san_Pham->nha_cung_cap_id = (int)$request->nha_cung_cap;
                $san_Pham->save();
                //tạo mới chi tiết sản phẩm
                $chi_Tiet_San_Pham = new ChiTietSanPham();
                $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
                $chi_Tiet_San_Pham->save();
            }
            else
            {

                $chi_Tiet_San_Pham = ChiTietSanPham::where('san_pham_id',$san_Pham->id)->where('mau_id',$request->mau[$i])->where('size_id',$request->size[$i])->first();
                
                if(empty($chi_Tiet_San_Pham))
                {
                    if(!empty($request->Thong_Tin[$i])){
                       
                        $san_Pham->thong_tin = $request->Thong_Tin[$i];
                        $san_Pham->save();
                    }
                    $chi_Tiet_San_Pham = new ChiTietSanPham();
                    $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                    $chi_Tiet_San_Pham->mau_id	= (int)$request->mau[$i];
                    $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                    $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
                    $chi_Tiet_San_Pham->save();
                }

                else{
                return redirect()->route('san-pham.nhap-hang')->with('thong_bao','Sản phẩm đã tồn tại');
                }
            }

            //tạo mới chi tiết nhập hàng

            $ChiTietNhapHang = new ChiTietNhapHang();
            $ChiTietNhapHang->nhap_hang_id = (int)$NhapHang->id;
            $ChiTietNhapHang->san_pham_id = (int)$san_Pham->id;
            $ChiTietNhapHang->gia_nhap = (double)$request->gia_Nhap[$i];
            $ChiTietNhapHang->gia_ban = (double)$request->gia_Ban[$i];
            $ChiTietNhapHang->so_luong = (int)$request->so_Luong[$i];
            $ChiTietNhapHang->thanh_tien	= (double)$thanh_Tien;
            $ChiTietNhapHang->save();


        }
        $NhapHang->tong_tien += $tong_Tien;
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
