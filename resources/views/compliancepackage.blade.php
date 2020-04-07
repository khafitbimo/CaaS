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
                <a href="#modal-addpackage" data-target="#modal-addpackage" data-toggle="modal" class="btn btn-success btn-icon-split float-right">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Packages Name</th>
                <th>Packages Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Packages Name</th>
                <th>Packages Description</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($data_compliancepackage as $compliancepackage )
                <tr>
                    
                    <td>{{$compliancepackage->packages_name}}</td>
                    <td>{{$compliancepackage->packages_description}}</td>
                    <td>
                        <input type="hidden" id="package_id" name="package_id" value="{{$compliancepackage->packages_id}}"/>
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

<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="modal-addpackage" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="addFormPackage">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                    <label for="inputPackageName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input name="inputPackageName" type="text" class="form-control" id="inputPackageName" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPackageDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="inputPackageDescription" type="text" class="form-control" id="inputPackageDescription" placeholder="Description">
                    </div>
                </div>
 
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade bd-example-modal-lg" id="modal-editpackage" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="editFormPackage">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                    <label for="editPackageName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="editPackageId" name="editPackageId"/>
                        <input name="editPackageName" type="text" class="form-control" id="editPackageName" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editPackageDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="editPackageDescription" type="text" class="form-control" id="editPackageDescription" placeholder="Description">
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

<div class="modal fade" id="modal-deletepackage">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Package</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form-horizontal" id="deleteFormPackage">
          {{csrf_field()}}
          <div class="modal-body">
            <div class="box-body">
              <input type="hidden" name="deletePackageId" id="deletePackageId">
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
$(document).ready(function() {
    $('#addFormPackage').on('submit',function(e) {
        e.preventDefault();

        $.ajax({
            type:"POST",
            url:"/compliancepackage/add",
            data:$('#addFormPackage').serialize(),
            success:function(response) {
                if (response.fail) {
                    console.log(response.errors);
                    $.each(response.errors, function( key, value ) {
                        $( "[name*='"+key+"']" ).parents('.col-sm-10').append('<span class="text-red">'+value+'</span>');
                    })
                }else {
                    console.log(response)
                    $('#modal-addpackage').modal('hide')
                    alert('Data Saved');
                    location.reload();
                }
            },
            error: function(error){
                console.log(error)
                alert("Data Not Saved");
            }
        })
    });

    $('.btn-edit').on('click',function(){
        $('#modal-editpackage').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        var me = $(this);
        var package_id = me.parents('tr').find('#package_id').val();
        $('#editPackageId').val(package_id);
        $('#editPackageName').val(data[0]);
        $('#editPackageDescription').val(data[1]);

    });

    $('#editFormPackage').on('submit',function(e){
        e.preventDefault();


        $.ajax({
            type: "POST",
            url: "/compliancepackage/update",
            data: $('#editFormPackage').serialize(),
            success: function(response){
                console.log(response)
                $('#modal-editpackage').modal('hide')
                alert("Data Updated");
                location.reload();
            },
            error: function(error){
                console.log(error)
                alert("Data Not Saved");
            }

        });
    });

    $('.btn-delete').on('click',function(){
        $('#modal-deletepackage').modal('show');

        var me = $(this);
        var package_id = me.parents('tr').find('#package_id').val();

        $('#deletePackageId').val(package_id);


    });


    $('#deleteFormPackage').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/compliancepackage/delete",
            data: $('#deleteFormPackage').serialize(),
            success: function(response){
                console.log(response)
                $('#modal-deletepackage').modal('hide')
                alert("Data Deleted");
                location.reload();
            },
            error: function(error){
                console.log(error)
                alert("Data Not Deleted");
            }

        });
    });

    $('.modal').on('hidden.bs.modal',function(e){
        $(this).find('form')[0].reset();
    });

})
</script>
@endsection