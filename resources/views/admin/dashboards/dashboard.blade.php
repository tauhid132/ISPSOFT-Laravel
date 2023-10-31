@if(Auth::guard('admin')->user()->role == 'Admin')
@include('admin.dashboards.admin-dashboard')
@elseif(Auth::guard('admin')->user()->role == 'Accountant')
@include('admin.dashboards.accountant-dashboard')
@elseif(Auth::guard('admin')->user()->role == 'Support')
@include('admin.dashboards.support-dashboard')
@elseif(Auth::guard('admin')->user()->role == 'Sales-Marketing')
@include('admin.dashboards.sales-marketing-dashboard')
@endif
