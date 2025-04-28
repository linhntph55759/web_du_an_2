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
                        <form action="{{ route('donhang.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <label for="ma_don_hang" class="form-label">Mã </label>
                                        <input type="text"
                                            class="form-control @error('ma_don_hang') is-invalid @enderror"
                                            name="ma_don_hang"
                                            id="ma_don_hang"
                                            value="{{ strtoupper(Str::random(10)) }}"
                                            readonly>
                                        @error('ma_don_hang')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="khach_hang_id" class="form-label">Tên khách hàng</label>
                                        <select name="khach_hang_id" id="khach_hang_id" class="form-control">
                                            <option value="">-- Chọn khách hàng --</option>
                                            @foreach($khachHangs as $khach)
                                                <option value="{{ $khach->id }}"
                                                    data-diachi="{{ $khach->dia_chi }}"
                                                    data-dienthoai="{{ $khach->sdt }}">
                                                    {{ $khach->ten_khach_hang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('khach_hang_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="dia_chi" class="form-label">Địa chỉ</label>
                                        <input type="text" name="dia_chi" id="dia_chi"
                                            class="form-control @error('dia_chi') is-invalid @enderror" readonly>
                                        @error('dia_chi')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="sdt" class="form-label">Số điện thoại</label>
                                        <input type="text" name="sdt" id="sdt"
                                            class="form-control @error('sdt') is-invalid @enderror" readonly>
                                        @error('sdt')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="san_pham_id" class="form-label">Tên sản phẩm</label>
                                        <select name="san_pham_id" id="san_pham_id" class="form-control">
                                            <option value="">-- Chọn sản phẩm --</option>
                                            @foreach($sanPhams as $sp)
                                                <option value="{{ $sp->id }}">{{ $sp->ten_san_pham }}</option>
                                            @endforeach
                                        </select>
                                        @error('san_pham_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="tien_ship" class="form-label">Tiền ship</label>
                                        <input type="number" name="tien_ship" id="tien_ship"
                                            class="form-control @error('tien_ship') is-invalid @enderror" value="{{ old('tien_ship', 0) }}">
                                        @error('tien_ship')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="so_luong" class="form-label">Số lượng</label>
                                        <input type="number" name="so_luong" id="so_luong"
                                            class="form-control @error('so_luong') is-invalid @enderror" min="1" value="{{ old('so_luong', 1) }}">
                                        @error('so_luong')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="ghi_chu" class="form-label">Ghi chú</label>
                                        <input type="text" name="ghi_chu" id="ghi_chu"
                                            class="form-control @error('ghi_chu') is-invalid @enderror" value="{{ old('ghi_chu') }}">
                                        @error('ghi_chu')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label for="trang_thais" class="form-label">Trạng thái</label>
                                        <select name="trang_thais" id="trang_thais" class="form-control">
                                            <option value="1" {{ old('trang_thais') == '1' ? 'selected' : '' }}>Chưa xác nhận</option>
                                            <option value="0" {{ old('trang_thais') == '0' ? 'selected' : '' }}>Đã xác nhận</option>
                                            <option value="2" {{ old('trang_thais') == '2' ? 'selected' : '' }}>Đang vận chuyển</option>
                                            <option value="3" {{ old('trang_thais') == '3' ? 'selected' : '' }}>Đã giao</option>
                                            <option value="4" {{ old('trang_thais') == '4' ? 'selected' : '' }}>Hoàn hàng</option>
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
