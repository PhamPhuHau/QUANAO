<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;

class KhachHangAPIController extends Controller
{
    public function login(Request $rq)
    {
        
        $credentials = request(['email', 'password']);
        
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function doiMatKhau(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $khachHang = KhachHang::where('email',$request->email)->first();
        $khachHang->password=hash::make($request->newPassWord);
        $khachHang->save();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
        ]);
    }
    public function capNhatThongTin(Request $request)
    {
        $khachHang = KhachHang::where('email',$request->email)->first();
        $khachHang->ho_ten=$request->ho_ten;
        $khachHang->so_dien_thoai=$request->so_dien_thoai;
        $khachHang->dia_chi=$request->dia_chi;

        $khachHang->save();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
        ]);
    }
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function Regester(request $rq)
    {
        $khachHang = new KhachHang();
        $khachHang->ho_ten = $rq->hoTen;
        $khachHang->email = $rq->email;
        $khachHang->password = Hash::make($rq->password);
        $khachHang->so_dien_thoai = $rq->soDienThoai;
        $khachHang->dia_chi = $rq->diaChi;
        $khachHang->save();
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }

    public function LayLaiMatKhau(Request $request)
    {
        $khachHang = KhachHang::where('email', $request->email)->first();
        $matKhauMoi = Str::random(6);
        $khachHang->password=Hash::make($matKhauMoi);
        if (!$khachHang) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng với địa chỉ email này.'
            ]);
        }
    
        Mail::send('EMAIL.gui-mail', compact('khachHang','matKhauMoi'), function ($email) use ($khachHang) {
            $email->to($khachHang->email, $khachHang->ho_ten);
        });
    
        return response()->json([
            'message' => 'Thành công'
        ]);
    }
    
}
