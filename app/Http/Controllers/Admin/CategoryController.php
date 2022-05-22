<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Image;
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

    public function addEditCategory(Request $request,$id=null)
    {
        if($id == ''){
            //Add category
            $title = 'Add Category';
            $category = new Category;
            $getCategories = array();
            $success = 'Category has been added successfully';
        }else{
            //edit category
            $title = 'Edit Category';
            $category = Category::find($id);
            $getCategories = Category::with('subcategorie')->where(['parent_id' => 0, 'section_id' => $category['section_id']])->get();
            //echo '<pre></pre>'; print_r($category['category_name']); die;
            $success = 'Category has been updated successfully';
        }

        $sections = Section::get()->toArray();

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
            ];
            $customMessage = [
                'category_name.required' => 'Category Name is required',
                'category_name.regax' => 'Valid Category name is required',
                'section_id.required' => 'Section ID is required',
                'url.required' => 'Category URL is required',
            ];
            $this->validate($request,$rules,$customMessage);

           if($data['category_discount'] == ''){
               $data['category_discount'] = 0;
           }

            if($request->hasFile('category_image')){
                $img_tmp = $request->file('category_image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'front/images/categories/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            
            }else{
                $category->category_image = '';//add edende sekil yoxcusa xeta vermesin
            }
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->section_id = $data['section_id'];
            $category->status =1;
            $category->save();
            return redirect('admin/categories')->with('success',$success);
        }

        return view('admin.categories.add_edit_category')->with(compact('title','category','sections','getCategories'));
    }

    public function appendCategoriesLevel(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $getCategories = Category::with('subcategorie')->where(['parent_id' => 0, 'section_id' => $data['section_id']])->get()->toArray();
            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::where('id',$id)->delete();
        $success = 'Category has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }

    public function deleteCategoryImage($id)
    {
        //get category image
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        //get category image path
        $imagePath = 'front/images/categories/';  
        if(file_exists($imagePath.$categoryImage->category_image)){
            unlink($imagePath.$categoryImage->category_image);
        }
        Category::where('id',$id)->update(['category_image' => '']);
        $success = 'Category Image has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }
}
