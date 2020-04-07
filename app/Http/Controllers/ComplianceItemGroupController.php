<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\ComplianceItemGroup;
use App\CompliancePackage;
use DB;

class ComplianceItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data_compliancepackage = CompliancePackage::where('packages_disable',0)->get();

        return view('complianceitemgroup',['data_compliancepackage' => $data_compliancepackage]);
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
                    'inputItemGroupName' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $complianceItemGroup = new ComplianceItemGroup;
            $complianceItemGroup->packages_id = $request->input('inputPackageId');
            $complianceItemGroup->item_group_name = $request->input('inputItemGroupName');
            $complianceItemGroup->item_group_description = $request->input('inputItemGroupDescription');
            $complianceItemGroup->item_group_implemented = 1;
            $complianceItemGroup->save();
            
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
        $id = $request->editItemGroupId;
        $data_update = array(
            'packages_id' => $request->editPackageId,
            'item_group_name'=>$request->editItemGroupName,
            'item_group_description'=>$request->editItemGroupDescription,            

        );
        ComplianceItemGroup::where(['item_group_id'=>$id])->update($data_update);
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
        $complianceitemgroup = ComplianceItemGroup::find($id);
        $complianceitemgroup->item_group_disable = 1;
        $complianceitemgroup->save();
    }

    public function delete(Request $request)
    {
        $id = $request->deleteId;
        ComplianceItemGroup::where(['item_group_id'=>$id])->update(['item_group_disable'=>1]);
    }

    public function getItemGroupByPackageId($packages_id)
    {
        $complianceitemgroup = ComplianceItemGroup::where('item_group_disable',0)
                                                    ->where('packages_id',$packages_id)->get();
        return response($complianceitemgroup);
    }
}
