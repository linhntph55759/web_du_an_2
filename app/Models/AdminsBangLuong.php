<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsBangLuong extends Model
{
    use HasFactory;
    protected $table ='bang_luong';
    protected $fillable =[
        'nhan_vien_id',
        'tien_thuong',
        'id_trang_thai',

    ];
    public function nhanVien()
    {
        return $this->belongsTo(AdminsNhanVien::class, 'nhan_vien_id');
    }
    public function trangThai()
{
    return $this->belongsTo(AdminsTrangThai::class, 'id_trang_thai');
}
}
