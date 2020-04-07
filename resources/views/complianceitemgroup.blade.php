@extends('layouts.sbadmin')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Item Groups</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-5">
                <h6 class="m-0 font-weight-bold text-primary">Data Item Groups</h6>
            </div>
            <div class="col-md-5">
                <a href="#modal-addpackage" data-target="#modal-addpackage" data-toggle="modal" class="btn btn-success btn-icon-split float-right">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span>
                </a>
            </div>
            <div class="col-md-2">
            <button type="button" id="filter" name="filter">Filter</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-2">Package</label>
            <select class="form-control col-md-10" id="filter_package" name="filter_package">
            
            </select>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="itemgroup_table" name="itemgroup_table" width="100%s" cellspacing="0">
            <thead>
            <tr>
                <th>item_group_id</th>
                <th>packages_id</th>
                <th>item_group_name</th>
                <th>item_group_description</th>
                <th>item_group_implemented</th>
                <th>item_group_disable</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
            <th>item_group_id</th>
                <th>packages_id</th>
                <th>item_group_name</th>
                <th>item_group_description</th>
                <th>item_group_implemented</th>
                <th>item_group_disable</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
            </tfoot>
            
        </table>
        </div>
    </div>
    </div>
@endsection
@section('js')
<script>



function loadDataTable() {
    // if ($.fn.DataTable.isDataTable('#itemgroup_table')) {
    //     $('#itemgroup_table').DataTable().destroy();
    // }

    
    $('#itemgroup_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "complianceitemgroup/getitemjson",
            dataSrc:"",
            dataType: "json",
            type: "POST",
            data:{_token: "{{csrf_token()}}"},
            complete:function(result){
                console.log(result);
            }
        },
        columns:[
            { "data": "item_group_id","name":"item_group_id"},
            { "data": "packages_id","name":"packages_id"},
            { "data": "item_group_name","name":"item_group_name" },
            { "data": "item_group_description","name":"item_group_description"},
            { "data": "item_group_implemented","name":"item_group_implemented"},
            { "data": "item_group_disable","name":"item_group_disable"},
            { "data": "created_at","name":"created_at"},
            { "data": "updated_at","name":"updated_at"}
        ]
    })
}


$(document).ready(function(){
    loadDataTable();
    

    // $('#filter').click(function() {
    //     var filter_package = $('#filter_package').val();

    //     if (filter_package != '') {
    //         $('#itemgroup_table').DataTable().destroy();
    //         loadDataTable(filter_package);
    //     }else{
    //         $('#itemgroup_table').DataTable().destroy();
    //         loadDataTable();
    //     }
    // })
})

</script>
@endsection