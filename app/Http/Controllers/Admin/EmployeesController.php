<?php

namespace App\Http\Controllers\Admin;;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Image;
use App\Employees;
use App\Companies;



class EmployeesController extends Controller
{
    public function index()
    {
        $Employees=Employees::paginate(10);
        return view('admin.employees.index',compact('Employees'));
    }

    public function create()
    {
        $AllCompanies=Companies::orderBy('id','desc')->get();
        return view('admin.employees.create',compact('AllCompanies'));
    }

   
    public function store(Request $request)
    {
        $formInput=$request->all();
        $this->validate($request,[
            'Company_id'=>'required',
            'First_name'=>'required|max:255|unique:employees,First_name',
            'last_name' =>'required|max:255|unique:employees,last_name',
        ]);
       
        if($formInput['email'] != ""){
            $this->validate($request,[
                'email'=>'required|string|email|unique:employees,email',
            ]);
        }
        if($formInput['phone'] != ""){
            $this->validate($request,[
                'phone'=>'required|numeric',
            ]);
        }

       
        Employees::create($formInput);
        return redirect()->route('employees.index')->with('message','Added successfully');
    }

    public function show($id)
    {
        echo $id;
    }

    public function edit($id)
    {
        $AllCompanies=Companies::orderBy('id','asc')->get();
        $edit_employees=Employees::findOrFail($id);
        return view('admin.employees.edit',compact('edit_employees','AllCompanies'));
    }

    public function update(Request $request, $id)
    {
        $update_employee=Employees::findOrFail($id);
        $this->validate($request,[
            'First_name'=>'required|max:255|unique:employees,First_name,'.$update_employee->id,
            'last_name'=>'required|max:255|unique:employees,last_name,'.$update_employee->id,
        ]);
       
        $input_data=$request->all();
        if($input_data['email'] != ""){
            $this->validate($request,[
                'email'=>'required|string|email',
            ]);
        }
        if($input_data['phone'] != ""){
            $this->validate($request,[
                'phone'=>'required|numeric',
            ]);
        }
       
       
        $update_employee->update($input_data);
        return redirect()->route('employees.index')->with('message','Edited successfully');
    }

    public function destroy($id)
    {
        $delete=Employees::findOrFail($id);
        $delete->delete();

        return redirect()->route('employees.index')->with('message','Deleted successfully');
    }
}
