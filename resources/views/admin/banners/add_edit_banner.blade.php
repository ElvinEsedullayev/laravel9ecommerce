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
<form enctype="multipart/form-data" @if(empty($banner['id'])) action="{{url('admin/banner-add-edit')}}" @else action="{{url('admin/banner-add-edit/'.$banner['id'])}}" @endif method="POST">
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
<label>Title </label>
<input type="text" class="form-control" @if(!empty($banner['title'])) value="{{$banner['title']}}" @else placeholder="Add banner title" @endif name="title">
</div>
<div class="form-group">
<label>Alt Title </label>
<input type="text" class="form-control" @if(!empty($banner['alt'])) value="{{$banner['alt']}}" @else placeholder="Add banner alt title" @endif name="alt">
</div>
<div class="form-group">
<label>Link </label>
<input type="text" class="form-control" @if(!empty($banner['link'])) value="{{$banner['link']}}" @else placeholder="Add banner link" @endif name="link">
</div>

<div class="form-group">
  <label>Banner Image </label>
<input type="file" class="form-control" name="image">
  @if(!empty($banner['image']))
  <a href="{{url('front/images/banner/'.$banner['image'])}}" target="_blank">View Image</a> &nbsp;|&nbsp;
  <a href="Javascript:void(0)" module="banner-image" moduleid="{{$banner['id']}}" class="confirmDelete">Delete Image</a>
  @endif
</div>
<div class="form-group">
    <label>Banner Type </label>
    <select name="type" id="" class="form-control" required>
        <option value="">Select</option>
        <option value="Slider" @if(!empty($banner['type']) && $banner['type'] == 'Slider') selected @endif>Slider</option>
        <option value="Fix" @if(!empty($banner['type']) && $banner['type'] == 'Fix') selected @endif>Fix</option>
    </select>
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
