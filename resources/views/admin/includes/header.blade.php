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
                    <a href="{{ route('createTicket') }}" type="button" class="btn btn-primary rounded-4 p-2">
                        <i class="fa fa-plus me-1"></i>Create Ticket
                    </a>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='fa fa-bell fs-22'></i>
                        @if (Auth::guard('admin')->user()->notifications->where('seen', 0)->count() != 0)
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ Auth::guard('admin')->user()->notifications->where('seen', 0)->count() }}</span>
                        @endif
                        
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        @forelse (Auth::guard('admin')->user()->notifications as $notification)
                        <div class="text-reset notification-item d-block dropdown-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-soft-success text-success rounded-circle fs-16">
                                        <i class="fa fa-bell"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-2 lh-base">
                                        {{ $notification->notification }}
                                    </h6>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="fa fa-clock"></i> {{ $notification->created_at->format('l, j F, Y h:i A') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-reset notification-item d-block dropdown-item">
                            <div class="d-flex justify-content-center">
                                <h4 class="pt-4 pb-4"><i class="fa fa-bell-slash me-1"></i>No Notifications!</h4>
                            </div>
                        </div>
                        @endforelse
                        
                        
                    </div>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class='fa fa-envelope fs-22'></i>
                        {{-- <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">0</span> --}}
                    </button>
                    
                </div>
                
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user border" src="{{ Auth::guard('admin')->user()->profile_picture == null ? asset('images/avatar.png') : asset('images/profile_pictures').'/'.Auth::guard('admin')->user()->profile_picture }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::guard('admin')->user()->name }}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('viewMyProfileAdmin') }}"><i class="fa fa-user-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">My Profile</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chat Messages -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel"><i class="fa fa-envelope me-1"></i> Messages</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 overflow-hidden">
            
        </div>
        <div class="offcanvas-foorter border p-3 text-center">
            <a href="javascript:void(0);" class="link-success">Open in Chat Box <i class="fa fa-arrow-right align-middle ms-1"></i></a>
        </div>
    </div>


</header>