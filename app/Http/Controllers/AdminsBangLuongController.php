<?php

namespace App\Http\Controllers;

use App\Models\AdminsBangLuong;
use App\Models\AdminsNhanVien;
use App\Models\AdminsTrangThai;
use Illuminate\Http\Request;

class AdminsBangLuongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $nhanViens = AdminsNhanVien::with(['bangLuong.trangThai'])->get();

    $data = $nhanViens->map(function ($nv) {
        $congViec = $nv->congViec(); // GỌI HÀM THƯỜNG, đúng cách
        $mucLuongGoc = $congViec ? $congViec->muc_luong : 0;
        $bangLuong = $nv->bangLuong;
        $tienThuong = optional($bangLuong)->tien_thuong ?? 0;
        $tongLuong = $mucLuongGoc + $tienThuong;

        return [
            'nhan_vien_id' => $nv->id, // Thêm dòng này
            'ma_nhan_vien' => $nv->ma_nhan_vien,
            'ten_nhan_vien' => $nv->ten_nhan_vien,
            'email' => $nv->email,
            'sdt' => $nv->sdt,
            'luong_co_ban' => $mucLuongGoc,
            'tien_thuong' => $tienThuong,
            'tong_luong' => $tongLuong,
            'ten_trang_thai' => optional(optional($bangLuong)->trangThai)->ten_trang_thai ?? 'Không có',
        ];
    });

    return view('admins.bangluongs.index', compact('data'));
    dd($data);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $trangThai = AdminsTrangThai::all();
        $nhanVien = AdminsNhanVien::findOrFail($id);
        $congViec = $nhanVien->congViec();
        $mucLuong = $congViec ? $congViec->muc_luong : 0;
        return view('admins.bangluongs.create', compact('nhanVien', 'mucLuong','trangThai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'tien_thuong' => 'nullable|numeric|min:0',

        ]);

        $nhanVien = AdminsNhanVien::findOrFail($id);
        $congViec = $nhanVien->congViec();
        $mucLuong = $congViec ? $congViec->muc_luong : 0;

        AdminsBangLuong::updateOrCreate(
            ['nhan_vien_id' => $id],
            [
                'so_luong' => $mucLuong,
                'tien_thuong' => $request->tien_thuong,
                'id_trang_thai' => $request->id_trang_thai,
            ]
        );

        return redirect()->route('bangluong.index')->with('success', 'Thêm bảng lương thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bangLuong = AdminsBangLuong::with('trangThai')->where('nhan_vien_id', $id)->firstOrFail();

        if ($bangLuong->trangThai && $bangLuong->trangThai->ten_trang_thai === 'Đã thanh toán') {
            return redirect()->route('bangluong.index')->with('error', 'Không thể sửa vì bảng lương đã được thanh toán.');
        }

        $trangThai = AdminsTrangThai::all();
        $nhanVien = AdminsNhanVien::findOrFail($id);
        $congViec = $nhanVien->congViec();
        $mucLuong = $congViec ? $congViec->muc_luong : 0;

        return view('admins.bangluongs.edit', compact('bangLuong', 'nhanVien', 'mucLuong', 'trangThai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bangLuong = AdminsBangLuong::with('trangThai')->where('nhan_vien_id', $id)->firstOrFail();

    if ($bangLuong->trangThai && $bangLuong->trangThai->ten_trang_thai === 'Đã thanh toán') {
        return redirect()->route('bangluong.index')->with('error', 'Không thể cập nhật vì bảng lương đã được thanh toán.');
    }

    $request->validate([
        'tien_thuong' => 'nullable|numeric|min:0',
        'id_trang_thai' => 'required|exists:admins_trang_thais,id'
    ]);

    $congViec = $bangLuong->nhanVien->congViec();
    $mucLuong = $congViec ? $congViec->muc_luong : 0;

    $bangLuong->update([
        'so_luong' => $mucLuong,
        'tien_thuong' => $request->tien_thuong,
        'id_trang_thai' => $request->id_trang_thai,
    ]);

    return redirect()->route('bangluong.index')->with('success', 'Cập nhật bảng lương thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
