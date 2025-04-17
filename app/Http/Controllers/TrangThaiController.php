<?php

namespace App\Http\Controllers;

use App\Models\AdminsTrangThai;
use Illuminate\Http\Request;

class TrangThaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $trangthai = AdminsTrangThai::where('ten_trang_thai', 'like', '%' . $search . '%')->paginate(3);
        } else {
            $trangthai = AdminsTrangThai::orderByDesc('id')->paginate(4);
        }
            return view('admins.trangthais.index',compact('trangthai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.trangthais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_trang_thai' => 'required|unique:trang_thai,ten_trang_thai|max:255',

        ]);


        AdminsTrangThai::create([
            'ten_trang_thai' => $request->ten_trang_thai,

        ]);


        return redirect()->route('trangthai.index')->with('success', 'Thêm trạng thái thành công');
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

        $trangthais = AdminsTrangThai::findOrFail($id);
        return view('admins.trangthais.edit',compact('trangthais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_trang_thai'=> 'required|max:225|unique:trang_thai,ten_trang_thai,'.$id,


        ]);

        $trangthais = AdminsTrangThai::findOrFail($id);
        $trangthais->update([
            'ten_trang_thai' => $request->ten_trang_thai,

        ]);
        return redirect()->route('trangthai.index')->with('success',"Cập nhật thành công thành công ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $trangthais = AdminsTrangThai::findOrFail($id);
        $trangthais->delete();
        return redirect()->route('trangthai.index')->with('success',"xoá  thành công thành công ");
    }
}
