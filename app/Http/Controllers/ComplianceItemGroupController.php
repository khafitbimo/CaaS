<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\ComplianceItemGroup;

class ComplianceItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_complianceitemgroup = ComplianceItemGroup::where('item_group_disable',0)->get();
        return view('complianceitemgroup',['data_complianceitemgroup' => $data_complianceitemgroup]);
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
                    'item_group_name' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $complianceItemGroup = new ComplianceItemGroup;
            $complianceItemGroup->packages_id = $request->input('packages_id');
            $complianceItemGroup->item_group_name = $request->input('item_group_name');
            $complianceItemGroup->item_group_description = $request->input('item_group_description');
            $complianceItemGroup->item_group_implemented = $request->input('item_group_implemented');
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
    public function update(Request $request, $id)
    {
        //
        $id = $request->item_group_id;
        $data_update = array(
            'packages_id' => $request->packages_id,
            'item_group_name'=>$request->item_group_name,
            'item_group_description'=>$request->item_group_description,
            'item_group_implemented'=>$request->item_group_implemented
            

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
        $id = $request->item_group_id;
        ComplianceItemGroup::where(['item_group_id'=>$id])->update(['item_group_disable'=>1]);
    }
}
