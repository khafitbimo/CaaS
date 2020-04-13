<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\AccountPackage;
use App\AccountItemGroup;
use App\ItemStatus;
use App\AccountItem;

class AccountItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_account = Account::first();
        $account_id = $data_account->account_id;

        $data_accountpackage = AccountPackage::where('account_id','=',$account_id)
                                                ->where('isdisable','=',0)->get();
        
        $data_status = ItemStatus::where('status_disable',0)->get();

        return view('accountitem',['data_accountpackage' => $data_accountpackage,'data_status'=>$data_status]);
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
        $id = $request->editAccountItemId;
        $data_update = array(
            'status_id'=>$request->editStatusId,
            'suggested_approach'=>$request->editItemSuggestedApproach
        );
        AccountItem::where(['id'=>$id])->update($data_update);
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
    }

    public function delete(Request $request)
    {
        $id = $request->deleteId;
        AccountItem::where(['id'=>$id])->update(['isdisable'=>1]);
    }

    public function getItemGroupByItemGroupId($itemgroup_id)
    {
        $data_account = Account::first();
        $account_id = $data_account->account_id;

        $accountitem = AccountItem::with(['accountItemToItem','accountItemToStatus'])
                                                ->where('account_id','=',$account_id)
                                                ->where('item_group_id','=',$itemgroup_id)
                                                ->where('isdisable','=',0)->get();
        return response($accountitem);
    }
}
