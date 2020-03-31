<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\ItemStatus;

class ItemStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_itemstatus = ItemStatus::where('status_disable',0)->get();
        return view('itemstatus',['data_itemstatus' => $data_itemstatus]);
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
                    'status_name' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{
            $itemStatus = new ItemStatus;
            $itemStatus->status_name = $request->input('status_name');
            $itemStatus->status_description = $request->input('status_description');
            $itemStatus->save();
            
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
        $id = $request->status_id;
        $data_update = array(
            'status_name' => $request->status_name,
            'status_description'=>$request->status_description
        );
        ItemStatus::where(['status_id'=>$id])->update($data_update);
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
        $itemStatus = ItemStatus::find($id);
        $itemStatus->status_disable = 1;
        $itemStatus->save();
    }

    public function delete(Request $request)
    {
        $id = $request->status_id;
        ItemStatus::where(['status_id'=>$id])->update(['status_disable'=>1]);
    }
}
