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
                            <h4 class="card-title mb-0 flex-grow-1">Danh sách bảng lương</h4>
                            <a href="" class="btn btn-soft-success material-shadow-none">
                                Thêm bảng lương
                            </a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mã NV</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>SĐT</th>
                                                <th>Lương cơ bản</th>
                                                <th>Thưởng</th>
                                                <th>Tổng lương</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data  as $index => $bl)
                                            dd($bl);
                                                <tr>
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{ $bl['ma_nhan_vien'] }}</td>
                                                    <td>{{ $bl['ten_nhan_vien'] }}</td>
                                                    <td>{{ $bl['email'] }}</td>
                                                    <td>{{ $bl['sdt'] }}</td>
                                                    <td>{{ number_format($bl['luong_co_ban']) }} VNĐ</td>
                                                    <td>{{ number_format($bl['tien_thuong']) }} VNĐ</td>
                                                    <td><strong>{{ number_format($bl['tong_luong']) }} VNĐ</strong></td>
                                                    <td>{{ $bl['ten_trang_thai'] }}</td>

                                                    <td>
                                                        @if($bl['ten_trang_thai'] !== 'Đã thanh toán')
                                                        <a href="{{route('bangluong.edit',$bl['nhan_vien_id'])}}" class="btn btn-warning">Sửa</a>
                                                        @endif
                                                        <form action="" method="POST" onsubmit="return confirm('Bạn có muốn xoá ko ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Xoá</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
