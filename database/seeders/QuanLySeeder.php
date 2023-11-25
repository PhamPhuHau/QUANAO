<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuanLy;
use Illuminate\Support\Facades\Hash;

class QuanLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quanly = new Quan_Ly();
        $quanly->ten_dang_nhap='hachiba';
        $quanly->password=Hash::make('hachiba123');

        $quanly ->save();
    }
}
