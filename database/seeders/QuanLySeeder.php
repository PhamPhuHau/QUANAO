<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuanLy;
use App\Models\Loai;
use App\Models\Mau;
use App\Models\Size;
use App\Models\NhaCungCap;
use Illuminate\Support\Facades\Hash;

class QuanLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quanly = new QuanLy();
        $quanly->ten_dang_nhap='hachiba';
        $quanly->password=Hash::make('hachiba123');
        $quanly ->save();

        $loai = new Loai();
        $loai->ten = "Áo thun";
        $loai->save();

        $mau =new Mau();
        $mau->ten = "Đỏ";
        $mau->save();

        $size = new Size();
        $size->ten = "X";
        $size->save();

        $nhaCungCap = new NhaCungCap();
        $nhaCungCap->ten = "Red Dog";
        $nhaCungCap->email = "RedDog@gmail.com";
        $nhaCungCap->dia_chi = "tp Hồ Chí Minh";
        $nhaCungCap->save();
    }
}
