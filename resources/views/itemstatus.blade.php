@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Item Status</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Item Status</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Status ID</th>
                <th>Status Name</th>
                <th>Status Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Status ID</th>
                <th>Status Name</th>
                <th>Status Description</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($data_itemstatus as $itemstatus)
            <tr>
                <td id="status_id">{{$itemstatus->status_id}}</td>
                <td>{{$itemstatus->status_name}}</td>
                <td>{{$itemstatus->status_description}}</td>
                <td>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit">
                    <button type="button" class="btn btn-warning btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>
                    </span>

                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete">
                    <button type="button" class="btn btn-danger btn-sm btn-delete"><span class="glyphicon glyphicon-trash"></span></button>
                    </span>


                    <button type="button" class="btn btn-success btn-sm btn-info"><span class="glyphicon glyphicon-cloud"></span></button>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>
@endsection