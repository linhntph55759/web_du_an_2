@extends('layouts.admin')

@section('title')
    Quản lý nhân viên
@endsection

@section('CSS')
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Thông báo --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Thông tin tài khoản --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin tài khoản</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tên quản trị:</strong> {{ $admin->ten_quan_tri }}</p>
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                    <p><strong>SĐT:</strong> {{ $admin->sdt }}</p>
                    @if ($admin->anh_dai_dien)
                        <p><strong>Ảnh đại diện:</strong></p>
                        <img src="{{ asset('storage/' . $admin->anh_dai_dien) }}" class="rounded-circle border" width="120" alt="Avatar">
                    @endif
                </div>
            </div>

            {{-- Đổi mật khẩu --}}
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Đổi mật khẩu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('taikhoan.changePassword') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại:</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required>
                            @if ($errors->has('current_password'))
                                <div class="text-danger">{{ $errors->first('current_password') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới:</label>
                            <input type="password" name="password" id="new_password" class="form-control" required>
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới:</label>
                            <input type="password" name="password_confirmation" id="new_password_confirmation" class="form-control" required>
                            @if ($errors->has('password_confirmation'))
                                <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-lock-reset"></i> Đổi mật khẩu
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('JS')
@endsection
