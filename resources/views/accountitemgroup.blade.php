@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Item Groups</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Data Item Groups</h6>
            </div>
            <div class="col-md-6">
                <a href="#" onClick="openModalAdd();" class="btn btn-success btn-icon-split float-right">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2">Package</label>
            <select class="form-control col-md-8" id="filter_package" name="filter_package">
            @foreach ($data_accountpackage as $accountpackage)
                <option value="{{$accountpackage->packages_id}}">{{$accountpackage->accountPackagesToPackages->packages_name}}</option>
            @endforeach
            </select>
            <div class="col-md-2">
            <button type="button" class="btn btn-primary btn-block" id="btnfilter" name="btnfilter">Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="itemgroup_table" name="itemgroup_table" width="100%s" cellspacing="0">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Group Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Group Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                
            </table>
        </div>
    </div>
</div>


<!-- Modal Add -->
<div class="modal fade bd-example-modal-lg" id="modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Item Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="addForm">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                    <label for="inputPackageName" class="col-sm-2 control-label">Package</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="inputPackageId" name="inputPackageId">
                        @foreach ($data_accountpackage as $accountpackage)
                            <option value="{{$accountpackage->packages_id}}">{{$accountpackage->accountPackagesToPackages->packages_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputItemGroupName" class="col-sm-2 control-label">Group Name</label>
                    <div class="col-sm-10">
                        <input name="inputItemGroupName" type="text" class="form-control" id="inputItemGroupName" placeholder="Group Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputItemGroupDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="inputItemGroupDescription" type="text" class="form-control" id="inputItemGroupDescription" placeholder="Description">
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
<div class="modal fade bd-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Item Group</h5>
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
                        <input type="hidden" id="editAccountItemGroupId" name="editAccountItemGroupId"/>
                        <input name="editPackageName" type="text" class="form-control" id="editPackageName" placeholder="Group Name" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editAccountItemGroupName" class="col-sm-2 control-label">Group Name</label>
                    <div class="col-sm-10">
                        <input name="editAccountItemGroupName" type="text" class="form-control" id="editAccountItemGroupName" placeholder="Group Name" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editAccountItemGroupDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="editAccountItemGroupDescription" type="text" class="form-control" id="editAccountItemGroupDescription" placeholder="Description" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editStatusId" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="editStatusId" name="editStatusId">
                        @foreach ($data_status as $status)
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

function loadDataTable(package_id) {
    if ($.fn.DataTable.isDataTable('#itemgroup_table')) {
        $('#itemgroup_table').DataTable().destroy();
    }

    
    $('#itemgroup_table').DataTable({
        ajax: {
            url: "accountitemgroup/getitemjson/"+ package_id,
            dataSrc:"",
            dataType: "json",
            type: "GET",
            data:{_token: "{{csrf_token()}}"},
            complete:function(result){
                console.log(result);
            }
        },
        columns:[
            { render:function(data,type,row) {
                if (row['status_id']==2) {
                    content = '<div class="py-2 bg-success text-white text-center">'+row['account_itemg_group_to_status']['status_name']+'</div>';
                }else{
                    content = '<div class="py-2 bg-warning text-white text-center">'+row['account_itemg_group_to_status']['status_name']+'</div>';
                }

                return content;
            }},
            { "data": "account_item_group_to_item_group.item_group_name","name":"item_group_name" },
            { "data": "account_item_group_to_item_group.item_group_description","name":"item_group_description"},
            { render:function (data,type,row) {
                content = '<input type="hidden" id="account_item_group_id" name="account_item_group_id" value="'+row['id'] +'"/>'
                        + '<input type="hidden" id="status_id" name="status_id" value="'+row['status_id'] +'"/>'  
                        + '<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit">'
                        + '<button type="button" class="btn btn-info btn-circle btn-edit"><i class="fa fa-list"></i></button></span> '
                        + '<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete">'
                        + '<button type="button" class="btn btn-danger btn-circle btn-delete"><i class="fas fa-trash"></i></button></span>';
                return content;
            }}
        ]
    })
}

function openModalAdd(){
    $('#modal-add').modal('show');

    

}


$(document).ready(function(){
    var packages_id = $("#filter_package :selected").val();

    loadDataTable(packages_id);

    $('#btnfilter').on('click',function () {
        var packages_id = $("#filter_package :selected").val();
        loadDataTable(packages_id);
    });

    $('.modal').on('hidden.bs.modal',function(e){
        $(this).find('form')[0].reset();
    });

    $('#addForm').on('submit',function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"/complianceitemgroup/add",
            data:$('#addForm').serialize(),
            success:function(response) {
                if (response.fail) {
                    console.log(response.errors);
                    $.each(response.errors, function( key, value ) {
                        $( "[name*='"+key+"']" ).parents('.col-sm-10').append('<span class="text-red">'+value+'</span>');
                    })
                }else {
                    console.log(response)
                    $('#modal-add').modal('hide')
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

    $('#itemgroup_table').on('click','.btn-edit',function() {
        $('#modal-edit').modal('show');

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        var me = $(this);
        
        var itemPackageName = $("#filter_package :selected").text();
        var account_item_group_id = me.parents('tr').find('#account_item_group_id').val();
        var status_id = me.parents('tr').find('#status_id').val();

        $('#editAccountItemGroupId').val(account_item_group_id);
        $('#editStatusId').val(status_id);
        $('#editPackageName').val(itemPackageName);
        $('#editItemGroupName').val(data[1]);
        $('#editItemGroupDescription').val(data[2]);
    });

    $('#editForm').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/accountitemgroup/update",
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

    $('#itemgroup_table').on('click','.btn-delete',function() {
        $('#modal-delete').modal('show');

        var me = $(this);
        var account_item_group_id = me.parents('tr').find('#account_item_group_id').val();

        $('#deleteId').val(account_item_group_id);
    });

    $('#deleteForm').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/accountitemgroup/delete",
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