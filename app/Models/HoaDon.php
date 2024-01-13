<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = "hoa_don";

    public function khach_hang() {
        return $this->belongsTo(KhachHang::class);
    }
}
