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
        $catDetails = Category::select('id','url','category_name')->with('subcategorie')->where('url',$url)->first()->toArray();
        //dd($catDetaisl);
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategorie'] as $key => $subcategory) {
            $catIds[] = $subcategory['id'];
        }
        //dd($catIds);
        $resp = array('catIds' => $catIds,'catDetails' => $catDetails);
        return $resp;
    }
}
