<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsTaiKhoan extends Model
{
    use HasFactory;
    protected $table ='tai_khoan';
    protected $fillable =[
        'ten_quan_tri',
        'sdt',
        'email',
        'password',
        'anh_dai_dien',
    ];
}
