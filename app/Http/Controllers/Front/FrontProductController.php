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
            $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);

            //check latest product
            if(isset($_GET['sort']) && !empty($_GET['sort'])){
                if($_GET['sort'] == 'product_latest'){
                    $categoryProducts->orderBy('products.id','Desc');
                }else if($_GET['sort'] == 'price_lowest'){
                    $categoryProducts->orderBy('products.product_price','Asc');
                }else if($_GET['sort'] == 'price_highest'){
                    $categoryProducts->orderBy('products.product_price','Desc');
                }else if($_GET['sort'] == 'name_a_z'){
                    $categoryProducts->orderBy('products.product_name','Asc');
                }else if($_GET['sort'] == 'name_z_a'){
                    $categoryProducts->orderBy('products.product_name','Desc');
                }
            }

            $categoryProducts = $categoryProducts->paginate(3);
            //dd($categoryProducts);
            //dd($categoryDetails);
            //echo 'cat exists';die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
            abort(404);
        }
    }
}
