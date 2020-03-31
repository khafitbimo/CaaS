@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <table id="tbl_compliancepackage" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Packages ID</th>
                                    <th>Packages Name</th>
                                    <th>Packages Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data_compliancepackage as $compliancepackage )
                                <tr>
                                    <td id="packages_id">{{$compliancepackage->packages_id}}</td>
                                    <td>{{$compliancepackage->packages_name}}</td>
                                    <td>{{$compliancepackage->packages_description}}</td>
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
                                    <th>Packages ID</th>
                                    <th>Packages Name</th>
                                    <th>Packages Description</th>
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