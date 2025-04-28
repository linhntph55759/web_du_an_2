<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminKhachHang extends Model
{
    use HasFactory;
    protected $table = 'khach_hangs';
    protected $fillable =[
        'ma_khach_hang',
        'ten_khach_hang',
        'sdt',
        'email',
        'mat_khau',
        'ngay_sinh',
        'anh',
        'dia_chi',
        'so_tai_khoan',
        'ten_ngan_hang',
        'created_at',
        'updated_at',
];
public function donHangs()
{
    return $this->hasMany(AdminsDonHang::class,'khach_hang_id');
}
}
