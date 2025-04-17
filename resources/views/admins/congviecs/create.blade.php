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
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới công việc </h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('congviec.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row gy-4">
                                    <div class="col-md-4">

                                        <div class="mt-3">
                                            <label for="ten_cong_viec" class="form-label">Tên công việc</label>
                                            <input type="text" name="ten_cong_viec" id="ten_cong_viec" placeholder="Nhập tên công việc"
                                                class="form-control @error('ten_cong_viec') is-invalid @enderror" value="{{ old('ten_cong_viec') }}">
                                            @error('ten_cong_viec')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="mo_ta" class="form-label">Mô tả công việc</label>
                                            <textarea name="mo_ta" id="mo_ta" placeholder="Nhập mô tả"
                                                class="form-control @error('mo_ta') is-invalid @enderror">{{ old('mo_ta', $congviec->mo_ta ?? '') }}</textarea>
                                            @error('mo_ta')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mt-3">
                                            <label for="muc_luong" class="form-label">Mức luong</label>
                                            <input type="number" name="muc_luong" id="muc_luong" placeholder="Nhập muc luong"
                                                class="form-control @error('muc_luong') is-invalid @enderror" value="{{ old('muc_luong') }}">
                                            @error('muc_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="ca_lam" class="form-label">Ca làm</label>
                                            <input type="text" name="ca_lam" id="ca_lam" placeholder="Nhập ca làm"
                                                class="form-control @error('ca_lam') is-invalid @enderror">
                                            @error('ca_lam')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <!-- Thêm phần Chức vụ -->
                                        <div class="mt-3">
                                            <label for="id_chuc_vu" class="form-label">Chức vụ</label>
                                            <select name="id_chuc_vu" id="id_chuc_vu" class="form-control @error('id_chuc_vu') is-invalid @enderror">
                                                <option value="">Chọn chức vụ</option>
                                                @foreach($chucVus as $chucVu)
                                                    <option value="{{ $chucVu->id }}" {{ old('id_chuc_vu') == $chucVu->id ? 'selected' : '' }}>
                                                        {{ $chucVu->ten_chuc_vu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_chuc_vu')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Thêm phần Phòng ban -->
                                        <div class="mt-3">
                                            <label for="id_phong_ban" class="form-label">Phòng ban</label>
                                            <select name="id_phong_ban" id="id_phong_ban" class="form-control @error('id_phong_ban') is-invalid @enderror">
                                                <option value="">Chọn phòng ban</option>
                                                @foreach($phongBans as $phongBan)
                                                    <option value="{{ $phongBan->id }}" {{ old('id_phong_ban') == $phongBan->id ? 'selected' : '' }}>
                                                        {{ $phongBan->ten_phong_ban }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_phong_ban')
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
