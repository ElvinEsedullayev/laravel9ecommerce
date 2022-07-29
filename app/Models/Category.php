<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function section()
    {
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function categoryParent()
    {
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }

    public function subcategorie()
    {
        return $this->hasMany('App\Models\Category','parent_id')->where('status',1);//categoria ucun..
    }

    public static function catDetails($url)
    {
        $catDetails = Category::select('id','parent_id','url','category_name','description')->with(['subcategorie' => function($query){
            $query->select('id','category_name','parent_id','url','description');
        }])->where('url',$url)->first()->toArray();
        //dd($catDetaisl);
        $catIds = array();
        $catIds[] = $catDetails['id'];
        if($catDetails['parent_id'] == 0){
            //show only main category and breadcrumbs
            $breadcrumbs = '<li class="is-marked">
                        <a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>
                    </li>';
        }else{
            //show main and subcategory breadcrumbs
            $parentCategory = Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<li class="has-separator">
                        <a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a>
                    </li><li class="is-marked">
                        <a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a>
                    </li>';
        }
        foreach ($catDetails['subcategorie'] as $key => $subcategory) {
            $catIds[] = $subcategory['id'];
        }
        //dd($catIds);
        $resp = array('catIds' => $catIds,'catDetails' => $catDetails,'breadcrumbs' => $breadcrumbs);
        return $resp;
    }
}
