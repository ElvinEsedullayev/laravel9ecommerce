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
<form enctype="multipart/form-data" @if(empty($filterValue['id'])) action="{{url('admin/filter-value-add-edit')}}" @else action="{{url('admin/filter-value-add-edit/'.$filterValue['id'])}}" @endif method="POST">
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
<label>Select Filter</label>
<select name="filter_id"  id="filter_id" class="form-control">
  @foreach($productFilters as $filter)
  <option value="{{$filter['id']}}">{{$filter['filter_name']}}</option>
  @endforeach
</select>
</div>
<div class="form-group">
<label>Filter Value</label>
<input type="text" class="form-control" @if(!empty($filterValue['filter_value'])) value="{{$filterValue['filter_value']}}" @else placeholder="Add filter Value" @endif name="filter_value">
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
