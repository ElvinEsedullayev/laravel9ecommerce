<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
    public function banner()
    {
        $banners = Banner::get()->toArray();
        //dd($banners);
        return view('admin.banners.banner')->with(compact('banners'));
    }

    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deletebanner($id)
    {
        $bannerImage = Banner::where('id',$id)->first();
        $imagePath = 'front/images/banner/';  
        if(file_exists($imagePath.$bannerImage->image)){
            unlink($imagePath.$bannerImage->image);
        }
        Banner::where('id',$id)->delete();
        $success = 'Banner has been deleted successfully';
        return redirect()->back()->with('success',$success);
    }
}
