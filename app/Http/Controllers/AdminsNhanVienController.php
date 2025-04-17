<?php

namespace App\Http\Controllers;

use App\Models\AdminsNhanVien;
use App\Models\chucVu;
use App\Models\phongBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminsNhanVienController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ bảng 'nhan_viens' với phân trang và tìm kiếm
        $query = AdminsNhanVien::query();

        // Kiểm tra và thực hiện tìm kiếm nếu có
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('ma_nhan_vien', 'like', "%{$keyword}%")
                    ->orWhere('ten_nhan_vien', 'like', "%{$keyword}%");
            });
        }

        // Lấy danh sách nhân viên với phân trang
        $listNhanVien = $query->orderByDesc('id')->paginate(3);

        // Trả về view với dữ liệu
        return view('admins.nhanviens.index', compact('listNhanVien'));
    }

    public function create(){
        $chucVus = chucVu::all(); // Lấy tất cả chức vụ
    $phongBans = phongBan::all(); // Lấy tất cả phòng ban

        return view('admins.nhanviens.create',compact('chucVus', 'phongBans'));
    }
    public function store(Request $request)
{
    DB::beginTransaction(); // Bắt đầu giao dịch

    try {
        // Validate dữ liệu đầu vào
        $request->validate([
            'ma_nhan_vien' => 'required|string|max:255|unique:nhan_viens,ma_nhan_vien',
            'ten_nhan_vien' => 'required|string|max:255',
            'sdt' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:nhan_viens,email',
            'mat_khau' => 'required|string|min:3',
            'nam_sinh' => 'required|date',
            'ngay_lam' => 'required|date',
            'chuc_vu_id' => 'required|exists:chuvu,id',
            'phong_ban_id' => 'required|exists:phong_ban,id',
            'id_bang_luong' => 'nullable|exists:bang_luongs,id',
            'anh_dai_dien' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',

        ]);

        // Kiểm tra và lưu ảnh nếu có
        $filePath = null;
        if ($request->hasFile('anh_dai_dien')) {
            $filePath = $request->file('anh_dai_dien')->store('uploads/nhanviens', 'public');
        }

        // Dữ liệu nhân viên
        $dataNhanVien = [
            'ma_nhan_vien' => $request->input('ma_nhan_vien'),
            'ten_nhan_vien' => $request->input('ten_nhan_vien'),
            'sdt' => $request->input('sdt'),
            'email' => $request->input('email'),
            'mat_khau' => bcrypt($request->input('mat_khau')), // Mã hóa mật khẩu
            'nam_sinh' => $request->input('nam_sinh'),
            'anh_dai_dien' => $filePath, // Lưu đường dẫn ảnh
            'ngay_lam' => $request->input('ngay_lam'),
            'chuc_vu_id' => $request->input('chuc_vu_id'),
            'phong_ban_id' => $request->input('phong_ban_id'),
            'id_bang_luong' => $request->input('id_bang_luong'),
            // 'trang_thai' => $request->input('trang_thai'), // Thêm trạng thái
            'created_at' => now(),
            'updated_at' => null,
        ];

        // Tạo mới nhân viên sử dụng Eloquent
        AdminsNhanVien::create($dataNhanVien);

        // Cam kết giao dịch
        DB::commit();

        return redirect()->route('nhanvien.index')->with('success', 'Thêm nhân viên thành công!');
    } catch (\Exception $e) {
        // Rollback giao dịch nếu có lỗi
        DB::rollback();

        return redirect()->route('nhanvien.index')->with('error', 'Có lỗi xảy ra khi thêm nhân viên: ' . $e->getMessage());
    }
}



public function edit($id){
    $chucVus = chucVu::all(); // Lấy tất cả chức vụ
    $phongBans = phongBan::all();

    $nhanvien = AdminsNhanVien::findOrFail($id);
     if(!$nhanvien){
        return redirect()->route('nhanvien.index')->with('error', 'Nhan vien ko ton tai');

     }
     return view('admins.nhanviens.edit', compact('nhanvien','chucVus','phongBans'));
}
public function update(Request $request, $id)
{

    DB::beginTransaction();
    try {
        $nhanvien = AdminsNhanVien::findOrFail($id);
        if (!$nhanvien) {
            return redirect()->route('nhanvien.index')->with('error', 'Nhân viên không tồn tại');
        }

        // VALIDATE
        $request->validate([
            'ten_nhan_vien' => 'required|string|max:255',
            'sdt' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:nhan_viens,email,' . $id,
            'mat_khau' => 'required|string|min:3',
            'nam_sinh' => 'nullable|date',  // Vẫn để nullable để không bắt buộc nhập
            'ngay_lam' => 'nullable|date',
            'chuc_vu_id' => 'required|exists:chuvu,id',
            'phong_ban_id' => 'required|exists:phong_ban,id',
            'id_bang_luong' => 'nullable|exists:bang_luongs,id',
            'hinh_anh' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Xử lý ảnh
        $filePath = $nhanvien->anh_dai_dien;
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu có
            if ($nhanvien->anh_dai_dien) {
                Storage::delete('public/' . $nhanvien->anh_dai_dien);
            }
            // Lưu ảnh mới
            $filePath = $request->file('anh_dai_dien')->store('uploads/nhanviens', 'public');
        }

        // Dữ liệu cập nhật
        $dataNhanVien = [
            'ten_nhan_vien' => $request->input('ten_nhan_vien'),
            'sdt' => $request->input('sdt'),
            'email' => $request->input('email'),
            'mat_khau' => bcrypt($request->input('mat_khau')), // Mã hóa mật khẩu
            'nam_sinh' => $request->input('nam_sinh') ? $request->input('nam_sinh') : $nhanvien->nam_sinh,  // Nếu không có giá trị, giữ giá trị cũ
            'anh_dai_dien' => $filePath, // Lưu đường dẫn ảnh
            'ngay_lam' => $request->input('ngay_lam'),
            'chuc_vu_id' => $request->input('chuc_vu_id'),
            'phong_ban_id' => $request->input('phong_ban_id'),
            'id_bang_luong' => $request->input('id_bang_luong'),
        ];

        // Cập nhật dữ liệu nhân viên
        $nhanvien->update($dataNhanVien);

        DB::commit();

        return redirect()->route('nhanvien.index')->with('success', 'Cập nhật nhân viên thành công!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('nhanvien.index')->with('error', 'Có lỗi khi cập nhật nhân viên: ' . $e->getMessage());
    }
}


public function destroy($id){
    $nhanVien = AdminsNhanVien::findOrFail($id);
    if(!$nhanVien){
        return redirect('nhanvien.index')->with('error' , 'Nhan vien ko tồn tại');
    }
    $filePath = $nhanVien->anh_dai_dien;
    $nhanVien->delete();
    if($nhanVien){
        if($nhanVien && isset($filePath) && Storage::disk('public')->exists($nhanVien->anh_dai_dien)){
            Storage::disk('public')->delete($filePath);
        }
        return redirect()->route('nhanvien.index')->with('success',' Xoá thành công nhan vien !');
        }
            return redirect()->route('nhanvien.index')->with('error',' Có lỗi xin vui lòng thu lại  !');

}
}
