<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\KhachHang;
use Illuminate\Support\Facades\Hash;
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
}
