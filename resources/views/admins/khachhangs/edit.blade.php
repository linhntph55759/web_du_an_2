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
                            <form action="{{ route('khachhang.update',$khachHang->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @METHOD('PUT')


                                        <div class="mt-3">
                                            <label for="ten_khach_hang" class="form-label">Tên khách hàng</label>
                                            <input type="text" name="ten_khach_hang" id="ten_khach_hang" placeholder="Nhập tên nhân viên"
                                                class="form-control @error('ten_khach_hang') is-invalid @enderror" value="{{ $khachHang->ten_khach_hang }}">
                                            @error('ten_khach_hang')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="sdt" class="form-label">Số điện thoại</label>
                                            <input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại"
                                                class="form-control @error('sdt') is-invalid @enderror" value="{{ $khachHang->sdt }}">
                                            @error('sdt')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Nhập email"
                                                class="form-control @error('email') is-invalid @enderror" value="{{ $khachHang->email}}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mt-3">
                                            <label for="ngay_sinh" class="form-label">Năm sinh</label>
                                            <input type="date" name="ngay_sinh" id="ngay_sinh"
                                                class="form-control @error('ngay_sinh') is-invalid @enderror" value="{{ $khachHang->ngay_sinh }}">
                                            @error('ngay_sinh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="dia_chi" class="form-label">Địa chỉ giao hàng</label>
                                            <input type="text" name="dia_chi" id="dia_chi"
                                                class="form-control @error('dia_chi') is-invalid @enderror" value="{{$khachHang->dia_chi }}">
                                            @error('dia_chi')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <label for="anh" class="form-label">Hình ảnh</label>
                                            <input type="file" name="anh" id="anh" class="form-control @error('anh') is-invalid @enderror">

                                            <!-- Hiển thị ảnh cũ hoặc ảnh mặc định nếu không có ảnh cũ -->
                                            @if($khachHang->anh)
                                                <img src="{{ asset('storage/' . $khachHang->anh) }}" alt="Ảnh khách hàng" width="100px">
                                            @else
                                                <img src="{{ asset('storage/uploads/khachhangs/default.jpg') }}" alt="Ảnh mặc định" width="100px">
                                            @endif
                                    
                                            @error('anh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                        <div class="mt-3">
                                            <label for="so_tai_khoan" class="form-label">Số TK</label>
                                            <input type="number" name="so_tai_khoan" id="so_tai_khoan"
                                                class="form-control @error('so_tai_khoan') is-invalid @enderror" value="{{ $khachHang->so_tai_khoan }}">
                                            @error('so_tai_khoan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                        <!-- Thêm phần Chức vụ -->
                                        <div class="mt-3">
                                            <label for="ten_ngan_hang" class="form-label">Ngân hàng</label>
                                            <select name="ten_ngan_hang" id="ten_ngan_hang" class="form-control @error('ten_ngan_hang') is-invalid @enderror">
                                                <option value="">Chọn ngân hàng</option>
                                                <option value="teckcombank" {{ old('ten_ngan_hang', $khachHang->ten_ngan_hang) == 'teckcombank' ? 'selected' : '' }}>Teckcombank</option>
                                                <option value="MB" {{ old('ten_ngan_hang', $khachHang->ten_ngan_hang) == 'MB' ? 'selected' : '' }}>MB bank</option>
                                                <option value="TP bank" {{ old('ten_ngan_hang', $khachHang->ten_ngan_hang) == 'TP bank' ? 'selected' : '' }}>TP bank</option>
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
