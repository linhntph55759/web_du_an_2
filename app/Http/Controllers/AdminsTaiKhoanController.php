<?php

namespace App\Http\Controllers;

use App\Models\AdminsTaiKhoan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class AdminsTaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $search = $request->get('search');
        if($search){
            $taikhoan = AdminsTaiKhoan::where('ten_quan_tri','like','%'.$search.'%')->paginate(3);
        }else{
            $taikhoan = AdminsTaiKhoan::paginate(3);
        }
        return view('admins.quantri.index',compact('taikhoan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.quantri.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'ten_quan_tri'=> 'required|string|max:225|unique:tai_khoan,ten_quan_tri',
                'sdt' => 'required|string|max:20',
                'email' => 'required|email|max:255|unique:nhan_viens,email',
                'anh_dai_dien' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);
            $filePath = null;
            if ($request->hasFile('anh_dai_dien')) {
                $filePath = $request->file('anh_dai_dien')->store('uploads/taikhoan', 'public');
            }
            $dataTaiKhoan = [
                'ten_quan_tri'=> $request->input('ten_quan_tri'),
                'sdt' => $request->input('sdt'),
                'email' => $request->input('email'),
                'password' => bcrypt('1234'),
                'anh_dai_dien' => $filePath,
            ];
            AdminsTaiKhoan::insert($dataTaiKhoan);
            DB::commit();
            return redirect()->route('taikhoan.index')->with('success', 'Thêm tài khoản thành công!');
        }catch (\Exception $e) {
        // Rollback giao dịch nếu có lỗi
        DB::rollback();

        return redirect()->route('taikhoan.index')->with('error', 'Có lỗi xảy ra khi thêm tai khoan: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (session('admin_id') != 1) {
            return redirect()->route('taikhoan.index')->with('error', 'Bạn không có quyền chỉnh sửa tài khoản.');
        }
        $taikhoan = AdminsTaiKhoan::findOrFail($id);
        if(!$taikhoan){
            return redirect()->route('taikhoan.index')->with('error', 'tai khoan ko ton tai');
        }
        return view('admins.quantri.edit', compact('taikhoan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (session('admin_id') != 1) {
            return redirect()->route('taikhoan.index')->with('error', 'Bạn không có quyền chỉnh sửa tài khoản.');
        }
        DB::beginTransaction();
        try{
            if (session('admin_id') != 1) {
        return redirect()->route('taikhoan.index')->with('error', 'Bạn không có quyền chỉnh sửa tài khoản.');
    }
            $taikhoan = AdminsTaiKhoan::findOrFail($id);
            if(!$taikhoan){
            return redirect()->route('taikhoan.index')->with('error', 'tai khoan ko ton tai');
        }
        $request->validate([
            'ten_quan_tri'=> [
                'required',
                'string',
                'max:225',
                Rule::unique('tai_khoan', 'ten_quan_tri')->ignore($id),
            ],
            'sdt' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('nhan_viens', 'email')->ignore($id),
            ],
            'anh_dai_dien' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
        $filePath = $taikhoan->anh_dai_dien;
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu có
            if ($taikhoan->anh_dai_dien) {
                Storage::delete('public/' . $taikhoan->anh_dai_dien);
            }
            // Lưu ảnh mới
            $filePath = $request->file('anh_dai_dien')->store('uploads/taikhoan', 'public');
        }
        $dataTaiKhoan = [
            'ten_quan_tri'=> $request->input('ten_quan_tri'),
            'sdt' => $request->input('sdt'),
            'email' => $request->input('email'),
            'anh_dai_dien' => $filePath,
        ];
        $taikhoan->update($dataTaiKhoan);
        DB::commit();


       return redirect()->route('taikhoan.index')->with('success', 'Cập nhật tài khoản thành công!');
        }catch (\Exception $e) {
        // Rollback giao dịch nếu có lỗi
        DB::rollback();

        return redirect()->route('taikhoan.index')->with('error', 'Có lỗi xảy ra khi thêm tai khoan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (session('admin_id') != 1) {
            return redirect()->route('taikhoan.index')->with('error', 'Bạn không có quyền chỉnh sửa tài khoản.');
        }
        $taikhoans = AdminsTaiKhoan::findOrFail($id);
        if(!$taikhoans){
            return redirect()->route('taikhoan.index')->with('error', 'tai khoan ko ton tai');
        }
        $filePath = $taikhoans->anh_dai_dien;
    $taikhoans->delete();
    if($taikhoans){
        if($taikhoans && isset($filePath) && Storage::disk('public')->exists($taikhoans->anh_dai_dien)){
            Storage::disk('public')->delete($filePath);
        }
        return redirect()->route('taikhoan.index')->with('success',' Xoá thành công  tài khoản!');
        }
            return redirect()->route('taikhoan.index')->with('error',' Có lỗi xin vui lòng thu lại  !');

    }
    public function showLoginForm()
{
    return view('admins.auth.login');
}
public function login(Request $request)
{
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin =AdminsTaiKhoan::where('email', $request->email)->first();
        if($admin && Hash::check($request->password,$admin->password)){
            session(['admin_id' => $admin->id]);
        return redirect()->route('taikhoan.index')->with('success', 'Đăng nhập thành công!');
    }
    return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
        }
        public function logout(Request $request)
        {
            $request->session()->forget('admin_id');
            return redirect()->route('taikhoan.showLoginForm')->with('success', 'Đăng xuất thành công!');
        }

        public function changePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            // Lấy admin hiện tại
            $admin = AdminsTaiKhoan::find(session('admin_id'));

            // Kiểm tra mật khẩu hiện tại có đúng không
            if (!$admin || !Hash::check($request->current_password, $admin->password)) {
                return back()->with('error', 'Mật khẩu hiện tại không đúng');
            }

            // Cập nhật mật khẩu mới và thời gian thay đổi
            $admin->password = bcrypt($request->password);
            $admin->save();
            return back()->with('success', 'Đổi mật khẩu thành công');
        }

        public function profile()
{
    $adminId = session('admin_id');
    $admin = AdminsTaiKhoan::find($adminId);

    if (!$admin) {
        return redirect()->route('taikhoan.showLoginForm')->with('error', 'Vui lòng đăng nhập lại');
    }

    return view('admins.quantri.profile', compact('admin'));
}
}
