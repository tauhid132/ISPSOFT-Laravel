<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
                <div>
                    <span>
                        <img style="margin-top:5px; margin-left:25px" src="{{ asset('images/logo.png') }}" alt="" height="60">
                    </span> 
                </div>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='fa fa-bell fs-22'></i>
                        {{-- <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">0</span> --}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="text-reset notification-item d-block dropdown-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                    </a>
                                    <div class="fs-13 text-muted">
                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                    </div>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                    </p>
                                </div>
                                <div class="px-2 fs-15">
                                    <div class="form-check notification-check">
                                        <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                        <label class="form-check-label" for="messages-notification-check01"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='fa fa-envelope fs-22'></i>
                        {{-- <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">0</span> --}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="text-reset notification-item d-block dropdown-item">
                            <div class="d-flex">
                                <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                    </a>
                                    <div class="fs-13 text-muted">
                                        <p class="mb-1">We talked about a project on linkedin.</p>
                                    </div>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                    </p>
                                </div>
                                <div class="px-2 fs-15">
                                    <div class="form-check notification-check">
                                        <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                        <label class="form-check-label" for="messages-notification-check01"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ Auth::guard('admin')->user()->profile_picture == null ? asset('images/avatar.png') : asset('images/profile_pictures').'/'.Auth::guard('admin')->user()->profile_picture }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::guard('admin')->user()->name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('viewMyProfileAdmin') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>