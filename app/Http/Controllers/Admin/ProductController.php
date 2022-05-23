<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function product()
    {
        $products = Product::get()->toArray();
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
}
