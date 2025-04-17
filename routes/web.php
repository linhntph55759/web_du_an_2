<?php

use App\Http\Controllers\AdminPhongBanController;
use App\Http\Controllers\AdminsBangLuongController;
use App\Http\Controllers\AdminsChucVuController;
use App\Http\Controllers\AdminsNhanVienController;
use App\Http\Controllers\AdminsTaiKhoanController;
use App\Http\Controllers\CongViecController;
use App\Http\Controllers\TrangThaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::redirect('/admin', 'showLoginForm');
Route::resource('nhanvien',            AdminsNhanVienController::class);
Route::resource('chucvu',            AdminsChucVuController::class);
Route::resource('phongban',            AdminPhongBanController::class);
Route::resource('taikhoan',            AdminsTaiKhoanController::class);
Route::resource('congviec',            CongViecController::class);
Route::resource('trangthai',            TrangThaiController::class);
// Xem thông tin cá nhân và đổi mk

Route::get('tai-khoan-cua-toi', [AdminsTaiKhoanController::class, 'profile'])->name('taikhoan.profile');
Route::post('changePassword', [AdminsTaiKhoanController::class, 'changePassword'])->name('taikhoan.changePassword');
// bảng lương
Route::get('/bangluong/create/{id}', [AdminsBangLuongController::class, 'create'])->name('bangluong.create');
Route::post('/bangluong/store/{id}', [AdminsBangLuongController::class, 'store'])->name('bangluong.store');
Route::get('/bangluong/index', [AdminsBangLuongController::class, 'index'])->name('bangluong.index');
Route::get('/bangluong/edit/{id}', [AdminsBangLuongController::class, 'edit'])->name('bangluong.edit');
Route::post('/bangluong/update/{id}', [AdminsBangLuongController::class, 'update'])->name('bangluong.update');

// Hiển thị form đăng nhập
Route::get('showLoginForm', [AdminsTaiKhoanController::class, 'showLoginForm'])->name('taikhoan.showLoginForm');

// Xử lý đăng nhập
Route::post('login', [AdminsTaiKhoanController::class, 'login'])->name('taikhoan.login');

// Đăng xuất
Route::post('logout', [AdminsTaiKhoanController::class, 'logout'])->name('taikhoan.logout');

