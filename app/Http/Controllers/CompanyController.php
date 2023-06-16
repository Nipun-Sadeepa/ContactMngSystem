<?php

namespace App\Http\Controllers;

// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    
    public function index()
    {
        $company=Company::paginate(10);

        if(isset($company[0])){
            return view("company.companyView")->with("companyList", $company); 
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.companyAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->website!=null){
            $website=$request->website;
        }

        $rules=['name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'website'=> 'string|max:225',
                ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["msg"=>"ValidationFailed","errors" => $validator->errors()], 422);

        }else{
            
            $validated = $validator->validated();
            $company= Company::create([
                    'name'=>$validated['name'],
                    'companyEmail'=>$validated['email'],
                    'website'=>$website,
                ]);
        }

        if(isset($company)){
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
        $company= Company::where('id',$id)->first();

        if(isset($company)){
            return view("company.companyEdit")->with("company",$company);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request = $request->except('_token', '_method'); 

        $rules=['name' => 'required|string|max:255',
                'companyEmail' => 'required|email|max:255',
                'website'=>'string|max:255',
        ];
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            return response()->json(["msg"=>"ValidationFailed","errors" => $validator->errors()], 422);
        }else{
            $validated = $validator->validated();
            $company= Company::where("id",$id)->update( $validated);
        }

        if($company==1){  
            return response(["msg"=>"Success"],201);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company= Company::where('id',$id)->delete();
        
        if($company==1){
            return response(["msg"=>"Success"],201);
        }else{
            return response(["msg"=>"Fail"],404);
        }
    }
}
