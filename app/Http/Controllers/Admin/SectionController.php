<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
class SectionController extends Controller
{
    public function section()
    {
        $sections = Section::get()->toArray();
        //dd($sections);
        return view('admin.sections.section')->with(compact('sections'));
    }


    public function updateSectionStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            if($data['status']== 'Active'){
                $status = 0;
            }else{
                $status =1;
            }
            Section::where('id',$data['section_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status,'section_id'=>$data['section_id']]);
        }
    }

    public function deleteSection($id)
    {
        $section = Section::where('id',$id)->delete();
        $success = 'Section has been deleted successfully!';
        return redirect()->back()->with('success',$success);
    }

    public function addEditSection(Request $request, $id=null)
    {
        if($id == ''){
            $title = 'Add Section';
            $section = new Section;
            $success = 'Section has been added successfully';
        }else{
            $title = 'Edit Section';
            $section = Section::find($id);
            $success = 'Section has been updated successfully';
        }

        if($request->isMethod('post')){
            $data = $request->all();
            //echo '<pre></pre>'; print_r($data); die;
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];
            $customMessage = [
                'name.required' => 'Name is required',
                'name.regax' => 'Valid name is required',
            ];
            $this->validate($request,$rules,$customMessage);
            $section->name = $data['name'];
            $section->status = 1;
            $section->save();
            return redirect('admin/section')->with('success',$success);
        }

        return view('admin.sections.add_edit_section')->with(compact('title','section'));
    }
}
