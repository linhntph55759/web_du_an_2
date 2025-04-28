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
                            <h4 class="card-title mb-0 flex-grow-1">Danh sách khách hàng</h4>
                            <a href="{{route('khachhang.create')}}" class="btn btn-soft-success material-shadow-none">
                                {{-- <i class="?act=form-them-danh-muc="ri-add-circle-line align-middle me-1"></i> --}}
                                Thêm khách hàng
                            </a>
                        </div><!-- end card header -->
                        <form action="{{route('khachhang.index')}}" method="GET" class="d-flex mb-4">
                            <input type="text" name="keyword" class="form-control me-2" placeholder="Nhập mã hoặc tên " value="{{ request('keyword') }}">

                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Tên </th>
                                                <th scope="col">Mã </th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Địa chỉ  </th>
                                                <th scope="col">SDT</th>
                                                <th scope="col">email</th>
                                                <th scope="col">Ngày sinh</th>
                                                <th scope="col">Số tài khoản</th>
                                                <th scope="col">Ngân hàng</th>
                                                <th scope="col">ngày tạo</th>
                                                <th scope="col">Action</th>
                                            </tr>


                                        </thead>
                                        @foreach ($listKH as $index =>$kh)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$kh->ten_khach_hang}}</td>
                                            <td>{{$kh->ma_khach_hang}}</td>
                                            <td><img src="{{ Storage::url($kh->anh) }}" class="img-thumbnail" alt="hinh anh" width="100px"></td>
                                            <td>{{$kh->dia_chi}}</td>
                                            <td>{{$kh->sdt}}</td>
                                            <td>{{ $kh->email }}</td>
                                            <td>{{ $kh->ngay_sinh }}</td>
                                            <td>{{ $kh->so_tai_khoan }}</td>
                                            <td>{{ $kh->ten_ngan_hang }}</td>
                                            <td>{{ $kh->created_at }}</td>
                                            <td>
                                                <a href="{{route('khachhang.create',$kh->id)}}"class="btn btn-primary">Xem</a>
                                                <a href="{{route('khachhang.edit',$kh->id) }}"class="btn btn-warning">Sửa</a>
                                                <form action="{{route('khachhang.destroy',$kh->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xoá ko ?') ">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">Xoá</button>
                                                </form>

                                            </td>
                                        </tr>
                                            @endforeach
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{$listKH->links("pagination::bootstrap-5")}}
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
