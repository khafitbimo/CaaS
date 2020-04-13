<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\CompliancePackage;

class CompliancePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_compliancepackage= CompliancePackage::where('packages_disable',0)->get();
        return view('compliancepackage',['data_compliancepackage' => $data_compliancepackage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),
                [
                    'inputPackageName' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $compliancePackage = new CompliancePackage;
            $compliancePackage->packages_name = $request->input('inputPackageName');
            $compliancePackage->packages_description = $request->input('inputPackageDescription');
            $compliancePackage->save();
            
            return array(
                'fail' => false
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->editPackageId;
        $data_update = array(
            'packages_name' => $request->editPackageName,
            'packages_description'=>$request->editPackageDescription
        );
        CompliancePackage::where(['packages_id'=>$id])->update($data_update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $compliancePackage = CompliancePackage::find($id);
        $compliancePackage->packages_disable = 1;
        $compliancePackage->save();
    }

    public function delete(Request $request)
    {
        $id = $request->deletePackageId;
        CompliancePackage::where(['packages_id'=>$id])->update(['packages_disable'=>1]);
    }

    public function getPackageJson()
    {
        $data_compliancepackage= CompliancePackage::where('packages_disable',0)->get();
        return response($data_compliancepackage);
    }
}
