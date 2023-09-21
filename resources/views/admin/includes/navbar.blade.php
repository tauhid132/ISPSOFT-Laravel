<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <center><li class="menu-title"><span data-key="t-menu">ISP Management System</span></li></center>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active':''  }}" href="{{ route('viewAdminDashboard') }}" >
                        <i class="fa fa-tachometer"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('crm/*') ? 'active':''  }}" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="fa fa-user"></i> <span data-key="t-apps">CRM</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewUsersPage') }}" class="nav-link" data-key="t-calendar"> All Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat.html" class="nav-link" data-key="t-chat"> User's Setting </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewLeftUsers') }}" class="nav-link" data-key="t-chat"> Left Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarResetPass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass" data-key="t-password-reset">
                                    Resellers
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarResetPass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('viewResellers') }}" class="nav-link" data-key="t-basic">
                                                Resellers List </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-cover.html" class="nav-link" data-key="t-cover">
                                                Reseller Mac </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fa fa-ticket"></i> <span data-key="t-layouts">Support Tickets</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewAllTickets') }}" class="nav-link" data-key="t-horizontal">All Tickets</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#inventory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-briefcase"></i> <span data-key="t-authentication">Inventory</span>
                    </a>
                    <div class="collapse menu-dropdown" id="inventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link" data-key="t-horizontal">Horizontal</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">Detached</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Two Column</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered.html" target="_blank" class="nav-link" data-key="t-hovered">Hovered</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sales" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-shopping-cart"></i> <span data-key="t-authentication">Sales & Marketing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sales">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link" data-key="t-horizontal">Horizontal</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">Detached</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Two Column</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered.html" target="_blank" class="nav-link" data-key="t-hovered">Hovered</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#accounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-sack-dollar"></i> <span data-key="t-authentication">Accounts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="accounts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyBill') }}"  class="nav-link" data-key="t-horizontal">Bill Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewServiceCharges') }}"  class="nav-link" data-key="t-horizontal">Other Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyExpenses') }}"  class="nav-link" data-key="t-two-column">Expenses</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlySalary') }}" class="nav-link" data-key="t-hovered">Salary Sheet</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyUpstreamDownstreamBill') }}"  class="nav-link" data-key="t-hovered">Up/Downstream Bill</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyIncomeStatement') }}?month={{ date('F') }}&year={{ date('Y') }}"  class="nav-link" data-key="t-hovered">Income Statement</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#hrm" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-user"></i> <span data-key="t-authentication">HRM</span>
                    </a>
                    <div class="collapse menu-dropdown" id="hrm">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewEmployees') }}" class="nav-link" data-key="t-horizontal">Employee List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-envelope"></i> <span data-key="t-authentication">SMS</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewReminderSms') }}" class="nav-link" data-key="t-horizontal">Bill Reminder</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">Group SMS</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Single SMS</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered.html" target="_blank" class="nav-link" data-key="t-hovered">SMS Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#mikrotikApi" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-key"></i> <span data-key="t-authentication">Mikrotik API</span>
                    </a>
                    <div class="collapse menu-dropdown" id="mikrotikApi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link" data-key="t-horizontal">Mikrotik List</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached.html" target="_blank" class="nav-link" data-key="t-detached">API Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#stakeholders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-sitemap"></i> <span>Stakeholders</span>
                    </a>
                    <div class="collapse menu-dropdown" id="stakeholders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewUpDownstreams') }}" class="nav-link">Up/Downstreams</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewProductVendors') }}" class="nav-link">Product Vendors</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-cog"></i> <span data-key="t-authentication">Settings</span>
                    </a>
                    <div class="collapse menu-dropdown" id="setting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewAdmins') }}" class="nav-link" data-key="t-horizontal">Admins</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewManualGenerator') }}" class="nav-link" data-key="t-detached">Manual Generator</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewSystemLogs') }}" class="nav-link" data-key="t-two-column">System Logs</a>
                            </li>
                        </ul>
                    </div>
                </li>

                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>