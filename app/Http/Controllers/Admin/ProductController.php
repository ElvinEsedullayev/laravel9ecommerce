<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Database\Seeders\ProductAttributeSeeder;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductsImage;
use App\Models\ProductAttribute;
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
            $product = Product::find($id);
            //dd($product);
            //echo '<pre></pre>'; print_r($product); die;
            $success = 'Product has been updated successfully';
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
            if(!empty($data['is_bestseller'])){
                $product->is_bestseller = $data['is_bestseller'];
            }else{
                $product->is_bestseller = 'No';
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

    public function deleteProductImage($id)
    {
        $productImage = Product::select('product_image')->where('id',$id)->first();
        $small_image_path = 'front/images/products/small/';
        $medium_image_path = 'front/images/products/medium/';
        $large_image_path = 'front/images/products/large/';
        if(file_exists($small_image_path.$productImage->product_image)){
            unlink($small_image_path.$productImage->product_image);
        }
        if(file_exists($medium_image_path.$productImage->product_image)){
            unlink($medium_image_path.$productImage->product_image);
        }
        if(file_exists($large_image_path.$productImage->product_image)){
            unlink($large_image_path.$productImage->product_image);
        }
        Product::where('id',$id)->update(['product_image' => '']);
        $success = 'Product Image has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id',$id)->first();
        $product_video_path = 'front/videos/products/';
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }
        Product::where('id',$id)->update(['product_video' => '']);
        $success = 'Product Video has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }


    public function addEditAttribute(Request $request,$id)
    {
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('attributes')->find($id);
        //$product = json_decode(json_encode($product),true);
        //dd($product);
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            //echo '<pre></pre>'; print_r($data); die;
            foreach($data['sku'] as $key => $value){
                if(!empty($value)){

                    //sku dublicate check
                    $skuCount = ProductAttribute::where('sku',$value)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('error','SKU already exsist. Please add another!');
                    }

                    //size dublicate check
                    $sizeCount = ProductAttribute::where(['product_id' => $id,'size'=>$data['size'][$key]])->count();
                    if($sizeCount > 0){
                        return redirect()->back()->with('error','Size already exsist. Please add another!');
                    }

                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success','Product Attribute has been added successfully');
        }
        return view('admin.attributes.add_edit_attribute')->with(compact('product'));
    }

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            ProductAttribute::where('id',$data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function updateAttribute(Request $request,$id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            foreach($data['attributeId'] as $key => $attribute){
                if(!empty($attribute)){
                    ProductAttribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success','Product Attribute has been updated successfully');
        }
    }

    public function addImages(Request $request,$id)
    {
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($request->hasFile('images')){
                $images = $request->file('images');
                //echo '<pre></pre>'; print_r($images); die;
                foreach ($images as $key => $image) {
                    $img_tmp = Image::make($image);
                    $img_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $img_name.rand(11111,9999999).'.'.$extension;
                    $largeImagePath = 'front/images/products/large/'.$imageName;
                    $mediumImagePath = 'front/images/products/medium/'.$imageName;
                    $smallImagePath = 'front/images/products/small/'.$imageName;
                    Image::make($img_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($img_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($img_tmp)->resize(250,250)->save($smallImagePath);
                    $image = new ProductsImage;
                    $image->image = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }
            return redirect()->back()->with('success','Product Images has been added successfully');
        }
         return view('admin.images.add_image')->with(compact('product'));
    }


    public function updateImagesStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            ProductsImage::where('id',$data['images_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'images_id'=>$data['images_id']]);
        }
    }

    public function deleteImage($id)
    {
        $productImage = ProductsImage::select('image')->where('id',$id)->first();
        $small_image_path = 'front/images/products/small/';
        $medium_image_path = 'front/images/products/medium/';
        $large_image_path = 'front/images/products/large/';
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }
        ProductsImage::where('id',$id)->delete();
        $success = 'Image has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }
}
