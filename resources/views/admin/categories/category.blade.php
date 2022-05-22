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
<h4 class="card-title mb-0">Section</h4>

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
  <a href="{{url('admin/category-add-edit')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
<div class="table-responsive">
<table id="categories" class="table table-striped mb-0">
<thead>
  
<tr>
<th>ID</th>
<th>Category</th>
<th>Parent Category</th>
<th>Section</th>
<th>Url</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($categories as $category)
  @if(isset($category['category_parent']['category_name']) && !empty($category['category_parent']['category_name']))
    @php 
      $parent_category = $category['category_parent']['category_name'];
    @endphp
  @else
  @php
  $parent_category = 'Root';
  @endphp
  @endif
<tr>
<td>{{$category['id']}}</td>
<td>{{$category['category_name']}}</td>
<td>{{$parent_category}}</td>
<td>{{$category['section']['name']}}</td>
<td>{{$category['url']}}</td>



<td>
  @if($category['status'] == 1) 
  <a href="Javascript:void(0)" class="updateCategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateCategoryStatus" id="category-{{$category['id']}}" category_id="{{$category['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>
 <a href="{{url('admin/category-add-edit/'.$category['id'])}}">
  <i class="fa fa-edit fa-lg"></i>
</a>
 {{-- <a href="{{url('admin/section-delete/'.$section['id'])}}" title="section" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i> --}}


  {{-- sweet alert2 javascript --}}
   <a href="Javascript:void(0)" module="section" moduleid="{{$category['id']}}" class="confirmDelete">
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