<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\AccountPackage;
use App\AccountItem;
use App\AccountItemGroup;
use App\ItemStatus;
use App\ComplianceItemGroup;
use App\ComplianceItem;

class AccountPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data_accountpackage= AccountPackage::where('isdisable',0)->get();
        $data_itemstatus = ItemStatus::where('status_disable',0)->get();
        return view('accountpackage',['data_accountpackage' => $data_accountpackage,'data_itemstatus' => $data_itemstatus]);

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
                    'inputAccountId' => 'required',
                    'inputPackageId' => 'required'
                ]
            );
        if ($validator->fails()){
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        }else{

            $rowcount = AccountPackage::where('account_id','=',$request->input('inputAccountId'))
                                                ->where('packages_id','=',$request->input('inputPackageId'))->get()->count();
            
            if ($rowcount > 0) {
                return array(
                    'fail' => true,
                    'errors' => 'Packages already add'
                );
            }

            $packages_id = $request->input('inputPackageId');
            $account_id = $request->input('inputAccountId');
            $accountPackage = new AccountPackage;
            $accountPackage->account_id = $account_id;
            $accountPackage->packages_id = $packages_id ;
            $accountPackage->status_id = 1;
            $accountPackage->isdisable = 0;
            $accountPackage->save();

            $data_complianceItemGroup = ComplianceItemGroup::where('packages_id','=',$packages_id)
                                                            ->where('item_group_disable','=',0)->get();
            
            foreach ($data_complianceItemGroup as $complianceItemGroup) {
                $data_complianceItem = ComplianceItem::where('item_group_id',$complianceItemGroup->item_group_id)
                                                        ->where('item_disable',0)->get();

                $accountItemGroup = new AccountItemGroup;
                $accountItemGroup->account_id = $account_id;
                $accountItemGroup->packages_id = $packages_id;
                $accountItemGroup->item_group_id = $complianceItemGroup->item_group_id;
                $accountItemGroup->status_id = 1;
                $accountItemGroup->isdisable = 0;
                $accountItemGroup->save();
                
                foreach ($data_complianceItem as $complianceItem) {
                    $accountItem = new AccountItem;
                    $accountItem->account_id = $account_id;
                    $accountItem->packages_id = $packages_id;
                    $accountItem->item_group_id = $complianceItemGroup->item_group_id;
                    $accountItem->item_id = $complianceItem->item_id;
                    $accountItem->status_id = 1;
                    $accountItem->suggested_approach = "";
                    $accountItem->notes = "";
                    $accountItem->isdisable = 0;
                    $accountItem->save();
                }
            }
            
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
        $id = $request->editAccountPackageId;
        $data_update = array(
            'status_id'=>$request->editStatusId,
        );
        AccountPackage::where(['id'=>$id])->update($data_update);
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
        AccountPackage::where(['id'=>$id])->update(['isdisable'=>1]);
    }

    public function updatestatus($id, $statusid)
    {
        
        $data_update = array(
            'status_id' => $statusid
        );
        AccountPackage::where(['id'=>$id])->update($data_update);
    }


    
}
