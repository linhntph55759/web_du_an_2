<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/admins/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/admins/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user"
                    src="{{ $admin && $admin->avatar ? asset('storage/' . $admin->avatar) : asset('assets/admins/images/users/avatar-1.jpg') }}"
                    alt="Avatar" width="40" height="40">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">
                        {{ $admin ? $admin->ten_tai_khoan : 'Chưa đăng nhập' }}
                    </span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">Online</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <h6 class="dropdown-header">Chào {{ $admin ? $admin->ten_tai_khoan : 'bạn' }}!</h6>

            <a class="dropdown-item" href="{{ route('taikhoan.show', $admin->id ?? 0) }}">
                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Thông tin cá nhân</span>
            </a>

            <a class="dropdown-item" href=""
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Đăng xuất</span>
            </a>

            <form id="logout-form" action="{{ route('taikhoan.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="#">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('chucvu.*') ? 'active' : '' }}" href="#sidebarChucVu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarChucVu">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Quản lý chức vụ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarChucVu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('chucvu.index') }}" class="nav-link" data-key="t-sweet-alerts">Danh sách</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('chucvu.create') }}" class="nav-link" data-key="t-nestable-list">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('phongban.*') ? 'active' : '' }}" href="#sidebarPhongBan" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPhongBan">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Quản lý Phòng ban</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPhongBan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('phongban.index') }}" class="nav-link" data-key="t-sweet-alerts">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('phongban.create') }}" class="nav-link" data-key="t-nestable-list">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                    <!-- Quản lý Nhân Viên-->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('nhanvien.*') ? 'active' : '' }}" href="#sidebarNhanVien" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarNhanVien">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Quản lý nhân viên</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarNhanVien">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('nhanvien.index') }}" class="nav-link" data-key="t-sweet-alerts">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('taikhoan.create') }}" class="nav-link" data-key="t-nestable-list">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                    <!-- Quản lý công việc-->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('congviec.*') ? 'active' : '' }}" href="#sidebarNhanVien" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarNhanVien">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Quản lý Cồng việc</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarNhanVien">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('congviec.index') }}" class="nav-link" data-key="t-sweet-alerts">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('congviec.create') }}" class="nav-link" data-key="t-nestable-list">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                    <!-- Quản lý Khách hàng -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('khachhang.*') ? 'active' : '' }}" href="#sidebarKhachHang" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarKhachHang">
                            <i class="ri-stack-line"></i> <span>Quản lý Khách hàng</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarKhachHang">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('khachhang.index') }}" class="nav-link">Danh sách</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('khachhang.create') }}" class="nav-link">Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Quản lý Sản phẩm -->
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('sanpham.*') ? 'active' : '' }}" href="#sidebarSanPham" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSanPham">
                            <i class="ri-stack-line"></i> <span>Quản lý sản phẩm</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSanPham">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('sanpham.index') }}" class="nav-link">Danh sách</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sanpham.create') }}" class="nav-link">Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!------------- Quản lí đơn hang------------>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('donhang.*') ? 'active' : '' }}" href="#sidebarSanPham" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSanPham">
                            <i class="ri-stack-line"></i> <span>Quản lý đơn hàng</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSanPham">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('donhang.index') }}" class="nav-link">Danh sách</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('donhang.create') }}" class="nav-link">Thêm mới</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                            <li class="nav-item">
                                <a href="{{ route('sanpham.create') }}" class="nav-link" data-key="t-nestable-list">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Bán hàng</span></li>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
