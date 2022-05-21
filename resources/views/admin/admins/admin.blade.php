@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">

<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Blank Page</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
<li class="breadcrumb-item active">Blank Page</li>
</ul>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4 class="card-title mb-0">{{$title}}</h4>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped mb-0">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Type</th>
<th>Email</th>
<th>Mobile</th>
<th>Image</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($admins as $admin)
<tr>
<td>{{$admin['id']}}</td>
<td>{{$admin['name']}}</td>
<td>{{$admin['type']}}</td>
<td>{{$admin['email']}}</td>
<td>{{$admin['mobile']}}</td>
<td>
  <img src="{{asset('admin/images/photes/'.$admin['image'])}}" width="50" class="circle" alt=""></td>
<td>
  @if($admin['status'] == 1) 
  <a href="Javascript:void(0)" class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>@if($admin['type'] == 'vendor') <a href="{{url('admin/view-vendor-details/'.$admin['id'])}}"><i class="fa fa-file fa-lg"></i></a> @endif</td>
</tr>
@endforeach

</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
@endsection