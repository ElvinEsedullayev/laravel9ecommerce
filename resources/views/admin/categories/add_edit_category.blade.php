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
<li class="breadcrumb-item active">Category Upadte</li>
</ul>
</div>
</div>
</div>

<div class="card-header">
<h4 class="card-title mb-0">{{$title}}</h4>
</div>
<br>
<form @if(empty($category['id'])) action="{{url('admin/category-add-edit')}}" @else action="{{url('admin/category-add-edit/'.$category['id'])}}" @endif method="POST">
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
<label>Category Name</label>
<input type="text" class="form-control" @if(!empty($category['category_name'])) value="{{$category['category_name']}}" @else placeholder="Add Category Name" @endif name="category_name">
</div>
<div class="form-group">
<label>Select Section</label>
<select name="section_id" id="section_id" class="form-control">
  <option value="">Select</option>
  @foreach($sections as $section)
  <option value="{{$section['id']}}" @if(!empty($category['section_id']) && $category['section_id']==$section['id']) selected @endif>{{$section['name']}}</option>
  @endforeach
</select>
</div>
<div id="appendCategoriesLevel">
  @include('admin.categories.append_categories_level')
</div>
<div class="form-group">
<label>Category Discount</label>
<input type="text" class="form-control" @if(!empty($category['category_discount'])) value="{{$category['category_discount']}}" @else value="{{old('category_discount')}}" @endif name="category_discount">
</div>
<div class="form-group">
<label>Category Description</label>
<textarea name="description" id="description"  rows="3" class="form-control"></textarea>
</div>

<div class="form-group">
<label>Category Url</label>
<input type="text" class="form-control" @if(!empty($category['url'])) value="{{$category['url']}}" @else value="{{old('url')}}" @endif name="category_url">
</div>
<div class="form-group">
<label>Category Meta Title</label>
<input type="text" class="form-control" @if(!empty($category['meta_title'])) value="{{$category['meta_title']}}" @else value="{{old('meta_title')}}" @endif name="meta_title">
</div>
<div class="form-group">
<label>Category Meta Description</label>
<input type="text" class="form-control" @if(!empty($category['meta_description'])) value="{{$category['meta_description']}}" @else value="{{old('meta_description')}}" @endif name="meta_description">
</div>
<div class="form-group">
<label>Category Meta Keywords</label>
<input type="text" class="form-control" @if(!empty($category['meta_keywords'])) value="{{$category['meta_keywords']}}" @else value="{{old('meta_keywords')}}" @endif name="meta_keywords">
</div>
<div class="form-group">
  @if(!empty($category['category_image']))
  <img src="{{asset('admin/images/categories/'.$category['category_image'])}}" alt="" width="200">
  @endif
<label>Category Image</label>
<input type="file" class="form-control" name="category_image">
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>

</div>

</div>
@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
