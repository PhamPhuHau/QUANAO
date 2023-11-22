<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class San_Pham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';

    public function CT_San_Pham(){
        return $this->belongsto(Chi_Tiet_San_Pham::class);
    }
}
