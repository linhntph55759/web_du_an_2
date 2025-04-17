<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsCongViec extends Model
{
    use HasFactory;
    protected $table ='cong_viec';
    protected $fillable =[
        'ten_cong_viec',
        'muc_luong',
        'mo_ta',
        'ca_lam',
        'id_chuc_vu',
        'id_phong_ban',
    ];
    public function chucVu()
    {
        return $this->belongsTo(chucVu::class, 'id_chuc_vu');
    }

    public function congViec()
{
    return $this->hasOne(AdminsCongViec::class, 'id_chuc_vu', 'chuc_vu_id')
                ->where('id_phong_ban', $this->phong_ban_id);
}
}
