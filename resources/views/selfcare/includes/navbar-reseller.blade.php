<div class="app-menu navbar-menu" >
    <div class="navbar-brand-box">
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
        </button>
    </div>

    <div id="scrollbar" class="minimized-sidebar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <center><li class="menu-title"><span data-key="t-menu">Reseller Management Portal</span></li></center>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('viewResellerDashboard') }}" >
                        <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active':''  }}" href="{{ route('viewMyUsers') }}" >
                        <i class="fa fa-user"></i> <span>My Customers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active':''  }}" href="{{ route('viewMyUsers') }}" >
                        <i class="fa fa-ticket"></i> <span>Tickets</span>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>