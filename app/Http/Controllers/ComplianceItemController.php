<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\ComplianceItem;

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
        $data_complianceitem = ComplianceItem::where('item_disable',0)->get();
        return view('complianceitem',['data_complianceitem' => $data_complianceitem]);
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
                    'item_name' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $complianceItem = new ComplianceItem;
            $complianceItem->item_group_id = $request->input('item_group_id');
            $complianceItem->status_id = $request->input('status_id');
            $complianceItem->item_name = $request->input('item_name');
            $complianceItem->item_description = $request->input('item_description');
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
    public function update(Request $request, $id)
    {
        //
        $id = $request->item_id;
        $data_update = array(
            'item_group_id'=>$request->item_group_id,
            'status_id'=>$request->status_id,
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
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
        $id = $request->item_id;
        ComplianceItem::where(['item_id'=>$id])->update(['item_disable'=>1]);
    }
}
