<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Nha_Cung_Cap;
use App\models\Loai;
class SanPhamController extends Controller
{
    public function View()
    {
        $Nha_Cung_Cap = Nha_Cung_Cap::all();
        $Loai = Loai::all();
        return view('NHAPHANG/danh-sach',compact('Nha_Cung_Cap','Loai'));
    }
}
