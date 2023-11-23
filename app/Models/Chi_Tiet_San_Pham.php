<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chi_Tiet_San_Pham extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_san_pham';

    public function Loai(){
        return $this->belongsto(Loai::class);
    }
    public function Mau(){
        return $this->belongsto(Mau::class);
    }
    public function Size(){
        return $this->belongsto(Size::class);
    }
    public function DS_San_Pham(){
        return $this->belongsto(San_Pham::class);
    }
}
