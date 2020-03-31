@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <table id="tbl_complianceitem" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Group ID</th>
                                    <th>Status ID</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data_complianceitem as $complianceitem )
                                <tr>
                                    <td id="item_id">{{$complianceitem->item_id}}</td>
                                    <td>{{$complianceitem->item_group_id}}</td>
                                    <td>{{$complianceitem->status_id}}</td>
                                    <td>{{$complianceitem->item_name}}</td>
                                    <td>{{$complianceitem->item_description}}</td>
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
                            <tfoot>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Group ID</th>
                                    <th>Status ID</th>
                                    <th>Item Name</th>
                                    <th>Item Description</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection