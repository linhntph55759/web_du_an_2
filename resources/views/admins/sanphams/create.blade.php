@extends('layouts.admin')

@section('title')
    Quản lý sản phẩm
@endsection

@section('CSS')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Quản lý sản phẩm</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới sản phẩm</h4>
                </div>

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div class="mt-3">
                                        <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                        <input type="text"
                                            class="form-control @error('ma_san_pham') is-invalid @enderror"
                                            name="ma_san_pham"
                                            id="ma_san_pham"
                                            value="{{ strtoupper(Str::random(10)) }}"
                                            readonly>
                                        @error('ma_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                        <input type="text"
                                            name="ten_san_pham"
                                            id="ten_san_pham"
                                            placeholder="Nhập tên sản phẩm"
                                            class="form-control @error('ten_san_pham') is-invalid @enderror"
                                            value="{{ old('ten_san_pham') }}">
                                        @error('ten_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="so_luong" class="form-label">Số lượng</label>
                                        <input type="number"
                                            name="so_luong"
                                            id="so_luong"
                                            placeholder="Nhập số lượng"
                                            class="form-control @error('so_luong') is-invalid @enderror"
                                            value="{{ old('so_luong') }}">
                                        @error('so_luong')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="gia" class="form-label">Giá</label>
                                        <input type="number"
                                            name="gia"
                                            id="gia"
                                            placeholder="Nhập giá"
                                            class="form-control @error('gia') is-invalid @enderror"
                                            value="{{ old('gia') }}">
                                        @error('gia')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                        <input type="number"
                                            name="gia_khuyen_mai"
                                            id="gia_khuyen_mai"
                                            placeholder="Nhập giá khuyến mãi"
                                            class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                            value="{{ old('gia_khuyen_mai') }}">
                                        @error('gia_khuyen_mai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="mo_ta" class="form-label">Mô tả</label>
                                        <textarea name="mo_ta" id="mo_ta" rows="4"
                                            class="form-control @error('mo_ta') is-invalid @enderror">{{ old('mo_ta') }}</textarea>
                                        @error('mo_ta')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="trang_thai" class="form-label">Trạng thái</label>
                                        <select name="trang_thai" id="trang_thai" class="form-control @error('trang_thai') is-invalid @enderror">
                                            <option value="1" {{ old('trang_thai') == '1' ? 'selected' : '' }}>Còn hàng</option>
                                            <option value="0" {{ old('trang_thai') == '0' ? 'selected' : '' }}>Hết hàng</option>
                                        </select>
                                        @error('trang_thai')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 text-center">
                                        <button class="btn btn-primary" type="submit">Thêm mới</button>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mt-3">
                                        <label for="anh_san_pham" class="form-label">Hình ảnh</label>
                                        <input type="file" name="anh_san_pham" id="anh_san_pham"
                                            class="form-control @error('anh_san_pham') is-invalid @enderror">
                                        @error('anh_san_pham')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                    @endif
                                </div>

                            </div> <!-- end row -->
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
