<?php

namespace App\Http\Controllers;

use App\Models\AdminKhachHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminkhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AdminKhachHang::query();

        if($request->filled('keyword')){
            $keyword = $request->input('keyword');
                $query->where(function ($q) use ($keyword){
                    $q->where('ma_khach_hang' ,'like' ,"%{$keyword}%")
                    ->orWhere('ten_khach_hang', 'like', "%{$keyword}%");
                });

        }
        $listKH = $query->orderByDesc('id')->paginate(3);
        return view('admins.khachhangs.index', compact('listKH'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.khachhangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'ma_khach_hang' => 'required|string|max:255|unique:khach_hangs,ma_khach_hang',
                'ten_khach_hang' => 'required|string|max:255',
                'sdt' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:khach_hangs,email',
                'mat_khau' => 'required|string|min:3',
                'ngay_sinh' => 'required|date',
                'anh' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
                'dia_chi' => 'required|string',

            ]);

            $filePath = null;
            if ($request->hasFile('anh')) {
                $filePath = $request->file('anh')->store('uploads/khachhangs', 'public');
            }

            $dataKhachHang = [
                'ma_khach_hang' => $request->input('ma_khach_hang'),
                'ten_khach_hang' => $request->input('ten_khach_hang'),
                'sdt' => $request->input('sdt'),
                'email' => $request->input('email'),
                'mat_khau' => bcrypt($request->input('mat_khau')),
                'ngay_sinh' => $request->input('ngay_sinh'),
                'dia_chi' => $request->input('dia_chi'),
                'ten_ngan_hang' => $request->input('ten_ngan_hang'),
                'so_tai_khoan' => $request->input('so_tai_khoan'),
                'anh' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            AdminKhachHang::create($dataKhachHang);

            DB::commit();
            return redirect()->route('khachhang.index')->with('success', 'Thêm thành công ạ ' );
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('khachhang.index')->with('error', 'Có lỗi xảy ra khi thêm khach hang: ' . $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $khachHangs = AdminKhachHang::with('donHangs')
        ->whereHas('donHangs')
        ->get();

    return view('admins.donhangs.detail', compact('khachHangs'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $khachHang = AdminKhachHang::findOrFail($id);
        if(!$khachHang){
            return redirect('khachhang.index')->with('error' , 'khach hàng ko tồn tại');
        }
        return view('admins.khachhangs.edit',compact('khachHang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try{
            $khachHang = AdminKhachHang::findOrFail($id);
            if(!$khachHang){
            return redirect('khachhang.index')->with('error' , 'khach hàng ko tồn tại');
        }

            $request->validate([
                'ten_khach_hang' => 'required|string|max:255',
                'sdt' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:khach_hangs,email,' . $khachHang->id,
                'ngay_sinh' => 'required|date',
                'anh' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
                'dia_chi' => 'required|string',

            ]);

            $filePath = $khachHang->anh;
            if ($request->hasFile('anh')) {
                if($khachHang->anh){
                    Storage::delete('public/' . $khachHang->anh);
                }
                $filePath = $request->file('anh')->store('uploads/khachhangs', 'public');
            }

            $dataKhachHang = [
                'ten_khach_hang' => $request->input('ten_khach_hang'),
                'sdt' => $request->input('sdt'),
                'email' => $request->input('email'). $khachHang->id,
                'ngay_sinh' => $request->input('ngay_sinh'),
                'dia_chi' => $request->input('dia_chi'),
                'ten_ngan_hang' => $request->input('ten_ngan_hang'),
                'so_tai_khoan' => $request->input('so_tai_khoan'),
                'anh' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $khachHang->update($dataKhachHang);

            DB::commit();
            return redirect()->route('khachhang.index')->with('success', 'Cập nhật thành công ạ ' );
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('khachhang.index')->with('error', 'Có lỗi xảy ra khi thêm khach hang: ' . $e->getMessage());
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khachHang = AdminKhachHang::findOrFail($id);
        if(!$khachHang){
            return redirect('khachhang.index')->with('error' , 'khach hàng ko tồn tại');
        }
        $filePath = $khachHang->anh;
        $khachHang->delete();
        if($khachHang){
            if($khachHang && isset($filePath) && Storage::disk('public')->exists($khachHang->anh)){
                Storage::disk('public')->delete($filePath);
            }
            return redirect()->route('khachhang.index')->with('success',' Xoá thành công !');
            }
                return redirect()->route('khachhang.index')->with('error',' Có lỗi xin vui lòng thu lại  !');

    }

    }

