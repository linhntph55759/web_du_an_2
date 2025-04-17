<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsTrangThai extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'trang_thai';
    protected $fillable = ['ten_trang_thai'];

    public function bangLuong()
    {
        return $this->hasMany(AdminsBangLuong::class);

    }
}

