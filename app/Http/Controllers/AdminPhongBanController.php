<?php

namespace App\Http\Controllers;

use App\Models\phongBan;
use Illuminate\Http\Request;

class AdminPhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = phongBan::query();
        $search = $request->get('search');
        if($search){
            $phongban = phongBan::where('ten_phong_ban','like','%' .$search .'%')->paginate(3);
        }else{
            $phongban = $query->orderByDesc('id')->paginate(4);
        }
        return view('admins.phongbans.index',compact('phongban'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admins.phongbans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_phong_ban'=>'required|unique:phong_ban,ten_phong_ban|max:255',
            'mo_ta'=>'nullable',
        ]);

        phongBan::create([
            'ten_phong_ban'=>$request->ten_phong_ban,
            'mo_ta'=>$request->mo_ta,
        ]);

        return redirect()->route('phongban.index')->with('success' , 'Thêm phong ban thanh công');
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
        $phongbans = phongBan::findOrFail($id);
        return view('admins.phongbans.edit',compact('phongbans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_phong_ban'=>'required|unique:phong_ban,ten_phong_ban|max:255',
            'mo_ta'=>'nullable',
        ]);
        $phongban = phongBan::findOrFail($id);
        $phongban->update([
            'ten_phong_ban'=>$request->ten_phong_ban,
            'mo_ta'=>$request->mo_ta,
        ]);
        return redirect()->route('phongban.index')->with('success','Cập nhật thành công ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phongban = phongBan::findOrFail($id);
        $phongban->delete();
        return redirect()->route('phongban.index')->with('success','Xoá  thành công ');
    }
}
