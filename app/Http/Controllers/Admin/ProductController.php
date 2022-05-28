<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use Auth;
use Image;
class ProductController extends Controller
{
    public function product()
    {
        $products = Product::with(['section' => function($query){
            $query->select('id','name');
        },'category' => function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        //dd($products);
        return view('admin.products.product')->with(compact('products'));
    }


    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            Product::where('id',$data['product_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id',$id)->delete();
        $success = 'Product has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }

    public function addEditProduct(Request $request, $id=null)
    {
        if($id == ''){
            $title = 'Add Product';
            $product = new Product;
            $success = 'Product has been added successfully';
        }else{
            $title = 'Edit Product';
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r(Auth::guard('admin')->user()); die;
             $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
                'category_id.required' => 'Category ID is required',
                'product_name.required' => 'Product name is required',
                'product_name.regax' => 'Valid Product name is required',
                'product_code.required' => 'Product code is required',
                'product_code.regax' => 'Valid Product code is required',
                'product_price.required' => 'Product price is required',
                'product_price.regax' => 'Valid Product code is required',
                'product_color.required' => 'Product color is required',
                'product_color.regax' => 'Valid Product color is required',
            ];
            $this->validate($request,$rules,$customMessage);
            
            //Upload image resize: small 250x250,medium 500x500,large 1000x1000
            if($request->hasFile('product_image')){
                $img_tmp = $request->file('product_image');
                 if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $largeImagePath = 'front/images/products/large/'.$imageName;
                    $mediumImagePath = 'front/images/products/medium/'.$imageName;
                    $smallImagePath = 'front/images/products/small/'.$imageName;
                    Image::make($img_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($img_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($img_tmp)->resize(250,250)->save($smallImagePath);
                    $product->product_image = $imageName;
                }
            }

            //upload product video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(11111,99999).'.'.$extension;
                    $videoPath = 'front/videos/products/';
                    $video_tmp->move($videoPath,$videoName);
                    $product->product_video = $videoName;
                }
            }

            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];


            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;
            $product->admin_type = $adminType;
           $product->admin_id = $admin_id;
            if($adminType == 'vendor'){
                 $product->vendor_id = $vendor_id;
            }else{
                 $product->vendor_id = 0;
            }
            
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = 'No';
            }
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success',$success);
        }
        //Get section with categories and sub categories
        $categories = Section::with('categories')->get()->toArray();
        
        //dd($categories);
        //get brand
        $brands = Brand::where('status',1)->get()->toArray();
        return view('admin.products.add_edit_product')->with(compact('product','title','categories','brands'));
    }
}
