<?php

namespace App\Http\Controllers;

use App\Models\chucVu;
use Illuminate\Http\Request;

class AdminsChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $chucvu = chucVu::where('ten_chuc_vu', 'like', '%' . $search . '%')->paginate(3);
        } else {
            $chucvu = chucVu::orderByDesc('id')->paginate(4);
        }
            return view('admins.chucvus.index',compact('chucvu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.chucvus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'ten_chuc_vu' => 'required|unique:chuvu,ten_chuc_vu|max:255',
        'mo_ta' => 'nullable',
    ]);


    chucVu::create([
        'ten_chuc_vu' => $request->ten_chuc_vu,
        'mo_ta' => $request->mo_ta,
    ]);


    return redirect()->route('chucvu.index')->with('success', 'Thêm chức vụ thành công');
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
        $chucvus = chucVu::findOrFail($id);
        return view('admins.chucvus.edit',compact('chucvus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_chuc_vu'=> 'required|max:225|unique:chuvu,ten_chuc_vu,'.$id,
            'mo_ta'=>'nullable',

        ]);
        $chucvus = chucVu::findOrFail($id);
        $chucvus->update([
            'ten_chuc_vu'=>$request->ten_chuc_vu,
            'mo_ta'=>$request->mo_ta,
        ]);
        return redirect()->route('chucvu.index')->with('success',"Cập nhật thành công thành công ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chucvu = chucVu::findOrFail($id);
        $chucvu->delete();
        return redirect()->route('chucvu.index')->with('success',"xoá  thành công thành công ");
    }
}
