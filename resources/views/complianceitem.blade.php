@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Items</h1>
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
                @foreach ($data_compliancepackages as $compliancepackage)
                <option value="{{$compliancepackage->packages_id}}">{{$compliancepackage->packages_name}}</option>
                @endforeach
            </select>
            <div class="col-md-2">
                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2">Item Group</label>
            <select class="form-control col-md-8" id="filter_itemgroup" name="filter_itemgroup">
                
            </select>
            <div class="col-md-2">
            <button type="button" class="btn btn-primary btn-block" id="btnfilter" name="btnfilter">Filter</button>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="item_table" name="item_table" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Item Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Item Name</th>
                <th>Item Description</th>
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
            <h5 class="modal-title">New Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="addForm">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                    <label for="inputPackageId" class="col-sm-2 control-label">Package</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="inputPackageId" name="inputPackageId">
                        @foreach ($data_compliancepackages as $compliancepackage)
                            <option value="{{$compliancepackage->packages_id}}">{{$compliancepackage->packages_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputItemGroupId" class="col-sm-2 control-label">Item Group</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="inputItemGroupId" name="inputItemGroupId">
                        
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputItemName" class="col-sm-2 control-label">Item Name</label>
                    <div class="col-sm-10">
                        <input name="inputItemName" type="text" class="form-control" id="inputItemName" placeholder="Item Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputItemDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="inputItemDescription" type="text" class="form-control" id="inputItemDescription" placeholder="Description">
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
            <h5 class="modal-title">Edit Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
           
        <form class="form-horizontal" id="editForm">
            {{csrf_field()}}
            <div class="modal-body">
            <div class="box-body">
                <div class="form-group row">
                    <label for="editPackageId" class="col-sm-2 control-label">Package</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="editPackageId" name="editPackageId">
                        @foreach ($data_compliancepackages as $compliancepackage)
                            <option value="{{$compliancepackage->packages_id}}">{{$compliancepackage->packages_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editItemGroupId" class="col-sm-2 control-label">Item Group</label>
                    <div class="col-sm-10">
                        <select class="form-control col-md-8" id="editItemGroupId" name="editItemGroupId">
                        
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editItemName" class="col-sm-2 control-label">Item Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="editItemId" name="editItemId"/>
                        <input name="editItemName" type="text" class="form-control" id="editItemName" placeholder="Item Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editItemDescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input name="editItemDescription" type="text" class="form-control" id="editItemDescription" placeholder="Description">
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
            <h5 class="modal-title">Delete Item</h5>
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

function loadDataTable(item_group_id) {
    if ($.fn.DataTable.isDataTable('#item_table')) {
        $('#item_table').DataTable().destroy();
    }

    $('#item_table').DataTable({
        ajax: {
            url: "complianceitem/getitemjson/"+ item_group_id,
            dataSrc:"",
            dataType: "json",
            type: "GET",
            data:{_token: "{{csrf_token()}}"},
            complete:function(result){
                console.log(result);
            }
        },
        columns:[ 
            { "data": "item_name","name":"item_name" },
            { "data": "item_description","name":"item_description"},
            { render:function (data,type,row) {
                content = '<input type="hidden" id="item_id" name="item_id" value="'+row['item_id'] +'"/>'
                        + '<input type="hidden" id="item_group_id" name="item_group_id" value="'+row['item_group_id'] +'"/>'  
                        + '<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit">'
                        + '<button type="button" class="btn btn-info btn-circle btn-edit"><i class="fa fa-list"></i></button></span> '
                        + '<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete">'
                        + '<button type="button" class="btn btn-danger btn-circle btn-delete"><i class="fas fa-trash"></i></button></span>';
                return content;
            }}
        ]
    })
}

function loadSelectItemGroup(packages_id,div,callback){
    var div = $(div)
    var op = "";
    $.ajax({
        url: "complianceitemgroup/getitemjson/"+ packages_id,
        dataType: "json",
        type: "GET",
        data:{_token: "{{csrf_token()}}"},
        success:function(data) {

            for (let index = 0; index < data.length; index++) {
                op += '<option value="'+data[index].item_group_id+'">'+data[index].item_group_name+'</option>';
            }
            div.html("");
            div.append(op);

            callback();
        }
    })
};

function openModalAdd() {
    $('#modal-add').modal('show');

    var packages_id = $("select[name='inputPackageId'] option:selected").val(); 
    loadSelectItemGroup(packages_id,'#inputItemGroupId',function() {});
}

$(document).ready(function() {
    var packages_id = $("#filter_package :selected").val();

    loadSelectItemGroup(packages_id,'#filter_itemgroup',function() {});

    var item_group_id = $("select[name='filter_itemgroup'] option:selected").val(); 
    
    loadDataTable(item_group_id);


    $('#filter_package').on('change',function() {
        loadSelectItemGroup(this.value,'#filter_itemgroup',function() {});
    })

    $('#inputPackageId').on('change',function() {
        loadSelectItemGroup(this.value,'#inputItemGroupId',function() {});
    })

    $('#btnfilter').on('click',function () {
        var item_group_id = $("select[name='filter_itemgroup'] option:selected").val(); 
        loadDataTable(item_group_id);
    });

    $('.modal').on('hidden.bs.modal',function(e){
        $(this).find('form')[0].reset();
    });

    $('#addForm').on('submit',function(e) {
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"/complianceitem/add",
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

    $('#item_table').on('click','.btn-edit',function() {
        
        var package_id = $('#filter_package').val(); 
        $('#editPackageId').val(package_id);

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        loadSelectItemGroup(package_id,'#editItemGroupId',function() {
           
            var item_id = $('#item_id').val(); 
            var item_group_id = $('#item_group_id').val();  
                       
            $('#editItemGroupId').val(item_group_id);
            $('#editItemId').val(item_id);
            $('#editItemName').val(data[0]);
            $('#editItemDescription').val(data[1]);

            $('#modal-edit').modal('show');
        });
    });

    $('#editForm').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/complianceitem/update",
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

    $('#item_table').on('click','.btn-delete',function() {
        $('#modal-delete').modal('show');

        var me = $(this);
        var item_id = me.parents('tr').find('#item_id').val();

        $('#deleteId').val(item_id);
    });

    $('#deleteForm').on('submit',function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/complianceitem/delete",
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