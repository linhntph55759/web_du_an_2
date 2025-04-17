
<style>
    .img-avatar {
        width: 50px; /* Đặt chiều rộng ảnh */
        height: 50px; /* Đảm bảo chiều cao ảnh tương ứng */
        border-radius: 50%; /* Bo tròn ảnh */
        object-fit: cover; /* Đảm bảo ảnh không bị méo */
        border: 2px solid #ddd; /* Thêm viền xung quanh ảnh */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Thêm bóng cho ảnh */
    }
</style>

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admins/images/logo-light.png') }}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $admin->anh_dai_dien) }}" class="img-avatar" alt="Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{$admin->ten_quan_tri}}</span>

                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome Anna!</h6>

       <a class="dropdown-item" href="{{ route('taikhoan.profile') }}"><i                         class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="{{ route('taikhoan.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                 <span class="align-middle" data-key="t-logout">Logout</span>
                             </a>

                             <form id="logout-form" action="{{ route('taikhoan.logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
