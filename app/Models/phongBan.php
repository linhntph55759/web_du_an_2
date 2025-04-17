<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phongBan extends Model
{
    use HasFactory;
    protected $table = 'phong_ban';
    protected $fillable = ['ten_phong_ban','mo_ta'];
    public function nhanViens()
    {
        return $this->hasMany(AdminsNhanVien::class);
    }
    public function congViecs()
    {
        return $this->hasMany(AdminsCongViec::class);
    }

}
