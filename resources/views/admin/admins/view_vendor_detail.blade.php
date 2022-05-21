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
<li class="breadcrumb-item active">Vendor Detail</li>
</ul>
</div>
</div>
</div>



<div class="card-header">
<h4 class="card-title mb-0">Vendor Personal Information</h4>
  <a href="{{url('admin/admins/vendor')}}" class="btn btn-danger btn-xs float-right"> Back to Vendors</a>
</div>
<br>
 
<div class="form-group">
<label> Vendor Email</label>
<input type="email" class="form-control" value="{{$vendorDetail['vendor_personal']['email']}}" readonly>
</div>
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" name="vendor_name"  value="{{$vendorDetail['vendor_personal']['name']}}"readonly>
</div>
<div class="form-group">
<label>Address</label>
<input type="text" class="form-control" name="vendor_address"  value="{{$vendorDetail['vendor_personal']['address']}}"readonly>
</div>
<div class="form-group">
<label>City</label>
<input type="text" class="form-control" name="vendor_city"  value="{{$vendorDetail['vendor_personal']['city']}}"readonly>
</div>
<div class="form-group">
<label>State</label>
<input type="text" class="form-control" name="vendor_state"  value="{{$vendorDetail['vendor_personal']['state']}}"readonly>
</div>
<div class="form-group">
<label>Country</label>
<input type="text" class="form-control" name="vendor_country"  value="{{$vendorDetail['vendor_personal']['country']}}"readonly>
</div>
<div class="form-group">
<label>Pincode</label>
<input type="text" class="form-control" name="vendor_pincode"  value="{{$vendorDetail['vendor_personal']['pincode']}}"readonly>
</div>
<div class="form-group">
<label>Mobile</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_personal']['mobile']}}" readonly>
</div>
<div class="form-group">
  @if(!empty(Auth::guard('admin')->user()->image))
  <img src="{{asset('admin/images/photes/'.Auth::guard('admin')->user()->image)}}" alt="" width="200">
  @endif
<label>Image</label>
</div>




<hr>

<div class="card-header">
<h4 class="card-title mb-0">Vendor Business Information</h4>
</div>
<br>
 
<div class="form-group">
<label> Vendor Shop Name</label>
<input type="text" class="form-control" value="{{$vendorDetail['vendor_business']['shop_name']}}" readonly>
</div>
<div class="form-group">
<label>Shop Address</label>
<input type="text" class="form-control" name="vendor_name"  value="{{$vendorDetail['vendor_business']['shop_address']}}"readonly>
</div>
<div class="form-group">
<label>Shop City</label>
<input type="text" class="form-control" name="vendor_address"  value="{{$vendorDetail['vendor_business']['shop_city']}}"readonly>
</div>
<div class="form-group">
<label>Shop State</label>
<input type="text" class="form-control" name="vendor_city"  value="{{$vendorDetail['vendor_business']['shop_state']}}"readonly>
</div>
<div class="form-group">
<label>Shop Country</label>
<input type="text" class="form-control" name="vendor_state"  value="{{$vendorDetail['vendor_business']['shop_country']}}"readonly>
</div>
<div class="form-group">
<label>Shop Pincode</label>
<input type="text" class="form-control" name="vendor_country"  value="{{$vendorDetail['vendor_business']['shop_pincode']}}"readonly>
</div>
<div class="form-group">
<label>Shop Mobile</label>
<input type="text" class="form-control" name="vendor_pincode"  value="{{$vendorDetail['vendor_business']['shop_mobile']}}"readonly>
</div>
<div class="form-group">
<label>Shop Email</label>
<input type="email" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['shop_email']}}" readonly>
</div>
<div class="form-group">
<label>Shop Website</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['shop_website']}}" readonly>
</div>
<div class="form-group">
<label>Address Proof</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['address_proof']}}" readonly>
</div>
<div class="form-group">
<label>Business License Number</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['businecc_license_number']}}" readonly>
</div>
<div class="form-group">
<label>GTS Number</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['gst_number']}}" readonly>
</div>
<div class="form-group">
<label>Pon Number</label>
<input type="text" class="form-control" name="vendor_mobile"  value="{{$vendorDetail['vendor_business']['pon_number']}}" readonly>
</div>
<div class="form-group">
  @if(!empty($vendorDetail['vendor_business']['address_proof_image']))
  <img src="{{asset('admin/images/proofs/'.$vendorDetail['vendor_business']['address_proof_image'])}}" alt="" width="200">
  @endif
<label>Vendor Business Image</label>
</div>

<hr>

<div class="card-header">
<h4 class="card-title mb-0">Vendor Bank Information</h4>
</div>
<br>
 
<div class="form-group">
<label> Account Holder Name</label>
<input type="text" class="form-control" value="{{$vendorDetail['vendor_bank']['account_holder_name']}}" readonly>
</div>
<div class="form-group">
<label>Account Number</label>
<input type="text" class="form-control" name="vendor_name"  value="{{$vendorDetail['vendor_bank']['account_number']}}"readonly>
</div>
<div class="form-group">
<label>Bank Name</label>
<input type="text" class="form-control" name="vendor_address"  value="{{$vendorDetail['vendor_bank']['bank_name']}}"readonly>
</div>
<div class="form-group">
<label>IFSC Code</label>
<input type="text" class="form-control" name="vendor_city"  value="{{$vendorDetail['vendor_bank']['bank_ifsc_code']}}"readonly>
</div>






</div>

</div>
@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
