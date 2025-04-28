<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsSanPham extends Model
{
    use HasFactory;
    protected $table='san_phams';
    protected $fillable=[
        'ma_san_pham',
        'ten_san_pham',
        'anh_san_pham',
        'mo_ta',
        'so_luong',
        'gia',
        'gia_khuyen_mai',
        'trang_thai',
    ];
    public function donHangs()
    {
        return $this->hasMany(AdminsDonHang::class);
    }
}
