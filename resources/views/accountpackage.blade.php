@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Packages</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
        <div class="col-md-6">
            <h6 class="m-0 font-weight-bold text-primary">Data Packages</h6>
        </div>
        <div class="col-md-6">
            @if(Auth::user()->roles==1)
            <a href="#modal-addpackage" data-target="#modal-addpackage" data-toggle="modal" class="btn btn-success btn-icon-split float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add</span>
            </a>
            @endif
            
        </div>
        </div>
        
        
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Status</th>
                <th>Packages Name</th>
                <th>Packages Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Status</th>
                <th>Packages Name</th>
                <th>Packages Description</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($data_accountpackage as $accountpackage )
                <tr>
                    <td>
                        <div class="dropdown no-arrow mb-4">
                        <button class="btn {{$accountpackage->accountPackagesToStatus->status_id==2?'btn-success':'btn-warning'}} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <input type="hidden" id="accountpackageid" name="accountpackageid" value="{{$accountpackage->id}}"></input>
                            {{$accountpackage->accountPackagesToStatus->status_name}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        @foreach($data_itemstatus as $itemstatus)
                            <a class="dropdown-item" href="#" onClick="updateStatus({{$itemstatus->status_id}})">{{$itemstatus->status_name}}</a>
                        @endforeach
                        
                        </div>
                        </div>
                    </td>
                    <td>{{$accountpackage->accountPackagesToPackages->packages_name}}</td>
                    <td>{{$accountpackage->accountPackagesToPackages->packages_description}}</td>
                    <td>
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit">
                        <button type="button" class="btn btn-info btn-circle btn-edit"><i class="fa fa-list"></i></button>
                        </span>

                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete">
                        <button type="button" class="btn btn-danger btn-circle btn-delete"><i class="fas fa-trash"></i></button>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>

<div class="modal fade" id="modal-addpackage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Package</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-editpackage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Edit Package</h4>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection
@section('js')
<script>
    function updateStatus($status_id)
    {
        $accountpackageid =  $('input[name=accountpackageid]').val();

        $.ajax({
            type:"GET",
            url:"/accountpackage/updatestatus/" +$accountpackageid+"/"+$status_id ,
            success:function(response){
                console.log(response);
                location.reload();
            },
            error:function(error){
                console.log(error);
                alert('data not saved');
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        })

    }
</script>
@endsection