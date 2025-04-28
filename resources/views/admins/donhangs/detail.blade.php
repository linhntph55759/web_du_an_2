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
                            <a href="" class="btn btn-soft-success material-shadow-none">
                                {{-- <i class="?act=form-them-danh-muc="ri-add-circle-line align-middle me-1"></i> --}}
                                Thêm đơn hàng
                            </a>
                        </div><!-- end card header -->

                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Tên khách hàng</th>
                                                <th>Địa chỉ</th>
                                                <th>Số điện thoại</th>
                                                <th>Đơn hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($khachHangs as $khach)
                                                <tr>
                                                    <td>{{ $khach->ten_khach_hang }}</td>
                                                    <td>{{ $khach->dia_chi }}</td>
                                                    <td>{{ $khach->sdt }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach($khach->donHangs as $donHang)
                                                                <li>Mã đơn hàng: {{ $donHang->ma_don_hang }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">

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
