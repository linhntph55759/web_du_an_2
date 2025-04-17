<?php

namespace App\Http\Controllers;

use App\Models\AdminsCongViec;
use App\Models\chucVu;
use App\Models\phongBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CongViecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $query = AdminsCongViec::query();
            if ($request->filled('keyword')){
                $keyword = $request->input('keyword');
                $query->where(function($q) use ($keyword){
                    $q->where('ten_cong_viec','like', "%{$keyword}%");
                });
            }
    $congviec = $query->orderByDesc('id')->paginate(3);

    return view('admins.congviecs.index',compact('congviec'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $chucVus = chucVu::all();
       $phongBans = phongBan::all();

       return view('admins.congviecs.create',compact('chucVus','phongBans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'ten_cong_viec' => 'required|string|max:255',
                'muc_luong' => 'required',
                'mo_ta' => 'required|string|max:255',
                'ca_lam' => 'required|string|max:255',
                'id_chuc_vu' => 'required|exists:chuvu,id',
                'id_phong_ban' => 'required|exists:phong_ban,id',
            ]);

            $dataCongViec = [
                'ten_cong_viec' => $request->input('ten_cong_viec'),
                'muc_luong' => $request->input('muc_luong'),
                'mo_ta' => $request->input('mo_ta'),
                'ca_lam' => $request->input('ca_lam'),
                'id_chuc_vu' => $request->input('id_chuc_vu'),
                'id_phong_ban' => $request->input('id_phong_ban'),
                'created_at' => now(),
                'updated_at' => null,
            ];
        AdminsCongViec::create($dataCongViec);
        DB::commit();
        return redirect()->route('congviec.index')->with('success' ,'Thêm công việc mới');
        } catch (\Exception $e){
            DB::rollback();

            return redirect()->route('congviec.index')->with('error', 'Có lỗi xảy ra khi thêm công việc: ' . $e->getMessage());
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
        $chucVus = chucVu::all(); // Lấy tất cả chức vụ
        $phongBans = phongBan::all();
        $congviec = AdminsCongViec::findOrFail($id);
        if(!$congviec){
            return redirect()->route('congviec.index')->with('error', 'Nhan vien ko ton tai');

         }
         return view('admins.congviecs.edit', compact('congviec','chucVus','phongBans'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try{
            $congviec = AdminsCongViec::findOrFail($id);
            if(!$congviec){
                return redirect()->route('congviec.index')->with('error','công việc ko tồn tại');
            }
            $request->validate([
                'ten_cong_viec' => 'required|string|max:255',
                'muc_luong' => 'required',
                'mo_ta' => 'required|string|max:255',
                'ca_lam' => 'required|string|max:255',
                'id_chuc_vu' => 'required|exists:chuvu,id',
                'id_phong_ban' => 'required|exists:phong_ban,id',
            ]);

            $dataCongViec = [
                'ten_cong_viec' => $request->input('ten_cong_viec'),
                'muc_luong' => $request->input('muc_luong'),
                'mo_ta' => $request->input('mo_ta'),
                'ca_lam' => $request->input('ca_lam'),
                'id_chuc_vu' => $request->input('id_chuc_vu'),
                'id_phong_ban' => $request->input('id_phong_ban'),
                'created_at' => now(),
                'updated_at' => null,
            ];
        $congviec->update($dataCongViec);
        DB::commit();
        return redirect()->route('congviec.index')->with('success' ,'cập nhật công việc mới');
        } catch (\Exception $e){
            DB::rollback();

            return redirect()->route('congviec.index')->with('error', 'Có lỗi xảy ra khi cập nhật công việc: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $congviec = AdminsCongViec::findOrFail($id);
       $congviec->delete();
       if(!$congviec){
        return redirect()->route('congviec.index')->with('error','công việc ko tồn tại');
    }
        return redirect()->route('congviec.index')->with('success','xoá công việc thành công ạ ');
    }
}
