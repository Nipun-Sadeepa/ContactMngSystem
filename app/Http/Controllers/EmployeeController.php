<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee=Company::join("employees", "companies.id","employees.companiesId")->paginate(10);
        if(isset($employee[0])){
            return view("employee.employeeView")->with("employeeList", $employee);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companyList=Company::select("id","name")->get();
        
        if(isset($companyList[0])){
            return view("employee.employeeAdd")->with("companyList", $companyList);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=['fName' => 'required|string|max:255',
                'lName' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|min:10|max:10',
                'companyDropdown'=>'required|string|max:5'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["msg"=>"ValidationFailed","errors" => $validator->errors()], 422);
        }else{
            $validated = $validator->validated();
            $employee= Employee::create([
                'fName'=>$validated['fName'],
                'lName'=>$validated['lName'],
                'email'=>$validated['email'],
                'phone'=>$validated['phone'],
                'companiesId'=>$validated['companyDropdown'],
            ]);
        }

        if(isset($employee)){
            return response(["msg"=>"Success"],201);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee=Company::join("employees", "companies.id","employees.companiesId")->where("employees.id",$id)->first();
        $companyList=Company::select("id","name")->get();

        if(isset($employee) && isset($companyList)){
            return view("employee.employeeEdit")->with("employee",$employee)->with("companyList",$companyList);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request = $request->except('_token','_method'); 

        $rules=['id'=>'required',
                'fName' => 'required|string|max:255',
                'lName' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|min:10|max:10',
                'companiesId'=>'required|integer|max:5',
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(["msg"=>"ValidationFailed","errors" => $validator->errors()], 422);
        }
        else{
            $validated = $validator->validated();
            $employee= Employee::where("id",$id)->update( $validated);
        }
        
        if($employee==1){
            return response(["msg"=>"Success"],201);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {

        $employee= Employee::where('id',$id)->delete();

        if($employee==1){
            return response(["msg"=>"Success"],201);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }
}
