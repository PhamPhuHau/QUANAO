<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';

    // public function CT_San_Pham(){
    //     return $this->belongsto(ChiTietSanPham::class);
    // }
}
