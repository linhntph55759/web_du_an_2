@extends('layouts.admin')

@section('title', 'Thêm bảng lương')

@section('content')
<div class="container mt-4">
    <h4>Thêm bảng lương cho nhân viên</h4>
    <div class="card p-4 shadow-sm">
        <form action="{{ route('bangluong.store', $nhanVien->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <strong>Tên nhân viên:</strong> {{ $nhanVien->ten_nhan_vien }} <br>
                <strong>Email:</strong> {{ $nhanVien->email }} <br>
                <strong>SĐT:</strong> {{ $nhanVien->sdt }} <br>
                @if ($nhanVien->anh_dai_dien)
                    <img src="{{ asset('storage/' . $nhanVien->anh_dai_dien) }}" width="100" class="rounded-circle mt-2" />
                @endif
            </div>

            <div class="mb-3">
                <label for="muc_luong" class="form-label">Mức lương cơ bản:</label>
                <input type="text" id="muc_luong" class="form-control" value="{{ number_format($mucLuong, 0, ',', '.') }} đ" disabled>
            </div>

            <div class="mb-3">
                <label for="tien_thuong" class="form-label">Tiền thưởng:</label>
                <input type="number" name="tien_thuong" class="form-control" step="1000" min="0">
            </div>

            <div class="mt-3">
                <label for="id_trang_thai" class="form-label">Trang Thái</label>
                <select name="id_trang_thai" id="id_trang_thai" class="form-control @error('id_trang_thai') is-invalid @enderror">
                    <option value="">Chọn trạng thái</option>
                    @foreach($trangThai as $trangThai)
                        <option value="{{ $trangThai->id }}" {{ old('id_trang_thai') == $trangThai->id ? 'selected' : '' }}>
                            {{ $trangThai->ten_trang_thai }}
                        </option>
                    @endforeach
                </select>
                @error('id_trang_thai')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Lưu bảng lương</button>
        </form>
    </div>
</div>
@endsection
