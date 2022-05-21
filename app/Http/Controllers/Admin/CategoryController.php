<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::with(['section','categoryParent'])->get()->toArray();
        //dd($categories);
        return view('admin.categories.category')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            Category::where('id',$data['category_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'category_id'=>$data['category_id']]);
        }
    }
}
