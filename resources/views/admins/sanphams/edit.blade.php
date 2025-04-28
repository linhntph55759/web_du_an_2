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
                    <h4 class="mb-sm-0">Quản lý sản phẩm</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Cập nhật sản phẩm </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Cập nhật sản phẩm</h4>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <form action="{{ route('sanpham.update',$sanPham->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @METHOD('PUT')


                                        <div class="mt-3">
                                            <label for="ten_san_pham" class="form-label">Tên sản phẩm </label>
                                            <input type="text" name="ten_san_pham" id="ten_san_pham" placeholder="Nhập tên nhân viên"
                                                class="form-control @error('ten_san_pham') is-invalid @enderror" value="{{ $sanPham->ten_san_pham }}">
                                            @error('ten_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="mo_ta" class="form-label">Mô tả </label>
                                            <input type="text" name="mo_ta" id="mo_ta" placeholder="Nhập mô tả"
                                                class="form-control @error('mo_ta') is-invalid @enderror" value="{{ $sanPham->mo_ta }}">
                                            @error('mo_ta')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="so_luong" class="form-label">so luong</label>
                                            <input type="number" name="so_luong" id="so_luong" placeholder="Nhập so_luong"
                                                class="form-control @error('so_luong') is-invalid @enderror" value="{{ $sanPham->so_luong}}">
                                            @error('so_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mt-3">
                                            <label for="gia" class="form-label">Giá sản phẩm </label>
                                            <input type="number" name="gia" id="gia"
                                                class="form-control @error('gia') is-invalid @enderror" value="{{ $sanPham->gia }}">
                                            @error('gia')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <label for="gia_khuyen_mai" class="form-label">Giá Khuyến mại</label>
                                            <input type="text" name="gia_khuyen_mai" id="gia_khuyen_mai"
                                                class="form-control @error('gia_khuyen_mai') is-invalid @enderror" value="{{$sanPham->gia_khuyen_mai }}">
                                            @error('gia_khuyen_mai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="mt-3">
                                            <label for="anh_san_pham" class="form-label">Hình ảnh</label>
                                            <input type="file" name="anh_san_pham" id="anh_san_pham" class="form-control @error('anh_san_pham') is-invalid @enderror">

                                            <!-- Hiển thị ảnh cũ hoặc ảnh mặc định nếu không có ảnh cũ -->
                                            @if($sanPham->anh_san_pham)
                                                <img src="{{ asset('storage/' . $sanPham->anh_san_pham) }}" alt="Ảnh khách hàng" width="100px">
                                            @else
                                                <img src="{{ asset('storage/uploads/sanphams/default.jpg') }}" alt="Ảnh mặc định" width="100px">
                                            @endif

                                            @error('anh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                        <!-- Thêm phần  trạng thái -->
                                        <div class="mt-3">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <select name="trang_thai" id="trang_thai" class="form-control @error('trang_thai') is-invalid @enderror">
                                                <option value="">Chọn trạng thái</option>
                                                <option value="1" {{ old('trang_thai', $sanPham->trang_thai) == '1' ? 'selected' : '' }}>Còn hàng</option>
                                                <option value="0" {{ old('trang_thai', $sanPham->trang_thai) == '0' ? 'selected' : '' }}>Hết hàng</option>

                                            </select>
                                            @error('trang_thai')
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
