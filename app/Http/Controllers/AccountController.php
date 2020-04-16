<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Account;
use App\AccountPackage;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if (Auth::user()->account_id==0) {
           
            $data_account = Account::where('account_disable',0)
                                ->orderBy('account_name','ASC')
                                ->get();
            return view('account',['data_account' => $data_account]);
        }else {
            $account_id = Auth::user()->account_id;
            $data_account = Account::where('account_disabe','=',0)
                                    ->where('account_id','=',$account_id)
                                    ->get();
            
            return view();
        }
        
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
            'inputAccountCode' => 'required|unique:accounts,account_code',
            'inputAccountName' => 'required'
        ]);
        if($validator->fails()){
            return array(
                'fail'=>true,
                'errors'=>$validator->errors()
            );
        }else{
            $account = new Account;
            $account->account_code = $request->input('inputAccountCode');
            $account->account_name = $request->input('inputAccountName');
            $account->account_description = $request->input('inputAccountDescription');
            $account->account_email = $request->input('inputAccountEmail');
            $account->account_address = $request->input('inputAccountAddress');
            $account->account_phone = $request->input('inputAccountPhone');
            $account->save();

            return array(
                'fail'=>false
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

     
            $id = $request->editAccountId;

            $data_update = array(
                'account_code' => $request->editAccountCode,
                'account_name'=>$request->editAccountName,
                'account_description'=>$request->editAccountDescription,
                'account_email'=>$request->editAccountEmail,
                'account_address'=>$request->editAccountAddress,
                'account_phone'=>$request->editAccountPhone
            );
            Account::where(['account_id'=>$id])->update($data_update);

          
       
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
        Account::where(['account_id'=>$id])->update(['account_disable'=>1]);
    }

    public function getAccountById($id)
    {
        $account = Account::where('account_id',$id)->get();
        return response($account);
    }
}
