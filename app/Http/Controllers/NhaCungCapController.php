<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhaCungCap;
class NhaCungCapController extends Controller
{
   function view()
   {
    $nha_Cung_Cap=NhaCungCap::all();
    return view('NHACUNGCAP/danh-sach',compact('nha_Cung_Cap'));
   } 
}
