@extends('layouts.admin')

@section('title')
    Thêm đơn hàng
@endsection

@section('CSS')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Quản lý đơn hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Thêm mới đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới đơn hàng</h4>
                </div>

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('donhang.update',$donHang->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="so_luong" class="form-label">Số lượng</label>
                                        <input type="number" class="form-control" name="so_luong" id="so_luong" value="{{ $donHang->so_luong }}">
                                        @error('so_luong')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Trường Tiền ship -->
                                    <div class="mb-3">
                                        <label for="tien_ship" class="form-label">Tiền ship</label>
                                        <input type="number" class="form-control" name="tien_ship" id="tien_ship" value="{{ $donHang->tien_ship }}">
                                        @error('tien_ship')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Trường Trạng thái -->
                                    <div class="mb-3">
                                        <label for="trang_thais" class="form-label">Trạng thái</label>
                                        <select name="trang_thais" id="trang_thais" class="form-control">
                                            <option value="1" {{ $donHang->trang_thais == 1 ? 'selected' : '' }}>Chưa xác nhận</option>
                                            <option value="0" {{ $donHang->trang_thais == 0 ? 'selected' : '' }}>Đã xác nhận</option>
                                            <option value="2" {{ $donHang->trang_thais == 2 ? 'selected' : '' }}>Đang vận chuyển</option>
                                            <option value="3" {{ $donHang->trang_thais == 3 ? 'selected' : '' }}>Đã giao</option>
                                            <option value="4" {{ $donHang->trang_thais == 4 ? 'selected' : '' }}>Hoàn hàng</option>
                                        </select>
                                        @error('trang_thais')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-4 text-center">
                                        <button class="btn btn-primary" type="submit">Thêm mới</button>
                                    </div>

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
<script>
    // Khi chọn khách hàng thì tự động điền địa chỉ và số điện thoại
    document.getElementById('khach_hang_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const diaChi = selected.getAttribute('data-diachi');
        const dienThoai = selected.getAttribute('data-dienthoai');

        document.getElementById('dia_chi').value = diaChi || '';
        document.getElementById('sdt').value = dienThoai || '';
    });
</script>
@endsection
