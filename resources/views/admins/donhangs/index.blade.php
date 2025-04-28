{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý nhân viên
@endsection

@section('CSS')

@endsection

{{-- @section: dùng để chị định phần nội dụng được hiển thị --}}
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong> {{session('success')}} </strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
       @endif

       <!-- Danger Alert -->
       @if(session('error'))
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>  {{session('error')}} </strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
       @endif
        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Danh sách sản phẩm</h4>
                            <a href="{{route('donhang.create')}}" class="btn btn-soft-success material-shadow-none">
                                {{-- <i class="?act=form-them-danh-muc="ri-add-circle-line align-middle me-1"></i> --}}
                                Thêm đơn hàng
                            </a>
                        </div><!-- end card header -->
                        <form action="{{route('donhang.index')}}" method="GET" class="d-flex mb-4">
                            <input type="text" name="keyword" class="form-control me-2" placeholder="Nhập mã hoặc tên " value="{{ request('keyword') }}">

                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="text-center" >
                                                <th>ID</th>
                                                <th>Mã đơn hàng</th>
                                                <th>Khách hàng</th>
                                                <th>SĐT</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền</th>
                                                <th>Tiền ship</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donHangs as $key => $don)
                                                <tr class="text-center">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $don->ma_don_hang }}</td>
                                                    <td>{{ $don->ten_khach_hang }}</td>
                                                    <td>{{ $don->sdt }}</td>
                                                    <td>{{ $don->ten_san_pham }}</td>
                                                    <td>{{ $don->so_luong }}</td>
                                                    <td>{{ number_format($don->tong_tien) }} đ</td>
                                                    <td>{{ number_format($don->tien_ship) }} đ</td>
                                                    <td>
                                                        @if($don->trang_thais == 0)
                                                            <span class="badge bg-success">Đã xác nhận</span>
                                                        @elseif($don->trang_thais == 1)
                                                            <span class="badge bg-warning">Chưa xác nhận</span>
                                                        @elseif($don->trang_thais == 2)
                                                            <span class="badge bg-info">Đang vận chuyển</span>
                                                        @elseif($don->trang_thais == 3)
                                                            <span class="badge bg-primary">Đã giao</span>
                                                        @elseif($don->trang_thais == 4)
                                                            <span class="badge bg-danger">Hoàn hàng</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $don->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <a href="{{route('khachhangmua.show' )}}"class="btn btn-primary">Xem KH đã mua</a>
                                                        <a href="{{route('donhang.edit',$don->id) }}"class="btn btn-warning">Sửa</a>



                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{$donHangs->links("pagination::bootstrap-5")}}
                                    </div>
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->

                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>

    </div>
@endsection

@section('JS')
@endsection
