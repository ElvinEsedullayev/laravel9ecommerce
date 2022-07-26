<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
class FrontProductController extends Controller
{
    public function listing()
    {
         $url = Route::getFacadeRoot()->current()->uri();
        //$categoryDetails = Category::catDetails();
        $categoryCount = Category::where(['url' => $url,'status' =>1])->count();
        if($categoryCount > 0){
            $categoryDetails = Category::catDetails($url);
            dd($categoryDetails);
            echo 'cat exists';die;
        }else{
            abort(404);
        }
    }
}
