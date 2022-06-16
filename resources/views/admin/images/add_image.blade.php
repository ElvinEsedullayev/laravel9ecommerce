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
                            <li class="breadcrumb-item active">Images Upadte</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <h4 class="card-title mb-0">Add Multiple Images</h4>
            </div>
            <br>
            <form enctype="multipart/form-data" action="{{url('admin/add-images/'.$product['id'])}}" method="POST" enctype="multipart/form-data">
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
                      <input type="file" name="images[]" id="" multiple="">
                    </div>
                    </div>
                </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
            </form>

        </div><br>
        <div class="card-header">
                <h4 class="card-title mb-0">Images</h4>
            </div>
            <br>
        <div class="col-md-12">

        <form action="{{url('admin/images-edit/'.$product['id'])}}" method="POST">
        @csrf
       <table id="attributes" class="table table-striped mb-0">
           <thead>

           <tr>
               <th>ID</th>
               <th>Product Images</th>
               
               <th>Status</th>

           </tr>
           </thead>
           <tbody>
           @foreach($product['images'] as $image)
           
               <tr>
                   <td>{{$image['id']}}</td>
                   <td>
                     <img style="width: 100px;" src="{{asset('front/images/products/small/'.$image['image'])}}" alt="">
                </td>
           

                   <td>
                       @if($image['status'] == 1)
                           <a href="Javascript:void(0)" class="updateProductImagesStatus" id="images-{{$image['id']}}" images_id="{{$image['id']}}">
                               {{-- <i class="la la-bookmark" status="Active"></i> --}}
                               <i class="fa fa-toggle-on fa-lg"  status="Active"></i>
                           </a>
                       @else
                           <a href="Javascript:void(0)" class="updateProductImagesStatus" id="images-{{$image['id']}}" images_id="{{$image['id']}}">
                               {{-- <i class="la la-bookmark" status="Inactive"></i> --}}
                               <i class="fa fa-toggle-off fa-lg"  status="Inactive"></i>
                           </a>
                       @endif
                       &nbsp;
                        <a href="Javascript:void(0)" module="image" moduleid="{{$image['id']}}" class="confirmDelete">
                        <i class="fa fa-trash fa-lg"></i>
                        </a>
                   </td>

               </tr>
           @endforeach
               
           </tbody>
       </table>
       <button type="submit" class="btn btn-primary">Update Images</button>
       </form>
   </div>

    </div>
    <br>

@endsection
{{-- @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection --}}
