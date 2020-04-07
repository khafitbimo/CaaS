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

function loadSelectItemGroup(packages_id){
    var div = $('#filter_itemgroup')
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
        }
    })
}

$(document).ready(function() {
    var packages_id = $("#filter_package :selected").val();

    loadSelectItemGroup(packages_id);

    var item_group_id = $("select[name='filter_itemgroup'] option:selected").val(); 
    loadDataTable(item_group_id);


    $('#filter_package').on('change',function() {
        loadSelectItemGroup(this.value);
    })

    $('#btnfilter').on('click',function () {
        var item_group_id = $("select[name='filter_itemgroup'] option:selected").val(); 
        loadDataTable(item_group_id);
    });
})

</script>
@endsection