

{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sản phẩm
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
                    <h4 class="mb-sm-0">Quản lý nhân viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thêm mới </h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('phongban.store') }}" method="POST" enctype="multipart/form-data">
                                    {{-- Khi sử dụng form trong Laravel bắt buộc phải có @csrf --}}
                                    @csrf

                                    <div class="row gy-4">
                                        <div class="col-md-4">


                                            <div class="mt-3">
                                                <label for="ten_phong_ban" class="form-label">Tên nhân viên</label>
                                                <input type="text" name="ten_phong_ban" id="ten_phong_ban"
                                                    placeholder="Nhập tên phòng ban"
                                                    class="form-control @error('ten_phong_ban') is-invalid @enderror"
                                                    value="{{ old('ten_phong_ban') }}">
                                                @error('ten_phong_ban')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mt-3">
                                                <label for="mo_ta" class="form-label">Mô tả</label>
                                                <input type="text"  name="mo_ta"
                                                    class="form-control @error('mo_ta') is-invalid @enderror" id="mo_ta"
                                                    placeholder="mo_ta" value="{{ old('mo_ta') }}">
                                                @error('mo_ta')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end col-->
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
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection
