@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">

<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">{{Auth::guard('admin')->user()->name}}</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.html">Admin Panel</a></li>
<li class="breadcrumb-item active">Product Upadte</li>
</ul>
</div>
</div>
</div>

<div class="card-header">
<h4 class="card-title mb-0">{{$title}}</h4>
</div>
<br>
<form enctype="multipart/form-data" @if(empty($product['id'])) action="{{url('admin/product-add-edit')}}" @else action="{{url('admin/product-add-edit/'.$product['id'])}}" @endif method="POST">
    @csrf
    	@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> {{Session::get('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	@endif
    	@if(Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{Session::get('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif    


<div class="form-group">
<label>Select Category</label>
<select name="category_id" id="category_id" class="form-control">
  <option value="">Select</option>
  @foreach($categories as $section)
  <optgroup label="{{$section['name']}}"></optgroup>
  @foreach($section['categories'] as $category)
  <option @if(!empty($product['category_id']) == $category['id']) selected @endif value="{{$category['id']}}">&nbsp;&nbsp;&nbsp;--&nbsp;{{$category['category_name']}}</option>
  @foreach($category['subcategorie'] as $subcategory)
  <option @if(!empty($product['category_id']) == $subcategory['id']) selected @endif value="{{$subcategory['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;{{$subcategory['category_name']}}</option>
  @endforeach
  @endforeach
  @endforeach
</select>
</div>
<div class="form-group">
<label>Select Brand</label>
<select name="brand_id" id="brand_id" class="form-control">
  <option value="">Select</option>
  @foreach($brands as $brand)
  <option @if(!empty($product['brand_id']) == $brand['id']) selected @endif value="{{$brand['id']}}">{{$brand['name']}}</option>
  @endforeach
</select>
</div>
<div class="form-group">
<label>Product Name</label>
<input type="text" class="form-control" @if(!empty($product['product_name'])) value="{{$product['product_name']}}" @else placeholder="Add product Name" @endif name="product_name">
</div>
<div class="form-group">
<label>Product Code</label>
<input type="text" class="form-control" @if(!empty($product['product_code'])) value="{{$product['product_code']}}" @else  value="{{old('product_code')}}" @endif name="product_code">
</div>
<div class="form-group">
<label>Product Color</label>
<input type="text" class="form-control" @if(!empty($product['product_color'])) value="{{$product['product_color']}}" @else  value="{{old('product_color')}}" @endif name="product_color">
</div>
<div class="form-group">
<label>Product Price</label>
<input type="text" class="form-control" @if(!empty($product['product_price'])) value="{{$product['product_price']}}" @else  value="{{old('product_price')}}" @endif name="product_price">
</div>
<div class="form-group">
<label>Product Discount (%)</label>
<input type="text" class="form-control" @if(!empty($product['product_discount'])) value="{{$product['product_discount']}}" @else value="{{old('product_discount')}}" @endif name="product_discount">
</div>
<div class="form-group">
<label>Product Weight</label>
<input type="text" class="form-control" @if(!empty($product['product_weight'])) value="{{$product['product_weight']}}" @else  value="{{old('product_weight')}}" @endif name="product_weight">
</div>
<div class="form-group">
<label>Product Description</label>
<textarea name="description" id="description"  rows="3" class="form-control">{{$product['description']}}</textarea>
</div>

<div class="form-group">
<label>Product Meta Title</label>
<input type="text" class="form-control" @if(!empty($product['meta_title'])) value="{{$product['meta_title']}}" @else value="{{old('meta_title')}}" @endif name="meta_title">
</div>
<div class="form-group">
<label>Product Meta Description</label>
<input type="text" class="form-control" @if(!empty($product['meta_description'])) value="{{$product['meta_description']}}" @else value="{{old('meta_description')}}" @endif name="meta_description">
</div>
<div class="form-group">
<label>Product Meta Keywords</label>
<input type="text" class="form-control" @if(!empty($product['meta_keywords'])) value="{{$product['meta_keywords']}}" @else value="{{old('meta_keywords')}}" @endif name="meta_keywords">
</div>
<div class="form-group">
<label>Featured Item</label>
<input type="checkbox"  value="Yes"  name="is_featured" @if(!empty($product['is_featured']) && $product['is_featured'] ==  'Yes') checked @endif>
</div>
<div class="form-group">
<label>Best Seller</label>
<input type="checkbox"  value="Yes"  name="is_bestseller" @if(!empty($product['is_bestseller']) && $product['is_bestseller'] ==  'Yes') checked @endif>
</div>
<div class="form-group">
  <label>Product Image (Recomended size: 1000x1000)</label>
<input type="file" class="form-control" name="product_image">
  @if(!empty($product['product_image']))
  <a href="{{url('front/images/products/large/'.$product['product_image'])}}" target="_blank">View Image</a> &nbsp;|&nbsp;
  <a href="Javascript:void(0)" module="product-image" moduleid="{{$product['id']}}" class="confirmDelete">Delete Image</a>
  @endif
<div class="form-group">
  <label>Product Video (Recomended size: Less then 2MB)</label>
<input type="file" class="form-control" name="product_video">
  @if(!empty($product['product_video']))
  <a href="{{url('front/videos/products/'.$product['product_video'])}}" target="_blank">View video</a> &nbsp;|&nbsp;
  <a href="Javascript:void(0)" module="product-video" moduleid="{{$product['id']}}" class="confirmDelete">Delete video</a>
  @endif
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>

</div>

<div>
  
</div>

</div>
@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
