<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="menu-title">
<span>Main</span>
</li>
<li class="submenu">
<a  href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a class="" href="{{route('admin.home')}}">Admin Dashboard</a></li>
<li><a href="/">Employee Dashboard</a></li>
</ul>
</li>
@if(Auth::guard('admin')->user()->type == 'vendor')
<li class="submenu">
<a  href="#"><i class="la la-cog"></i> <span> Vendor Detail</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li ><a href="{{url('admin/vendor-details-update/personal')}}">Personal Details</a></li>
<li><a href="{{url('admin/vendor-details-update/business')}}">Business Details</a></li>
<li><a href="{{url('admin/vendor-details-update/bank')}}">Bank Details</a></li>
</ul>
</li>
@else
<li class="submenu">
<a href="#"><i class="la la-cog"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="{{route('admin.password')}}">Update Password</a></li>
<li><a href="{{url('admin/details-update')}}">Update Details</a></li>
</ul>
</li>

<li class="submenu">
<a href="#" ><i class="fas fa-tasks"></i> <span> Admin Management</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="{{url('admin/admins/admin')}}">Admins </a></li>
<li><a href="{{url('admin/admins/subadmin')}}">Subadmins</a></li>
<li><a href="{{url('admin/admins/vendor')}}">Vendors</a></li>
<li ><a href="{{url('admin/admins')}}">All</a></li>
</ul>
</li>

<li class="submenu">
<a href="#"><i class="fas fa-users"></i> <span> Users Management</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="{{url('admin/users')}}">Users </a></li>
<li><a href="{{url('admin/subscribers')}}">Subscribers</a></li>

</ul>
</li>

<li class="submenu">
<a href="#"><i class="fas fa-users"></i> <span> Banners Management</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="{{url('admin/banners')}}">Banners </a></li>


</ul>
</li>
@endif
<li class="submenu">
<a href="#"><i class="fas fa-align-justify"></i> <span>Categories Management</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="{{url('admin/section')}}">Section </a></li>
<li><a href="{{url('admin/categories')}}">Categories</a></li>
<li><a href="{{url('admin/brands')}}">Brands</a></li>
<li><a href="{{url('admin/products')}}">Products</a></li>
</ul>
</li>
<li class="menu-title">
<span>Employees</span>
</li>
<li class="submenu">
<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
<ul style="display: none;">
<li><a href="employees.html">All Employees</a></li>
<li><a href="holidays.html">Holidays</a></li>
<li><a href="leaves.html">Leaves (Admin) <span class="badge badge-pill bg-primary float-right">1</span></a></li>


</ul>
</li>






















</ul>
</div>
</div>
</div>