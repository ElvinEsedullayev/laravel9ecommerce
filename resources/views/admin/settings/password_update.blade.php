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
<li class="breadcrumb-item active">Password Upadte</li>
</ul>
</div>
</div>
</div>

<div class="card-header">
<h4 class="card-title mb-0">Admin Password Update</h4>
</div>
<br>
<form action="{{url('admin/password-update')}}" method="POST">
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
<label> Name / Email</label>
<input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
</div>
<div class="form-group">
<label>Admin Type</label>
<input type="text" class="form-control" value="{{Auth::guard('admin')->user()->type}}" readonly>
</div>
<div class="form-group">
<label>Current Password</label>
<input type="password" class="form-control" name="current_password" id="current_password">
<span id="check_password"></span>
</div>
<div class="form-group">
<label>New Password</label>
<input type="password" class="form-control" name="new_password"  id="new_password">
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" name="confirm_password"  id="confirm_password">

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
