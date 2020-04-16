<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $data_dashboard = DB::table('vw_report_dashboard')->get();

        if (Auth::user()->account_id==0) {
            return view('home',['data_dashboard' => $data_dashboard,'status' => 'Admin']);
        }else {
            $status = Auth::user()->account_id;
            return view('home',['data_dashboard' => $data_dashboard,'status' => $status]);
        }


        
    }
}
