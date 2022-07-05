<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;
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

    public function addEditBanner(Request $request,$id=null)
    {
        if($id == ''){
            $title = 'Add Banner';
            $banner = new Banner;
            $success = 'Banner has been added successfully!';
        }else{
            $title = 'Edit Banner';
            $banner = Banner::find($id);
            $success = 'Banner has been updated successfully';
        }


        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $banner->type = $data['type'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->link = $data['link'];
            $banner->status = 1;

            if($data['type'] == 'Slider'){
                $width = 1920;
                $height = 750;
            }else if($data['type'] == 'Fix'){
                $width = 1920;
                $height = 450;
            }

            if($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'front/images/banner/'.$imageName;
                    Image::make($img_tmp)->resize($width,$height)->save($imagePath);
                    $banner->image = $imageName;
                }

            }else{
                $banner->image = '';//add edende sekil yoxcusa xeta vermesin
            }
            $banner->save();
            return redirect('admin/banners')->with('success',$success);
        }

        return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }
}
