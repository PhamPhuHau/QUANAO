<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function View()
    {
        $Size = Size::all();
        return view('SIZE/danh-sach',compact('Size'));
    }
    public function xuLyThemMoi(Request $request)
    {
        $size= new Size();

        $size->ten=$request->ten;

        $size->save();
        return redirect()->route("SIZE.danh-sach");
    }
    public function themMoi()
    {
        return View('SIZE/them');
    }
    public function Edit($id)
    {
        $size=Size::find($id);
        if(empty($size))
        {
            return redirect()->route("SIZE.danh-sach");
        }
        return view("SIZE.cap-nhat", compact("size"));
    }
    public function xlEdit(Request $request, $id)
    {
        $size=Size::find($id);
        $size->ten=$request->ten;

        $size->save();
        return redirect()->route("SIZE.danh-sach");
    }
    public function Delete($id)
    {
        $size=Size::find($id);
        if(empty($size))
        {
            return redirect()->route("SIZE.danh-sach");
        }
        $size->delete();
        return redirect()->route("SIZE.danh-sach");
    }
}
