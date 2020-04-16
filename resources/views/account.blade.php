@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Accounts</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Data Accounts</h6>
            </div>
            <div class="col-md-6">
                <a href="#modal-addpackage" data-target="#modal-add " data-toggle="modal" class="btn btn-success btn-icon-split float-right">
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
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($data_account as $account )
                <tr>
                    
                    <td>{{$account->account_code}}</td>
                    <td>{{$account->account_name}}</td>
                    <td>{{$account->account_description}}</td>
                    <td>{{$account->account_address}}</td>
                    <td>
                        <input type="hidden" id="account_id" name="account_id" value="{{$account->account_id}}"/>
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
<div class="modal fade bd-example-modal-lg" id="modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="addForm">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group row">
                        <label for="inputPackageName" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10">
                            <input name="inputAccountCode" type="text" class="form-control" id="inputAccountCode" placeholder="Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAccountName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input name="inputAccountName" type="text" class="form-control" id="inputAccountName" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAccountDescription" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input name="inputAccountDescription" type="text" class="form-control" id="inputAccountDescription" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAccountEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input name="inputAccountEmail" type="email" class="form-control" id="inputAccountEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAccountPhone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input name="inputAccountPhone" type="text" class="form-control" id="inputAccountPhone" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAccountAddress" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <textarea rows="4" class="form-control" id="inputAccountAddress" name="inputAccountAddress"></textarea>
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
            <h5 class="modal-title">Edit Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="editForm">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group row">
                        <label for="editAccountCode" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="editAccountId" name="editAccountId" />
                            <input name="editAccountCode" type="text" class="form-control" id="editAccountCode" placeholder="Code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editAccountName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input name="editAccountName" type="text" class="form-control" id="editAccountName" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editAccountDescription" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <input name="editAccountDescription" type="text" class="form-control" id="editAccountDescription" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editAccountEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input name="editAccountEmail" type="email" class="form-control" id="editAccountEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editAccountPhone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input name="editAccountPhone" type="text" class="form-control" id="editAccountPhone" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="editAccountAddress" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <textarea rows="4" class="form-control" id="editAccountAddress" name="editAccountAddress"></textarea>
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
            <h5 class="modal-title">Delete Package</h5>
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
$(document).ready(function() {
    $('#addForm').on('submit',function(e) {
        e.preventDefault();

        $.ajax({
            type:"POST",
            url:"/account/add",
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

    $('.btn-edit').on('click',function(){
        

        var me = $(this);
        var account_id = me.parents('tr').find('#account_id').val();
        
        
        $.ajax({
            type: "GET",
            url: "/account/"+ account_id,
            dataType: "json",
            data: {_token: "{{csrf_token()}}"},
            success: function(data){
                console.log(data)
                $('#editAccountId').val(account_id);
                $('#editAccountCode').val(data[0].account_code);
                $('#editAccountName').val(data[0].account_name);
                $('#editAccountDescription').val(data[0].account_description);
                $('#editAccountEmail').val(data[0].account_email);
                $('#editAccountAddress').val(data[0].account_address);
                $('#editAccountPhone').val(data[0].account_phone);

                $('#modal-edit').modal('show');
            },
            error: function(error){
                console.log(error)
                
            }

        });

    });

    $('#editForm').on('submit',function(e){
        e.preventDefault();

        
        $.ajax({
            type: "POST",
            url: "/account/update",
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

    $('.btn-delete').on('click',function(){
        $('#modal-delete').modal('show');

        var me = $(this);
        var account_id = me.parents('tr').find('#account_id').val();

        $('#deleteId').val(account_id);


    });


    $('#deleteForm').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/account/delete",
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

    $('.modal').on('hidden.bs.modal',function(e){
        $(this).find('form')[0].reset();
    });

})
</script>
@endsection