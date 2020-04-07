@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profile Account</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Item Status</h6>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered"  width="100%" cellspacing="0">
            <tbody>
            <tr>
                <td width="30%">Code</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_code}}</strong></td> 
            </tr>
            <tr>
                <td width="30%">Name</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_name}}</strong></td> 
            </tr>
            <tr>
                <td width="30%">Description</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_description}}</strong></td> 
            </tr>
            <tr>
                <td width="30%">Email</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_email}}</strong></td> 
            </tr>
            <tr>
                <td width="30%">Address</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_address}}</strong></td> 
            </tr>
            <tr>
                <td width="30%">Phone</td>
                <td width="5%">:</td>
                <td width="65%"><strong>{{$data_account->account_phone}}</strong></td> 
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
@endsection