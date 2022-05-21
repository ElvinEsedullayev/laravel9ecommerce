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
<li class="breadcrumb-item active">Vendor Detail Upadte</li>
</ul>
</div>
</div>
</div>


@if($slug == 'personal')
<div class="card-header">
<h4 class="card-title mb-0">Vendor Personal Detail Update</h4>
</div>
<br>
<form action="{{url('admin/vendor-details-update/personal')}}" method="POST" enctype="multipart/form-data">
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
<label> Vendor User Name / Email</label>
<input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
</div>
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" name="vendor_name"  value="{{$vendorDetail['name']}}">
</div>
<div class="form-group">
<label>Address</label>
<input type="text" class="form-control" name="vendor_address"  value="{{$vendorDetail['address']}}">
</div>
<div class="form-group">
<label>City</label>
<input type="text" class="form-control" name="vendor_city"  value="{{$vendorDetail['city']}}">
</div>
<div class="form-group">
<label>State</label>
<input type="text" class="form-control" name="vendor_state"  value="{{$vendorDetail['state']}}">
</div>
<div class="form-group">
<label>Country</label>
{{-- <input type="text" class="form-control" name="vendor_country"  value="{{$vendorDetail['country']}}"> --}}
<select name="vendor_country" id="" class="form-control">
  <option value="">Select Country</option>
  @foreach($countries as $country)
  <option value="{{$country['country_name']}}" @if($country['country_name'] == $vendorDetail['country']) selected @endif>{{$country['country_name']}}</option>
  @endforeach
</select>
</div>
<div class="form-group">
<label>Pincode</label>
<input type="text" class="form-control" name="vendor_pincode"  value="{{$vendorDetail['pincode']}}">
</div>
<div class="form-group">
<label>Mobile</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['mobile']}}">
</div>
<div class="form-group">
  @if(!empty(Auth::guard('admin')->user()->image))
  <img src="{{asset('admin/images/photes/'.Auth::guard('admin')->user()->image)}}" alt="" width="100">
  @endif
<label>Image</label>
<input type="file" class="form-control" name="image">
<input type="hidden" name="old_image" value="{{Auth::guard('admin')->user()->image}}">
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>






@elseif($slug == 'business')
<div class="card-header">
<h4 class="card-title mb-0">Vendor Bisoness Detail Update</h4>
</div>
<br>
<form action="{{url('admin/vendor-details-update/business')}}" method="POST" enctype="multipart/form-data">
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
<label> Vendor User Name / Email</label>
<input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
</div>
<div class="form-group">
<label>Business Name</label>
<input type="text" class="form-control" name="shop_name"  value="{{$vendorDetail['shop_name']}}">
</div>
<div class="form-group">
<label>Business Address</label>
<input type="text" class="form-control" name="shop_address"  value="{{$vendorDetail['shop_address']}}">
</div>
<div class="form-group">
<label>Business City</label>
<input type="text" class="form-control" name="shop_city"  value="{{$vendorDetail['shop_city']}}">
</div>
<div class="form-group">
<label>Business State</label>
<input type="text" class="form-control" name="shop_state"  value="{{$vendorDetail['shop_state']}}">
</div>
<div class="form-group">
<label>Business Country</label>
{{-- <input type="text" class="form-control" name="shop_country"  value="{{$vendorDetail['shop_country']}}"> --}}
<select name="shop_country" id="" class="form-control">
  <option value="">Select Country</option>
  @foreach($countries as $country)
  <option value="{{$country['country_name']}}" @if($country['country_name'] == $vendorDetail['shop_country']) selected @endif>{{$country['country_name']}}</option>
  @endforeach
</select>
</div>
<div class="form-group">
<label>Business Pincode</label>
<input type="text" class="form-control" name="shop_pincode"  value="{{$vendorDetail['shop_pincode']}}">
</div>
<div class="form-group">
<label>Business Mobile</label>
<input type="text" class="form-control" name="shop_mobile"  value="{{$vendorDetail['shop_mobile']}}">
</div>
<div class="form-group">
<label>Business Proof Address</label>
<select name="address_proof" id="" class="form-control">
  <option value="Passport" @if($vendorDetail['address_proof'] == 'Passport') selected @endif>Passport</option>
  <option value="Voting card" @if($vendorDetail['address_proof'] == 'Voting card') selected @endif>Voting Card</option>
  <option value="Pon" @if($vendorDetail['address_proof'] == 'Pon') selected @endif>Pan</option>
  <option value="Driving License" @if($vendorDetail['address_proof'] == 'Driving License') selected @endif>Driving License</option>
  <option value="Aadhar card" @if($vendorDetail['address_proof'] == 'Aadhar card') selected @endif>Aadhar Card</option>
</select>
</div>
<div class="form-group">
<label>Business License Number</label>
<input type="text" class="form-control" name="businecc_license_number"  value="{{$vendorDetail['businecc_license_number']}}">
</div>
<div class="form-group">
<label>GST Number</label>
<input type="text" class="form-control" name="gst_number"  value="{{$vendorDetail['gst_number']}}">
</div>
<div class="form-group">
<label>PON Number</label>
<input type="text" class="form-control" name="pon_number"  value="{{$vendorDetail['pon_number']}}">
</div>
<div class="form-group">
  {{-- @if(!empty(Auth::guard('admin')->user()->image))
  <img src="{{asset('admin/images/photes/'.Auth::guard('admin')->user()->image)}}" alt="" width="100">
  @endif --}}
<label>Address Proof Image</label>
<input type="file" class="form-control" name="address_proof_image">
{{-- <input type="hidden" name="old_image" value="{{Auth::guard('admin')->user()->image}}"> --}}
@if(!empty($vendorDetail['address_proof_image']))
<a href="{{url('admin/images/proofs/'.$vendorDetail['address_proof_image'])}}" target="_blank">View Address Proof Image</a>
<input type="hidden" name="old_proof_image" value="{{Auth::guard('admin')->user()->image}}">
@endif
</div>
<div class="text-right">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>





@elseif($slug == 'bank')
<div class="card-header">
<h4 class="card-title mb-0">Vendor Bank Detail Update</h4>
</div>
<br>
<form action="{{url('admin/vendor-details-update/bank')}}" method="POST">
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
<label> Vendor User Name / Email</label>
<input type="email" class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly>
</div>
<div class="form-group">
<label>Account Holder Name</label>
<input type="text" class="form-control" name="account_holder_name"  value="{{$vendorDetail['account_holder_name']}}">
</div>
<div class="form-group">
<label>Account Number</label>
<input type="text" class="form-control" name="account_number"  value="{{$vendorDetail['account_number']}}">
</div>
<div class="form-group">
<label>Bank Name</label>
<input type="text" class="form-control" name="bank_name"  value="{{$vendorDetail['bank_name']}}">
</div>
<div class="form-group">
<label>Bank IFSC Code</label>
<input type="text" class="form-control" name="bank_ifsc_code"  value="{{$vendorDetail['bank_ifsc_code']}}">
</div>




<div class="text-right">
<button type="submit" class="btn btn-primary btn-block">Submit</button>
</div>
</form>
@endif
</div>

</div>
@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
