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

        </div><br>
        <div class="card-header">
                <h4 class="card-title mb-0">Attribute</h4>
            </div>
            <br>
        <div class="col-md-12">

        <form action="{{url('admin/attribute-edit/'.$product['id'])}}" method="POST">
        @csrf
       <table id="attributes" class="table table-striped mb-0">
           <thead>

           <tr>
               <th>ID</th>
               <th>Product Size</th>
               <th>Product SKU</th>
               
               <th>Product Stock</th>
               <th>Product Price</th>
               {{-- <th>Product Image</th> --}}
               <th>Status</th>

           </tr>
           </thead>
           <tbody>
           @foreach($product['attributes'] as $attribute)
           <input type="hidden" name="attributeId[]" value="{{$attribute['id']}}">
               <tr>
                   <td>{{$attribute['id']}}</td>
                   <td>
                      {{$attribute['size']}}
                       {{-- <input style="width: 70px;" type="text" name="size[]" value=""> --}}
                </td>
                   <td>{{$attribute['sku']}}</td>
                   <td>
                   
                       <input style="width: 70px;" type="text" name="stock[]" value="{{$attribute['stock']}}">
                </td>
                </td>
                   <td>
                       {{$attribute['price']}}
                       <input style="width: 70px;" type="text" name="price[]" value="{{$attribute['price']}}">
                    </td>
                   {{-- <td>
                       @if(!empty($attribute['product_image']))
                           <img style="width: 100px;" src="{{asset('front/images/products/small/'.$attribute['product_image'])}}" alt="">
                       @else
                           <img style="width: 100px;" src="{{asset('front/images/products/small/small.png')}}" alt="">
                       @endif
                   </td> --}}


                   <td>
                       @if($attribute['status'] == 1)
                           <a href="Javascript:void(0)" class="updateProductAttributStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}">
                               {{-- <i class="la la-bookmark" status="Active"></i> --}}
                               <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
                           </a>
                       @else
                           <a href="Javascript:void(0)" class="updateProductAttributStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}">
                               {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
                               <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
                           </a>
                       @endif
                   </td>

               </tr>
           @endforeach
               
           </tbody>
       </table>
       <button type="submit" class="btn btn-primary">Update Attribute</button>
       </form>
   </div>

    </div>
    <br>

@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
