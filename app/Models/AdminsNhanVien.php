<?php

namespace App\Models;

use App\Http\Controllers\CongViecController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsNhanVien extends Model
{
    use HasFactory;

    protected $table = 'nhan_viens';
    protected $fillable =[
            'ma_nhan_vien',
            'ten_nhan_vien',
            'sdt',
            'email',
            'mat_khau',
            'nam_sinh',
            'anh_dai_dien',
            'ngay_lam',
            'chuc_vu_id',
            'phong_ban_id',
            'id_bang_luong',

    ];
    public function chucVu()
    {
        return $this->belongsTo(chucVu::class, 'chuc_vu_id');
    }

    public function phongBan()
    {
        return $this->belongsTo(phongBan::class, 'phong_ban_id');
    }
    public function bangLuong()
{
    return $this->hasOne(AdminsBangLuong::class, 'nhan_vien_id');
}

public function congViec()
{
    return AdminsCongViec::where('id_chuc_vu', $this->chuc_vu_id)
                   ->where('id_phong_ban', $this->phong_ban_id)
                   ->first();
}
}
