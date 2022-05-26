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
<h4 class="card-title mb-0">Product</h4>

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
  <a href="{{url('admin/product-add-edit')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Yeni</a><br><br>
<div class="table-responsive">
<table id="products" class="table table-striped mb-0">
<thead>
  
<tr>
<th>ID</th>
<th>Product Name</th>
<th>Product Code</th>
<th>Product Color</th>
<th>Section</th>
<th>Category</th>
<th>Added By</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  @foreach($products as $product)
<tr>
<td>{{$product['id']}}</td>
<td>{{$product['product_name']}}</td>
<td>{{$product['product_code']}}</td>
<td>{{$product['product_color']}}</td>
<td>{{$product['section']['name']}}</td>
<td>{{$product['category']['category_name']}}</td>
<td>
  @if($product['admin_type'] ==  'vendor')
  <a href="{{url('admin/view-vendor-details/'.$product['admin_id'])}}">{{$product['admin_type']}}</a>
  @else
  {{$product['admin_type']}}
  @endif
</td>
<td>
  @if($product['status'] == 1) 
  <a href="Javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}">
 {{-- <i class="la la-bookmark" status="Active"></i> --}}
 <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
</a>
  @else 
  <a href="Javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}">
 {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
 <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
</a>
  @endif
</td>
<td>
 <a href="{{url('admin/product-add-edit/'.$product['id'])}}">
  <i class="fa fa-edit fa-lg"></i>
</a>
 {{-- <a href="{{url('admin/section-delete/'.$section['id'])}}" title="section" class="confirmDelete">
  <i class="fa fa-trash fa-lg"></i> --}}


  {{-- sweet alert2 javascript --}}
   <a href="Javascript:void(0)" module="product" moduleid="{{$product['id']}}" class="confirmDelete">
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