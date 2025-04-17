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
                            <form action="{{ route('taikhoan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row gy-4">
                                    <div class="col-md-4">


                                        <div class="mt-3">
                                            <label for="ten_quan_tri" class="form-label">Tên nhân viên</label>
                                            <input type="text" name="ten_quan_tri" id="ten_quan_tri" placeholder="Nhập tên nhân viên"
                                                class="form-control @error('ten_quan_tri') is-invalid @enderror" value="{{ old('ten_quan_tri') }}">
                                            @error('ten_quan_tri')
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
                                            <label for="password" class="form-label">Mật khẩu mặc định</label>
                                            <input type="text" id="password" value="1234" class="form-control" disabled>
                                            <small class="text-muted">Mật khẩu mặc định là 1234 (người dùng có thể đổi sau).</small>
                                        </div>

                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control @error('anh_dai_dien') is-invalid @enderror">
                                            @error('anh_dai_dien')
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
