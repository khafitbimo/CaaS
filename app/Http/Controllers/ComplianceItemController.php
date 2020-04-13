<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\ComplianceItem;
use App\ComplianceItemGroup;
use App\CompliancePackage;

class ComplianceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $data_compliancepackages = CompliancePackage::where('packages_disable',0)->get();
        
        return view('complianceitem',['data_compliancepackages' => $data_compliancepackages]);
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
                    'inputItemName' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $complianceItem = new ComplianceItem;
            $complianceItem->item_group_id = $request->input('inputItemGroupId');
            $complianceItem->status_id = 1;
            $complianceItem->item_name = $request->input('inputItemName');
            $complianceItem->item_description = $request->input('inputItemDescription');
            $complianceItem->save();
            
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
        $id = $request->editItemId;
        $data_update = array(
            'item_group_id'=>$request->editItemGroupId,
            'item_name' => $request->editItemName,
            'item_description' => $request->editItemDescription,
        );
        ComplianceItem::where(['item_id'=>$id])->update($data_update);
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
        $complianceItem = ComplianceItem::find($id);
        $complianceItem->item_disable = 1;
        $complianceItem->save();
    }

    public function delete(Request $request)
    {
        $id = $request->deleteId;
        ComplianceItem::where(['item_id'=>$id])->update(['item_disable'=>1]);
    }

    public function getItemGroupByItemGroupId($itemgroup_id)
    {
        $complianceitem = ComplianceItem::where('item_disable',0)
                                        ->where('item_group_id',$itemgroup_id)->get();
        return response($complianceitem);
    }
}
