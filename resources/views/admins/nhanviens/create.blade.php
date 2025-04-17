@extends('layouts.admin')

@section('title')
    Quản lý nhân viên
@endsection

@section('CSS')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý nhân viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới nhân viên</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới nhân viên</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('nhanvien.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div class="mt-3">
                                            <label for="ma_nhan_vien" class="form-label">Mã nhân viên</label>
                                            <input type="text" class="form-control @error('ma_nhan_vien') is-invalid @enderror"
                                                name="ma_nhan_vien" id="ma_nhan_vien" value="{{ strtoupper(Str::random(10)) }}" readonly>
                                            @error('ma_nhan_vien')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="ten_nhan_vien" class="form-label">Tên nhân viên</label>
                                            <input type="text" name="ten_nhan_vien" id="ten_nhan_vien" placeholder="Nhập tên nhân viên"
                                                class="form-control @error('ten_nhan_vien') is-invalid @enderror" value="{{ old('ten_nhan_vien') }}">
                                            @error('ten_nhan_vien')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="sdt" class="form-label">Số điện thoại</label>
                                            <input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại"
                                                class="form-control @error('sdt') is-invalid @enderror" value="{{ old('sdt') }}">
                                            @error('sdt')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Nhập email"
                                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="mat_khau" class="form-label">Mật khẩu</label>
                                            <input type="password" name="mat_khau" id="mat_khau" placeholder="Nhập mật khẩu"
                                                class="form-control @error('mat_khau') is-invalid @enderror">
                                            @error('mat_khau')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="nam_sinh" class="form-label">Năm sinh</label>
                                            <input type="date" name="nam_sinh" id="nam_sinh"
                                                class="form-control @error('nam_sinh') is-invalid @enderror" value="{{ old('nam_sinh') }}">
                                            @error('nam_sinh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="ngay_lam" class="form-label">Ngày vào làm</label>
                                            <input type="date" name="ngay_lam" id="ngay_lam"
                                                class="form-control @error('ngay_lam') is-invalid @enderror" value="{{ old('ngay_lam') }}">
                                            @error('ngay_lam')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <label for="anh_dai_dien" class="form-label">Hình ảnh</label>
                                            <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control @error('anh_dai_dien') is-invalid @enderror">
                                            @error('anh_dai_dien')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Thêm phần Chức vụ -->
                                        <div class="mt-3">
                                            <label for="chuc_vu_id" class="form-label">Chức vụ</label>
                                            <select name="chuc_vu_id" id="chuc_vu_id" class="form-control @error('chuc_vu_id') is-invalid @enderror">
                                                <option value="">Chọn chức vụ</option>
                                                @foreach($chucVus as $chucVu)
                                                    <option value="{{ $chucVu->id }}" {{ old('chuc_vu_id') == $chucVu->id ? 'selected' : '' }}>
                                                        {{ $chucVu->ten_chuc_vu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('chuc_vu_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Thêm phần Phòng ban -->
                                        <div class="mt-3">
                                            <label for="phong_ban_id" class="form-label">Phòng ban</label>
                                            <select name="phong_ban_id" id="phong_ban_id" class="form-control @error('phong_ban_id') is-invalid @enderror">
                                                <option value="">Chọn phòng ban</option>
                                                @foreach($phongBans as $phongBan)
                                                    <option value="{{ $phongBan->id }}" {{ old('phong_ban_id') == $phongBan->id ? 'selected' : '' }}>
                                                        {{ $phongBan->ten_phong_ban }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('phong_ban_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3 text-center">
                                            <button class="btn btn-primary" type="submit">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection

@section('JS')
    <script src="https://cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection
