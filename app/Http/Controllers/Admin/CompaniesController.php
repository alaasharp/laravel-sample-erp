<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Companies;
use App\Employees;
use Image;



class CompaniesController extends Controller
{

    public function index()
    {
        $Companies=Companies::paginate(10);
        return view('admin.companies.index',compact('Companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

   
    public function store(Request $request)
    {
        $formInput=$request->all();

        $this->validate($request,[
            'Name'=>'required|max:255|unique:companies,Name',
        ]);

        if($formInput['email'] != ""){
            $this->validate($request,[
                'email'=>'required|string|email|unique:companies,email',
            ]);
        }
       

        if($request->file('logo')){
            $image=$request->file('logo');
            if($image->isValid()){
                $fileName=time().'-'.'.'.$image->getClientOriginalExtension();
                $small_image_path=storage_path('app/public/logos/small/'.$fileName);
                $large_image_path=storage_path('app/public/logos/small/'.$fileName);
               
                //Resize Image
                Image::make($image)->resize(100,100)->save($small_image_path);
                Image::make($image)->resize(300,300)->save($large_image_path);
                $formInput['logo']=$fileName;
            }
        }

        Companies::create($formInput);
        return redirect()->route('companies.index')->with('message','Added successfully');
    }

    public function show($id)
    {
        echo $id;
    }

    public function edit($id)
    {
        $edit_Companie=Companies::findOrFail($id);
        return view('admin.companies.edit',compact('edit_Companie'));
    }

    public function update(Request $request, $id)
    {
        $update_Companies=Companies::findOrFail($id);

        $this->validate($request,[
            'Name'=>'required|max:255|unique:companies,Name,'.$update_Companies->id,
        ]);

        $input_data=$request->all();

        //////UPLOAD 
        if($request->file('logo')){
            $image=$request->file('logo');
            if($image->isValid()){
        
                $fileName=time().'-'.'.'.$image->getClientOriginalExtension();
                $small_image_path=storage_path('app/public/logos/small/'.$fileName);
                $large_image_path=storage_path('app/public/logos/large/'.$fileName);
               
                //Resize Image
                Image::make($image)->resize(100,100)->save($small_image_path);
                Image::make($image)->resize(300,300)->save($large_image_path);
                $input_data['logo']=$fileName;
                 
            }
        }

        $update_Companies->update($input_data);
        return redirect()->route('companies.index')->with('message','Edited successfully');
    }

    public function destroy($id)
    {
        $delete=Companies::findOrFail($id);
        
        ///Del Logo
        if($delete->logo != ""){
            $image_small=storage_path().'/app/public/logos/small/'.$delete->logo;
            $image_large=storage_path().'/app/public/logos/large/'.$delete->logo;
            if($delete->delete()){
                unlink($image_small);
                unlink($image_large);
            }
        }
       

       
        Employees::where('Company_id',$id)->delete();
        $delete->delete();
        
        return redirect()->route('companies.index')->with('message','Deleted successfully');
    }
}
