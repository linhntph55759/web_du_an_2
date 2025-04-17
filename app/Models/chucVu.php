<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chucVu extends Model
{
    use HasFactory;
    protected $table = 'chuvu';
    protected $fillable = ['ten_chuc_vu', 'mo_ta'];
    public function nhanViens()
    {
        return $this->hasMany(AdminsNhanVien::class);

    }
    public function congViecs()
    {
        return $this->hasMany(AdminsCongViec::class);
    }
}


