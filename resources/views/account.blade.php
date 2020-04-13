@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Account</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Account</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <td width="30%">Code</td>
                        <td width="5%">:</td>
                        <td width="65%">
                        <input type="hidden" id="account_id" name="account_id" value="{{$data_account->account_id}}"/>
                        <strong>{{$data_account->account_code}}</strong></td> 
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
        <div class="row">
            <p>
                <button type="button" class="btn btn-primary" id="btn-edit-account">Edit Account</button>
                <button type="button" class="btn btn-success" id="btn-add-packages">Add Packages</button>
            </p>
            
        </div>
        <br>
        <div class="row">
            
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
                    @foreach($data_account_package as $account_package )
                        <tr>
                            
                            <td>{{$account_package->accountPackagesToPackages->packages_name}}</td>
                            <td>{{$account_package->accountPackagesToStatus->status_name}}</td>
                            <td>
                                <input type="hidden" id="account_package_id" name="account_package_id" value="{{$account_package->id}}"/>
                                <!-- <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Add">
                                <button type="button" class="btn btn-info btn-circle btn-edit"><i class="fa fa-list"></i></button>
                                </span> -->

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
</div>

<!-- Modal Add Package -->
<div class="modal fade bd-example-modal-lg" id="modal-add-package" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="package_table" name="package_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Package Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Package Name</th>
                            <th>Package Description</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        
                    </table>
                </div>
            </div>
        
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

function openModalPackage() {
    if ($.fn.DataTable.isDataTable('#package_table')) {
        $('#package_table').DataTable().destroy();
    }

    $('#package_table').DataTable({
        ajax: {
            url: "compliancepackage/getJson",
            dataSrc:"",
            dataType: "json",
            type: "GET",
            data:{_token: "{{csrf_token()}}"},
            complete:function(result){
                // console.log(result);
            }
        },
        columns:[ 
            { "data": "packages_name","name":"packages_name" },
            { "data": "packages_description","name":"packages_description"},
            { render:function (data,type,row) {
                content = '<input type="hidden" id="packages_id" name="packages_id" value="'+row['packages_id'] +'"/>'
                        + '<button type="button" class="btn btn-success btn-add-packages-modal">Add</button>';
                        
                return content;
            }}
        ],
        initComplete: function(settings,json) {
            $('#modal-add-package').modal('show');
        }
    })

    
       
}

$(document).ready(function() {
    $('#btn-add-packages').on('click',function() {
        openModalPackage(0);
    })

    $('#package_table').on('click','.btn-add-packages-modal',function() {
        var me = $(this);
        var packages_id = me.parents('tr').find('#packages_id').val();
        var account_id = $('#account_id').val();

        var formData = new FormData();
        formData.append('inputAccountId',account_id);
        formData.append('inputPackageId',packages_id);
        formData.append('_token', "{{csrf_token()}}");
        

        $.ajax({
            url: "accountpackage/add",
            type: "POST",
            data:formData,
            processData: false,
            contentType: false,
            success:function(response) {
                if (response.fail) {
                    
                    alert(response.errors);
                    
                }else {
                    console.log(response)
                    $('#modal-add-package').modal('hide');
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

    $('#dataTable').on('click','.btn-delete',function() {
        $('#modal-delete').modal('show');

        var me = $(this);
        var accountpackage_id = me.parents('tr').find('#account_package_id').val();

        $('#deleteId').val(accountpackage_id);
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