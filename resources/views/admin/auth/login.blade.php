<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="Smarthr - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
<meta name="author" content="Dreamguys - Bootstrap Admin Template">
<meta name="robots" content="noindex, nofollow">
<title>Login - HRMS admin template</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/img/favicon.png')}}">

<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">

<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body class="account-page">

<div class="main-wrapper">
<div class="account-content">
<a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a>
<div class="container">

<div class="account-logo">
<a href="index.html"><img src="{{asset('admin/assets/img/logo.png')}}" alt="Admin Dashboard"></a>
</div>

<div class="account-box">
<div class="account-wrapper">
<h3 class="account-title">Login</h3>
<p class="account-subtitle">Access to our dashboard</p>

<form action="{{url('/admin/login')}}" method="POST">
	@csrf
	@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> {{Session::get('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	@endif
	@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
					@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="form-group">
<label>Email Address</label>
<input class="form-control" type="email" name="email" required>
</div>
<div class="form-group">
<div class="row">
<div class="col">
<label>Password</label>
</div>
<div class="col-auto">
<a class="text-muted" href="forgot-password.html">
Forgot password?
</a>
</div>
</div>
<input class="form-control" type="password" name="password" required>
</div>
<div class="form-group text-center">
<button class="btn btn-primary account-btn" type="submit">Login</button>
</div>
<div class="account-footer">
<p>Don't have an account yet? <a href="register.html">Register</a></p>
</div>
</form>

</div>
</div>
</div>
</div>
</div>


<script src="{{asset('admin/assets/js/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>

<script src="{{asset('admin/assets/js/app.js')}}"></script>
</body>
</html>