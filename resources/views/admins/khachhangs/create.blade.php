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
                    <h4 class="mb-sm-0">Quản lý khách hàng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới khách hàng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới Khách hàng</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('khachhang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div class="mt-3">
                                            <label for="ma_khach_hang" class="form-label">Mã khách hàng</label>
                                            <input type="text" class="form-control @error('ma_khach_hang') is-invalid @enderror"
                                                name="ma_khach_hang" id="ma_khach_hang" value="{{ strtoupper(Str::random(10)) }}" readonly>
                                            @error('ma_khach_hang')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="ten_khach_hang" class="form-label">Tên khách hàng</label>
                                            <input type="text" name="ten_khach_hang" id="ten_khach_hang" placeholder="Nhập tên nhân viên"
                                                class="form-control @error('ten_khach_hang') is-invalid @enderror" value="{{ old('ten_khach_hang') }}">
                                            @error('ten_khach_hang')
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
                                            <label for="ngay_sinh" class="form-label">Năm sinh</label>
                                            <input type="date" name="ngay_sinh" id="ngay_sinh"
                                                class="form-control @error('ngay_sinh') is-invalid @enderror" value="{{ old('ngay_sinh') }}">
                                            @error('ngay_sinh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="dia_chi" class="form-label">Địa chỉ giao hàng</label>
                                            <input type="text" name="dia_chi" id="dia_chi"
                                                class="form-control @error('dia_chi') is-invalid @enderror" value="{{ old('dia_chi') }}">
                                            @error('dia_chi')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <label for="anh" class="form-label">Hình ảnh</label>
                                            <input type="file" name="anh" id="anh" class="form-control @error('anh') is-invalid @enderror">
                                            @error('anh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="so_tai_khoan" class="form-label">Số TK</label>
                                            <input type="number" name="so_tai_khoan" id="so_tai_khoan"
                                                class="form-control @error('so_tai_khoan') is-invalid @enderror" value="{{ old('so_tai_khoan') }}">
                                            @error('so_tai_khoan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                        <!-- Thêm phần Chức vụ -->
                                        <div class="mt-3">
                                            <label for="ten_ngan_hang" class="form-label">Ngân hàng</label>
                                            <select name="ten_ngan_hang" id="ten_ngan_hang" class="form-control @error('ten_ngan_hang') is-invalid @enderror">
                                                <option value="teckcombank">Teckcombank</option>
                                                <option value="MB">MB bank</option>
                                                <option value="TP bank">TP bank</option>
                                                 <option></option>
                                                 <option></option>
                                            </select>
                                            @error('ten_ngan_hang')
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
