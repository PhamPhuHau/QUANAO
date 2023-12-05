<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';

    public function hinh_anh(){
        return $this->hasMany(HinhAnh::class);
    }

    public function nha_cung_cap()
    {
        return $this->belongsTo(NhaCungCap::class);
    }

    public function loai()
    {
        return $this->belongsTo(Loai::class);
    }
}
