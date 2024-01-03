<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietHoaDon;
use PDF;
class PDFController extends Controller
{
    public function exportPDF()
    {
        try{
        $chiTietHoaDon=ChiTietHoaDon::all();
        $pdf = PDF::loadView('ADMIN/hoa-don-PDF', compact('chiTietHoaDon'));//my_view thì là file sẽ xuất cái file dpf
        return $pdf->stream('DanhMucSanPham.pdf');//nếu muốn tải trực tiếp thì đổi stream thành download -- DanhMucSanPham.pdf chỉ là cái tên muốn đặt sao cũng được
        }catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
