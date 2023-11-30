<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietSanPham extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_san_pham';

    public function loai(){
        return $this->belongsTo(Loai::class);
    }
    public function mau(){
        return $this->belongsTo(Mau::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function san_pham() {
        return $this->belongsTo(SanPham::class);
    }
}
