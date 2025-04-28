<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsDonHang extends Model
{
    use HasFactory;
    protected $table='don_hangs';
    protected $fillable=[
        'ma_don_hang',
        'khach_hang_id',
        'san_pham_id',
        'so_luong',
        'tien_ship',
        'tong_tien',
        'trang_thais',
    ];
    public function khachHang()
    {
        return $this->belongsTo(AdminKhachHang::class, 'id');
    }

    public function sanPham()
    {
        return $this->belongsTo(AdminsSanPham::class);
    }
}
