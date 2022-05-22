<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\VendorBusinessDetail;
use App\Models\VendorBankDetail;
use Image;
use Session;
class AdminController extends Controller
{
    public function index()
    {
        Session::put('page','index');
        return view('admin.index');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            // $rules = Validator::make($request->all(),[
                $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'email.required' => 'Email is required',
                'email.email'    => 'Valid email is required',
                'password.required' => 'Password is required'
            ];

             $this->validate($request,$rules,$customMessage);

            if(Auth::guard('admin')->attempt(['email' => $data['email'],'password' => $data['password'],'status' => 1])){
                return redirect()->route('admin.home');
            }else{
                return redirect()->back()->with('error', 'Invalid email or password');
            }
        }
        return view('admin.auth.login');
    }


    


    public function updatePassword(Request $request)
    {
        $data = $request->all();
        if($request->isMethod('post')){
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                if($data['new_password'] == $data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success','Password has been updated successfully');
                }else{
                    return redirect()->back()->with('error','New password and confirm password does not match');
                }
            }else{
                return redirect()->back()->with('error','Your current password is incorrect');
            }
        }
        $adminDetail = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.password_update')->with(compact('adminDetail'));
    }

    
     public function checkPassword(Request $request)
    {
        $data = $request->all();
        //echo '<pre>'; print_r($data); die;
        
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function updateDetail(Request $request)
    {
        
        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre>'; print_r($data); die;
            $rules = [  
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric'
            ];
            $customMessage = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Valid mobile is required'
            ];
            $this->validate($request,$rules,$customMessage);
            if($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'admin/images/photes/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                }
            }else if(!empty($data['old_image'])){ //bu hecne yazmadan submit duymesine vuranda xeta olmamasi ucun idi
                $imageName = $data['old_image'];
            }else{
                $imageName = '';
            }
           Admin::where('id',Auth::guard('admin')->user()->id)->update(['name' => $data['name'],'mobile' => $data['mobile'],'image' => $imageName]);
           return redirect()->back()->with('success','Admin details has been updated successfully');
        }
        return view('admin.settings.details_update');
    }

    public function updateVendor($slug,Request $request)
    {
        if($slug == 'personal'){
            if($request->isMethod('post')){
                $data = $request->all();
                //echo '<pre></pre>'; print_r($data); die;
                $rules = [  
                'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                'vendor_mobile' => 'required|numeric'
            ];
            $customMessage = [
                'vendor_name.required' => 'Name is required',
                'vendor_city.required' => 'City is required',
                'vendor_name.regex' => 'Valid name is required',
                'vendor_city.regex' => 'Valid city is required',
                'vendor_mobile.required' => 'Mobile is required',
                'vendor_mobile.numeric' => 'Valid mobile is required'
            ];
            $this->validate($request,$rules,$customMessage);
            if($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'admin/images/photes/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                }
            }else if(!empty($data['old_image'])){ //bu hecne yazmadan submit duymesine vuranda xeta olmamasi ucun idi
                $imageName = $data['old_image'];
            }else{
                $imageName = '';
            }
                // Update Admin Table
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['name' => $data['vendor_name'],'mobile' => $data['vendor_mobile'],'image' => $imageName]);
                //update vendor table
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['vendor_name'],
                    'address' => $data['vendor_address'],
                    'city' => $data['vendor_city'],
                    'state' => $data['vendor_state'],
                    'country' => $data['vendor_country'],
                    'pincode' => $data['vendor_pincode'],
                    'mobile' => $data['vendor_mobile'],
                ]);
                 return redirect()->back()->with('success','Vendor details has been updated successfully');
            }
            $vendorDetail = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();


        }else if($slug == 'business'){
             if($request->isMethod('post')){
                $data = $request->all();
                //echo '<pre></pre>'; print_r($data); die;
                $rules = [  
                'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                'address_proof' => 'required|regex:/^[\pL\s\-]+$/u',
                'shop_mobile' => 'required|numeric'
            ];
            $customMessage = [
                'shop_name.required' => 'Name is required',
                'shop_city.required' => 'City is required',
                'shop_name.regex' => 'Valid name is required',
                'shop_city.regex' => 'Valid city is required',
                'shop_mobile.required' => 'Mobile is required',
                'shop_mobile.numeric' => 'Valid mobile is required',
                'address_proof.required' => 'Proof address is required',
            ];
            $this->validate($request,$rules,$customMessage);
            if($request->hasFile('address_proof_image')){
                $img_tmp = $request->file('address_proof_image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $imageName = rand(11111,9999999).'.'.$extension;
                    $imagePath = 'admin/images/proofs/'.$imageName;
                    Image::make($img_tmp)->save($imagePath);
                }
            }else if(!empty($data['old_proof_image'])){ //bu hecne yazmadan submit duymesine vuranda xeta olmamasi ucun idi
                $imageName = $data['old_proof_image'];
            }else{
                $imageName = '';
            }
                
                //update vendor table
                VendorBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update([
                    'shop_name' => $data['shop_name'],
                    'shop_address' => $data['shop_address'],
                    'shop_city' => $data['shop_city'],
                    'shop_state' => $data['shop_state'],
                    'shop_country' => $data['shop_country'],
                    'shop_pincode' => $data['shop_pincode'],
                    'shop_mobile' => $data['shop_mobile'],
                    'address_proof' => $data['address_proof'],
                    'businecc_license_number' => $data['businecc_license_number'],
                    'gst_number' => $data['gst_number'],
                    'pon_number' => $data['pon_number'],
                    'address_proof_image' => $imageName,
                ]);
                 return redirect()->back()->with('success','Vendor business details has been updated successfully');
            }
            $vendorDetail = VendorBusinessDetail::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();





        }else if($slug == 'bank'){
            if($request->isMethod('post')){
                $data = $request->all();

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required',
                ];

                $customMessage = [
                    'account_holder_name.required' => 'Acoount holder name is required',
                    'account_holder_name.regex' => 'Valid account holder name is required',
                    'bank_name.required' => 'Bank name is required',
                    'account_number.number' => 'Valid account number is required',
                    'account_number.required' => 'Account number is required',
                    'bank_ifsc_code.required' => 'Bank ifsc code is required',
                ];

                $this->validate($request,$rules,$customMessage);
                VendorBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                    'bank_ifsc_code' => $data['bank_ifsc_code'],
                ]);
                return redirect()->back()->with('success','Vendor bank details has been updated successfully');
            }
            $vendorDetail = VendorBankDetail::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        $countries = Country::where('status',1)->get()->toArray();
        return view('admin.settings.vendor_update')->with(compact('slug','vendorDetail','countries'));
    }

    public function admin($type=null)
    {
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type',$type);
            $title = ucfirst($type).'s';
        }else{
            $title = 'All Admins/SUbadmins/Vendors';
        }
        $admins = $admins->get()->toArray(); 
        return view('admin.admins.admin')->with(compact('admins','title'));
        dd($admins);
    }

    public function viewVendorDetail($id)
    {
        $vendorDetail = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id',$id)->first();
        $vendorDetail = json_decode(json_encode($vendorDetail),true);
        //dd($vendorDetail);
        return view('admin.admins.view_vendor_detail')->with(compact('vendorDetail'));
    }

    public function updateAdminStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            Admin::where('id',$data['admin_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'admin_id'=>$data['admin_id']]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
