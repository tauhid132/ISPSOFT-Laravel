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
                <center><li class="menu-title"><span data-key="t-menu">ISP Management System</span></li></center>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active':''  }}" href="{{ route('viewAdminDashboard') }}" >
                        <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('crm/*') ? 'active':''  }}" href="#crm" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="fa fa-user"></i> <span>Customers</span>
                    </a>
                    <div class="collapse menu-dropdown" id="crm">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewUsersPage') }}" class="nav-link"> All Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewLeftUsers') }}" class="nav-link"> Left Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewNewUsers') }}" class="nav-link"> New Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarResetPass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass">
                                    Resellers
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarResetPass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('viewResellers') }}" class="nav-link">Resellers List</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('viewResellerPackages') }}" class="nav-link">Reseller Packages</a>
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
                                <a href="{{ route('viewAllTickets') }}" class="nav-link">All Tickets</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#inventory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-briefcase"></i> <span>Product Stocks</span>
                    </a>
                    <div class="collapse menu-dropdown" id="inventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewProductCategories') }}" class="nav-link">Product Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewProducts') }}" class="nav-link">Products</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sales" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-shopping-cart"></i> <span>Sales & Marketing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sales">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewNewConnectionQueries') }}" class="nav-link">Connection Queries</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewD2CMarketing') }}" class="nav-link">D2C Marketing</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#accounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-sack-dollar"></i> <span>Accounts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="accounts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyBill') }}"  class="nav-link">Bill Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewResellerInvoices') }}"  class="nav-link">Reseller Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewOtherInvoices') }}"  class="nav-link">Other Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyExpenses') }}"  class="nav-link">Expenses</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlySalary') }}" class="nav-link">Salary Sheet</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyUpstreamDownstreamBill') }}"  class="nav-link">Up/Downstream Bill</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyIncomeStatement') }}?month={{ date('F') }}&year={{ date('Y') }}" class="nav-link">Income Statement</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewPaymentGatewayPayments') }}"  class="nav-link">Payment Gateway Payments</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#hrm" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-user"></i> <span>HRM</span>
                    </a>
                    <div class="collapse menu-dropdown" id="hrm">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewEmployees') }}" class="nav-link">Employee List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-envelope"></i> <span>SMS</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewReminderSms') }}" class="nav-link">Bill Reminder</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewGroupSms') }}" class="nav-link">Group SMS</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewSingleSmsSender') }}" class="nav-link">Single SMS</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewSmsTemplates') }}" class="nav-link">SMS Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#mikrotikApi" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-server"></i> <span>Mikrotik API</span>
                    </a>
                    <div class="collapse menu-dropdown" id="mikrotikApi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewMikrotiks') }}" class="nav-link">Mikrotiks</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewApiUsers') }}" class="nav-link">API Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#network" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-ethernet"></i> <span>Network</span>
                    </a>
                    <div class="collapse menu-dropdown" id="network">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewDistributionPoints') }}" class="nav-link">Distribution Points</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#reports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-bar-chart"></i> <span>Report & Analytics</span>
                    </a>
                    <div class="collapse menu-dropdown" id="reports">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewMonthlyReport') }}" class="nav-link">Monthly Report</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">BTRC Report</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#stakeholders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-sitemap"></i> <span>Vendors</span>
                    </a>
                    <div class="collapse menu-dropdown" id="stakeholders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewUpDownstreams') }}" class="nav-link">Upstreams & Downstreams</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewProductVendors') }}" class="nav-link">Product Vendors</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#setting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fa fa-cog"></i> <span>Settings</span>
                    </a>
                    <div class="collapse menu-dropdown" id="setting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('viewAdmins') }}" class="nav-link">Admins</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewManualGenerator') }}" class="nav-link">Manual Generator</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewPackages') }}" class="nav-link">Packages</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewZones') }}" class="nav-link">Zones</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewSubzones') }}" class="nav-link">Sub Zones</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewTicketTypes') }}" class="nav-link">Ticket Types</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('viewSystemLogs') }}" class="nav-link">System Logs</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>