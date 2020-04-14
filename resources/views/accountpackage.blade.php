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
                        <div class="py-2 bg-{{$accountpackage->accountPackagesToStatus->status_id==2?'success':'warning'}} text-white text-center">
                            {{$accountpackage->accountPackagesToStatus->status_name}}

                        </div>
                        
                    </td>
                    <td>{{$accountpackage->accountPackagesToPackages->packages_name}}</td>
                    <td>{{$accountpackage->accountPackagesToPackages->packages_description}}</td>
                    <td>
                        <input type="hidden" id="account_package_id" name="account_package_id" value="{{$accountpackage->id}}"/>
                        <input type="hidden" id="status_id" name="status_id" value="{{$accountpackage->status_id}}"/>
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


<!-- Modal Edit -->
<div class="modal fade bd-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="editForm">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
            <div class="form-group row">
                    <label for="editPackageName" class="col-sm-2 control-label">Package</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="editAccountPackageId" name="editAccountPackageId"/>
                        <input name="editPackageName" type="text" class="form-control" id="editPackageName" placeholder="Package" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editPackageDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="editPackageDescription" type="text" class="form-control" id="editPackageDescription" placeholder="Description" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editStatusId" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="editStatusId" name="editStatusId">
                        @foreach ($data_itemstatus as $status)
                            <option value="{{$status->status_id}}">{{$status->status_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
 
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Item Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" id="deleteForm">
          {{csrf_field()}}
          <div class="modal-body">
            <div class="box-body">
              <input type="hidden" name="deleteId" id="deleteId">
              <p> Are you sure want to Delete this data ? </p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Delete</button>
          </div>
        </form>
      </div>
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

};

$(document).ready(function() {
    $('.modal').on('hidden.bs.modal',function(e){
        $(this).find('form')[0].reset();
    });

    $('#dataTable').on('click','.btn-edit',function() {
        $('#modal-edit').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        var me = $(this);
        
        var account_package_id = me.parents('tr').find('#account_package_id').val();
        var status_id = me.parents('tr').find('#status_id').val();

        $('#editAccountPackageId').val(account_package_id);
        $('#editStatusId').val(status_id);
        $('#editPackageName').val(data[1]);
        $('#editPackageDescription').val(data[2]);
    });

    $('#editForm').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/accountpackage/update",
            data: $('#editForm').serialize(),
            success: function(response){
                console.log(response)
                $('#modal-edit').modal('hide')
                alert("Data Updated");
                location.reload();
            },
            error: function(error){
                console.log(error)
                alert("Data Not Saved");
            }

        });
    });

    $('#dataTable').on('click','.btn-delete',function() {
        $('#modal-delete').modal('show');

        var me = $(this);
        var account_package_id = me.parents('tr').find('#account_package_id').val();

        $('#deleteId').val(account_package_id);
    });

    $('#deleteForm').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/accountpackage/delete",
            data: $('#deleteForm').serialize(),
            success: function(response){
                console.log(response)
                $('#modal-delete').modal('hide')
                alert("Data Deleted");
                location.reload();
            },
            error: function(error){
                console.log(error)
                alert("Data Not Deleted");
            }

        });
    });

})
</script>
@endsection