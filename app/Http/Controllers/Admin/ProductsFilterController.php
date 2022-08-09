<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsFilter;
use App\Models\ProductsFiltersValue;
use App\Models\Section;
use DB;
class ProductsFilterController extends Controller
{
    public function filter()
    {
        $productFilters = ProductsFilter::get()->toArray();
        //dd($productFilters);
        return view('admin.filters.filter')->with(compact('productFilters'));
    }

    public function filterValue()
    {
        $productFilterValues = ProductsFiltersValue::get()->toArray();
        //dd($productFilterValues);
        return view('admin.filters.filter_value')->with(compact('productFilterValues'));
    }

    public function updateFilterStatus(Request $request)
    {
        if($request->ajax()){
            $data =  $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFilter::where('id',$data['filter_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'filter_id'=>$data['filter_id']]);
        }
    }

        public function updateFilterValueStatus(Request $request)
    {
        if($request->ajax()){
            $data =  $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsFiltersValue::where('id',$data['filtervalue_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'filtervalue_id'=>$data['filtervalue_id']]);
        }
    }

    public function addEditFilter(Request $request, $id=null)
    {
        if($id == ''){
            $title = 'Add Filter';
            $filter = new ProductsFilter;
            $message = 'Filter has been added successfully';
        }else{
            $title = 'Edit Filters';
            $filter = ProductsFilter::find($id);
            $message = 'Filter has been updated successfully!';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data);die;
            $cat_ids = implode(',',$data['cat_ids']);
            $filter->cat_ids = $cat_ids;
            $filter->filter_name = $data['filter_name'];
            $filter->filter_column = $data['filter_column'];
            $filter->status = 1;
            $filter->save();
            //ad filter column in products table
            DB::statement('Alter table products add '.$data['filter_column'].' varchar(255) after description');
            return redirect('admin/filters')->with('success',$message);
        }
        //Get section with categories and sub categories
        $categories = Section::with('categories')->get()->toArray();
        return view('admin.filters.add_edit_filter')->with(compact('title','filter','categories'));
    }

    public function addEditFilterValue(Request $request , $id=null)
    {
        if($id == ''){
            $title = 'Add Filter Value';
            $filterValue = new ProductsFiltersValue;
            $message = 'Filter Value has been added successfully!';
        }else{
            $title = 'Edit Filter Value';
            $filterValue = ProductsFiltersValue::find($id);
            $message = 'Filter Value has been updated successfully!';
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            $filterValue->filter_id = $data['filter_id'];
            $filterValue->filter_value = $data['filter_value'];
            $filterValue->status = 1;
            $filterValue->save();
            return redirect('admin/product-filter-values')->with('success',$message);
        }
        $productFilters = ProductsFilter::where('status',1)->get()->toArray();
        return view('admin.filters.add_edit_filter_value')->with(compact('title','filterValue','productFilters'));
    }
}
