<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class FrontProductController extends Controller
{
    public function listing()
    {
         $url = Route::getFacadeRoot()->current()->uri();
        //$categoryDetails = Category::catDetails();
        $categoryCount = Category::where(['url' => $url,'status' =>1])->count();
        if($categoryCount > 0){
            $categoryDetails = Category::catDetails($url);
            //dd($categoryDetails);
            $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1)->paginate(3);
            //dd($categoryProducts);
            //dd($categoryDetails);
            //echo 'cat exists';die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
            abort(404);
        }
    }
}
