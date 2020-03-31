@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <table id="tbl_complianceitemgroup" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item Group ID</th>
                                    <th>Packages ID</th>
                                    <th>Item Group Name</th>
                                    <th>Item Group Description</th>
                                    <th>Item Group Implemented</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data_complianceitemgroup as $complianceitemgroup)
                                <tr>
                                    <td id="item_group_id">{{$complianceitemgroup->item_group_id}}</td>
                                    <td>{{$complianceitemgroup->packages_id}}</td>
                                    <td>{{$complianceitemgroup->item_group_name}}</td>
                                    <td>{{$complianceitemgroup->item_group_description}}</td>
                                    <td>{{$complianceitemgroup->item_group_implemented}}</td>
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
                                    <th>Item Group ID</th>
                                    <th>Packages ID</th>
                                    <th>Item Group Name</th>
                                    <th>Item Group Description</th>
                                    <th>Item Group Implemented</th>
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