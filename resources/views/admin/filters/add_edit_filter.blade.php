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
<li class="breadcrumb-item active">Filter Upadte</li>
</ul>
</div>
</div>
</div>

<div class="card-header">
<h4 class="card-title mb-0">{{$title}}</h4>
</div>
<br>
<form enctype="multipart/form-data" @if(empty($filter['id'])) action="{{url('admin/filter-add-edit')}}" @else action="{{url('admin/filter-add-edit/'.$filter['id'])}}" @endif method="POST">
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
<select name="cat_ids[]" multiple="" id="cat_ids" class="form-control">
  <option value="">Select</option>
  @foreach($categories as $section)
  <optgroup label="{{$section['name']}}"></optgroup>
  @foreach($section['categories'] as $category)
  <option @if(!empty($filter['category_id']) == $category['id']) selected @endif value="{{$category['id']}}">&nbsp;&nbsp;&nbsp;--&nbsp;{{$category['category_name']}}</option>
  @foreach($category['subcategorie'] as $subcategory)
  <option @if(!empty($filter['category_id']) == $subcategory['id']) selected @endif value="{{$subcategory['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;{{$subcategory['category_name']}}</option>
  @endforeach
  @endforeach
  @endforeach
</select>
</div>


<div class="form-group">
<label>Filter Name</label>
<input type="text" class="form-control" @if(!empty($filter['filter_name'])) value="{{$filter['filter_name']}}" @else placeholder="Add filter Name" @endif name="filter_name">
</div>
<div class="form-group">
<label>Filter Column</label>
<input type="text" class="form-control" @if(!empty($filter['filter_column'])) value="{{$filter['filter_column']}}" @else placeholder="Add filter Column" @endif name="filter_column">
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
