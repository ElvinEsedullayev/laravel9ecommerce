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
<h4 class="card-title mb-0">Banners</h4>

	@if(Session::has('success'))
  <br>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	@endif
</div>
<div class="card-body">
  <a href="{{url('admin/banner-add-edit')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
<div class="table-responsive">
<table id="banners" class="table table-striped mb-0">
<thead>
  
<tr>
<th>ID</th>
<th>Image</th>
<th>Title</th>
<th>Link</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($banners as $banner)
<tr>
<td>{{$banner['id']}}</td>
<td>
  @if(!empty($banner['image']))
  <img width="100" src="{{url('front/images/banner/'.$banner['image'])}}" alt="">
  @endif
</td>
<td>{{$banner['title']}}</td>
<td>{{$banner['link']}}</td>
<td>
  @if($banner['status'] == 1) 
  <a href="Javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>
 <a href="{{url('admin/banner-add-edit/'.$banner['id'])}}">
  <i class="fa fa-edit fa-lg"></i>
</a>
 {{-- <a href="{{url('admin/section-delete/'.$section['id'])}}" title="section" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i> --}}


  {{-- sweet alert2 javascript --}}
   <a href="Javascript:void(0)" module="banner" moduleid="{{$banner['id']}}" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i>
</a>
{{-- sweet alert2 javascript --}}
</td>
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