@extends('layouts.admin')

@section('title')
    Quản lý nhân viên
@endsection

@section('CSS')
@endsection

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý nhân viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Cập nhật nhân viên</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Cập nhật thông tin nhân viên</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('nhanvien.update', $nhanvien->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            {{-- <div class="mt-3">
                                                <label for="ma_nhan_vien" class="form-label">Mã nhân viên</label>
                                                <input type="text" class="form-control @error('ma_nhan_vien') is-invalid @enderror" name="ma_nhan_vien" id="ma_nhan_vien" value="{{ old('ma_nhan_vien', $nhanvien->ma_nhan_vien) }}" readonly>
                                                @error('ma_nhan_vien')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div> --}}

                                            <div class="mt-3">
                                                <label for="ten_nhan_vien" class="form-label">Tên nhân viên</label>
                                                <input type="text" name="ten_nhan_vien" id="ten_nhan_vien" class="form-control @error('ten_nhan_vien') is-invalid @enderror" value="{{ old('ten_nhan_vien', $nhanvien->ten_nhan_vien) }}">
                                                @error('ten_nhan_vien')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="sdt" class="form-label">Số điện thoại</label>
                                                <input type="text" name="sdt" id="sdt" class="form-control @error('sdt') is-invalid @enderror" value="{{ old('sdt', $nhanvien->sdt) }}">
                                                @error('sdt')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $nhanvien->email) }}">
                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="mat_khau" class="form-label">Mật khẩu</label>
                                                <input type="password" name="mat_khau" id="mat_khau" class="form-control @error('mat_khau') is-invalid @enderror" value="{{ old('mat_khau', $nhanvien->mat_khau) }}">
                                                @error('mat_khau')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="nam_sinh" class="form-label">Năm sinh</label>
                                                <input type="date" name="nam_sinh" id="nam_sinh" class="form-control @error('nam_sinh') is-invalid @enderror" value="{{ old('nam_sinh', $nhanvien->nam_sinh) }}">
                                                @error('nam_sinh')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="ngay_lam" class="form-label">Ngày vào làm</label>
                                                <input type="date" name="ngay_lam" id="ngay_lam" class="form-control @error('ngay_lam') is-invalid @enderror" value="{{ old('ngay_lam', $nhanvien->ngay_lam) }}">
                                                @error('ngay_lam')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mt-3">
                                                <label for="anh_dai_dien" class="form-label">Ảnh đại diện</label>
                                                <input type="file" class="form-control @error('anh_dai_dien') is-invalid @enderror" name="anh_dai_dien" id="anh_dai_dien">
                                                <img src="{{ Storage::url($nhanvien->anh_dai_dien) }}" class="img-thumbnail" alt="Ảnh đại diện" width="100px">
                                                @error('anh_dai_dien')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="chuc_vu_id" class="form-label">Chức vụ</label>
                                                <select name="chuc_vu_id" id="chuc_vu_id" class="form-select @error('chuc_vu_id') is-invalid @enderror">
                                                    <!-- Add dynamic options based on your roles -->
                                                    <option value="">Chọn chức vụ</option>
                                                @foreach($chucVus as $chucVu)
                                                    <option value="{{ $chucVu->id }}" {{ old('chuc_vu_id',$nhanvien->chuc_vu_id) == $chucVu->id ? 'selected' : '' }}>
                                                        {{ $chucVu->ten_chuc_vu }}
                                                    </option>
                                                    @endforeach
                                                    <!-- Add other roles as needed -->
                                                </select>
                                                @error('chuc_vu_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="phong_ban_id" class="form-label">Phòng ban</label>
                                                <select name="phong_ban_id" id="phong_ban_id" class="form-select @error('phong_ban_id') is-invalid @enderror">
                                                    <!-- Add dynamic options based on your departments -->
                                                    <option value="">Chọn phong ban</option>
                                                    @foreach($phongBans as $phongBan)
                                                        <option value="{{ $phongBan->id }}" {{ old('phong_ban_id',$nhanvien->phong_ban_id) == $phongBan->id ? 'selected' : '' }}>
                                                            {{ $phongBan->ten_phong_ban }}
                                                        </option>
                                                        @endforeach
                                                    <!-- Add other departments as needed -->
                                                </select>
                                                @error('phong_ban_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                                    <!-- Add dynamic options based on your salary table -->
                                            <div class="mt-3 text-center">
                                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>
@endsection

@section('JS')
    <script src="https://cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection
