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
                            <li class="breadcrumb-item active">Attribute Upadte</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <h4 class="card-title mb-0">Add Attribute</h4>
            </div>
            <br>
            <form enctype="multipart/form-data" action="{{url('admin/attributes-add-edit/'.$product['id'])}}" method="POST">
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
                    <label>Product Name</label>
                   &nbsp; {{$product['product_name']}}
                </div>
                <div class="form-group">
                    <label>Product Code</label>
                    &nbsp; {{$product['product_code']}}
                </div>
                <div class="form-group">
                    <label>Product Color</label>
                   &nbsp; {{$product['product_color']}}
                </div>
                <div class="form-group">
                    <label>Product Price</label>
                    &nbsp; {{$product['product_price']}}
                </div>
                <div class="form-group">
                   @if(!empty($product['product_image']))
                    <img width="150" src="{{url('front/images/products/large/'.$product['product_image'])}}" alt="">
                    @else
                    <img width="150" src="{{url('front/images/products/large/small.png')}}" alt="">
                    @endif
                </div>
 
                <div class="form-group">
                    <div class="field_wrapper">
                    <div>
                    <input type="text" name="size[]" placeholder="Size" required style="width: 200px;"/>
                    <input type="text" name="sku[]" placeholder="Sku" required style="width: 200px;"/>
                    <input type="text" name="price[]" placeholder="Price" required style="width: 200px;"/>
                    <input type="text" name="stock[]" placeholder="Stock" required style="width: 200px;"/>
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                    </div>
                    </div>
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
