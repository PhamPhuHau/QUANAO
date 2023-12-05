<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    public function View()
    {
        return view('TAIKHOAN/danh-sach');
    }
}
