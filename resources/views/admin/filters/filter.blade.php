@php
    use App\Models\Category;
@endphp
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
<h4 class="card-title mb-0">Products Filters</h4>

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
  <a href="{{url('admin/product-filter-values')}}" style="margin-top: 40px;" class="btn btn-primary float-left"><i class="fas fa-eye"></i> Product Filters Values</a><br><br>
  <a href="{{url('admin/filter-add-edit')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
<div class="table-responsive">
<table id="filters" class="table table-striped mb-0">
<thead>
  
<tr>
<th>ID</th>
<th>Categories</th>
<th>Filter Name</th>
<th>Column</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($productFilters as $filter)
<tr>
<td>{{$filter['id']}}</td>
<td>
  {{-- {{$filter['cat_ids']}} --}}
  @php
    $catIds = explode(',',$filter['cat_ids']);
    foreach ($catIds as $key => $catId) {
      $getCategoryName = Category::getCategoryName($catId); 
      echo $getCategoryName.' , ';
    }
     
  @endphp
</td>
<td>{{$filter['filter_name']}}</td>
<td>{{$filter['filter_column']}}</td>
<td>
  @if($filter['status'] == 1) 
  <a href="Javascript:void(0)" class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{$filter['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateFilterStatus" id="filter-{{$filter['id']}}" filter_id="{{$filter['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>
 <a href="{{url('admin/brand-add-edit/'.$filter['id'])}}">
  <i class="fa fa-edit fa-lg"></i>
</a>
 {{-- <a href="{{url('admin/section-delete/'.$section['id'])}}" title="section" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i> --}}


  {{-- sweet alert2 javascript --}}
   <a href="Javascript:void(0)" module="filter" filterid="{{$filter['id']}}" class="confirmDelete">
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