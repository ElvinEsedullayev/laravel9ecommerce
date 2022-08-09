@php
    use App\Models\ProductsFilter;
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
<h4 class="card-title mb-0">Products Filters Value</h4>

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
  <a href="{{url('admin/filters')}}" style="margin-top: 40px;" class="btn btn-primary float-left"><i class="fas fa-eye"></i> Product Filters </a><br><br>
  <a href="{{url('admin/filter-value-add-edit')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
<div class="table-responsive">
<table id="filters" class="table table-striped mb-0">
<thead>
  
<tr>
<th>ID</th>
<th>Filter ID</th>
<th>Filter Name</th>
<th>Filter Value</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($productFilterValues as $filterValue)
<tr>
<td>{{$filterValue['id']}}</td>
<td>{{$filterValue['filter_id']}}</td>
<td>
  {{-- {{$filterValue['filter_id']}} --}}
  @php
      echo ProductsFilter::getFilterName($filterValue['filter_id']);
  @endphp
</td>
<td>{{$filterValue['filter_value']}}</td>
<td>
  @if($filterValue['status'] == 1) 
  <a href="Javascript:void(0)" class="updateFilterValueStatus" id="filtervalue-{{$filterValue['id']}}" filtervalue_id="{{$filterValue['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateFilterValueStatus" id="filtervalue-{{$filterValue['id']}}" filtervalue_id="{{$filterValue['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>
 <a href="{{url('admin/brand-add-edit/'.$filterValue['id'])}}">
  <i class="fa fa-edit fa-lg"></i>
</a>
 {{-- <a href="{{url('admin/section-delete/'.$section['id'])}}" title="section" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i> --}}


  {{-- sweet alert2 javascript --}}
   <a href="Javascript:void(0)" module="filter" filterid="{{$filterValue['id']}}" class="confirmDelete">
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