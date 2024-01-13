<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSanPham;
use App\Models\SanPham;
use App\Models\Mau;
use App\Models\Size;
use Illuminate\Support\Str;

class HoaDonAPIController extends Controller
{
    public function ThanhToanNganHang(Request $request)
    {
        $hoaDon = HoaDon::orderByDesc('id')->first();

        if ($hoaDon) {
            
            $hoaDon = $hoaDon->id;
            // Tiếp tục xử lý...
        } else {
            $hoaDon = HoaDon::count();
        }
        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:3000/ThanhToan";
        $vnp_TmnCode = "AJ5OA62P";//Mã website tại VNPAY 
        $vnp_HashSecret = "FQIXOHHXXCKXLGGXOIWERHWOARBOIGGA"; //Chuỗi bí mật
        
        $vnp_TxnRef = $hoaDon; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "abc";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = 100000 * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "ncb";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        
        //truyền thông tin vào hoá đơn
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            'url' => $vnp_Url,
        ]);
    }

    public function ThanhToan(Request $request)
    {
        // Trả về response JSON cho client (có thể thay đổi tùy vào logic của bạn)
        for ($i = 0; $i < count($request->ten); $i++) {

            $mau = Mau::where('ten',$request->mau[$i])->first();
            $size = Size::where('ten',$request->size[$i])->first();    
            $sanPham = SanPham::where('ten',$request->ten[$i])->first();
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$sanPham->id)
            ->where('mau_id',$mau->id)
            ->where('size_id',$size->id)->first();
        // Assuming so_luong is a single value, remove [i] index
        if ($chiTietSanPham->so_luong < $request->so_luong[$i]) {
            return response()->json(['errors' => 'Vui lòng giảm số lượng '. $request->ten[$i] . ', màu '
            . $request->mau[$i] .', size '. $request->size[$i]], 422);
        }
        }
       

        //tạo mới hoá đơn
        $hoaDon = new HoaDon();
        
        $hoaDon->khach_hang_id = $request->khach_hang;
        $hoaDon->tien_ship = $request->tien_ship;
        $hoaDon->tong_tien = $request->tong_tien;
        if($request->PhuongThucThanhToan==1)
        {
            $hoaDon->phuong_thuc_thanh_toan = "Thanh toán khi nhận hàng";
        }
        else
        {
            $hoaDon->phuong_thuc_thanh_toan = "Thanh toán qua Ngân hàng NCB";
        }

        $hoaDon->trang_thai = 1;
        $hoaDon->save();

        $hoaDon->ma = $hoaDon->id + 1;

        

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





        
        return response()->json([
            
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon->id,
            
        ]);
    }
    public function KiemTraDonHang(Request $request)
    {
        $hoaDon = HoaDon::where('id',$request->hdID)->first();
        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$hoaDon->id)->get();
        foreach($chiTietHoaDon as $danhSach)
        {
            $danhSach->chi_tiet_san_pham->san_pham;
        }
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
            "dataCTHoaDon"=>$chiTietHoaDon,
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

    public function LayHoaDonKhachHang(Request $request)
    {
        $hoaDon = HoaDon::where('khach_hang_id',$request->KhachHang)->orderBy('id', 'desc')->get();
        
        
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
           
        ]);
    }
    
    public function Huy($id)
    {
        $hoaDon = HoaDon::where('id',$id)->first();
        $hoaDon->trang_thai = 0;
        $hoaDon->save();

        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$id)->get();
        foreach($chiTietHoaDon as $cthd)
        {
            $cthd->chi_tiet_san_pham->so_luong += $cthd->so_luong;
            $cthd->chi_tiet_san_pham->save();

            $sanPham = SanPham::where('id',$cthd->chi_tiet_san_pham->san_pham_id)->first();
            $sanPham->so_luong += $cthd->so_luong;
            $sanPham->save();
        }

        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            
           
        ]);    }
}
