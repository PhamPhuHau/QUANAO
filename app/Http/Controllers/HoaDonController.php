<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function View()
    {
        return view('HOADON/danh-sach');
    }
}
