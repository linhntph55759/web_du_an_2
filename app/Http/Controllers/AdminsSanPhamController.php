<?php

namespace App\Http\Controllers;

use App\Models\AdminsSanPham;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminsSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query =  AdminsSanPham::query();

        if($request->filled('keyword')){
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword){
                $q->where('ma_san_pham' ,'like', "%{$keyword}%")
                ->orwhere('ten_san_pham','like', "%{$keyword}%");
            });
        }

        $listSP = $query->orderByDesc('id')->paginate(3);
        return view('admins.sanphams.index', compact('listSP'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.sanphams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([

                'ma_san_pham' => 'required|string|max:255|unique:san_phams,ma_san_pham',
                'ten_san_pham' => 'required|string|max:255',
                'anh_san_pham' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'mo_ta' => 'nullable|string',
                'so_luong' => 'required|integer|min:0',
                'gia' => 'required|numeric|min:0',
                'gia_khuyen_mai' => 'nullable|numeric|min:0|lte:gia',
                'trang_thai' => 'required|in:0,1',
            ]);



            $filePath = null;
        if ($request->hasFile('anh_san_pham')) {
            $filePath = $request->file('anh_san_pham')->store('uploads/sanphams', 'public');
        }
        $dataSanPham = [
            'ma_san_pham' => $request->input('ma_san_pham'),
            'ten_san_pham' => $request->input('ten_san_pham'),
            'anh_san_pham' => $filePath,
            'mo_ta' => $request->input('mo_ta'),
            'so_luong' => $request->input('so_luong'),
            'gia' => $request->input('gia'),
            'gia_khuyen_mai' => $request->input('gia_khuyen_mai'),
            'trang_thai' => $request->input('trang_thai'),
        ];
        AdminsSanPham::create($dataSanPham);
        DB::commit();
        return redirect()->route('sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('sanpham.index')->with('error', 'Có lỗi xảy ra khi thêm sản phẩm: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanPham = AdminsSanPham::findOrFail($id);
        if(!$sanPham){
            return redirect()->route('sanpham.index')->with('error', 'Sản phẩm ko ton tai');
        }
        return view('admins.sanphams.edit',compact('sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sanPham = AdminsSanPham::findOrFail($id);
        if(!$sanPham){
            return redirect()->route('sanpham.index')->with('error', 'sản phẩm ko ton tai');
        }
        DB::beginTransaction();
        try{
            $request->validate([

                'ten_san_pham' => 'required|string|max:255',
                'anh_san_pham' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'mo_ta' => 'nullable|string',
                'so_luong' => 'required|integer|min:0',
                'gia' => 'required|numeric|min:0',
                'gia_khuyen_mai' => 'nullable|numeric|min:0|lte:gia',
                'trang_thai' => 'required|in:0,1',
            ]);
            $filePath = $sanPham->anh_san_pham;

        if ($request->hasFile('anh_san_pham')) {
            if($sanPham->anh_san_pham){
                Storage::delete('public/' . $sanPham->anh);
            }
            $filePath = $request->file('anh_san_pham')->store('uploads/sanphams', 'public');
        }
        $dataSanPham = [
            'ten_san_pham' => $request->input('ten_san_pham'),
            'anh_san_pham' => $filePath,
            'mo_ta' => $request->input('mo_ta'),
            'so_luong' => $request->input('so_luong'),
            'gia' => $request->input('gia'),
            'gia_khuyen_mai' => $request->input('gia_khuyen_mai'),
            'trang_thai' => $request->input('trang_thai'),
        ];
        $sanPham->update($dataSanPham);
        DB::commit();
        return redirect()->route('sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('sanpham.index')->with('error', 'Có lỗi xảy ra khi thêm sản phẩm: ' . $e->getMessage());
    }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $sanPham = AdminsSanPham::findOrFail($id);
        if(!$sanPham){
            return redirect()->route('sanpham.index')->with('error', 'sản phẩm ko ton tai');
        }
        $filePath = $sanPham->anh_san_pham;
        $sanPham->delete();
        if($sanPham){
            if($sanPham && isset($filePath) && Storage::disk('public')->exists($sanPham->anh_san_pham)){
                Storage::disk('public')->delete($filePath);
            }
            return redirect()->route('sanpham.index')->with('success',' Xoá thành công !');
            }
                return redirect()->route('sanpham.index')->with('error',' Có lỗi xin vui lòng thu lại  !');
    }
}
